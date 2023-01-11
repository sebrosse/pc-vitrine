<?php
add_image_size( 'hero', 1920, 780, true );
add_image_size( 'mini-product-thumb', 400, 400, true );
add_image_size( 'thumb-list', 80, 80, true );

add_filter( 'use_block_editor_for_post', '__return_false', 10 );

function pcv_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'pcv_remove_wp_block_library_css', 100 );

add_action( 'after_setup_theme', 'pcv_setup' );
function pcv_setup() {
	load_theme_textdomain( 'pcv', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
	//add_theme_support( 'woocommerce' );
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1920;
	}
	register_nav_menus( [
		'main-menu'   => esc_html__( 'Main Menu', 'pcv' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'pcv' )
	] );
}

add_action( 'admin_init', 'pcv_notice_dismissed' );
function pcv_notice_dismissed() {
	$user_id = get_current_user_id();
	if ( isset( $_GET['dismiss'] ) ) {
		add_user_meta( $user_id, 'pcv_notice_dismissed_8', 'true', true );
	}
}

add_action( 'wp_enqueue_scripts', 'pcv_enqueue' );
function pcv_enqueue() {
	wp_enqueue_style( 'pcv-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
}

add_filter( 'document_title_separator', 'pcv_document_title_separator' );
function pcv_document_title_separator( $sep ) {
	$sep = esc_html( '|' );

	return $sep;
}

add_filter( 'the_title', 'pcv_title' );
function pcv_title( $title ) {
	if ( $title == '' ) {
		return esc_html( '...' );
	} else {
		return wp_kses_post( $title );
	}
}

function pcv_schema_type() {
	$schema = 'https://schema.org/';
	if ( is_single() ) {
		$type = "Article";
	} elseif ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}
	echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}

add_filter( 'nav_menu_link_attributes', 'pcv_schema_url', 10 );
function pcv_schema_url( $atts ) {
	$atts['itemprop'] = 'url';

	return $atts;
}

if ( ! function_exists( 'pcv_wp_body_open' ) ) {
	function pcv_wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

add_filter( 'the_content_more_link', 'pcv_read_more_link' );
function pcv_read_more_link() {
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'pcv' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}

add_filter( 'excerpt_more', 'pcv_excerpt_read_more_link' );
function pcv_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;

		return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'pcv' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}

add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'pcv_image_insert_override' );
function pcv_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );

	return $sizes;
}

add_action( 'widgets_init', 'pcv_widgets_init' );
function pcv_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'pcv' ),
		'id'            => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}


function pcv_enqueue_style() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&family=Poppins:wght@400;500;600;700&display=swap', false );
	//wp_enqueue_style( 'bootstrap', THEME_ROOT_URI . '/assets/css/vendor/bootstrap.min.css' );
	//wp_enqueue_style( 'font-awesome', THEME_ROOT_URI . '/assets/css/vendor/font-awesome.css' );
	//wp_enqueue_style( 'flaticon', THEME_ROOT_URI . '/assets/css/vendor/flaticon/flaticon.css' );
	//wp_enqueue_style( 'slick', THEME_ROOT_URI . '/assets/css/vendor/slick.css' );
	//wp_enqueue_style( 'slick-theme', THEME_ROOT_URI . '/assets/css/vendor/slick-theme.css' );
	//wp_enqueue_style( 'jquery-ui.min', THEME_ROOT_URI . '/assets/css/vendor/jquery-ui.min.css' );
	//wp_enqueue_style( 'sal', THEME_ROOT_URI . '/assets/css/vendor/sal.css' );
	//wp_enqueue_style( 'magnific-popup', THEME_ROOT_URI . '/assets/css/vendor/magnific-popup.css' );
	//wp_enqueue_style( 'autocomplete', THEME_ROOT_URI . '/assets/css/vendor/autocomplete-theme-classic.css' );
	//wp_enqueue_style( 'base', THEME_ROOT_URI . '/assets/css/vendor/base.css' );
	wp_enqueue_style( 'style', THEME_ROOT_URI . '/assets/dist/css/app.min.css' );
}

add_action( 'wp_enqueue_scripts', 'pcv_enqueue_style' );

