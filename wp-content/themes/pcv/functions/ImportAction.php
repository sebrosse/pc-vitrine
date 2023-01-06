<?php

namespace App;

class ImportAction {

	public function __construct() {
		add_action( 'pmxi_saved_post', [ $this, 'set_computed_data' ], 10, 1 );
	}

	function set_computed_data( $post_id ) {
		$import_id = wp_all_import_get_import_id();
		if ( $import_id == '1' ) {
			$dynamic_fields_computed = get_field( 'dynamic_fields_computed', $post_id );

			if ( $dynamic_fields_computed ) {
				return;
			}

			// Chart data
			$chart_data = ( new PCVProduct( get_post( $post_id ) ) )->get_price_history_data_points();
			update_field( 'chart_data', $chart_data, $post_id );
			// Price variation
			$values    = array_column( $chart_data, "y" );
			$min       = min( $values );
			$max       = max( $values );
			$first     = reset( $values );
			$last      = end( $values );
			$variation = round( ( $last - $first ) / $first * 100 );
			update_field( 'price_variation', [
				'min'       => $min,
				'max'       => $max,
				'first'     => $first,
				'last'      => $last,
				'variation' => $variation
			], $post_id );

			update_field( 'dynamic_fields_computed', true, $post_id );
		}
	}
}

new ImportAction();