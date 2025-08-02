<!-- pagination -->
<div class="pagination">
	<?php 
		global $wp_query;
	    $big = 999999999; // need an unlikely integer
		$paged = get_query_var('page') ? get_query_var('page') : 1;
		$paginate_links = paginate_links( array(
		    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		    'format' => '?paged=%#%',
		    'current' => max( 1, get_query_var('paged') ),
		    'total' => $wp_query->max_num_pages,
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

		echo $paginate_view;
	?>
</div>
<!-- /pagination -->
