<?php

define( 'THEME_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/pcv');
define( 'THEME_ROOT_URI', get_stylesheet_directory_uri());

require_once( THEME_ROOT_PATH . "/functions/theme-setup.php" );
require_once( THEME_ROOT_PATH . "/functions/bootstrap5-nav-walker.php" );
require_once( THEME_ROOT_PATH . "/functions/security.php" );