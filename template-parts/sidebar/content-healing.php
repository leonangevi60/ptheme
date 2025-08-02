
<?php
  $layers = get_option('layer1');
  $count = 0;
  foreach($layers as $key => $layer) : 
    $count++;
    if($count == 3){
        $limit = 3;
    }else{
        $limit = 4;
    }
    $query = array(
        'posts_per_page' => $limit,
        'cat' => $layer);
    $myqr = new WP_Query($query); ?>
    <div class="panel item-category">
    <div class="panel-heading">
        <a href="#" title="#"><?php echo get_name_by_category_ID($layer); ?></a></div>
    <div class="panel-body">
    <?php if($myqr->have_posts()) : $count = 1;?>
        <ul class="list-post">
            <?php
            while($myqr->have_posts()) : $myqr->the_post(); 
            echo '
                <li>
                    <a href="'.get_permalink().'" title="#">
                      '.get_the_title().'
                    </a>
                </li>
            ';
            endwhile; 
            wp_reset_postdata(); ?>
          <?php else: 
                echo "<h4>Nội dung đang được cập nhật</h4>";
          endif; ?>
        </ul>
    </div>
</div>
<?php endforeach;?>