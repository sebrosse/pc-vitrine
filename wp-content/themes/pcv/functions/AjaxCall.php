<?php

namespace App;

class AjaxCall {

	const NONCE_STRING = 'pcv_2022';

	private array $methods = [
		'is_favorite',
		'add_favorite',
		'remove_favorite',
		'has_alert',
		'add_alert',
		'remove_alert',
		'search_products',
		'search_posts'
	];

	public function __construct() {
		foreach ( $this->methods as $method ) {
			add_action( 'wp_ajax_' . $method, [ $this, $method ] );
			add_action( 'wp_ajax_nopriv_' . $method, [ $this, $method ] );
		}
	}

	private function verify_nonce( $data ) {
		if ( ! isset( $data['nonce'] ) or
		     ! wp_verify_nonce( $data['nonce'], $this::NONCE_STRING )
		) {
			wp_send_json_error( "Vous n'êtes pas autorisé à effectuer cette action.", 403 );
		}
	}

	private function handle_api_response( $response ) {
		if ( str_starts_with( $response['http_code'], '2' ) ) {
			wp_send_json_success( $response['content'], 200 );
		} else {
			wp_send_json_error( "Vous n'êtes pas autorisé à effectuer cette action.", 403 );
		}
	}

	function is_favorite() {
		$this->verify_nonce( $_POST );

		$product_id = $_POST['pid'];

		$ApiCall  = new ApiCall();
		$response = $ApiCall->is_favorite( $product_id );

		$this->handle_api_response( $response );
	}

	function add_favorite() {
		$this->verify_nonce( $_POST );

		$product_id = $_POST['pid'];

		$ApiCall  = new ApiCall();
		$response = $ApiCall->add_favorite( $product_id );

		$this->handle_api_response( $response );
	}

	function remove_favorite() {
		$this->verify_nonce( $_POST );

		$fid = $_POST['fid'];

		$ApiCall  = new ApiCall();
		$response = $ApiCall->remove_favorite( $fid );

		$this->handle_api_response( $response );
	}

	function has_alert() {
		$this->verify_nonce( $_POST );

		$product_id = $_POST['pid'];

		$ApiCall = new ApiCall();
		$alert   = $ApiCall->has_alert( $product_id );

		if ( $alert['content'] ) {
			ob_start();
			include( THEME_ROOT_PATH . '/template-parts/ajax/alert-tag.php' );

			wp_send_json_success( ob_get_clean() );
		}

		wp_send_json_success( false );
	}

	function add_alert() {
		$this->verify_nonce( $_POST );

		$product_id = $_POST['pid'];
		$threshold  = $_POST['threshold'];

		$ApiCall = new ApiCall();
		$alert   = $ApiCall->add_alert( $product_id, $threshold );

		ob_start();
		include( THEME_ROOT_PATH . '/template-parts/ajax/alert-tag.php' );
		$response = ob_get_clean();

		wp_send_json_success( $response );
	}

	function remove_alert() {
		$this->verify_nonce( $_POST );

		$aid = $_POST['aid'];

		$ApiCall  = new ApiCall();
		$response = $ApiCall->remove_alert( $aid );

		$this->handle_api_response( $response );
	}

	function search_products2() {
		$this->verify_nonce( $_POST );

		$term = $_POST['term'];

		$args  = [
			'post_type'      => 'pc-product',
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			's'              => $term
		];
		$query = new \WP_Query( $args );

		$data = [];
		while ( $query->have_posts() ) {
			$query->the_post();
			global $post;
			$PCV_Product = new PCVProduct( $post );
			$data[]      = [
				'name'      => get_the_title(),
				'label'     => get_the_title(),
				'url'       => get_the_permalink(),
				'thumbnail' => pcv_get_product_featured_image_url( $post, 'thumb-list' ),
				'price'     => $PCV_Product->get_best_price()
			];
		}

		wp_send_json_success( $data );
	}

	function search_products() {
		$this->verify_nonce( $_POST );

		$term = $_POST['term'];

		$search = new Search();

		$results = $search->search( $term,'product',10 );
$data=[];
		foreach ( $results['ids'] as $id ) {
			$post        = get_post($id);
			$PCV_Product = new PCVProduct( $post );
			$data[]      = [
				'name'      => $post->post_title,
				'label'     => $post->post_title,
				'url'       => get_the_permalink($id),
				'thumbnail' => pcv_get_product_featured_image_url( $post, 'thumb-list' ),
				'price'     => $PCV_Product->get_best_price()
			];
		}

		wp_send_json_success( $data );
	}

	function search_posts() {
		$this->verify_nonce( $_POST );

		$term = $_POST['term'];

		$args  = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			's'              => $term
		];
		$query = new \WP_Query( $args );

		$data = [];
		while ( $query->have_posts() ) {
			$query->the_post();
			$data[] = [
				'name'  => get_the_title(),
				'label' => get_the_title(),
				'url'   => get_the_permalink()
			];
		}

		wp_send_json_success( $data );
	}

}

new AjaxCall();