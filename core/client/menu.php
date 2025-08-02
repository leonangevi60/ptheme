<?php
// Đổi class submenu của menu 
add_theme_support('menus');

function menu_change_class_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown-menu" /',$menu);    
    return $menu;
}
add_filter('wp_nav_menu','menu_change_class_submenu_class'); 

//Chuyển cấu hình menu về dạng mảng
function wp_get_menu_array($current_menu) {
 
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    if( $array_menu ){
        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu[$m->ID] = array();
                $menu[$m->ID]['ID']      =   $m->ID;
                $menu[$m->ID]['title']       =   $m->title;
                $menu[$m->ID]['url']         =   $m->url;
                $menu[$m->ID]['classes']     =   $m->classes;
                $menu[$m->ID]['children']    =   array();
            }
        }
        $submenu = array();
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu[$m->ID] = array();
                $submenu[$m->ID]['ID']       =   $m->ID;
                $submenu[$m->ID]['title']    =   $m->title;
                $submenu[$m->ID]['url']  =   $m->url;
                $submenu[$m->ID]['classes']     =   $m->classes;
                $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
            }
        }
    }
    return $menu;
     
}




function wp_get_menu_array_parent($current_menu) {
 
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    if( $array_menu ){
        foreach ($array_menu as $m) {
            $menu[$m->menu_item_parent][] = $m;
        }
    }
    return $menu;
}

//Thay đổi cấu trúc của menu
// $options = array(
//     'echo' => false,
//     'container' => false,
//     "menu" => client_get_options('home-box-2-sub-category-1'),
// );

// $menu = wp_nav_menu($options);
// $new_menu =  preg_replace(array(
//     '#^<ul[^>]*>#',
//     '#</ul>$#'
// ), '', $menu);

// echo '<ul class="nav navbar-nav">';
// echo '<li><a>cac benh ung thu</a> </li>';
// echo $new_menu;
// echo '<ul>';



//Đăng ký vị trí cho menu
// function register_Position_menu()
// {
//   register_nav_menus(array( // Using array to specify more menus if needed
//     'header-menu' => __('Đầu trang', 'ThuongDQ'), // Main Navigation
//     'sidebar-menu' => __('Lề trang', 'ThuongDQ'), // Sidebar Navigation
//     'footer-menu' => __('Cuối trang', 'ThuongDQ'), // Sidebar Navigation
//     'content-menu' => __('Nội dung', 'ThuongDQ'), // Sidebar Navigation
//     'extra-menu' => __('Mở rộng', 'ThuongDQ') // Extra Navigation if needed (duplicate as many as you need!)
//   ));
// }
// function nav_menu()
// {
//   wp_nav_menu(
//     array(
//       'theme_location'  => 'header-menu',
//       'menu'            => '',
//       'container'       => 'div',
//       'container_class' => 'menu-{menu slug}-container',
//       'container_id'    => '',
//       'menu_class'      => 'menu',
//       'menu_id'         => '',
//       'echo'            => true,
//       'fallback_cb'     => 'wp_page_menu',
//       'before'          => '',
//       'after'           => '',
//       'link_before'     => '',
//       'link_after'      => '',
//       'items_wrap'      => '<ul>%3$s</ul>',
//       'depth'           => 0,
//       'walker'          => ''
//     )
//   );
// }
// add_action('init', 'register_Position_menu');



function wp_get_menu_array_object($current_menu) {
    $menu = wp_get_nav_menu_items($current_menu);
    $menu_array = array();
    foreach ($menu as $key => $value) {
        $menu_array[$value->menu_item_parent][] = $value;
    }
    return $menu_array;
}


function menu_dequi_view($menu_array_parent, $curentmenu, $menu_view){
    $class = '';
    if($curentmenu->classes[0] != ""){
        $class = 'class="dropdown '.implode(' ', $curentmenu->classes).'"';
    }else{
        $class = 'class="dropdown"';
    }
    if(in_array('dropdown-mega',$curentmenu->classes)){
        $menu_view .= '
        <li '.$class.'>
            <a class="dropdown-item dropdown-toggle" id="'.$curentmenu->ID.'" href="'.$curentmenu->url.'" title="'.$curentmenu->title.'">
                '.$curentmenu->title.'
            </a>
            <ul class="dropdown-menu">
                <li>
                    <div class="dropdown-mega-content">
                        <div class="row">
        ';

        foreach ($menu_array_parent[$curentmenu->ID] as $key_child => $value_child) {
            if(in_array('element-col-3',$curentmenu->classes)){
                $menu_view .= '<div class="col-lg-3">';
            }else{
                $menu_view .= '<div class="col-lg-3">';
            }

            $class = '';
            if($value_child->classes[0] != ""){
                $class = 'class="dropdown-mega-sub-title" '.implode(' ', $value_child->classes).'"';
            }else{
                $class = 'class="dropdown-mega-sub-title"';
            }

            if($menu_array_parent[$value_child->ID] !== null){
                $menu_view .= '
                    <span '.$class.' id="'.$value_child->ID.'" href="'.$value_child->url.'" title="'.$value_child->title.'">
                        '.$value_child->title.'
                    </span>
                ';
                $menu_view .= '<ul class="dropdown-mega-sub-nav">';
                foreach ($menu_array_parent[$value_child->ID] as $key_mega => $value_mega) {
                    $menu_view .= '
                        <li>
                            <a class="dropdown-item" id="'.$value_mega->ID.'" href="'.$value_mega->url.'" title="'.$value_mega->title.'">
                                '.$value_mega->title.'
                            </a>
                        </li>';
                }
                $menu_view .= '</ul>';
            }else{
                $menu_view .= '
                    <a '.$class.' id="'.$value_child->ID.'" href="'.$value_child->url.'" title="'.$value_child->title.'">
                        '.$value_child->title.'
                    </a>
                ';
            }
            

            $menu_view .= '</div>';            
        }
        
             
        $menu_view .= '
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        ';
    }else{
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
    }
    
    return $menu_view;
}