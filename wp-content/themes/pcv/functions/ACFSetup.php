<?php

namespace App;

class ACFSetup {

	function __construct() {
		$this->define_options_pages();
	}

	private function define_options_pages() {

		if ( function_exists( 'acf_add_options_page' ) ) {

			acf_add_options_page( array(
				'page_title' => 'Theme Settings',
				'menu_title' => 'Theme Settings',
				'menu_slug'  => 'theme-settings',
				'capability' => 'edit_posts',
				'redirect'   => false
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
		}
	}
}

new ACFSetup();