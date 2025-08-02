<?php
add_filter( 'woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment', 30, 1 );
function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    if($woocommerce->cart->cart_contents_count){
        $total = "/ ".$woocommerce->cart->get_cart_total();
    }else{
        $total = "";
    }
    ?>
    <div id="top-cart">
        <div class="info">GIỎ HÀNG <?php echo $total; ?></div>
        <a class="cart-customlocation"  href="javascript:doSomething();" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
            <span>
                <div class="cart-contents">
                    <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
                </div>
            </span>
        </a>
        <div class="top-cart-content">
            <?php echo wc_get_template( 'cart/mini-cart.php' );?>
        </div>
    </div>
    <?php
    $fragments['#top-cart'] = ob_get_clean();
    return $fragments;
}

function mode_theme_update_mini_cart() {
  echo wc_get_template( 'cart/mini-cart.php' );
  die();
}
add_filter( 'wp_ajax_nopriv_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );
add_filter( 'wp_ajax_mode_theme_update_mini_cart', 'mode_theme_update_mini_cart' );