<?php
/**
 * Code chen Google Analytics vao trang AMP
 **/
function my_amp_scripts( $data ) {
    $data['amp_component_scripts'] = array(
        'amp-analytics' => 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js'
    );
        return $data;
}
add_filter( 'amp_post_template_data', 'my_amp_scripts' );

function my_amp_analytics( $amp_template ) {
    ?>
    <amp-analytics type="googleanalytics">
    <script type="application/json">
    {
        "vars": {
            "account": "UA-98252574-1"
        },
            "triggers": {
            "trackPageview": {
            "on": "visible",
            "request": "pageview"
            }
        }
    }
    </script>
    </amp-analytics><?php
}
// add_action( 'amp_post_template_footer', 'my_amp_analytics' );

/**
 * Het Code chen Google Analytics vao trang AMP
 */
 
 
 /**
 * Code bai viet lien quan cuoi moi bai trong AMP thay so 7 bang so ban muon
 */
 function my_amp_related_posts( $count = 7 ) {
 
    global $post;
    $taxs = get_object_taxonomies( $post );
    if ( ! $taxs ) {
        return;
    }
 
    // ignoring post formats
    if( ( $key = array_search( 'post_format', $taxs ) ) !== false ) {
        unset( $taxs[$key] );
    }
 
    // try tags first
 
    if ( ( $tag_key = array_search( 'post_tag', $taxs ) ) !== false ) {
 
        $tax = 'post_tag';
        $tax_term_ids = wp_get_object_terms( $post->ID, $tax, array( 'fields' => 'ids' ) );
    }
 
    // if no tags, then by cat or custom tax
 
    if ( empty( $tax_term_ids ) ) {
        // remove post_tag to leave only the category or custom tax
        if ( $tag_key !== false ) {
            unset( $taxs[ $tag_key ] );
            $taxs = array_values($taxs);
        }
 
        $tax = $taxs[0];
        $tax_term_ids = wp_get_object_terms( $post->ID, $tax, array('fields' => 'ids') );
 
    }
 
    if ( $tax_term_ids ) {
        $args = array(
            'post_type' => $post->post_type,
            'posts_per_page' => $count,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'field' => 'id',
                    'terms' => $tax_term_ids
                )
            ),
            'post__not_in' => array ($post->ID),
        );
        $related = new WP_Query( $args );
 
        if ($related->have_posts()) : ?>
 
            <aside>
               <h3>Xem thêm</h3>
               <ul>
         
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
         
                    <li><a href="<?php echo amp_get_permalink( get_the_id() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
         
                    <?php endwhile; 
                    wp_reset_postdata(); ?>
                         
                </ul>
           </aside>
 
        <?php endif;
         
    }
 
} 

function my_add_related_posts_to_amp( $template ) {
    ?>
    <div class="amp-wp-content">
    <?php my_amp_related_posts(); ?>
    </div>
    <?php
}
add_action( 'amp_post_template_footer', 'my_add_related_posts_to_amp' );

 /**
 * Het code bai viet lien quan cuoi moi bai trong AMP thay so 7 bang so ban muon
 */
 
 /**
 * Code chen anh Featured Image 
 */

add_action( 'pre_amp_render_post', 'xyz_amp_add_custom_actions' );
function xyz_amp_add_custom_actions() {
    add_filter( 'the_content', 'xyz_amp_add_featured_image' );
}

function xyz_amp_add_featured_image( $content ) {
    if ( has_post_thumbnail() ) {
        // Just add the raw <img /> tag; our sanitizer will take care of it later.
        $image = sprintf( '<p class="xyz-featured-image">%s</p>', get_the_post_thumbnail() );
        $content = $image . $content;
    }
    return $content;
}
 /**
 * Het code chen anh Featured Image 
 */
