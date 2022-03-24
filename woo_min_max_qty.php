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

if ( ! class_exists('Woo_min_max_qty')) {
	class Woo_min_max_qty {
		public function __construct() {
			
		}
	}
}

if ( class_exists('Woo_min_max_qty' ) ) {
	new Woo_min_max_qty();
}