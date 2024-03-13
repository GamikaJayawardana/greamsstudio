<?php
/**
 * Admin.
 */

namespace Extendify\Library;

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
        if (self::$instance) {
            return self::$instance;
        }

        self::$instance = $this;
        $this->loadScripts();

        $this->registerUserMeta();
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
            function ($hook) {
                if (!current_user_can(Config::$requiredCapability)) {
                    return;
                }

                $this->maybeAddDeactivationScript();

                if (!$this->isGutenbergEditor($hook)) {
                    return;
                }

                $this->addScopedScriptsAndStyles();
            }
        );
    }

    /**
     * Makes sure we are on the correct page
     *
     * @param string $hook - An optional hook provided by WP to identify the page.
     * @return boolean
     */
    public function isGutenbergEditor($hook = '')
    {
        // Check for the post type, or on the FSE page.
        $type = isset($GLOBALS['typenow']) ? $GLOBALS['typenow'] : '';
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if (!$type && isset($_GET['postType'])) {
            // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            $type = sanitize_text_field(wp_unslash($_GET['postType']));
        }

        if (\use_block_editor_for_post_type($type)) {
            return $hook && in_array($hook, ['post.php', 'post-new.php'], true);
        }

        // Temporarily disable the library on the site editor page until the issues with 6.3 are fixed.
        return false;
    }

    /**
     * Adds various scripts and styles
     *
     * @return void
     */
    public function addScopedScriptsAndStyles()
    {
        $userInfo = \get_user_option('extendify_library_user');
        $partnerData = PartnerData::getPartnerData();
        $hasPartner = PartnerData::$id && PartnerData::$id !== 'no-partner';
        $userInfo = $userInfo ? json_decode($userInfo, true) : [
            'state' => ['openOnNewPage' => $hasPartner],
            'version' => 0,
        ];
        $siteInfo = \get_option('extendify_library_site_data', [
            'state' => ['siteType' => \get_option('extendify_siteType', new \stdClass())],
            'version' => 0,
        ]);
        $version = Config::$environment === 'PRODUCTION' ? Config::$version : uniqid();
        $scriptAssetPath = EXTENDIFY_PATH . 'public/build/' . Config::$assetManifest['extendify-library.php'];
        $fallback = [
            'dependencies' => [],
            'version' => $version,
        ];
        $scriptAsset = file_exists($scriptAssetPath) ? require $scriptAssetPath : $fallback;
        foreach ($scriptAsset['dependencies'] as $style) {
            \wp_enqueue_style($style);
        }

        \wp_register_script(
            Config::$slug . 'library-scripts',
            EXTENDIFY_BASE_URL . 'public/build/' . Config::$assetManifest['extendify-library.js'],
            $scriptAsset['dependencies'],
            $scriptAsset['version'],
            true
        );

        \wp_add_inline_script(
            Config::$slug . 'library-scripts',
            'window.extLibraryData = ' . \wp_json_encode([
                'devbuild' => Config::$environment === 'DEVELOPMENT',
                'siteId' => \get_option('extendify_site_id', ''),
                'insightsEnabled' => defined('EXTENDIFY_INSIGHTS_URL'),
                'root' => \esc_url_raw(\rest_url(Config::$slug . '/' . Config::$apiVersion)),
                'nonce' => \wp_create_nonce('wp_rest'),
                'partnerLogo' => \esc_attr(PartnerData::$logo),
                'partnerName' => \esc_attr(PartnerData::$name),
                'partnerId' => \esc_attr(PartnerData::$id),
                'showLocalizedCopy' => array_key_exists('showLocalizedCopy', $partnerData),
                'userInfo' => $userInfo,
                'siteInfo' => $siteInfo,
                'wpVersion' => \get_bloginfo('version'),
                'themeSlug' => \get_option('stylesheet'),
                'globalStylesPostID' => \WP_Theme_JSON_Resolver::get_user_global_styles_post_id(),
                'wpLanguage' => \get_locale(),
                'asset_path' => \esc_url(EXTENDIFY_URL . 'public/assets'),
            ]),
            'before'
        );

        \wp_enqueue_script(Config::$slug . 'library-scripts');
        \wp_set_script_translations(Config::$slug . 'library-scripts', 'extendify-local', EXTENDIFY_PATH . 'languages/js');

        // Inline the library styles to keep them out of the iframe live preview.
        // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
        $css = file_get_contents(
            EXTENDIFY_PATH . 'public/build/' . Config::$assetManifest['extendify-library.css']
        );
        \wp_register_style(Config::$slug, false, [], Config::$version);
        \wp_enqueue_style(Config::$slug);
        \wp_add_inline_style(Config::$slug, $css);

        $cssColorVars = PartnerData::cssVariableMapping();
        $cssString = implode('; ', array_map(function ($k, $v) {
            return "$k: $v";
        }, array_keys($cssColorVars), $cssColorVars));
        wp_add_inline_style(Config::$slug, "body { $cssString; }");
    }

    /**
     * Adds user meta to the user profile
     *
     * @return void
     */
    public function registerUserMeta()
    {
        add_action('rest_api_init', function () {
            register_rest_field('user',
                'extendify_library_user',
                [
                    'get_callback' => function ($user) {
                        return \get_user_option('extendify_library_user', $user['id']);
                    },
                    'update_callback' => function ($value, $user) {
                        return \update_user_option($user->ID, 'extendify_library_user', $value);
                    },
                    'schema' => [
                        'description' => __('Extendify Library User Settings', 'extendify-local'),
                        'type' => 'string',
                    ],
                ]
            );
        });
    }

    /**
     * Adds deactivation prompt JS script
     *
     * @return void
     */
    public function maybeAddDeactivationScript()
    {
        $screen = get_current_screen();
        if (!isset($screen->id) || $screen->id !== 'plugins') {
            return;
        }

        if (!get_option('extendify_pattern_was_imported', false)) {
            return;
        }

        $version = Config::$environment === 'PRODUCTION' ? Config::$version : uniqid();
        $scriptAssetPath = EXTENDIFY_PATH . 'public/build/' . Config::$assetManifest['extendify-deactivate.php'];
        $fallback = [
            'dependencies' => [],
            'version' => $version,
        ];
        $scriptAsset = file_exists($scriptAssetPath) ? require $scriptAssetPath : $fallback;
        foreach ($scriptAsset['dependencies'] as $style) {
            wp_enqueue_style($style);
        }

        \wp_register_script(
            Config::$slug . '-deactivate-scripts',
            EXTENDIFY_BASE_URL . 'public/build/' . Config::$assetManifest['extendify-deactivate.js'],
            $scriptAsset['dependencies'],
            $scriptAsset['version'],
            true
        );

        \wp_localize_script(
            Config::$slug . '-deactivate-scripts',
            'extendifyData',
            array_merge([
                'root' => \esc_url_raw(rest_url(Config::$slug . '/' . Config::$apiVersion)),
                'nonce' => \wp_create_nonce('wp_rest'),
                'partnerLogo' => \esc_attr(PartnerData::$logo),
                'partnerName' => \esc_attr(PartnerData::$name),
                'adminUrl' => \esc_url_raw(\admin_url()),
            ])
        );

        \wp_enqueue_script(Config::$slug . '-deactivate-scripts');

        \wp_set_script_translations(Config::$slug . '-deactivate-scripts', 'extendify-local', EXTENDIFY_PATH . 'languages/js');

        \wp_enqueue_style(Config::$slug, EXTENDIFY_BASE_URL . '/public/build/' . Config::$assetManifest['extendify-library.css'], [], Config::$version);
    }

}
