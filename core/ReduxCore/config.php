<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if ( ! class_exists( 'Redux' ) ) {
    return;
}
// This is your option name where all the Redux data is stored.
$opt_name = "tp_options";
// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );
/*
 *
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 *
 */
//Check info
$sampleHTML = '';
if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
    Redux_Functions::initWpFilesystem();
    global $wp_filesystem;
    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
}
// Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
$sample_patterns      = array();
if ( is_dir( $sample_patterns_path ) ) {
    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
        $sample_patterns = array();
        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {
            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                $name              = explode( '.', $sample_patterns_file );
                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                $sample_patterns[] = array(
                    'alt' => $name,
                    'img' => $sample_patterns_url . $sample_patterns_file
                );
            }
        }
    }
}
/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme(); // For use with some settings. Not necessary.
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __( 'Cấu hình', 'ThuongDQ' ),
    'page_title'           => __( 'Cấu hình', 'ThuongDQ' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '_options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);
// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
// $args['admin_bar_links'][] = array(
//     'id'    => 'docs',
//     'href'  => '#',
//     'title' => __( 'Documentation', 'ThuongDQ' ),
// );
$args['admin_bar_links'] = array();
// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
    'url'   => '#',
    'title' => 'Visit us on GitHub',
    'icon'  => 'el el-github'
    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
);
$args['share_icons'] = array();
// Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
    if ( ! empty( $args['global_variable'] ) ) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace( '-', '_', $args['opt_name'] );
    }
    $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'ThuongDQ' ), $v );
} else {
    $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'ThuongDQ' );
}
// Add content after the form.
$args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'ThuongDQ' );
Redux::setArgs( $opt_name, $args );
/*
 * ---> END ARGUMENTS
 */
/*
 * ---> START HELP TABS
 */
$tabs = array(
    array(
        'id'      => 'redux-help-tab-1',
        'title'   => __( 'Theme Information 1', 'ThuongDQ' ),
        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'ThuongDQ' )
    ),
    array(
        'id'      => 'redux-help-tab-2',
        'title'   => __( 'Theme Information 2', 'ThuongDQ' ),
        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'ThuongDQ' )
    )
);
Redux::setHelpTab( $opt_name, $tabs );
// Set the help sidebar
$content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'ThuongDQ' );
Redux::setHelpSidebar( $opt_name, $content );
/*
 * <--- END HELP TABS
 */
/*
 *
 * ---> START SECTIONS
 *
 */
/*
    As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
 */
