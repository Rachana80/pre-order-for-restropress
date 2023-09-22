<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https:// https://magnigenie.com
 * @since      1.0.0
 *
 * @package    Pre_Order_For_Restropress
 * @subpackage Pre_Order_For_Restropress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pre_Order_For_Restropress
 * @subpackage Pre_Order_For_Restropress/includes
 * @author     Rachana Panda <rachana4panda@gmail.com>
 */
class Pre_Order_For_Restropress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pre-order-for-restropress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
