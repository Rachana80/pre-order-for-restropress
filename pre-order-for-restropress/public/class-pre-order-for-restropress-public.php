<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https:// https://magnigenie.com
 * @since      1.0.0
 *
 * @package    Pre_Order_For_Restropress
 * @subpackage Pre_Order_For_Restropress/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pre_Order_For_Restropress
 * @subpackage Pre_Order_For_Restropress/public
 * @author     Rachana Panda <rachana4panda@gmail.com>
 */
class Pre_Order_For_Restropress_Public
{

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version )
	{
		add_action( 'rpress_before_service_time', array( $this, 'pre_order_delivery' ) );

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url(__FILE__) . 'css/pre-order-for-restropress-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url(__FILE__) . 'js/pre-order-for-restropress-public.js', array('jquery'), $this->version, false );
	}
	public function pre_order_delivery( $service_type )
	{

		if ( 'delivery' == $service_type ) {
?>
			<div class="delivery-time-text">
				<?php
				echo  rpress_get_option( 'po_delivery_date_text' );
				?>
			</div>

			<select name="" id="" class="rp-form-control rpress_get_delivery_dates">
				<?php

				$no_date = rpress_get_option( 'po_days' );
				$date_format = get_option( 'date_format' );

				for ($i = 0; $i < $no_date; $i++) {
					$date = date( $date_format, strtotime('+ ' . $i . ' days') );
					$date_y_m_d = date( 'Y-m-d', strtotime('+' . $i . ' days') );


					// Check if the cookie exists, and if not, set it to a blank space
					$selected_item = isset( $_COOKIE['delivery_date'] ) ? $_COOKIE['delivery_date'] : '';

					$check_select = $selected_item == $date ? true : false;
					// Now, $selected_item contains the selected item from the cookie or a blank space if no item is selected.

					echo "<option";
					if ( $check_select ) {
						echo " selected ";
					}
					echo " value='$date_y_m_d'>{$date}</option>";
				}
				?>

			</select>

		<?php
		}
		if ( 'pickup' == $service_type ) {
		?>
			<div class="pickup-time-text">
				<?php
				echo rpress_get_option( 'po_pickup_date_text' );

				?>
			</div>

			<select name="" id="" class="rp-form-control rpress_get_delivery_dates">
				<?php
				$no_date = rpress_get_option( 'po_days' );
				$date_format = get_option( 'date_format' );

				for ($i = 0; $i < $no_date; $i++) {
					$date = date( $date_format, strtotime( '+' . $i . ' days' ) );
					$date_y_m_d = date( 'Y-m-d', strtotime( '+' . $i . ' days' ) );

					// Check if the cookie exists, and if not, set it to a blank space
					$selected_item = isset( $_COOKIE['delivery_date'] ) ? $_COOKIE['delivery_date'] : '';


					$check_select = $selected_item == $date ? true : false;
					// Now, $selected_item contains the selected item from the cookie or a blank space if no item is selected.

					echo "<option";
					if ( $check_select ) {
						echo " selected ";
					}
					echo " value='$date_y_m_d'>{$date}</option>";
				}
				?>
			</select>

			</div>
<?php
		}
	}
}
