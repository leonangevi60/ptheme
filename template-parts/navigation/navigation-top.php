<!-- BEGIN: BRAND -->
<div class="c-navbar-wrapper clearfix">
    <div class="c-brand c-pull-left">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-logo" alt="Lập trình trực tuyến">
        <img src="<?php echo get_template_directory_uri('/'); ?>/design/base/img/layout/logos/logo.png" alt="Lập trình trực tuyến" class="c-desktop-logo">
        <img src="<?php echo get_template_directory_uri('/'); ?>/design/base/img/layout/logos/logo.png" alt="Lập trình trực tuyến" class="c-desktop-logo-inverse">
        <img src="<?php echo get_template_directory_uri('/'); ?>/design/base/img/layout/logos/logo.png" alt="Lập trình trực tuyến" class="c-mobile-logo">
        </a>
        <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
        <span class="c-line"></span>
        <span class="c-line"></span>
        <span class="c-line"></span>
        </button>
        <button class="c-search-toggler" type="button">
        <i class="fa fa-search"></i>
        </button>
    </div>
    <!-- END: BRAND -->
    <!-- BEGIN: QUICK SEARCH -->
    <form class="c-quick-search" action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
        <input type="text" id="s" name="s"  placeholder="Nhập để tìm kiếm..." value="" class="form-control" autocomplete="off">
        <span class="c-theme-link">&times;</span>
    </form>
    <!-- END: QUICK SEARCH -->
    <!-- BEGIN: HOR NAV -->
    <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
    <!-- BEGIN: MEGA MENU -->
    <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
        <!-- BEGIN: MEGA MENU -->
        <?php wp_nav_menu(array("menu" => "menu-top", 'container'=>"", 'menu_class' => 'nav navbar-nav')) ?>
        <ul class="nav navbar-nav">
            <li class="c-search-toggler-wrapper">
                <a href="#" class="c-btn-icon c-search-toggler"><i class="fa fa-search"></i></a>
            </li>
        </ul>
        <!-- END MEGA MENU -->
        </nav>
        <!-- END: MEGA MENU -->
        <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
        <!-- END: HOR NAV -->
    </div>