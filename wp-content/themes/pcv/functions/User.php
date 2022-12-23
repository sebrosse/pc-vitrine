<?php

namespace App;

class User extends \WP_User {

	const KEY_IS_VERIFIED = 'is_verified';
	const KEY_VERIFICATION_TOKEN = 'verification_token';

	public function __construct( $id = 0, $name = '', $site_id = '' ) {
		parent::__construct( $id, $name, $site_id );
	}

	public function is_verified(): bool {
		return is_user_logged_in() && get_user_meta( $this->ID, $this::KEY_IS_VERIFIED, true );
	}

	public function send_verification_email(): bool {

		$body = str_replace(
			'[verification_link]',
			$this->get_verification_link(),
			get_field( 'verification_email', 'option' )
		);

		return wp_mail(
			$this->user_email,
			'Bienvenue sur ' . get_bloginfo( 'name' ) . ', veuillez vérifier votre email.',
			$body
		);
	}

	private function get_verification_token(): string {
		if ( empty( $token = get_user_meta( $this->ID, $this::KEY_VERIFICATION_TOKEN, true ) ) ) {
			$token = bin2hex( random_bytes( 32 ) );
			update_user_meta( $this->ID, $this::KEY_VERIFICATION_TOKEN, $token );
		}

		return $token;
	}

	private function get_verification_link(): string {
		$page_verify_email = get_field( 'page_verify_email', 'option' );
		$url               = get_permalink( $page_verify_email->ID );

		return add_query_arg( [
			'email' => $this->user_email,
			'token' => $this->get_verification_token()
		], $url );
	}

	public static function check_token( $email, $token ): bool {
		$user = get_user_by( 'email', $email );

		if ( ! $user ) {
			return false;
		}

		$user_token = get_user_meta( $user->ID, User::KEY_VERIFICATION_TOKEN, true );

		if ( $user_token === $token ) {
			return true;
		}

		return false;
	}

	public static function verify_user( $email ): void {
		$user = get_user_by( 'email', $email );

		update_user_meta( $user->ID, User::KEY_IS_VERIFIED, true );
	}

}