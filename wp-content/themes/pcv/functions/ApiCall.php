<?php

namespace App;

class ApiCall {

	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';
	const METHOD_DELETE = 'DELETE';

	const SCOPE_ADMIN = 'admin';
	const SCOPE_USER = 'user';

	private User $user;

	function __construct() {
		$this->user = new User( get_current_user_id() );
	}

	private function call( $scope, $endpoint, $method, $params = [] ) {

		$ch = curl_init();

		if ( $scope === $this::SCOPE_ADMIN ) {
			$api_key = get_field( 'admin_api_key', 'option' );
		} else {
			$api_key = get_user_meta( $this->user->ID, 'apiKey', true );

			if ( empty( $api_key ) ) {
				$response = $this->add_user( $this->user->user_email );

				$api_key = $response['apiKey'];
				update_user_meta( $this->user->ID, 'apiKey', $api_key );
			}
		}

		$headers[] = 'x-auth-token: ' . $api_key;
		$headers[] = 'Content-Type: application/json';

		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_URL, $endpoint );

		if ( $method === $this::METHOD_POST ) {
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
		} elseif ( $method === $this::METHOD_DELETE ) {
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $this::METHOD_DELETE );
		}

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 1 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

		$content   = curl_exec( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

		curl_close( $ch );

		return [ 'http_code' => $http_code, 'content' => json_decode( $content, true ) ];

	}

	private function cancel_if_unverified() {

	}

	public function add_user( $email ) {
		$endpoint = get_field( 'add_user_endpoint', 'option' );

		return $this->call( $this::SCOPE_ADMIN, $endpoint, $this::METHOD_POST, [ 'email' => $email ] );
	}

	public function add_favorite( $original_product_id ) {
		$endpoint = get_field( 'add_favorite_endpoint', 'option' );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_POST, [ 'product' => '/api/products/' . $original_product_id ] );
	}

	public function remove_favorite( $fid ) {
		$endpoint = get_field( 'remove_favorite_endpoint', 'option' );
		$endpoint = str_replace( '{id}', $fid, $endpoint );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_DELETE, [] );
	}

	public function me( $email ) {
		$endpoint = get_field( 'me_endpoint', 'option' );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_GET, [] );
	}

	public function favorites() {
		$endpoint = get_field( 'favorites_endpoint', 'option' );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_GET, [] );
	}

	public function is_favorite( $pid ) {
		$endpoint = get_field( 'is_favorite_endpoint', 'option' );
		$endpoint = str_replace( '{id}', $pid, $endpoint );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_GET, [] );
	}

	public function add_alert( $pid, $threshold ) {
		$endpoint = get_field( 'add_alert_endpoint', 'option' );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_POST, [
			'product'   => '/api/products/' . $pid,
			'threshold' => (int) $threshold
		] );
	}

	public function has_alert( $pid ) {
		$endpoint = get_field( 'has_alert_endpoint', 'option' );
		$endpoint = str_replace( '{id}', $pid, $endpoint );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_GET, [] );
	}

	public function remove_alert( $aid ) {
		$endpoint = get_field( 'remove_alert_endpoint', 'option' );
		$endpoint = str_replace( '{id}', $aid, $endpoint );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_DELETE, [] );
	}

	public function alerts() {
		$endpoint = get_field( 'alerts_endpoint', 'option' );

		return $this->call( $this::SCOPE_USER, $endpoint, $this::METHOD_GET, [] );
	}
}