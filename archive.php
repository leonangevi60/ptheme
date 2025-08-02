<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Template blog
 *
 * @package ThuongDQ
 */
?>
<?php
    get_header();
    $category_slugs_array = explode("+",esc_attr($wp_query->query['category_name']));
    $category = get_category_by_slug( $category_slugs_array[0] );
    if($category){
        $name = $category->name;
    }else{
        $tag = get_term_by('slug', $wp_query->query['tag'], 'post_tag');
        $name = "Tags: ".$tag->name;
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
                <?php get_sidebar(); ?>
                <div class="col-lg-9 order-lg-1">
                    <div class="blog-posts">
                        <?php
                            if ( have_posts() ) :
                                /* Start the Loop */
                            while ( have_posts() ) : the_post();
                            global $post;
                            $author = get_user_by('id', $post->post_author);
                            $list_cat = get_the_category( get_the_ID() );
                            $list_cat_arr = [];
                            foreach ($list_cat as $key_cat => $value_cat) {
                                $list_cat_arr[] = '<a href="'.get_category_link($value_cat).'" title="'.$value_cat->name.'">'.$value_cat->name.'</a>';
                            }
                        ?>
                            <article class="post post-medium">
                                <div class="row mb-3">
                                    <div class="col-lg-5">
                                        <div class="post-image">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php echo media_view_image(get_the_ID(), get_the_title(), get_the_content(), 'thumbnail', 'default', 'img-fluid img-thumbnail img-thumbnail-no-borders rounded-0'); ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="post-content">
                                            <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2">
                                               <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            <p class="mb-0">
                                                <?php echo post_sub_excerpt(get_the_content(), 530, ' [...]')?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="post-meta">
                                            <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date('d/m/Y'); ?> </span>
                                            <span><i class="far fa-user"></i> <a href="<?php echo get_author_posts_url($author->id); ?>"><?php echo $author->display_name; ?></a> </span>
                                            <span><i class="far fa-folder"></i> <?php echo implode(", ", $list_cat_arr); ?> </span>
                                            <span><i class="far fa-comments"></i> <a href="#"><?php echo get_comments_number(); ?> Bình luận</a></span>
                                            <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0">
                                                <a href="<?php the_permalink(); ?>" class="btn btn-xs btn-light text-1 text-uppercase">Chi tiết</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php
                            endwhile;
                            wp_reset_query();
                            get_template_part('pagination');
                            else :
                              ?>
                             <article class="post post-medium">
                                <h4>Nội dung đang được cập nhật</h4>
                            </article>
                          <?php
                            endif;
                            ?>

                    </div>
                </div>
            </div>

        </div>

    </div>
<?php get_footer(); ?>