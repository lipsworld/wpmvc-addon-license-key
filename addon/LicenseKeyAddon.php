<?php

namespace WPMVC\Addons\LicenseKey;

use WPMVC\Addon;

/**
 * Addon class.
 * Wordpress MVC.
 *
 * @link http://www.wordpress-mvc.com/v1/add-ons/
 * @author Cami Mostajo
 * @package WPMVC\Addons\LicenseKey
 * @license MIT
 * @version 1.0.0
 */
class LicenseKeyAddon extends Addon
{
    /**
     * Constant tag.
     * @since 1.0.0
     *
     * @var string
     */
    const TAG = 'license-key';
    /**
     * Addon tag.
     * @since 1.0.0
     *
     * @var string
     */
    public $tag = 'license-key';
    /**
     * Function called when user is on admin dashboard.
     * Add wordpress hooks (actions, filters) here.
     */
    public function on_admin()
    {
        add_filter(
            'plugin_action_links_'.$this->main->config->get('paths.base_file'),
            [&$this, 'filter_action_links']
        );
        add_action('admin_menu', [&$this, 'admin_menu'], 99);
    }
    /**
     * Returns flag indicating if license key is valid.
     * @since 1.0.0
     *
     * @return bool
     */
    public function is_license_key_valid()
    {
        return $this->mvc->action( 'LicenseController@validate', $this->main );
    }
    /**
     * Returns API response.
     * Tries to activate a license key.
     * @since 1.0.0
     *
     * @param string $license_key
     *
     * @return object
     */
    public function activate_license_key( $license_key )
    {
        return $this->mvc->action( 'LicenseController@activate',  $license_key, $this->main );
    }
    /**
     * Returns API response.
     * Tries to deactivate the activated license key.
     * @since 1.0.0
     *
     * @param string $license_key
     *
     * @return object
     */
    public function deactivate_license_key()
    {
        return $this->mvc->action( 'LicenseController@deactivate',  $this->main );
    }
    /**
     * Returns API response.
     * Tries to deactivate the activated license key.
     * @since 1.0.0
     *
     * @param string $license_key
     *
     * @return object
     */
    public function get_license_key()
    {
        return $this->mvc->action( 'LicenseController@get',  $this->main );
    }
    /**
     * Returns action links.
     * @since 1.0.0
     *
     * @param array $links
     *
     * @return array
     */
    public function filter_action_links( $links )
    {
        return $this->mvc->action( 'SettingsController@action_links', $links, $this->main );
    }
    /**
     * Action hook.
     * @since 1.0.0
     */
    public function admin_menu()
    {
        $this->mvc->call( 'SettingsController@admin_menu', $this->main );
    }
    /**
     * Displays missing license key notice.
     * @since 1.0.0
     */
    public function license_key_notice()
    {
        $this->mvc->view->show( 'admin.license-notice', ['main' => $this->main] );
    }
}