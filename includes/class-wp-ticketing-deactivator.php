<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.ticketself.com
 * @since      1.0.0
 *
 * @package    Wp_ticketing
 * @subpackage Wp_ticketing/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_ticketing
 * @subpackage Wp_ticketing/includes
 * @author     mg <mikel@ticketself.com>
 */
class Wp_ticketing_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option('wpticketing-installed');
	}

}
