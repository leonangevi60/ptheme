<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */
/*------------------------------------*\
    Custom Functions
\*------------------------------------*/
global $current_link;
$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
/**
@ Khai bao hang gia tri
@ THEME_URL = lay duong dan thu muc theme
@ CORE = lay duong dan cua thu muc /core
**/
define( 'THEME_URL', get_stylesheet_directory() );
define ( 'CORE', THEME_URL . "/core" );
define ( 'ASSET', get_template_directory_uri() . "/asset" );
/**
@ Nhung file /core/init.php
**/
// require_once( CORE . "/lib/init.php" );
// if( !class_exists( 'ReduxFramewrk' ) ) {
//     require_once( CORE . '/ReduxCore/framework.php' );
// }
require_once( CORE . "/client/redux.php" );
// require_once( CORE . "/ReduxCore/sample-config.php" );
require_once( CORE . "/client/config.php" );
require_once( CORE . "/admin/config.php" );
require_once( CORE . "/admin/style.php" );
require_once( CORE . "/client/global.php" );
require_once( CORE . "/client/post.php" );
require_once( CORE . "/client/category.php" );
require_once( CORE . "/client/menu.php" );
require_once( CORE . "/client/media.php" );
require_once( CORE . "/client/widget.php" );
// require_once( CORE . "/client/permalink.php" );
// add_theme_support( 'woocommerce' );
// require_once( CORE . "/client/woocommerce.php" );
require_once( CORE . "/client/custom-field.php" );
require_once( CORE . "/client/yoastseo.php" );
require_once( CORE . "/client/design.php" );
require_once( CORE . "/client/amp.php" );



