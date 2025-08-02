<?php
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
function client_get_options($option){
    global $tp_options;
    if(isset($tp_options[$option])){
        return $tp_options[$option];
    }
    return false;
    // print_r(Redux::getField('tp_options', $option));
    // return Redux::getField('tp_options', $option);
}
//minify
class WP_HTML_Compression{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;
    // Variables
    protected $html;
    public function __construct($html){
        if (!empty($html)){
            $this->parseHTML($html);
        }
    }
    public function __toString(){
        return $this->html;
    }
    protected function bottomComment($raw, $compressed){
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw-$compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html){
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;
        // Variable reused for output
        $html = '';
        foreach ($matches as $token){
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
            $content = $token[0];
            if (is_null($tag))
            {
                if ( !empty($token['script']) )
                {
                    $strip = $this->compress_js;
                }
                else if ( !empty($token['style']) )
                {
                    $strip = $this->compress_css;
                }
                else if ($content == '<!--wp-html-compression no compression-->')
                {
                    $overriding = !$overriding;
                    // Don't print the comment
                    continue;
                }
                else if ($this->remove_comments)
                {
                    if (!$overriding && $raw_tag != 'textarea')
                    {
                        // Remove any HTML comments, except MSIE conditional comments
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            }
            else
            {
                if ($tag == 'pre' || $tag == 'textarea')
                {
                    $raw_tag = $tag;
                }
                else if ($tag == '/pre' || $tag == '/textarea')
                {
                    $raw_tag = false;
                }
                else
                {
                    if ($raw_tag || $overriding)
                    {
                        $strip = false;
                    }
                    else
                    {
                        $strip = true;
                        // Remove any empty attributes, except:
                        // action, alt, content, src
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                        // Remove any space before the end of self-closing XHTML tags
                        // JavaScript excluded
                        $content = str_replace(' />', '/>', $content);
                    }
                }
            }
            if ($strip)
            {
                $content = $this->removeWhiteSpace($content);
            }
            $html .= $content;
        }
        return $html;
    }
    public function parseHTML($html){
        $this->html = $this->minifyHTML($html);
        if ($this->info_comment)
        {
            $this->html .= "\n" . $this->bottomComment($html, $this->html);
        }
    }
    protected function removeWhiteSpace($str){
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);
        while (stristr($str, '  ')){
            $str = str_replace('  ', ' ', $str);
        }
        return $str;
    }
}
function wp_html_compression_finish($html){
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start(){
    ob_start('wp_html_compression_finish');
}
// add_action('get_header', 'wp_html_compression_start');
/*
//Chuyển trang trước khi load
function edirect_page() {
if ( is_category() && !is_category(2) && !is_category(3)) {
$category = get_category(get_query_var('cat'));
$term_children = get_term_children( $category->term_id, 'category' );
if($category->parent == 0 && !empty($term_children)){
$category_redirect = get_category( $term_children[0] );
wp_redirect(get_term_link($category_redirect->term_id));
}
}
}
add_action( 'template_redirect', 'edirect_page' );
*/
//Kiểm tra để xoá js và css không dùng
// if(!is_single() && !is_page()){
//         function deregister_cf7_js() {
//          if ( ! is_page( 'contact' ) ) {
//           wp_deregister_script( 'contact-form-7' );
//            }
//         }
//         add_action( 'wp_print_scripts', 'deregister_cf7_js', 100 );

//         function deregister_ct7_styles() {
//            if ( ! is_page( 'contact' ) ) {
//                 wp_deregister_style( 'contact-form-7' );
//             }
//         }
//         add_action( 'wp_print_styles', 'deregister_ct7_styles', 100 );

//         wp_deregister_script( 'jquery' );
// }


if ( !is_admin() ) {
    add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
    function my_jquery_enqueue() {
       wp_deregister_script('jquery');
       wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null);
       // wp_enqueue_script('jquery');
    }
    // remove_action('wp_head', 'print_emoji_detection_script', 7);
    // remove_action('wp_print_styles', 'print_emoji_styles');
    // function deregister_cf7_js() {
    //  if ( ! is_page( 'contact' ) ) {
    //   wp_deregister_script( 'contact-form-7' );
    //    }
    // }
    // add_action( 'wp_print_scripts', 'deregister_cf7_js', 100 );
    // function deregister_ct7_styles() {
    //    if ( ! is_page( 'contact' ) ) {
    //         wp_deregister_style( 'contact-form-7' );
    //     }
    // }
    // add_action( 'wp_print_styles', 'deregister_ct7_styles', 100 );
    // function my_deregister_scripts(){
    //   wp_deregister_script( 'wp-embed' );
    // }
    // add_action( 'wp_footer', 'my_deregister_scripts' );
    // function my_deregister_scripts_footer(){
    //     wp_dequeue_script( 'wp-embed' );
    // }
    // add_action( 'wp_footer', 'my_deregister_scripts_footer' );
}
// function redirect_to_child_category($category_slugs_array){
//     $total = count($category_slugs_array);
//     echo '<pre>';
//     print_r($category_slugs_array[$total - 1]);
//     echo '</pre>';
//     $category = get_category_by_slug($category_slugs_array[$total - 1]);
//     if($category->parent == 0){
//       $term_children = get_term_children( $category->term_id, 'category' );
//       if(!empty($term_children)){
//         header("Location: http://example.com/myOtherPage.php");
//         return true;
//       }
//       echo '<pre>';
//       print_r($term_children);
//       echo '</pre>';
//     }
//     return false;
// }
// add_filter( 'wp_redirect', 'redirect_to_child_category' );
// function wpse121308_redirect_page() {
//     if ( is_category() && !is_category(2) && !is_category(3)) {
//         $category = get_category(get_query_var('cat'));
//         $term_children = get_term_children( $category->term_id, 'category' );
//         if($category->parent == 0 && !empty($term_children)){
//           $category_redirect = get_category( $term_children[0] );
//           wp_redirect(get_term_link($category_redirect->term_id));
//           // echo '<pre>';
//           // print_r($category_redirect);
//           // echo '</pre>';
//         }
//     }
// }
// add_action( 'template_redirect', 'wpse121308_redirect_page' );