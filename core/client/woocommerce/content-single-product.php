<?php
add_action('init', function(){
    // remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

    // remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10, 0);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 45, 0);
    // remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10, 0);
    // remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15, 0);
    add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    add_action('woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 5);
    add_action('woocommerce_single_product_summary', 'woocommerce_show_product_images', 7);
    add_action('woocommerce_single_product_summary', 'woocommerce_before_show_product_info', 9);
    add_action('woocommerce_single_product_summary', 'woocommerce_after_show_product_info', 60);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 5);

    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_before_single_add_to_cart', 25 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_after_single_add_to_cart', 35 );
});


if ( ! function_exists( 'woocommerce_before_show_product_info' ) ) {
  function woocommerce_before_show_product_info() {
    echo '<div class="detail_right detail-product-tab-2 col-sm-6">';
  }
}

if ( ! function_exists( 'woocommerce_after_show_product_info' ) ) {
  function woocommerce_after_show_product_info() {
    echo '</div>';
  }
}

if ( ! function_exists( 'woocommerce_template_before_single_add_to_cart' ) ) {
  function woocommerce_template_before_single_add_to_cart() {
    echo '<div class="action-product-add-card">';
  }
}

if ( ! function_exists( 'woocommerce_template_after_single_add_to_cart' ) ) {
  function woocommerce_template_after_single_add_to_cart() {
    echo '</div>';
  }
}