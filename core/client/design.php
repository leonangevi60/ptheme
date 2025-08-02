<?php
function title_benh_ly_lien_quan($level){
	$title = '';
	$view = '';
	if($level == 'child'){
        if(client_get_options('breadcums-benhly-1')){
            $breadcums_ungthu = wp_get_menu_array(client_get_options('breadcums-benhly-1'));
            foreach ($breadcums_ungthu as $key => $value) {
                $title .= '
                <li>
                    <a href="'.$value['url'].'" title="'.$value['title'].'">
                        '.$value['title'].'
                    </a>
                </li>
                ';
            }
        }
	}else{
		
	}
	$view .= '
		<div class="title-category">
		    <ul class="nav nav-pills">
		        <li>
		            <a class="current-category" href="'.get_category_link($current_category->term_id).'" title="'.$current_category->name.'">
		                '.$current_category->name.'
		            </a>
		        </li>
		        '.$title.'
		    </ul>
		</div>
	';
}