// -> START Basic Fields
// BEGIN GLOBAL
Redux::setSection( $opt_name, array(
    'title'  => __( 'Tổng quát', 'ThuongDQ' ),
    'desc'   => __( 'Cấu hình chung cho toàn Website.', 'ThuongDQ' ),
    'icon'   => 'el el-globe',
    'id'     => 'global',
    'fields' => array(
            array(
                'id'    => 'default-image',
                'type'  => 'media',
                'title' => __('Hình ảnh mặc định', 'ThuongDQ'),
                'desc'  => __('Hình ảnh bạn muốn sử dụng làm ảnh thay thế cho khu vực không có ảnh.', 'ThuongDQ')
            ),
            array(
                'id'       => 'banner-ad-global',
                'type'     => 'slides',
                'title'       => __('Danh sách ảnh quảng cáo chung cho toàn bộ sản phẩm', 'ThuongDQ'),
                'subtitle'    => __('Không giới hạn số lượng ảnh, Kéo và thả để sắp xếp', 'ThuongDQ'),
                'desc'        => __('Là danh sách banner quảng cáo nằm dưới slides ảnh sản phẩm trong trang chi tiết', 'ThuongDQ'),
                'placeholder' => array(
                    'title'           => __('Tiêu đề', 'ThuongDQ'),
                    'description'     => __('Mô tả', 'ThuongDQ'),
                    'url'             => __('Liên kết', 'ThuongDQ'),
                ),
            ),
            array(
                'id'    => 'page-quick-search',
                'type'  => 'select',
                'title' => __( 'Trang Tìm kiếm nhanh', 'ThuongDQ' ), 
                'data'  => 'pages',
                'args'  => array(
                    'posts_per_page' => -1,
                    'orderby'        => 'id',
                    'order'          => 'DESC',
                )
            ),
            array(
                'id'       => 'quick-search-key',
                'type'     => 'slides',
                'title'       => __('Từ khóa tìm kiếm nhanh', 'ThuongDQ'),
                'subtitle'    => __('Nhập thông tin từ khóa bạn muốn khách hàng tìm kiếm nhanh', 'ThuongDQ'),
                'placeholder' => array(
                    'title'           => __('Từ khóa', 'ThuongDQ'),
                    'description'     => __('Mô tả', 'ThuongDQ'),
                    'url'             => __('Liên kết', 'ThuongDQ'),
                ),
            ),
            array(
                'id'    => 'page-tra-gop',
                'type'  => 'select',
                'title' => __( 'Trang mua hàng trả góp', 'ThuongDQ' ), 
                'data'  => 'pages',
                'args'  => array(
                    'posts_per_page' => -1,
                    'orderby'        => 'id',
                    'order'          => 'DESC',
                )
            ),
            array(
                'id'    => 'phone-hotline',
                'type'  => 'text',
                'title' => __('Số điện thoại mua hàng nhanh', 'ThuongDQ'),
                'desc'  => __('', 'ThuongDQ')
                )
            ),
            array(
                'id'    => 'facebook',
                'type'  => 'text',
                'title' => __('Facebook', 'ThuongDQ'),
                'desc'  => __('Đường dẫn liên kết đến fanepage', 'ThuongDQ')
            ),
            array(
                'id'    => 'tweeter',
                'type'  => 'text',
                'title' => __('Tweeter', 'ThuongDQ'),
                'desc'  => __('Đường dẫn liên kết đến fanepage', 'ThuongDQ')
            ),
            array(
                'id'    => 'google',
                'type'  => 'text',
                'title' => __('Google', 'ThuongDQ'),
                'desc'  => __('Đường dẫn liên kết đến fanepage', 'ThuongDQ')
            ),
            array(
                'id'    => 'mail',
                'type'  => 'text',
                'title' => __('Mail', 'ThuongDQ'),
                'desc'  => __('Địa chỉ email nhận thư', 'ThuongDQ')
            ),
            array(
                'id'    => 'youtube',
                'type'  => 'text',
                'title' => __('Chanel youtube', 'ThuongDQ'),
                'desc'  => __('Nhập vào ID kênh you của bạn', 'ThuongDQ')
            )
) );
// END GLOBAL
// -> START Basic Fields
// BEGIN HEADER
Redux::setSection( $opt_name, array(
    'title'  => __( 'Đầu trang', 'ThuongDQ' ),
    'desc'   => __( 'Cấu hình chung cho toàn Website.', 'ThuongDQ' ),
    'icon'   => 'el el-arrow-down',
    'id'     => 'header',
    'fields' => array(
            array(
                'id'    => 'header-slogan',
                'type'  => 'editor',
                'title' => __('khẩu hiệu hoặc giới thiệu ngắn vè công ty', 'ThuongDQ'),
                'desc'  => __('Đặt trên cùng của trang.', 'ThuongDQ')
            ),
            array(
                'id'    => 'logo-image',
                'type'  => 'media',
                'title' => __('Hình ảnh Logo', 'ThuongDQ'),
                'desc'  => __('Hình ảnh bạn muốn sử dụng làm logo.', 'ThuongDQ')
            ),
            array(
                'id'       => 'menu-top',
                'type'     => 'select',
                'title'    => __('Menu top', 'ThuongDQ'), 
                'subtitle' => __('Nằm trên cùng của website', 'ThuongDQ'),
                'desc'     => __('Đây là menu 1 cấp nằm trên cùng cạnh slogan công ty', 'ThuongDQ'),
                'data'     => 'menu'
            ),
            array(
                'id'       => 'menu-main',
                'type'     => 'select',
                'title'    => __('Menu chính nằm dưới logo của website', 'ThuongDQ'), 
                'subtitle' => __('Menu chứa links chính cùng của website', 'ThuongDQ'),
                'desc'     => __('Đây là menu đa cấp gồm các liên kết chính', 'ThuongDQ'),
                'data'     => 'menu'
            )
        )
) );
// END HEADER
// -> START Basic Fields
// BEGIN CONTENT
Redux::setSection( $opt_name, array(
    'title'            => __( 'Nội dung chính', 'ThuongDQ' ),
    'id'               => 'content',
    'desc'             => __( 'Cấu hình tất cả nội dung nằm giữa trang!', 'ThuongDQ' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-home'
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Trang chủ', 'ThuongDQ' ),
    'id'               => 'home',
    'subsection'       => true,
    'customizer_width' => '500px',
    'desc'             => __( 'Nội dung hiển thị trên trang chủ', 'ThuongDQ' ) ,
    'fields'           => array(
        array(
            'id'       => 'menu-products',
            'type'     => 'select',
            'title'    => __('Menu sản phẩm công ty', 'ThuongDQ'), 
            'subtitle' => __('Danh sách các danh mục sản phâm của công ty', 'ThuongDQ'),
            'desc'     => __('Dữ liệu menu, nằm bên trái cạnh slide', 'ThuongDQ'),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'slides-show-home',
            'type'     => 'slides',
            'title'       => __('Slides ảnh chạy', 'ThuongDQ'),
            'subtitle'    => __('Không giới hạn số lượng ảnh, Kéo và thả để sắp xếp', 'ThuongDQ'),
            'desc'        => __('Là slide chạy hình ảnh hiển thị trên đầu trang chủ', 'ThuongDQ'),
            'placeholder' => array(
                'title'           => __('Tiêu đề', 'ThuongDQ'),
                'description'     => __('Mô tả', 'ThuongDQ'),
                'url'             => __('Liên kết', 'ThuongDQ'),
            ),
        ),
        array(
            'id'       => 'menu-news',
            'type'     => 'select',
            'title'    => __('Menu tin tức', 'ThuongDQ'), 
            'subtitle' => __('Chuyên mục tin tức nổi bật của công ty', 'ThuongDQ'),
            'desc'     => __('Dữ liệu menu, Trên Mobile sẽ hiển thị để thay thế slide', 'ThuongDQ'),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'slides-poster',
            'type'     => 'slides',
            'title'       => __('Ảnh quảng cáo', 'ThuongDQ'),
            'subtitle'    => __('Không giới hạn số lượng ảnh, Kéo và thả để sắp xếp', 'ThuongDQ'),
            'desc'        => __('Là các ảnh quảng cáo hiển thị bên dưới slide trên trang chủ. Chiều rộng tối đa của ảnh 1200px', 'ThuongDQ'),
            'placeholder' => array(
                'title'           => __('Tiêu đề', 'ThuongDQ'),
                'description'     => __('Mô tả', 'ThuongDQ'),
                'url'             => __('Liên kết', 'ThuongDQ'),
            ),
        ),
        array(
            'id'       => 'hot-products',
            'type'     => 'slides',
            'title'       => __('Ảnh đại diện cho box khuyến mại hót', 'ThuongDQ'),
            'subtitle'    => __('Ảnh nằm trên cùng của box thay thế cho tiêu đề', 'ThuongDQ'),
            'desc'        => __('Lấy tất cả sản phẩm bán chạy mà trong kho vẫn còn hàng. Chiều rộng tối đa của ảnh 1200px', 'ThuongDQ'),
            'placeholder' => array(
                'title'           => __('Tiêu đề', 'ThuongDQ'),
                'description'     => __('Mô tả', 'ThuongDQ'),
                'url'             => __('Liên kết đến sản phẩm hoặc chuyên mục khuyến mại', 'ThuongDQ'),
            ),
        ),
        array(
            'id'       => 'list-categoties',
            'type'     => 'select',
            'title'    => __('Danh sách các menu chuyên mục muốn hiển thị lên trang chủ', 'ThuongDQ'), 
            'subtitle' => __('Nội dung chính hiển thị các sản phẩm trên trang chủ', 'ThuongDQ'),
            'desc'     => __('Đây là menu 2 cấp. Cấp 1 là chuyên mục cha và cấp 2 là chuyên mục con muốn hiển thị dạng tab', 'ThuongDQ'),
            'data'     => 'menu'
        ),
)
) );
Redux::setSection( $opt_name, array(
    'title'            => __( 'Box nhúng toàn trang', 'ThuongDQ' ),
    'id'               => 'box-embed',
    'subsection'       => true,
    'customizer_width' => '500px',
    'desc'             => __( 'Là thông tin các box hiển thị được nhúng trong toàn trang', 'ThuongDQ' ) ,
    'fields'           => array(
        array(
            'id'       => 'box-ad-footer',
            'type'     => 'slides',
            'title'       => __('Quảng cáo về chính sách của công ty', 'ThuongDQ'),
            'subtitle'    => __('4 thông tin quảng cáo về công ty', 'ThuongDQ'),
            'placeholder' => array(
                'title'           => __('Tiêu đề', 'ThuongDQ'),
                'description'     => __('Mô tả', 'ThuongDQ'),
                'url'             => __('Liên kết', 'ThuongDQ'),
            ),
        ),
        array(
            'id'       => 'box-static-footer',
            'type'     => 'slides',
            'title'       => __('Thống kê thông tin quảng cáo về công ty', 'ThuongDQ'),
            'subtitle'    => __('4 thông tin thống kê về công ty', 'ThuongDQ'),
            'placeholder' => array(
                'title'           => __('Tiêu đề', 'ThuongDQ'),
                'description'     => __('Mô tả', 'ThuongDQ'),
                'url'             => __('Liên kết', 'ThuongDQ'),
            ),
        ),
    )
) );
// Redux::setSection( $opt_name, array(
//     'title'            => __( 'Sản phẩm', 'ThuongDQ' ),
//     'id'               => 'product',
//     'subsection'       => true,
//     'customizer_width' => '500px',
//     'desc'             => __( 'Nội dung hiển thị trên các trang về sản phẩm', 'ThuongDQ' ) ,
//     'fields'           => array(
//         array(
//             'id'       => 'amount-product',
//             'type'     => 'text',
//             'title'    => __('Số lượng sản phẩm trong trang danh mục', 'ThuongDQ'), 
//             'subtitle' => __('Dữ Liệu số', 'ThuongDQ'),
//             'validate' => 'number',
//         )
//     )
// ) );
// Redux::setSection( $opt_name, array(
//     'title'            => __( 'Công ty', 'ThuongDQ' ),
//     'id'               => 'company',
//     'subsection'       => true,
//     'customizer_width' => '500px',
//     'desc'             => __( 'Nội dung hiển thị thông tin về công ty trên trang chủ', 'ThuongDQ' ) ,
//     'fields'           => array(
//         array(
//             'id'       => 'company-name',
//             'type'     => 'text',
//             'title'    => __('Tên công ty', 'ThuongDQ'), 
//             'subtitle' => __('', 'ThuongDQ')
//         ),
//         array(
//             'id'       => 'company-slogan',
//             'type'     => 'text',
//             'title'    => __('Slogan của công ty', 'ThuongDQ'), 
//             'subtitle' => __('', 'ThuongDQ')
//         ),
//         array(
//             'id'       => 'company-info',
//             'type'     => 'textarea',
//             'title'    => __('Mô tả ngắn về công ty', 'ThuongDQ'), 
//             'subtitle' => __('', 'ThuongDQ')
//         ),
//         array(
//             'id'       => 'company-news',
//             'type'     => 'select',
//             'title'    => __('Bài viết về công ty', 'ThuongDQ'), 
//             'subtitle' => __('', 'ThuongDQ'),
//             'desc'     => __('', 'ThuongDQ'),
//             'data'     => 'menu'
//         ),array(
//             'id'       => 'company-youtube',
//             'type'     => 'text',
//             'title'    => __('Video của công ty', 'ThuongDQ'), 
//             'subtitle' => __('Nhập vào mã nhúng của video', 'ThuongDQ')
//         )
//     )
// ) );
// Redux::setSection( $opt_name, array(
//     'title'            => __( 'sidebar', 'ThuongDQ' ),
//     'id'               => 'sidebar',
//     'desc'             => __( 'Cấu hình tất cả nội dung nằm bên phải trang!', 'ThuongDQ' ),
//     'customizer_width' => '400px',
//     'icon'             => 'el el-arrow-right',
//     'fields' => array(
//         array(
//             'id'       => 'menu-left',
//             'type'     => 'select',
//             'title'    => __('Menu sản phẩm', 'ThuongDQ'), 
//             'subtitle' => __('Nằm bên trái của website', 'ThuongDQ'),
//             'desc'     => __('Đây là menu 2 cấp gồm các links về danh mục sản phẩm', 'ThuongDQ'),
//             'data'     => 'menu'
//         ), 
//         array(
//             'id'       => 'info-advertising-company',
//             'type'     => 'slides',
//             'title'       => __('Thông tin để quảng cáo về công ty', 'ThuongDQ'),
//             'subtitle'    => __('Các thông tin quảng caaos về chất lượng và uy tín của công ty', 'ThuongDQ'),
//             'desc'        => __('Các thông tin quảng caaos về chất lượng và uy tín của công ty', 'ThuongDQ'),
//             'placeholder' => array(
//                 'title'           => __('Tiêu đề', 'ThuongDQ'),
//                 'description'     => __('Mô tả', 'ThuongDQ'),
//                 'url'             => __('Liên kết', 'ThuongDQ'),
//             ),
//         )
//         // array(
//         //     'id'       => 'ad-right',
//         //     'type'     => 'slides',
//         //     'title'       => __('Những hình ảnh quảng cáo', 'ThuongDQ'),
//         //     'subtitle'    => __('Là những hình ảnh quảng cáo nằm bên phải website trong mục tin tức', 'ThuongDQ'),
//         //     'placeholder' => array(
//         //         'title'           => __('Tiêu đề', 'ThuongDQ'),
//         //         'description'     => __('Mô tả', 'ThuongDQ'),
//         //         'url'             => __('Liên kết', 'ThuongDQ'),
//         //     ),
//         // ),
//     )
// ) );
// END CONTENT
// -> START Basic Fields
// BEGIN FOOTER
Redux::setSection( $opt_name, array(
    'id'               => 'footer',
    'title'            => __( 'Cuối trang', 'ThuongDQ' ),
    'desc'             => __( 'Cấu hình chung cho toàn Website.', 'ThuongDQ' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-arrow-up',
    'fields' => array(
        array(
            'id'       => 'footer-menu-1',
            'type'     => 'select',
            'title'    => __('Menu chân trang 1', 'ThuongDQ'), 
            'subtitle' => __('DỮ LIỆU MENU', 'ThuongDQ'),
            'desc'     => __('Menu đầu tiên tính từ trái trang nằm ở cuối trang', 'ThuongDQ'),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'footer-menu-2',
            'type'     => 'select',
            'title'    => __('Menu chân trang 2', 'ThuongDQ'), 
            'subtitle' => __('DỮ LIỆU MENU', 'ThuongDQ'),
            'desc'     => __('Menu thứ 2 tính từ trái trang nằm ở cuối trang', 'ThuongDQ'),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'footer-menu-3',
            'type'     => 'select',
            'title'    => __('Menu chân trang 3', 'ThuongDQ'), 
            'subtitle' => __('DỮ LIỆU MENU', 'ThuongDQ'),
            'desc'     => __('Menu  thứ 3 tính từ trái trang nằm ở cuối trang', 'ThuongDQ'),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'footer-menu-4',
            'type'     => 'select',
            'title'    => __('Menu chân trang 4', 'ThuongDQ'), 
            'subtitle' => __('DỮ LIỆU MENU', 'ThuongDQ'),
            'desc'     => __('Menu  thứ 4 tính từ trái trang nằm ở cuối trang', 'ThuongDQ'),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'footer-menu-end',
            'type'     => 'select',
            'title'    => __( 'Menu nằm ngang dưới cùng của trang', 'ThuongDQ' ),
            'subtitle' => __( '', 'ThuongDQ' ),
            'data'     => 'menu'
        ),
        array(
            'id'       => 'footer-info-bottom',
            'type'     => 'textarea',
            'title'    => __( 'Thông tin chân trang', 'ThuongDQ' ),
            'subtitle' => __( '', 'ThuongDQ' ),
        ),
        array(
            'id'       => 'footer-embed',
            'type'     => 'textarea',
            'title'    => __( 'Mã nhúng đặt cuối trang', 'ThuongDQ' ),
            'subtitle' => __( '', 'ThuongDQ' ),
        ),
    )
) );
if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
    $section = array(
        'icon'   => 'el el-list-alt',
        'title'  => __( 'Documentation', 'ThuongDQ' ),
        'fields' => array(
            array(
                'id'       => '17',
                'type'     => 'raw',
                'markdown' => true,
                'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                //'content' => 'Raw content here',
            ),
        ),
    );
    Redux::setSection( $opt_name, $section );
}
/*
 * <--- END SECTIONS
 */
/*
 *
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
 *
 */
/*
*
* --> Action hook examples
*
*/
// If Redux is running as a plugin, this will remove the demo notice and links
//add_action( 'redux/loaded', 'remove_demo' );
// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
//add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
// Change the arguments after they've been declared, but before the panel is created
//add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
// Change the default value of a field after it's been set, but before it's been useds
//add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
// Dynamically add a section. Can be also used to modify sections/fields
//add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }
}
/**
 * Custom function for the callback validation referenced above
 * */
if ( ! function_exists( 'redux_validate_callback_function' ) ) {
    function redux_validate_callback_function( $field, $value, $existing_value ) {
        $error   = false;
        $warning = false;
        //do your validation
        if ( $value == 1 ) {
            $error = true;
            $value = $existing_value;
        } elseif ( $value == 2 ) {
            $warning = true;
            $value   = $existing_value;
        }
        $return['value'] = $value;
        if ( $error == true ) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }
        if ( $warning == true ) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }
        return $return;
    }
}
/**
 * Custom function for the callback referenced above
 */
if ( ! function_exists( 'redux_my_custom_field' ) ) {
    function redux_my_custom_field( $field, $value ) {
        print_r( $field );
        echo '<br/>';
        print_r( $value );
    }
}
/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 * */
if ( ! function_exists( 'dynamic_section' ) ) {
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'ThuongDQ' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'ThuongDQ' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );
        return $sections;
    }
}
/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if ( ! function_exists( 'change_arguments' ) ) {
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;
        return $args;
    }
}
/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if ( ! function_exists( 'change_defaults' ) ) {
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';
        return $defaults;
    }
}
/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}
