<?php
if ( ! function_exists( 'ultra_woocommerce_single_gallery_thumbnail_size' ) ) :
/**
 * Change the gallery thumbnail image size.
 * @link https://github.com/woocommerce/woocommerce/wiki/Customizing-image-sizes-in-3.3-
 */
function ultra_woocommerce_single_gallery_thumbnail_size( $size ) {
    return array(
        'width'  => 150,
        'height' => 150,
        'crop'   => 0,
    );  
}
endif;
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'ultra_woocommerce_single_gallery_thumbnail_size' );




add_theme_support( 'woocommerce', array(
    'thumbnail_image_width'         => 250,
    'single_image_width'            => 500,
) );
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', get_option( 'amount-product' ) );
function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
    global $wp_query;
    $cols = $wp_query->post_count;
  $cols = 16;
  return $cols;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_catalog_ordering_args', 20, 1 );

function add_html_permalink_product( $post_type, $args ) {
  if ( $post_type === 'product' )
  add_permastruct( $post_type, "/%$post_type%.html", $args->rewrite );
}
add_action( 'registered_post_type', 'add_html_permalink_product', 10, 2 );


function custom_catalog_ordering_args( $args ) {
  // $product_category = 'my-pham-duc'; // <== HERE define your product category
  // Only for defined product category archive page
  // if( ! is_product_category($product_category) ) return $args;
  // Set default ordering to 'date ID', so "Newness"
  $args['orderby'] = 'date ID';
  if( $args['orderby'] == 'date ID' )
    $args['order'] = 'DESC'; // Set order by DESC
  //if( $args['meta_key'] )
  //  unset($args['meta_key']);
  return $args;
}
// add_filter( 'woocommerce_product_variation_title_include_attributes', 'custom_product_variation_title', 10, 2 );
// function custom_product_variation_title($should_include_attributes, $product){
//     $should_include_attributes = false;
//     return $should_include_attributes;
// }
/**
 * Get list id product variable by product id
 */
// $handle=new WC_Product_Variable('48');
// $variations1=$handle->get_children();
// echo '<pre>';
// print_r($variations1);
// echo '</pre>';
// add_filter( 'woocommerce_grouped_price_html', 'bbloomer_grouped_price_range_from', 10, 3 );
// function bbloomer_grouped_price_range_from( $price, $product, $child_prices ) {
//   echo '<pre>';
//   print_r($child_prices);
//   echo '</pre>';
// $prices = array( min( $child_prices ), max( $child_prices ) );
// $price = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
// return $price;
// }




// show min price product in woocommerce variable
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2); 
function custom_variation_price( $price, $product ) { 
     $price = '';
     $price .= wc_price($product->get_price()); 
     return $price;
}