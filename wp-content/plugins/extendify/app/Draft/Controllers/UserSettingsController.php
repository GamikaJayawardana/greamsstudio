<?php
/**
 * Controls Draft Settings
 */

namespace Extendify\Draft\Controllers;

if (!defined('ABSPATH')) {
    die('No direct access.');
}

/**
 * The controller for keeping draft settings in sync
 */
class UserSettingsController
{

    /**
     * Return the data
     *
     * @return \WP_REST_Response
     */
    public static function get()
    {
        $data = get_option('extendify_draft_settings', []);
        return new \WP_REST_Response($data);
    }

    /**
     * Persist the data
     *
     * @param \WP_REST_Request $request - The request.
     * @return \WP_REST_Response
     */
    public static function store($request)
    {
        $data = json_decode($request->get_param('state'), true);
        update_option('extendify_draft_settings', $data);
        return new \WP_REST_Response($data);
    }
}