function pcv_enqueue_scripts() {
	//wp_enqueue_script( 'modernizr', THEME_ROOT_URI . '/assets/js/vendor/modernizr.min.js' );
	//wp_enqueue_script( 'jquery', THEME_ROOT_URI . '/assets/js/vendor/jquery.js' );
	//wp_enqueue_script( 'popper', THEME_ROOT_URI . '/assets/js/vendor/popper.min.js' );
	//wp_enqueue_script( 'bootstrap', THEME_ROOT_URI . '/assets/js/vendor/bootstrap.min.js' );
	//wp_enqueue_script( 'slick', THEME_ROOT_URI . '/assets/js/vendor/slick.min.js' );
	//wp_enqueue_script( 'cookie', THEME_ROOT_URI . '/assets/js/vendor/js.cookie.js' );
	//wp_enqueue_script( 'jquery-ui', THEME_ROOT_URI . '/assets/js/vendor/jquery-ui.min.js' );
	//wp_enqueue_script( 'jquery.countdown', THEME_ROOT_URI . '/assets/js/vendor/jquery.countdown.min.js' );
	//wp_enqueue_script('sal',THEME_ROOT_URI.'/assets/js/vendor/sal.js');
	//wp_enqueue_script( 'jquery.magnific-popup', THEME_ROOT_URI . '/assets/js/vendor/jquery.magnific-popup.min.js' );
	//wp_enqueue_script( 'imagesloaded', THEME_ROOT_URI . '/assets/js/vendor/imagesloaded.pkgd.min.js' );
	//wp_enqueue_script( 'counterup', THEME_ROOT_URI . '/assets/js/vendor/counterup.js' );
	//wp_enqueue_script( 'waypoints', THEME_ROOT_URI . '/assets/js/vendor/waypoints.min.js' );
	//wp_enqueue_script( 'autocomplete', THEME_ROOT_URI . '/assets/js/vendor/autocomplete-js.js' );
	//wp_enqueue_script( 'chart-js', THEME_ROOT_URI . '/assets/js/vendor/chart.min.js' );
	//wp_enqueue_script('main',THEME_ROOT_URI.'/assets/js/main.js');

	//wp_enqueue_script( 'chart', THEME_ROOT_URI . '/assets/js/chart.js' );

	wp_enqueue_script( 'app', THEME_ROOT_URI . '/assets/dist/js/app.min.js' );
	wp_localize_script( 'app', 'pcv_vars',
		array(
			'ajaxurl'           => admin_url( 'admin-ajax.php' ),
			'nonce'             => wp_create_nonce( \App\AjaxCall::NONCE_STRING ),
			'is_user_logged_in' => is_user_logged_in(),
			'is_user_verified'  => get_user_meta( get_current_user_id(), \App\User::KEY_IS_VERIFIED, true ),
			'profile_url'       => pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_PROFILE ),
			'login_url'         => pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_LOGIN )
		)
	);
	//wp_enqueue_script( 'search', THEME_ROOT_URI . '/assets/js/search.js' );
}

add_action( 'wp_enqueue_scripts', 'pcv_enqueue_scripts' );

function pcv_get_product_featured_image( WP_Post $product, $size = 'full' ) {

	if ( has_post_thumbnail( $product->ID ) ) {
		return get_the_post_thumbnail( $product->ID, $size );
	} else {
		$image = get_field( 'product_featured_image_placeholder', 'option' );

		if ( $size === 'full' ) {
			$url = $image['url'];
		} else {
			$url = $image['sizes'][ $size ];
		}

		return '<img class="img-fluid wp-post-image" src="' . $url . '" alt="" decoding="async"/>';
	}
}

function pcv_get_product_featured_image_url( WP_Post $product, $size = 'full' ) {

	if ( has_post_thumbnail( $product->ID ) ) {
		return get_the_post_thumbnail_url( $product->ID, $size );
	} else {
		$image = get_field( 'product_featured_image_placeholder', 'option' );

		if ( $size === 'full' ) {
			return $image['url'];
		}

		return $image['sizes'][ $size ];
	}
}

function pcv_get_page_link( string $page ) {
	$page = get_field( $page, 'option' );

	if ( $page ) {
		return get_permalink( $page->ID );
	}

	return false;
}

function pcv_is_login_template() {
	return in_array( get_page_template_slug(), [
		"page-login.php",
		"page-registration.php",
		"page-verify-email.php",
		"page-request-password-reset.php",
		"page-password-reset.php"
	] );
}

function pcv_redirect_loggedin_user_from_login() {
	if ( is_user_logged_in() && pcv_is_login_template() ) {
		wp_redirect( pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_PROFILE ) );
	}
}

add_action( 'template_redirect', 'pcv_redirect_loggedin_user_from_login' );

function pcv_disable_dashboard_access_for_users() {
	$current_user = wp_get_current_user();

	if ( is_admin() && ! $current_user->has_cap( 'administrator' ) && ! wp_doing_ajax() ) {
		wp_redirect( site_url() );
	}
}

add_action( 'admin_init', 'pcv_disable_dashboard_access_for_users' );


function pcv_remove_admin_bar() {
	if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
		show_admin_bar( false );
	}
}

add_action( 'after_setup_theme', 'pcv_remove_admin_bar' );

function pcv_rewrite_url() {

	add_rewrite_tag( '%pid%','([^&]+)' );

	$page_redirect_id=get_field(\App\ACFSetup::OPTION_PAGE_REDIRECT,'option')->ID;

	add_rewrite_rule(
		'go/([^/]+)',
		'index.php?post_type=page&page_id='.$page_redirect_id.'&pid=$matches[1]',
		'top'
	);
}
add_action( 'init', 'pcv_rewrite_url' );
