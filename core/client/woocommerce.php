<?php
require_once( CORE . "/client/woocommerce/global.php" );
require_once( CORE . "/client/woocommerce/content-product.php" );
require_once( CORE . "/client/woocommerce/single-product.php" );
require_once( CORE . "/client/woocommerce/content-single-product.php" );
// require_once( CORE . "/client/woocommerce/mini-cart.php" );
require_once( CORE . "/client/woocommerce/ajax.php" );
add_action('init', function(){
    // remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
});
if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ) {
  function woocommerce_taxonomy_archive_description() {
    if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
      $term = get_queried_object();
      if ( $term && ! empty( $term->description ) ) {
        echo '<h2 class="pull-right">' . wc_format_content( $term->description ) . '</h2>'; // WPCS: XSS ok.
      }
    }
  }
}

function custom_mini_cart() { 
    echo '<a href="#" class="dropdown-back" data-toggle="dropdown"> ';
    echo '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
    echo '<div class="basket-item-count" style="display: inline;">';
        echo '<span class="cart-items-count count">';
            echo WC()->cart->get_cart_contents_count();
        echo '</span>';
    echo '</div>';
    echo '</a>';
    echo '<ul class="dropdown-menu dropdown-menu-mini-cart">';
        echo '<li> <div class="widget_shopping_cart_content">';
                  woocommerce_mini_cart();
            echo '</div></li></ul>';
      }
add_shortcode( 'custom-techno-mini-cart', 'custom_mini_cart' );
/*Woocommerce minicart*/
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
 global $woocommerce;
 ob_start();
 ?>
 <div class="cart-contents"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div>
 <?php
 $fragments['div.cart-contents'] = ob_get_clean();
 return $fragments;
}
add_filter('woocommerce_product_add_to_cart_text', 'wh_archive_custom_cart_button_text');   // 2.1 +
function wh_archive_custom_cart_button_text()
{
  global $product;
  switch ($product->get_type()) {
      case 'variable':
        return __('Lựa chọn', 'woocommerce');
        break;
      default:
        return __('Thêm vào giỏ', 'woocommerce');
        break;
   } 
}
function custom_override_checkout_fields( $fields ) {
$fields['billing']['billing_first_name']['label'] = 'Họ';
$fields['billing']['billing_last_name']['label'] = 'Tên'; 
// $fields['billing']['billing_email']['label'] = 'メールアドレス';
// $fields['billing']['billing_phone']['label'] = '電話番号';
// $fields['billing']['billing_country']['label'] = '国';
// $fields['billing']['billing_city']['label'] = '名!';
// $fields['billing']['billing_city']['placeholder'] = '市町村';
// $fields['billing']['billing_state']['label'] = '都道府県';
// $fields['billing']['billing_state']['placeholder'] = '都道府県';
// $fields['billing']['billing_postcode']['label'] = '郵便番号';
// $fields['billing']['billing_postcode']['placeholder'] = '郵便番号';
// $fields['billing']['billing_address_1']['label'] = '住所';
// $fields['billing']['billing_address_1']['placeholder'] = '住所';
// $fields['billing']['billing_address_2']['placeholder'] = 'アパート名等';
return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function buy_now_submit_form() {
 ?>
  <script>
      jQuery(document).ready(function(){
          // listen if someone clicks 'Buy Now' button
          jQuery('#buy_now_button').click(function(){
              // set value to 1
              jQuery('#is_buy_now').val('1');
              //submit the form
              jQuery('form.cart').submit();
          });
      });
  </script>
 <?php
}
add_action('woocommerce_after_add_to_cart_form', 'buy_now_submit_form');
function redirect_to_checkout($redirect_url) {
  if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
     global $woocommerce;
     $redirect_url = wc_get_checkout_url();
  }
  return $redirect_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function get_icon_product_cat($product_cat_id){
  $thumbnail_id = get_woocommerce_term_meta($product_cat_id, 'thumbnail_id', true);
  $image = wp_get_attachment_url( $thumbnail_id );
  return $image;
}


/**
 * This code should be added to functions.php of your theme
 **/
add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');

function custom_default_catalog_orderby() {
     return 'price'; // Can also use title and price
}