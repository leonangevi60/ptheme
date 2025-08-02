<?php get_header(); 
    $args = array(
      'name'        => $wp_query->query['pagename'],
      'post_type'   => 'post',
      'post_status' => 'publish'
    );
    $current_page = get_posts($args);
    if($current_page){
        $name = $current_page[0]->post_title;
    }
?> 
<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
    <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-bold"><?php echo $name; ?></h3>
            </div>
            <?php if ( function_exists('yoast_breadcrumb') ) {
              yoast_breadcrumb('<div id="breadcrumbs" class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular" > ','</div>');
            } ?>
        </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: BLOG LISTING -->
    <div class="c-content-box c-size-md">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="c-content-blog-post-1-list">
                        <?php
                        if ( have_posts() ) :
                            /* Start the Loop */
                        while ( have_posts() ) : the_post();?>
                        <div class="c-content-blog-post-1">
                            <?php the_content(); ?>
                        </div>
                        <?php
                        endwhile;
                        wp_reset_query();
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                    get_sidebar();
                ?>
            </div>
        </div>
    </div>
    <!-- END: BLOG LISTING  -->
    <!-- END: PAGE CONTENT -->
</div>
<!-- END: PAGE CONTAINER -->
<?php
    get_footer();
?>



