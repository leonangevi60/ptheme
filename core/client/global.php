<?php
global $report_view;
$report_view = false;
global $default_image;
if(client_get_options('default-image') &&  isset(client_get_options('default-image')['url'])){
	$default_image = client_get_options('default-image')['url'];
}else{
	$default_image = home_url().'/assets/images/logo.png';
}
$default_image = home_url().'/assets/images/logo.png';

// Search by Post Title
function search_by_title_only( $search, $wp_query )
{
    global $wpdb;
    if ( empty( $search ) )
        return $search; // skip processing - no search term in query
    $q = $wp_query->query_vars;
    $n = ! empty( $q['exact'] ) ? '' : '%';
    $search = '';
    $searchand = '';
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( $wpdb->esc_like( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter( 'posts_search', 'search_by_title_only', 500, 2 );

