<?php

namespace App;

class ACFSetup {

	const OPTION_PAGE_PROFILE = 'page_profile';
	const OPTION_PAGE_PROFILE_ALERTS = 'page_profile_alerts';
	const OPTION_PAGE_PROFILE_FAVORITES = 'page_profile_favorites';
	const OPTION_PAGE_LOGIN = 'page_login';
	const OPTION_PAGE_LOGOUT = 'page_logout';
	const OPTION_PAGE_REGISTER = 'page_register';
	const OPTION_PAGE_VERIFY_EMAIL = 'page_verify_email';
	const OPTION_PAGE_RESEND_VERIFICATION_EMAIL = 'page_resend_verification_email';
	const OPTION_PAGE_REQUEST_PASSWORD_RESET = 'page_request_password_reset';
	const OPTION_PAGE_PASSWORD_RESET = 'page_password_reset';

	function __construct() {
		$this->define_options_pages();
		add_filter( 'acf/load_field/key=field_63a41a95e585d', [ $this, 'acf_website_choices' ] );
	}

	private function define_options_pages() {

		if ( function_exists( 'acf_add_options_page' ) ) {

			acf_add_options_page( array(
				'page_title' => 'Theme Settings',
				'menu_title' => 'Theme Settings',
				'menu_slug'  => 'theme-settings',
				'capability' => 'edit_posts',
				'redirect'   => true
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Page',
				'menu_title'  => 'Page',
				'parent_slug' => 'theme-settings',
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Header',
				'menu_title'  => 'Header',
				'parent_slug' => 'theme-settings',
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Login',
				'menu_title'  => 'Login',
				'parent_slug' => 'theme-settings',
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Api',
				'menu_title'  => 'Api',
				'parent_slug' => 'theme-settings',
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Product',
				'menu_title'  => 'Product',
				'parent_slug' => 'theme-settings',
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Email',
				'menu_title'  => 'Email',
				'parent_slug' => 'theme-settings',
			) );

			acf_add_options_sub_page( array(
				'page_title'  => 'Social',
				'menu_title'  => 'Social',
				'parent_slug' => 'theme-settings',
			) );
		}
	}

	public function acf_website_choices( $field ) {

		// reset choices
		$field['choices'] = array();


		// get the textarea value from options page without any formatting
		$choices = [ 'bonjour', 'coucou', 'salut' ];

		global $wpdb;
		$choices = array_column( $wpdb->get_results(
			"SELECT DISTINCT(pm.meta_value) 
					FROM $wpdb->postmeta pm 
					WHERE (meta_key LIKE 'offers_%_domain' )
					ORDER BY pm.meta_value ASC"
			, ARRAY_N ),
			'0'
		);

		if ( is_array( $choices ) ) {
			foreach ( $choices as $choice ) {
				$field['choices'][ $choice ] = $choice;
			}
		}

		return $field;

	}

}

new ACFSetup();