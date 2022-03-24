<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists('Woo_min_max_qty_settings' ) ) {

	class Woo_min_max_qty_settings {
		public function __construct() {
			add_filter( 'woocommerce_quantity_input_args',  [ $this, 'quantity_stock_base_args' ], 10, 2 );
			add_action( 'woocommerce_product_options_inventory_product_data', [ $this, 'add_min_max_qty_fields' ] );
			add_action( 'woocommerce_process_product_meta', [ $this, 'save_product_min_max_qty_fields' ] );
		}

		public function add_min_max_qty_fields(){
			echo '<div class="option_group">';

			woocommerce_wp_text_input(
				array(
					'id' => 'min_qty',
					'label' => 'Minimum quantity',
					'desc_tip' => true,
					'description' => 'Specify minimum allowed product quantity for orders to be completed.',
					'value' => get_post_meta( get_the_ID(), 'min_qty', true ),
					'type' => 'number'
				)
			);

			woocommerce_wp_text_input(
				array(
					'id' => 'max_qty',
					'label' => 'Maximum quantity',
					'desc_tip' => true,
					'description' => 'Specify maximum allowed product quantity for orders to be completed.',
					'value' => get_post_meta( get_the_ID(), 'max_qty', true ),
					'type' => 'number'
				)
			);

			echo '</div>';
		}

		public function save_product_min_max_qty_fields( $post_id ) {
			update_post_meta( $post_id, 'min_qty', intval( $_POST[ 'min_qty' ] ) );
			update_post_meta( $post_id, 'max_qty', intval( $_POST[ 'max_qty' ] ) );
		}

		public function quantity_stock_base_args($args, $product) {

			$min = get_post_meta( $product->get_id(), 'min_qty', true );
			$max = get_post_meta( $product->get_id(), 'max_qty', true );

			$args[ 'min_value' ] = $min ?? 1;
			$args[ 'max_value' ] = $max ?? $product->get_stock_quantity();
			$product_in_stock    = $product->get_stock_quantity();

			if( $product->get_manage_stock() ) {

				if( $product_in_stock < 10 ) {
					$args[ 'max_value' ] = $product_in_stock;
				}

				if( $product_in_stock == 1 ) {
					$args[ 'min_value' ] = 1;
				}
			}

			return $args;
		}

	}
}