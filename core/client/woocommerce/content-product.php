<?php
add_action('init', function(){
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    // remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_before_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 15);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_after_product_thumbnail', 20);
    // add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20);
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    // add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_before_product_info', 5);
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    // add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);
    // add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 20);
    // add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);
    // add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_after_product_info', 30);
    // remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    // remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 15);
});

if ( ! function_exists( 'woocommerce_template_loop_product_link_open' ) ) {
    function woocommerce_template_loop_product_link_open() {
        echo '<div class="product_item_link text-center">';
    }
}

if ( ! function_exists( 'woocommerce_template_before_product_thumbnail' ) ) {
    function woocommerce_template_before_product_thumbnail() {
        echo '<div class="product_item_img">';
    } 
}


if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail('woocommerce_thumbnail');
    } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog' ) {
        global $post, $woocommerce;
        $output = '
            <a href="'.get_the_permalink($post).'" title="'.$post->post_title.'">
                '.media_view_image($post->ID, $post->post_title, $post->post_content, $size, "", "lazy-loaded").'
            </a>
        ';
        return $output;
    }
}

if ( ! function_exists( 'woocommerce_template_after_product_thumbnail' ) ) {
    function woocommerce_template_after_product_thumbnail() {
        echo '</div>';
    } 
}


if ( ! function_exists( 'woocommerce_template_before_product_info' ) ) {
    function woocommerce_template_before_product_info () {
        echo '<div class="fbox-desc">
                <div class="product-desc center">';
    }
}

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
    function woocommerce_template_loop_product_title() {
        echo '
          <h3 class="product_item_title">
              <a href="'.get_the_permalink().'" title="'.get_the_title().'">
                  '.get_the_title().'
              </a>
          </h3>
        ';
    }
}

if ( ! function_exists( 'woocommerce_template_loop_price' ) ) {
    function woocommerce_template_loop_price() {
        global $post, $woocommerce;
        echo '<div class="product_item_price">';
        wc_get_template( 'loop/price.php' );
        echo '</div>';
    }
}


if ( ! function_exists( 'woocommerce_template_after_product_info' ) ) {
    function woocommerce_template_after_product_info() {
        echo ' </div>
            </div>';
    }
}

if ( ! function_exists( 'woocommerce_template_loop_product_link_close' ) ) {
    function woocommerce_template_loop_product_link_close() {
        echo '</div>';
    }
}