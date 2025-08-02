<?php
if( function_exists('acf_add_options_page') ) {   

    acf_add_options_page(array(
        'page_title'    => 'Danh sách công ty hỗ trợ trả góp',
        'menu_title'    => 'Cấu hình trả góp',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'menu_slug'     => 'theme-general-settings'
    )); 
}

function mass_update_posts() {
		
	$args = array(	'post_type'=>'product', //whatever post type you need to update 
					'posts_per_page'   => -1);
		
	$my_posts = get_posts($args);
	
	foreach($my_posts as $key => $my_post){
		$meta_values = get_post_meta( $my_post->ID);
		foreach($meta_values as $meta_key => $meta_value ){
			update_field($meta_key, $meta_value[0], $my_post->ID);
		}
	}
}

// add_action( 'init', 'mass_update_posts' );