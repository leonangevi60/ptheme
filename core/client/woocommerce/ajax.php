<?php
// AJAX DATA LOAD TAB HOME LIST CATEGORY
add_action( 'wp_ajax_list_cat_item', 'list_cat_item_init' );
add_action( 'wp_ajax_nopriv_list_cat_item', 'list_cat_item_init' );
function list_cat_item_init() {
    $result = "";
    $cat = (isset($_POST['cat']))?esc_attr($_POST['cat']) : '';
    // $product_id = (isset($_POST['product_id']))?esc_attr($_POST['product_id']) : '';

    // $list_agency = get_field('list_agency','option'); 
    // foreach ($list_agency as $key => $value) {
    //   if($value['code_agency'] == $_POST['agency']){
    //     $result['agency'] = [
    //       'title' => $value['title_box_agency'],
    //       'content' => $value['content_box_agency']
    //     ];
    //   }
    // }
    // $list_khuyen_mai = get_field( 'chi_nhanh', $product_id);
    // foreach ($list_khuyen_mai as $key => $value) {
    //   if($value['ma_chi_nhanh'] == $_POST['agency']){
    //     $result['khuyenmai'] = [
    //       'title' => $value['ten_chi_nhanh'],
    //       'content' => $value['khuyen_mai']
    //     ];
    //   }
    // }
    // $title_box_thong_so = get_field( 'title_box_thong_tin', $product_id);
    // $thong_so_ky_thuat= get_field( 'thong_so_ky_thuat', $product_id);

    $args = array(
        'posts_per_page' => 8,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                // 'terms' => 'white-wines'
                'terms' => $cat,
            )
        ),
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '=',
            )
        ),
        'post_type' => 'product',
        'orderby' => 'title,'
    );
    $products = new WP_Query( $args );
    // $result .= '<div class="row tab-pane fade" id="box-'.$cat.'">';
    // $result .= '<div class="tab-content">'.count($product);
    
    if($products->have_posts()){
        while ( $products->have_posts() ) {
            $products->the_post();
            global $product;
            $defaults = array(
              'quantity'   => 1,
              'class'      => implode( ' ', array_filter( array(
                'button',
                'product_type_' . $product->get_type(),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
              ) ) ),
              'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
              ),
            );

            
            $result .= '<div class="product_item col-md-3 col-sm-4 col-xs-6">';
            $result .= '<div class="product_item_link text-center">';

            $result .= '<div class="product_item_img">';
            $result .= woocommerce_get_product_thumbnail('woocommerce_thumbnail');
            $result .= '</div>';
            $result .= '<div class="fbox-desc"><div class="product-desc center">';
            $result .= '
                        <h3 class="product_item_title">
                            <a href="'.get_the_permalink().'" title="'.get_the_title().'">
                                '.get_the_title().'
                            </a>
                        </h3>
                      ';
            $result .= '<div class="product_item_price">'.$product->get_price_html().'</div>';
            $result .= apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
                          sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                            esc_url( $product->add_to_cart_url() ),
                            esc_attr( isset( $defaults['quantity'] ) ? $defaults['quantity'] : 1 ),
                            esc_attr( isset( $defaults['class'] ) ? $defaults['class'] : 'button' ),
                            isset( $defaults['attributes'] ) ? wc_implode_html_attributes( $defaults['attributes'] ) : '',
                            esc_html( $product->add_to_cart_text() )
                          ),
                        $product, $defaults );
            $result .= '</div></div>';     

            $result .= '</div>';
            $result .= '</div>';
        }
    }
    // $result .= '</div>';
    // $result .= '</div>';
    wp_reset_query();
    wp_send_json_success(json_encode($result));
 
    die();//bắt buộc phải có khi kết thúc
}


// AJAX DATA SINGLE PRODUCT
add_action( 'wp_ajax_data_single_product', 'data_single_product_init' );
add_action( 'wp_ajax_nopriv_data_single_product', 'data_single_product_init' );
function data_single_product_init() {
    $result = "";
    $agency = (isset($_POST['agency']))?esc_attr($_POST['agency']) : '';
    $product_id = (isset($_POST['product_id']))?esc_attr($_POST['product_id']) : '';

    $list_agency = get_field('list_agency','option'); 
    foreach ($list_agency as $key => $value) {
      if($value['code_agency'] == $_POST['agency']){
        $result['agency'] = [
          'title' => $value['title_box_agency'],
          'content' => $value['content_box_agency']
        ];
      }
    }
    $list_khuyen_mai = get_field( 'chi_nhanh', $product_id);
    foreach ($list_khuyen_mai as $key => $value) {
      if($value['ma_chi_nhanh'] == $_POST['agency']){
        $result['khuyenmai'] = [
          'title' => $value['ten_chi_nhanh'],
          'content' => $value['khuyen_mai']
        ];
      }
    }
    $title_box_thong_so = get_field( 'title_box_thong_tin', $product_id);
    $thong_so_ky_thuat= get_field( 'thong_so_ky_thuat', $product_id);


    wp_send_json_success(json_encode($result));
 
    die();//bắt buộc phải có khi kết thúc
}