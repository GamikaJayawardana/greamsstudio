<?php
/**
 * The App details file
 */

namespace Extendify;

/**
 * Controller for handling various app data
 */
class Config
{

    /**
     * Plugin slug
     *
     * @var string
     */
    public static $slug = 'extendify';

    /**
     * The JS/CSS asset manifest (with hashes)
     *
     * @var array
     */
    public static $assetManifest = [];

    /**
     * Plugin version
     *
     * @var string
     */
    public static $version = '';

    /**
     * Plugin API REST version
     *
     * @var string
     */
    public static $apiVersion = 'v1';

    /**
     * Whether to load Launch
     *
     * @var boolean
     */
    public static $showLaunch = false;

    /**
     * Plugin environment
     *
     * @var string
     */
    public static $environment = '';

    /**
     * Host plugin
     *
     * @var string
     */
    public static $requiredCapability = 'manage_options';

    /**
     * Plugin config
     *
     * @var array
     */
    public static $config = [];

    /**
     * Whether Launch was finished
     *
     * @var boolean
     */
    public static $launchCompleted = false;

    /**
     * Process the readme file to get version and name
     *
     * @return void
     */
    public function __construct()
    {
        // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
        $readme = file_get_contents(EXTENDIFY_PATH . 'readme.txt');

        preg_match('/Stable tag: ([0-9.:]+)/', $readme, $matches);
        self::$version = $matches[1];

        self::$assetManifest = wp_json_file_decode(EXTENDIFY_PATH . 'public/build/manifest.json', ['associative' => true]);

        if (!get_option('extendify_first_installed_version')) {
            update_option('extendify_first_installed_version', self::$version);
        }

        // An easy way to check if we are in dev mode is to look for a dev specific file.
        $isDev = is_readable(EXTENDIFY_PATH . '.devbuild');

        self::$environment = $isDev ? 'DEVELOPMENT' : 'PRODUCTION';
        self::$launchCompleted = (bool) get_option('extendify_onboarding_completed', false) || $isDev;
        self::$showLaunch = $this->showLaunch();

        // Add the config.
        // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
        $config = file_get_contents(EXTENDIFY_PATH . 'config.json');
        self::$config = json_decode($config, true);
    }

    /**
     * Conditionally load Extendify Launch.
     *
     * @return boolean
     */
    private function showLaunch()
    {
        // Always show it for dev mode.
        if (self::$environment === 'DEVELOPMENT') {
            return true;
        }

        // Currently we require a flag to be set.
        if (!defined('EXTENDIFY_SHOW_ONBOARDING')) {
            return false;
        }

        return constant('EXTENDIFY_SHOW_ONBOARDING') === true;
    }
}
