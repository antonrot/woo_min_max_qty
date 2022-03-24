<?php

/**
 * Plugin Name: Woocommerce minimum / maximum product quantity
 * Plugin URI: https://www.wordpress.org/Woocommerce-minimum-maximum-product-quantity
 * Description: Description
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Anton Rotshtein
 * Author URI: https://examle.net
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woo-min-max-qty
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists('Woo_min_max_qty' ) ) {
	class Woo_min_max_qty {
		public function __construct() {

			$this->define_constants();

			require_once ( PLUGIN_PATH . 'settings/woo_min_max_license_settings.php' );
			new Woo_min_max_license_settings();

			require_once ( PLUGIN_PATH . 'settings/woo_min_max_qty_settings.php' );
			new Woo_min_max_qty_settings();
		}

		public function define_constants() {
			define('PLUGIN_PATH', plugin_dir_path(__FILE__));
			define('PLUGIN_URL', plugin_dir_url(__FILE__));
			define('PLUGIN_VERSION', '1.0.0');
		}

	}
}

if ( class_exists('Woo_min_max_qty' ) ) {
	new Woo_min_max_qty();
}