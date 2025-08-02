<?php get_header(); 
    $args = array(
      'name'        => $wp_query->query['name'],
      'post_type'   => 'post',
      'post_status' => 'publish'
    );
    $current_post = get_posts($args);
    if($current_post){
        $name = $current_post[0]->post_title;
    }

?> 
<div role="main" class="main">
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8"><?php echo $name; ?></h1>
                </div>
                <div class="col-md-12 align-self-center">
                    <?php 
                        if ( function_exists('yoast_breadcrumb') ) {
                          yoast_breadcrumb('<div id="breadcrumb" class="breadcrumb d-block text-center" > ','</div>');
                        } 
                    ?>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">

        <div class="row">
            <div class="col">
                <div class="blog-posts single-post">
                    <?php
                    if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                    global $post;
                    $author = get_user_by('id', $post->post_author);
                    $list_cat = get_the_category( get_the_ID() );
                    $list_cat_arr = [];
                    foreach ($list_cat as $key_cat => $value_cat) {
                        $list_cat_arr[] = '<a href="'.get_category_link($value_cat).'" title="'.$value_cat->name.'">'.$value_cat->name.'</a>';
                    }
                    ?>

                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                       <!--  <div class="post-image ml-0">
                            <a href="blog-post.html">
                                <img src="img/blog/wide/blog-11.jpg" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                            </a>
                        </div> -->
                
                        <div class="post-date ml-0">
                            <span class="day"><?php echo get_the_date('d'); ?></span>
                            <span class="month"><?php echo get_the_date('F'); ?></span>
                        </div>
                
                        <div class="post-content ml-0">
                
                            <h2 class="font-weight-bold"><a href="blog-post.html"><?php the_title(); ?></a></h2>
                
                            <div class="post-meta">
                                <span><i class="far fa-user"></i> <a href="<?php echo get_author_posts_url($author->id); ?>"><?php echo $author->display_name; ?></a> </span>
                                <span><i class="far fa-folder"></i> <?php echo implode(", ", $list_cat_arr); ?> </span>
                                <span><i class="far fa-comments"></i> <a href="#"><?php echo get_comments_number(); ?> Bình luận</a></span>
                            </div>
                            <div class="wv-button-placeholder"></div>
                            <?php the_content(); ?>
                            <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                            <div id="comments" class="post-block mt-5 post-comments">
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) {
                                        comments_template();
                                    }
                                ?>
                
                            </div>
                
                        </div>
                    </article>
                    <?php
                        endwhile;
                        wp_reset_query();
                        endif;
                        ?>
                </div>
            </div>
        </div>

    </div>

</div>
<?php
    get_footer();
?>
