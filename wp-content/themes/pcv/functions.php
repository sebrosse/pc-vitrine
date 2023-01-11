<?php

define( 'THEME_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/pcv' );
define( 'THEME_ROOT_URI', get_stylesheet_directory_uri() );

require_once( THEME_ROOT_PATH . "/vendor/autoload.php" );
require_once( THEME_ROOT_PATH . "/functions/theme-setup.php" );
require_once( THEME_ROOT_PATH . "/functions/Bootstrap5MenuWalker.php" );
require_once( THEME_ROOT_PATH . "/functions/security.php" );
require_once( THEME_ROOT_PATH . "/functions/PCVProduct.php" );
require_once( THEME_ROOT_PATH . '/cpt/pc-product.php' );
require_once( THEME_ROOT_PATH . "/functions/ACFSetup.php" );
require_once( THEME_ROOT_PATH . "/functions/ApiCall.php" );
require_once( THEME_ROOT_PATH . "/functions/AjaxCall.php" );
require_once( THEME_ROOT_PATH . "/functions/FormattingHelper.php" );
require_once( THEME_ROOT_PATH . "/functions/User.php" );
require_once( THEME_ROOT_PATH . "/functions/Search.php" );
require_once( THEME_ROOT_PATH . "/functions/ImportAction.php" );
require_once( THEME_ROOT_PATH . "/functions/EncryptionHelper.php" );