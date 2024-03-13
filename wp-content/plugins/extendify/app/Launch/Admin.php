<?php
/**
 * Admin.
 */

namespace Extendify\Launch;

use Extendify\PartnerData;
use Extendify\Config;

/**
 * This class handles any file loading for the admin area.
 */
class Admin
{
    /**
     * The instance
     *
     * @var $instance
     */
    public static $instance = null;

    /**
     * Adds various actions to set up the page
     *
     * @return self|void
     */
    public function __construct()
    {
        // Whether to load Extendify Launch or not.
        if (!Config::$showLaunch) {
            return;
        }

        if (self::$instance) {
            return self::$instance;
        }

        self::$instance = $this;
        $this->loadScripts();
        $this->redirectOnce();
        $this->addMetaField();
    }

    /**
     * Adds a meta field so we can indicate a page was made with launch
     *
     * @return void
     */
    public function addMetaField()
    {
        \add_action(
            'init',
            function () {
                register_post_meta(
                    'page',
                    'made_with_extendify_launch',
                    [
                        'single'       => true,
                        'type'         => 'boolean',
                        'show_in_rest' => true,
                    ]
                );
            }
        );
    }

    /**
     * Adds scripts to the admin
     *
     * @return void
     */
    public function loadScripts()
    {
        \add_action(
            'admin_enqueue_scripts',
            function () {
                if (!current_user_can(Config::$requiredCapability)) {
                    return;
                }

                // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                if (!isset($_GET['page']) || $_GET['page'] !== 'extendify-launch') {
                    return;
                }

                $this->addScopedScriptsAndStyles();
            }
        );
    }


    /**
     * Redirect once to Launch, only once (at least once) when
     * the email matches the entry in WP Admin > Settings > General.
     *
     * @return void
     */
    public function redirectOnce()
    {
        \add_action('admin_init', function () {
            if (\get_option('extendify_launch_loaded', 0)
                // These are here for legacy reasons.
                || \get_option('extendify_onboarding_skipped', 0)
                || Config::$launchCompleted
            ) {
                return;
            }

            // Only redirect if we aren't already on the page.
            // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            if (isset($_GET['page']) && $_GET['page'] === 'extendify-launch') {
                return;
            }

            $user = \wp_get_current_user();
            if ($user
                // Check the main admin email, and they have an admin role.
                // phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
                && \get_option('admin_email') === $user->user_email
                && in_array('administrator', $user->roles, true)
            ) {
                \update_option('extendify_attempted_redirect', gmdate('Y-m-d H:i:s'));
                \wp_safe_redirect(\admin_url() . 'admin.php?page=extendify-launch');
            }
        });
    }

    /**
     * Adds various JS scripts
     *
     * @return void
     */
    public function addScopedScriptsAndStyles()
    {
        $version = Config::$environment === 'PRODUCTION' ? Config::$version : uniqid();
        $scriptAssetPath = EXTENDIFY_PATH . 'public/build/' . Config::$assetManifest['extendify-launch.php'];
        $fallback = [
            'dependencies' => [],
            'version' => $version,
        ];
        $scriptAsset = file_exists($scriptAssetPath) ? require $scriptAssetPath : $fallback;
        foreach ($scriptAsset['dependencies'] as $style) {
            wp_enqueue_style($style);
        }

        \wp_enqueue_script(
            Config::$slug . '-launch-scripts',
            EXTENDIFY_BASE_URL . 'public/build/' . Config::$assetManifest['extendify-launch.js'],
            $scriptAsset['dependencies'],
            $scriptAsset['version'],
            true
        );

        $globalStylesId = \WP_Theme_JSON_Resolver::get_user_global_styles_post_id();
        if (Config::$environment === 'DEVELOPMENT') {
            // In dev, reset the variaton to the default.
            wp_update_post([
                'ID' => $globalStylesId,
                'post_content' => wp_json_encode([
                    'styles' => [],
                    'settings' => [],
                    'isGlobalStylesUserThemeJSON' => true,
                    'version' => 2,
                ]),
            ]);
        }

        $skipSteps = defined('EXTENDIFY_SKIP_STEPS') ? constant('EXTENDIFY_SKIP_STEPS') : [];
        $partnerData = PartnerData::getPartnerData();
        $consentTermsUrlAI = isset($partnerData['consentTermsUrl']) ? \esc_url_raw($partnerData['consentTermsUrl']) : '';
        // Always shows on devmode, and won't show if disabled, or the consent url is missing.
        if (!array_key_exists('showAICopy', $partnerData) && Config::$environment !== 'DEVELOPMENT') {
            $skipSteps[] = 'business-information';
        }

        \wp_add_inline_script(
            Config::$slug . '-launch-scripts',
            'window.extOnbData = ' . \wp_json_encode([
                'globalStylesPostID' => $globalStylesId,
                'editorStyles' => \get_block_editor_settings([], null),
                'site' => \esc_url_raw(\get_site_url()),
                'adminUrl' => \esc_url_raw(\admin_url()),
                'pluginUrl' => \esc_url_raw(EXTENDIFY_BASE_URL),
                'home' => \esc_url_raw(\get_home_url()),
                'root' => \esc_url_raw(\rest_url(Config::$slug . '/' . Config::$apiVersion)),
                'config' => Config::$config,
                'wpRoot' => \esc_url_raw(\rest_url()),
                'nonce' => \wp_create_nonce('wp_rest'),
                'partnerLogo' => \esc_attr(PartnerData::$logo),
                'partnerName' => \esc_attr(PartnerData::$name),
                'partnerId' => \esc_attr(PartnerData::$id),
                'partnerSkipSteps' => $skipSteps,
                'consentTermsUrlAI' => $consentTermsUrlAI,
                'showLocalizedCopy' => array_key_exists('showLocalizedCopy', $partnerData),
                'devbuild' => \esc_attr(Config::$environment === 'DEVELOPMENT'),
                'version' => Config::$version,
                'siteId' => \get_option('extendify_site_id', ''),
                // Only send insights if they have opted in explicitly.
                'insightsEnabled' => defined('EXTENDIFY_INSIGHTS_URL'),
                'activeTests' => \get_option('extendify_active_tests', []),
                'wpLanguage' => \get_locale(),
                'wpVersion' => \get_bloginfo('version'),
                'siteCreatedAt' => get_user_option('user_registered', 1),
                'oldPagesIds' => $this->getLaunchCreatedPages(),
            ]),
            'before'
        );

        \wp_set_script_translations(Config::$slug . '-launch-scripts', 'extendify-local', EXTENDIFY_PATH . 'languages/js');

        \wp_enqueue_style(
            Config::$slug . '-launch-styles',
            EXTENDIFY_BASE_URL . 'public/build/' . Config::$assetManifest['extendify-launch.css'],
            [],
            Config::$version
        );

        $cssColorVars = PartnerData::cssVariableMapping();
        $cssString = implode('; ', array_map(function ($k, $v) {
            return "$k: $v";
        }, array_keys($cssColorVars), $cssColorVars));
        wp_add_inline_style(Config::$slug . '-launch-styles', "body { $cssString; }");
    }

    /**
     * Returns all the pages created by Extendify.
     *
     * @return array
     */
    public static function getLaunchCreatedPages()
    {
        $posts = get_posts([
            'numberposts' => -1,
            'post_status' => 'publish',
            'post_type' => 'page',
            // only return the ID field.
            'fields' => 'ids',
        ]);

        return array_values(array_filter(array_map(function ($post) {
            return get_post_meta($post, 'made_with_extendify_launch') ? $post : false;
        }, $posts)));
    }
}
