<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Template demo
 *
 * @package ThuongDQ
 */
function wp_get_menu_array_object($current_menu) {
    $menu = wp_get_nav_menu_items($current_menu);
    $menu_array = array();
    foreach ($menu as $key => $value) {
        $menu_array[$value->menu_item_parent][] = $value;
    }
    return $menu_array;
}

$menu_main = wp_get_menu_array_object(client_get_options('menu-main'));
// $menu_main = wp_get_nav_menu_items(client_get_options('menu-main'));
// echo '<pre>';
// print_r($menu_main);
// echo "</prE>";
function menu_dequi_view($menu_array_parent, $curentmenu, $menu_view){
	$class = '';
    if($curentmenu->classes[0] != ""){
    	$class = 'class="'.implode(' ', $curentmenu->classes).'"';
    }

    $menu_view .= '
        <li '.$class.'>
            <a class="dropdown-item dropdown-toggle" id="'.$curentmenu->ID.'" href="'.$curentmenu->url.'" title="'.$curentmenu->title.'">
                '.$curentmenu->title.'
            </a>
            <ul class="dropdown-menu">
    ';

    foreach ($menu_array_parent[$curentmenu->ID] as $key_child => $value_child) {
    	$class = '';
	    if($value_child->classes[0] != ""){
	    	$class = 'class="'.implode(' ', $value_child->classes).'"';
	    }

    	if(null !== $menu_array_parent[$value_child->ID]){
    		$menu_view = menu_dequi_view($menu_array_parent, $value_child, $menu_view);
    	}else{
    		$menu_view .= '
	            <li '.$class.'>
	                <a class="dropdown-item" id="'.$value_child->ID.'" href="'.$value_child->url.'" title="'.$value_child->title.'">
	                	'.$value_child->title.'
	                </a>
	            </li>
	        ';
    	}
        
    }

    $menu_view .= '
            </ul>
        </li>
    ';
    return $menu_view;
}

foreach ($menu_main[0] as $key => $value) {
    $class = '';
    if($value->classes[0] != ""){
    	$class = 'class="'.implode(' ', $value->classes).'"';
    }
    if( null !== $menu_main[$value->ID]){
    	$menu_main_view = menu_dequi_view($menu_main, $value, $menu_main_view);
    }else{
       $menu_main_view .= '
            <li '.$class.'>
                <a id="'.$value->ID.'" href="'.$value->url.'" title="'.$value->title.'">
                    '.$value->title.'
                </a>
            </li>
        ';
    }
    
}

echo $menu_main_view;
?>