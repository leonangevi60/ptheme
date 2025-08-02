<?PHP
    get_header();
?> 
<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
    <!-- <div class="c-layout-breadcrumbs-1 c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-bold">Blog List View</h3>
            </div>
            <ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
                <li>
                    <a href="#">Pages</a>
                </li>
                <li>
                    /
                </li>
                <li class="c-state_active">
                    Blog List View
                </li>
            </ul>
        </div>
    </div> -->
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
                    	?>
                    <header class="page-header">
						<h1 class="page-title">
							<?php printf( __( 'Kết quả tìm kiếm cho: %s' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
						</h1>
					</header><!-- .page-header -->

					<?php
                        /* Start the Loop */
                    while ( have_posts() ) : the_post();?>
                    <div class="c-content-blog-post-1">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php
                        $img = get_the_post_thumbnail();
                        if($img == ''){
                            $img = '<img src="'.get_path_image_first_content_post().'" alt="'.get_the_title().'">';
                        }
                        echo $img;
                        ?>
                        </a>
                        <div class="c-title c-font-bold c-font-uppercase">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="c-desc">
                            <?php
                            html5wp_excerpt('html5wp_index');
                            ?>
                        </div>
                        <div class="c-panel">
                            <div class="c-author">
                                <a href="#">Viết bởi <span class="c-font-uppercase"><?php the_author(); ?></span></a>
                            </div>
                            <div class="c-date">
                                vào <span class="c-font-uppercase"><?php echo get_the_date(); ?></span>
                            </div>
                            <ul class="c-tags c-theme-ul-bg">
                                <?php the_tags( '<li>', '</li><li>', '</li>'); ?>
                            </ul>

                            <div class="c-comments">
                                <a href="#"><i class="icon-speech"></i> <?php echo get_comments_number()?> comments</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                    get_template_part('pagination');
                    else :
                      ?>
                     <div class="c-content-blog-post-1">
                        <h4>Không tìm thấy bài viết phù hợp.</h4>
                    </div>
                  <?php
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




<?php get_header(); ?>

	<?php if (have_posts()) : ?>

		<h2>Search Results</h2>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2><?php the_title(); ?></h2>

				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

			</div>

		<?php endwhile; ?>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>No posts found.</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>