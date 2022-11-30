<?php

add_filter('use_block_editor_for_post', '__return_false', 10);

add_action( 'after_setup_theme', 'pcv_setup' );
function pcv_setup() {
	load_theme_textdomain( 'pcv', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
	add_theme_support( 'woocommerce' );
	global $content_width;
	if ( !isset( $content_width ) ) { $content_width = 1920; }
	register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'pcv' ) ) );
}

add_action( 'admin_init', 'pcv_notice_dismissed' );
function pcv_notice_dismissed() {
	$user_id = get_current_user_id();
	if ( isset( $_GET['dismiss'] ) )
		add_user_meta( $user_id, 'pcv_notice_dismissed_8', 'true', true );
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
if ( !function_exists( 'pcv_wp_body_open' ) ) {
	function pcv_wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
add_action( 'wp_body_open', 'pcv_skip_link', 5 );
function pcv_skip_link() {
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'pcv' ) . '</a>';
}
add_filter( 'the_content_more_link', 'pcv_read_more_link' );
function pcv_read_more_link() {
	if ( !is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'pcv' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
}
add_filter( 'excerpt_more', 'pcv_excerpt_read_more_link' );
function pcv_excerpt_read_more_link( $more ) {
	if ( !is_admin() ) {
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
		'name' => esc_html__( 'Sidebar Widget Area', 'pcv' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'wp_head', 'pcv_pingback_header' );
function pcv_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'comment_form_before', 'pcv_enqueue_comment_reply_script' );
function pcv_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
function pcv_custom_pings( $comment ) {
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
	<?php
}
add_filter( 'get_comments_number', 'pcv_comment_count', 0 );
function pcv_comment_count( $count ) {
	if ( !is_admin() ) {
		global $id;
		$get_comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

function pcv_enqueue_style(){
	wp_enqueue_style('bootstrap',THEME_ROOT_URI.'/assets/css/vendor/bootstrap.min.css');
	wp_enqueue_style('font-awesome',THEME_ROOT_URI.'/assets/css/vendor/font-awesome.css');
	wp_enqueue_style('flaticon',THEME_ROOT_URI.'/assets/css/vendor/flaticon/flaticon.css');
	wp_enqueue_style('slick',THEME_ROOT_URI.'/assets/css/vendor/slick.css');
	wp_enqueue_style('slick-theme',THEME_ROOT_URI.'/assets/css/vendor/slick-theme.css');
	wp_enqueue_style('jquery-ui.min',THEME_ROOT_URI.'/assets/css/vendor/jquery-ui.min.css');
	wp_enqueue_style('sal',THEME_ROOT_URI.'/assets/css/vendor/sal.css');
	wp_enqueue_style('magnific-popup',THEME_ROOT_URI.'/assets/css/vendor/magnific-popup.css');
	wp_enqueue_style('base',THEME_ROOT_URI.'/assets/css/vendor/base.css');
	wp_enqueue_style('style',THEME_ROOT_URI.'/assets/css/style.css');
}
add_action( 'wp_enqueue_scripts', 'pcv_enqueue_style' );

function pcv_enqueue_scripts(){
	wp_enqueue_script('modernizr',THEME_ROOT_URI.'/assets/js/vendor/modernizr.min.js');
	wp_enqueue_script('jquery',THEME_ROOT_URI.'/assets/js/vendor/jquery.js');
	wp_enqueue_script('popper',THEME_ROOT_URI.'/assets/js/vendor/popper.min.js');
	wp_enqueue_script('bootstrap',THEME_ROOT_URI.'/assets/js/vendor/bootstrap.min.js');
	wp_enqueue_script('slick',THEME_ROOT_URI.'/assets/js/vendor/slick.min.js');
	wp_enqueue_script('cookie',THEME_ROOT_URI.'/assets/js/vendor/js.cookie.js');

	wp_enqueue_script('jquery-ui',THEME_ROOT_URI.'/assets/js/vendor/jquery-ui.min.js');
	wp_enqueue_script('jquery.countdown',THEME_ROOT_URI.'/assets/js/vendor/jquery.countdown.min.js');
	wp_enqueue_script('sal',THEME_ROOT_URI.'/assets/js/vendor/sal.js');
	wp_enqueue_script('jquery.magnific-popup',THEME_ROOT_URI.'/assets/js/vendor/jquery.magnific-popup.min.js');
	wp_enqueue_script('imagesloaded',THEME_ROOT_URI.'/assets/js/vendor/imagesloaded.pkgd.min.js');
	wp_enqueue_script('counterup',THEME_ROOT_URI.'/assets/js/vendor/counterup.js');
	wp_enqueue_script('waypoints',THEME_ROOT_URI.'/assets/js/vendor/waypoints.min.js');

	wp_enqueue_script('main',THEME_ROOT_URI.'/assets/js/main.js');
}
add_action( 'wp_enqueue_scripts', 'pcv_enqueue_scripts' );