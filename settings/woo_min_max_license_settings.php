<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists('Woo_min_max_license_settings' ) ) {
	class Woo_min_max_license_settings {
		public function __construct() {
			add_filter('woocommerce_get_sections_products', [ $this, 'add_min_max_qty_section' ]);
			add_filter('woocommerce_get_settings_products', [ $this, 'add_min_max_qty_settings' ], 10, 2 );
		}

		public function add_min_max_qty_section( $sections ) {
			$sections['min_max_qty'] = 'Minimum / Maximum Product Quantity';
			return $sections;
		}

		public function add_min_max_qty_settings( $settings, $current_section ): array {

			if ( 'min_max_qty' === $current_section ) {

				$settings = [];

				$settings[] = [
					'type' => 'title',
					'title' => 'Minimum and maximum quantity settings'
				];

				$settings[] = [
					'id' => 'licence',
					'title' => 'License key',
					'desc_tip' => 'For plugin update need an a licence key',
					'type' => 'text',
				];

				$settings[] = [
					'type' => 'sectionend'
				];
			}
			return $settings;
		}
	}
}