<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https:// https://magnigenie.com
 * @since      1.0.0
 *
 * @package    Pre_Order_For_Restropress
 * @subpackage Pre_Order_For_Restropress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pre_Order_For_Restropress
 * @subpackage Pre_Order_For_Restropress/admin
 * @author     Rachana Panda <rachana4panda@gmail.com>
 */
class Pre_Order_For_Restropress_Admin
{
	public $options;

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
	public function __construct( )
	{

		add_filter( 'rpress_settings_general', array( $this, 'pre_order' ), 1, 1 );

		add_filter( 'rpress_settings_sections_general', array( $this, 'rpress_add_pre_order_settings' ) );

		// add_filter( 'rpress_settings_general_sanitize', array( $this, 'rpress_settings_sanitize_rpress_pr' ), 10, 1 );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pre_Order_For_Restropress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pre_Order_For_Restropress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url(__FILE__) . 'css/pre-order-for-restropress-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pre_Order_For_Restropress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pre_Order_For_Restropress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/pre-order-for-restropress-admin.js', array('jquery'), $this->version, false);
	}
	public function pre_order( $general_settings )
	{
		$general_settings['pre_order']['adress_heading'] = array(
			'id'            => 'pre_orde_setting',
			'class'         => 'pre_orde_setting',
			'name'          => '<h3>' . __( 'Pre order Setting', 'rp-preorder-setting' ) . '</h3>',
			'desc'          => '',
			'type'          => 'header',
			'tooltip_title' => __( 'Pre order Setting', 'rp-adress-setting' ),
		);

		$general_settings['pre_order']['enable_printing'] = array(
			'id' => 'enable_printing',
			'name'    => __( 'Enable Printing Option', 'rp-preorder' ),
			'desc' => __( 'Check this box to enable pre order settings.', 'rp-preorder' ),
			'type' => 'checkbox',
		);

		$general_settings['pre_order']['delivery_date'] = array(
			'id' => 'po_delivery_date_text',
			'name'    => __( 'Delivery Date Text ', 'rp-preorder' ),
			'desc' => __( 'Enter delivery date  text of product', 'rp-preorder' ),
			'type' => 'text',
		);
		$general_settings['pre_order']['pickup_date'] = array(
			'id' => 'po_pickup_date_text',
			'name'    => __( 'Pickup Date Text ', 'rp-preorder' ),
			'desc' => __( 'Enter pickup date text  of product', 'rp-preorder' ),
			'type' => 'text',
		);
		$general_settings['pre_order']['days'] = array(
			'id' => 'po_days',
			'name'    => __( 'NO. of days for pre-order ', 'rp-preorder' ),
			'desc' => __( 'Enter number of days for pre-order of a product', 'rp-preorder' ),
			'type' => 'number',
		);

		return $general_settings;
	}                                                                                                                                                                                                                                                                                                                                                                                                  
	public function rpress_add_pre_order_settings( $section )
	{
		$section['pre_order'] = __( 'Pre Order', 'rp-preorder' );
		return $section;
	}
	
}
