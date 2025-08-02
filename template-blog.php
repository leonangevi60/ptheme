<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Template blog
 *
 * @package ThuongDQ
 */
?>
<?php get_header(); ?>
<?php
	$args = array(
	    'posts_per_page' => -1,
	    'orderby'     => 'modified',
	    'order'       => 'DESC',
	);
	$list_post_all = get_posts($args);

	$pagination = '';
	$big = 999999999; // need an unlikely integer
	$per_page = 5;
	$paged = get_query_var('page') ? get_query_var('page') : 1;
	$paginate_links = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => ceil(count($list_post_all)/$per_page),
	    'prev_next' => false,
	    'type'  => 'array',
	    'prev_next'   => TRUE,
	    'prev_text'    => __('&laquo;'),
	    'next_text'    => __('&raquo;'),
	) );


	$paginate_view = "";
	if( is_array( $paginate_links ) ) {
	    $paginate_view .= '<ul class="pagination float-right">';
	        foreach ( $paginate_links as $page ) {
	            if(strpos($page, "current")){
	                $class = ' active';
	            }else{
	                $class = '';
	            }
	            $page = '<li class="page-item '.$class.'">'.str_replace("page-numbers", "page-link", $page).'</li>';
	            $paginate_view .= $page;
	        }
	    $paginate_view .= '</ul>';
	}
?>
	<div role="main" class="main">
		<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
			<div class="container">
				<div class="row">
					<div class="col-md-12 align-self-center p-static order-2 text-center">
						<h1 class="text-dark font-weight-bold text-8">SHARE STORE</h1>
					</div>
				</div>
			</div>
		</section>

		<div class="container py-4">
			<div class="row">
				<?php get_sidebar(); ?>
				<div class="col-lg-9 order-lg-1">
					<div class="blog-posts">
						<?php
							$args = array( 
				                'posts_per_page'   => $per_page ,
				                'offset' => $per_page * ($paged - 1),
				                'orderby'     => 'modified',
	    						'order'       => 'DESC',
				            );

				            $list_post = get_posts( $args );
				            foreach ($list_post as $key => $value) {
				            	$author = get_user_by('id', $value->post_author);
				            	$list_cat = get_the_category( $value->ID );
				            	$list_cat_arr = [];
				            	foreach ($list_cat as $key_cat => $value_cat) {
				            		$list_cat_arr[] = '<a href="'.get_category_link($value_cat).'" title="'.$value_cat->name.'">'.$value_cat->name.'</a>';
				            	}
						?>
							<article class="post post-medium">
								<div class="row mb-3">
									<div class="col-lg-5">
										<div class="post-image">
											<a href="<?php echo get_permalink($value); ?>" title="<?php echo $value->post_title; ?>">
												<?php echo media_view_image($value->ID, $value->post_title, $value->post_content, 'thumbnail', 'default', 'img-fluid img-thumbnail img-thumbnail-no-borders rounded-0'); ?>
											</a>
										</div>
									</div>
									<div class="col-lg-7">
										<div class="post-content">
											<h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2">
												<a href="<?php echo get_permalink($value); ?>" title="<?php echo $value->post_title; ?>">
													<?php echo $value->post_title; ?>
												</a>
											</h2>
											<p class="mb-0">
												<?php echo post_sub_excerpt($value->post_content, 530, ' [...]')?>
											</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="post-meta">
											<span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d/m/Y', $value); ?> </span>
											<span><i class="far fa-user"></i> <a href="<?php echo get_author_posts_url($author->id); ?>"><?php echo $author->display_name; ?></a> </span>
											<span><i class="far fa-folder"></i> <?php echo implode(", ", $list_cat_arr); ?> </span>
											<span><i class="far fa-comments"></i> <a href="#"><?php echo get_comments_number($value); ?> Bình luận</a></span>
											<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0">
												<a href="<?php echo get_permalink($value); ?>" class="btn btn-xs btn-light text-1 text-uppercase">Chi tiết</a>
											</span>
										</div>
									</div>
								</div>
							</article>
						<?php }?>
						<?php echo $paginate_view; ?>

					</div>
				</div>
			</div>

		</div>

	</div>
<?php get_footer(); ?>