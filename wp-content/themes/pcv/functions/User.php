<?php

namespace App;

class User extends \WP_User {

	const KEY_IS_VERIFIED = 'is_verified';
	const KEY_VERIFICATION_TOKEN = 'verification_token';
	const KEY_PASSWORD_RESET_TOKEN = 'password_reset_token';

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
			'Bienvenue sur ' . get_bloginfo( 'name' ) . ' - Confirmation de votre adresse email.',
			$body
		);
	}

	public function send_password_reset_email(): bool {

		$body = str_replace(
			'[reset_link]',
			$this->get_password_reset_link(),
			get_field( 'password_reset_email', 'option' )
		);

		return wp_mail(
			$this->user_email,
			get_bloginfo( 'name' ) . ' - Réinitialisation de votre mot de passe.',
			$body
		);
	}

	private function get_token( $token_type ): string {
		$token = bin2hex( random_bytes( 32 ) );
		update_user_meta( $this->ID, $token_type, $token );

		return $token;
	}

	private function get_verification_link(): string {
		$page_verify_email = get_field( 'page_verify_email', 'option' );
		$url               = get_permalink( $page_verify_email->ID );

		return add_query_arg( [
			'email' => $this->user_email,
			'token' => $this->get_token( $this::KEY_VERIFICATION_TOKEN )
		], $url );
	}

	private function get_password_reset_link(): string {
		$page_password_reset = get_field( 'page_password_reset', 'option' );
		$url                 = get_permalink( $page_password_reset->ID );

		return add_query_arg( [
			'email' => $this->user_email,
			'token' => $this->get_token( $this::KEY_PASSWORD_RESET_TOKEN )
		], $url );
	}

	public static function check_token( $email, $token, $token_type ): bool {
		$user = get_user_by( 'email', $email );

		if ( ! $user ) {
			return false;
		}

		$user_token = get_user_meta( $user->ID, $token_type, true );

		if ( $user_token === $token ) {
			return true;
		}

		return false;
	}

	public static function verify_user( $email ): void {
		$user = get_user_by( 'email', $email );

		update_user_meta( $user->ID, User::KEY_IS_VERIFIED, true );
	}

	public static function validate_password( $pass1, $pass2 = "" ) {

		if ( empty($pass1)) {
			return [
				'success' => false,
				'message' => 'Le champ mot de passe est vide.'
			];
		}

		if ( $pass1 !== $pass2 && ! empty( $pass2 ) ) {
			return [
				'success' => false,
				'message' => 'Les mots de passe saisis ne sont pas identiques.'
			];
		}

		if ( strlen( $pass1 ) < 8 || strlen( $pass1 ) > 20 ) {
			return [
				'success' => false,
				'message' => "Le mot de passe doit contenir entre 8 et 20 caractères"
			];
		}


		if ( str_contains( $pass1, " " ) ) {
			return [
				'success' => false,
				'message' => "Le mot de passe ne peut pas contenir d'espace"
			];
		}

		return [ 'success' => true ];

	}
}