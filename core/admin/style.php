<?php
/*********************
* add style for admin
**********************/
function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/core/admin/css/admin.css' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


/*********************
* add style for login admin
**********************/
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/core/admin/css/login.css' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/core/admin/js/login.js', array( 'jquery' ), '1.0.0', true  );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// add_filter( 'login_headerurl', 'custom_loginlogo_url' );

// function custom_loginlogo_url($url) {
//      return 'https://laptrinhtructuyen.com/';
// }