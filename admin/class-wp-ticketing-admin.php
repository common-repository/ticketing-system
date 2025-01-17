<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ticketself.com
 * @since      1.0.0
 *
 * @package    Wp_ticketing
 * @subpackage Wp_ticketing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_ticketing
 * @subpackage Wp_ticketing/admin
 * @author     mg <mikel@ticketself.com>
 */
class Wp_ticketing_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->wp_ticketing_options = get_option($this->plugin_name);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_ticketing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_ticketing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-ticketing-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_ticketing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_ticketing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-ticketing-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function add_plugin_admin_menu() {

    /*
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     */
    add_options_page( 'ticketing Online Plugin functions', 'ticketing Online', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
    );
}

 /**
 * Add settings action link to the plugins page.
 *
 * @since    1.0.0
 */

public function add_action_links( $links ) {
    /*
    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
    */
   $settings_link = array(
    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
   );
   return array_merge(  $settings_link, $links );

}

/**
 * Render the settings page for this plugin.
 *
 * @since    1.0.0
 */

public function display_plugin_setup_page() {
    include_once( 'partials/wp-ticketing-admin-display.php' );
}

public function validate($input) {
    $valid = array();
    $valid['username'] = (isset($_POST['wp-ticketing_']['username']) && !empty($_POST['wp-ticketing_']['username'])) ? $_POST['wp-ticketing_']['username'] : '';
    $valid['password'] = (isset($_POST['wp-ticketing_']['password']) && !empty($_POST['wp-ticketing_']['password'])) ? $_POST['wp-ticketing_']['password'] : '';
    delete_option('wpticketing-email');
    delete_option('wpticketing-password');
    add_option('wpticketing-email', $valid['username'], '', 'yes' );
    add_option('wpticketing-password', $valid['password'], '', 'yes' );
    return $valid;
 }

public function options_update() {
    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
 }
}
