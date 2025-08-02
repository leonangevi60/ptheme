<?php

// Remove category base
// Xóa Category cha trên đường dẫn
// Cấu trúc ten-mien/ten-danh-muc
// Begin Remove category base
add_filter('category_link', 'no_category_parents',1000,2);
function no_category_parents($catlink, $category_id) {
    $category = get_category( $category_id );
    if($category->category_parent != 0){
      $parent = get_category( $category->category_parent );
    }

    if ( is_wp_error( $category ) )
          return $category;
      $category_nicename = $category->slug;
    // if($category->category_parent != 0 && $parent->slug == 'nam-lim-xanh'){
    //   $catlink = trailingslashit(get_option( 'home' )).'nam-lim-xanh/'. user_trailingslashit( $category_nicename, 'category' );
    // }else if($category->category_parent != 0 && $parent->slug == 'cay-xa-den'){
    //   $catlink = trailingslashit(get_option( 'home' )).'cay-xa-den/'. user_trailingslashit( $category_nicename, 'category' );
    // }else{
    //   $catlink = trailingslashit(get_option( 'home' )) . user_trailingslashit( $category_nicename, 'category' );
    // }
      $catlink = trailingslashit(get_option( 'home' )).'news/'.$category_id .'/' . user_trailingslashit( $category_nicename, 'category' );
    return $catlink;
}

// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_parents_rewrite_rules');
function no_category_parents_rewrite_rules($category_rewrite) {
    //print_r($category_rewrite); // For Debugging

    $category_rewrite=array();
    $categories=get_categories(array('hide_empty'=>false));
    foreach($categories as $category) {
        $category_nicename = $category->slug;
        $category_rewrite['('.$category_nicename.')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
        $category_rewrite['('.$category_nicename.')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
        $category_rewrite['('.$category_nicename.')/?$'] = 'index.php?category_name=$matches[1]';
    }
    // Redirect support from Old Category Base
    global $wp_rewrite;
    $old_base = $wp_rewrite->get_category_permastruct();
    $old_base = str_replace( 'news/%category%', '(.+)', $old_base );
    $old_base = trim($old_base, '/');
    $category_rewrite[$old_base.'$'] = 'index.php?category_redirect=$matches[1]';

    //print_r($category_rewrite); // For Debugging
    return $category_rewrite;
}

// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_parents_query_vars');
function no_category_parents_query_vars($public_query_vars) {
    $public_query_vars[] = 'category_redirect';
    return $public_query_vars;
}
// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_parents_request');
function no_category_parents_request($query_vars) {
    //print_r($query_vars); // For Debugging
    if(isset($query_vars['category_redirect'])) {
        $catlink = trailingslashit(get_option( 'home' )).'news/' . user_trailingslashit( $query_vars['category_redirect'], 'category' );
        status_header(301);
        header("Location: $catlink");
        exit();
    }
    return $query_vars;
}
// End Remove category base

//set single category for post link
/**
 * Plugin Name: Single Category Permalink
 * Version:     2.2
 *
 **/
defined( 'ABSPATH' ) or die();
if ( ! class_exists( 'SingleCategoryPermalink' ) ) :
class SingleCategoryPermalink {
 
  public static function init() {
    add_action( 'init', array( __CLASS__, 'do_init' ) );
  }

  public static function do_init() {
    add_filter( 'post_link',         array( __CLASS__, 'post_link' ),        10, 2 );
  }

  /**
   * Returns post URI for a given post.
   *
   * If the post permalink structure includes %category%, then this function
   * kicks into gear to reduce a hierarchical category structure to its lowest
   * category.
   *
   * @param  string  $permalink The default URI for the post
   * @param  WP_Post $post      The post
   * @return string             The post URI.
   */
  public static function post_link( $permalink, $post ) {
    
    $permalink_structure = get_option( 'permalink_structure' );
    // Only do anything if '%category%' is part of the post permalink
   
    // $check_cat = false;
    // if($cats->category_parent != 0){
    //   $parent = get_category( $cats->category_parent );
    //   if($parent->slug = 'nam-lim-xanh'){
    //     $check_cat = true;
    //   }
    // }

    if ( strpos( $permalink_structure, '%category%' ) !== false ) {
      // Find the canonical category for the post (assigned category with
      // lowest id)
       $cats = get_the_category( $post->ID );
      if ( $cats ) {
        // Order categories by term_id.
        if ( function_exists( 'wp_list_sort' ) ) { // Introduced in WP 4.7
          $cats = wp_list_sort( $cats, 'term_id' );
        } else {
          usort( $cats, '_usort_terms_by_ID' );
        }
        $category = $cats[0];
      } else {
        $category = get_category( absint( get_option( 'default_category' ) ) );
      }
      // Find category hierachy for the category. By default, these would be
      // part of the full category permalink.
      $category_hierarchy = $category->slug;
      if ( $parent = $category->parent ) {
        if($category->parent !=  0){
          $category_parent = get_category( $category->parent );
          if($category_parent->slug == 'nam-lim-xanh'){
            $category_hierarchy = $category->slug;
          }else if($category_parent->slug == 'cay-xa-den'){
            $category_hierarchy = $category->slug;
          }else{
            $category_hierarchy = get_category_parents( $parent, false, '/', true ) . $category->slug;
          }
        }else{
          $category_hierarchy = get_category_parents( $parent, false, '/', true ) . $category->slug;
        }
        
      }
      // Now that the permalink component involving category hierarchy consists of is known, get rid of it.

      $permalink = str_replace( $category_hierarchy, $category->slug, $permalink );
    }

    $url = $_SERVER['REQUEST_URI'];
    if(strpos($url, '/amp')){
      $permalink = '/amp';
    }

    return $permalink;
  }
} // end SingleCategoryPermalink

SingleCategoryPermalink::init();
endif; // end if !class_exists()

if ( ! function_exists( 'single_category_postlink' ) ) :
/**
 * Returns post URI for a given post.
 *
 * If the post permalink structure includes %category%, then this function
 * kicks into gear to reduce a hierarchical category structure to its lowest
 * category.
 *
 * @deprecated 2.2 Use SingleCategoryPermalink::post_link() instead.
 *
 * @param  string  $permalink The default URI for the post
 * @param  WP_Post $post      The post
 * @return string  The post URI
 */
function single_category_postlink( $permalink, $post ) {
  _deprecated_function( __FUNCTION__,  'SingleCategoryPermalink::post_link()' );
  return SingleCategoryPermalink::post_link( $permalink, $post );
}
endif;
