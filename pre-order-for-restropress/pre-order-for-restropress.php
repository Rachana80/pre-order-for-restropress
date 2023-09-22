<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https:// https://magnigenie.com
 * @since             1.0.0
 * @package           Pre_Order_For_Restropress
 *
 * @wordpress-plugin
 * Plugin Name:       Pre-order for RestroPress
 * Plugin URI:        https://https://www.restropress.com
 * Description:       To add pre-order functionality for restropress
 * Version:           1.0.0
 * Author:            magnigenie
 * Author URI:        https:// https://magnigenie.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rp-preorder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( !defined( 'RP_PRE_ORDER_FILE' ) ) {
    define( 'RP_PRE_ORDER_FILE', __FILE__ );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PRE_ORDER_FOR_RESTROPRESS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pre-order-for-restropress-activator.php
 */
function activate_pre_order_for_restropress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pre-order-for-restropress-activator.php';
	Pre_Order_For_Restropress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pre-order-for-restropress-deactivator.php
 */
function deactivate_pre_order_for_restropress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pre-order-for-restropress-deactivator.php';
	Pre_Order_For_Restropress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pre_order_for_restropress' );
register_deactivation_hook( __FILE__, 'deactivate_pre_order_for_restropress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pre-order-for-restropress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pre_order_for_restropress() {

	$plugin = new Pre_Order_For_Restropress();
	$plugin->run();

}
run_pre_order_for_restropress();
