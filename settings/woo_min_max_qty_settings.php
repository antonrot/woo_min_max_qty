<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists('Woo_min_max_qty_settings' ) ) {

	class Woo_min_max_qty_settings {
		public function __construct() {
			add_filter('woocommerce_get_sections_products', [ $this, 'add_min_max_qty_section' ]);
			add_filter('woocommerce_get_settings_products', [ $this, 'add_min_max_qty_settings' ], 10, 2 );
			add_filter( 'woocommerce_quantity_input_args',  [ $this, 'quantity_stock_base_args' ], 10, 2 );
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
					'id' => 'min_qty',
					'name' => 'min_qty',
					'title' => 'Minimum Quantity',
					'desc_tip' => 'Minimum quantity to order',
					'type' => 'number',
				];

				$settings[] = [
					'id' => 'max_qty',
					'name' => 'max_qty',
					'title' => 'Maximum Quantity',
					'desc_tip' => 'Maximum quantity to order',
					'type' => 'number',
				];


				$settings[] = [
					'type' => 'sectionend'
				];
			}
			return $settings;
		}

		public function quantity_stock_base_args($args, $product) {

			$args[ 'min_qty' ] = 2;
			$args[ 'max_qty' ] = 10;

			if( $product->get_manage_stock() ) {

				$product_in_stock = $product->get_stock_quantity();

				if( $product_in_stock < 10 ) {
					$args[ 'max_qty' ] = $product_in_stock;
				}

				if( $product_in_stock == 1 ) {
					$args[ 'min_qty' ] = 1;
				}

			}

			return $args;
		}

	}
}