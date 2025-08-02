<div class="col-lg-3 order-lg-2">
    <aside class="sidebar">
        <form action="page-search-results.html" method="get">
            <div class="input-group mb-3 pb-1">
                <input class="form-control text-1" placeholder="Tìm kiếm..." name="s" id="s" type="text">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
                </span>
            </div>
        </form>
        <h5 class="font-weight-bold pt-4">Danh mục</h5>
        <ul class="nav nav-list flex-column mb-5">
            <?php
                $args = array(
                    'type'                     => 'post',
                    'child_of'                 => '',
                    'parent'                   => 0,
                    'orderby'                  => 'name',
                    'order'                    => 'ASC',
                    'hide_empty'               => false,
                    'hierarchical'             => 1,
                    'exclude'                  => array(1),
                    'include'                  => '',
                    'number'                   => '',
                    'taxonomy'                 => 'category',
                    'pad_counts'               => false
                );
                $categories = get_categories($args);
                $list_category_view = '';
                foreach ($categories as $key => $value) {
                    $args_child = array(
                        'parent' => $value->term_id,
                    );
                    $categories_child = get_categories($args_child);
                    if(empty($categories_child)){
                       $list_category_view .= '
                            <li class="nav-item">
                                <a class="nav-link"  href="'.get_category_link($value).'" title"'.$value->name.'">'.$value->name.' ('.$value->count.')</a>
                            </li>
                        '; 
                    }else{
                        $list_category_view .= '
                            <li class="nav-item">
                                <a href="'.get_category_link($value).'" title"'.$value->name.'">'.$value->name.' ('.$value->count.')</a>
                                <ul>';
                        foreach ($categories_child as $key_chid => $value_child) {
                            $list_category_view .= '
                                <li class="nav-item">
                                    <a class="nav-link"  href="'.get_category_link($value_child).'" title"'.$value_child->name.'">'.$value_child->name.' ('.$value_child->count.')</a>
                                </li>
                            '; 
                        }
                        $list_category_view .= '
                                </ul>
                            </li>
                        '; 
                    }
                }
                echo $list_category_view;
            ?>
        </ul>
        <div class="tabs tabs-dark mb-4 pb-2">
            <ul class="nav nav-tabs">
                <li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">Phổ biến</a></li>
                <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Gần đây</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="popularPosts">
                    <ul class="simple-post-list">
                        <?php
                             $args = array(
                                'posts_per_page' => 4,
                                'post_type' => 'post',
                                'suppress_filters' => false,
                                'orderby' => 'post_views',
                                'order' => 'DESC'
                            );
                            $popularPosts = get_posts( $args );
                            foreach ($popularPosts as $key => $value) {
                                echo '
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                <a href="'.get_permalink($value).'" title="'.$value->post_title.'">
                                                    '.media_view_image($value->ID, $value->post_title, $value->post_content, 'thumbnail', 'default', '', 'width="50" height="50"').'
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a href="'.get_permalink($value).'" title="'.$value->post_title.'">
                                                '.$value->post_title.'
                                            </a>
                                            <div class="post-meta">
                                                 '.get_the_date('d/m/Y', $value).'
                                            </div>
                                        </div>
                                    </li>
                                ';
                            }
                        ?>
                    </ul>
                </div>
                <div class="tab-pane" id="recentPosts">
                    <ul class="simple-post-list">
                        <?php
                             $args = array(
                                'posts_per_page' => 4,
                                'post_type' => 'post',
                                'orderby' => 'id',
                                'order' => 'DESC'
                            );
                            $recentPosts = get_posts( $args );
                            foreach ($recentPosts as $key => $value) {
                                echo '
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                <a href="'.get_permalink($value).'" title="'.$value->post_title.'">
                                                    '.media_view_image($value->ID, $value->post_title, $value->post_content, 'thumbnail', 'default', '', 'width="50" height="50"').'
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a href="'.get_permalink($value).'" title="'.$value->post_title.'">
                                                '.$value->post_title.'
                                            </a>
                                            <div class="post-meta">
                                                 '.get_the_date('d/m/Y', $value).'
                                            </div>
                                        </div>
                                    </li>
                                ';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <h5 class="font-weight-bold pt-4">Giới thiệu</h5>
        <p>Tôi là 1 lập trình viên và luôn muốn chia sẻ với tất cả các bạn những hiểu biết của mình. </p>
    </aside>
</div>