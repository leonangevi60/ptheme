<?php
//Thay đổi tên danh mục
function category_change_name($name){
    $name =  preg_replace('/Thực phẩm gây ung thư$/i', 'Thực phẩm', $name);
    $name =  preg_replace('/Chuyên gia ung thư$/i', 'Chuyên gia', $name);
    return $name;   
}

function category_get_name_by_ID( $cat_ID ) {
    $cat_ID = (int) $cat_ID;
    $category = get_term( $cat_ID, 'category' );
    if($category){
        return $category->name;
    }else{
        return "";
    } 
}

//config phân trang
function category_custom_pagination()
{
 global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
            'prev_text'    => __('&laquo;'),
            'next_text'    => __('&raquo;'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination pagination-sm page-numbers">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul>';
        }
} 
add_action('init', 'category_custom_pagination'); 
