<?php
global $default_image;
// $default_image = client_get_options('header');
// echo '<br><br><br><br><br><br><br><br>';
// echo '<pre>';
// print_r($default_image);
// echo '</pre>';
//full medium thumbnail 
add_theme_support( 'post-thumbnails' );
// add_image_size('poster',377,154, true);
// add_image_size('product_thumbnail',300,350, false);
// add_image_size('woocommerce_thumbnail',110,110, true);
// add_image_size('custom_thumbnail',200,200, true);
// add_image_size('small',89,53, true);
// add_image_size('large_m',349,466, true);
// add_image_size('medium_m',270,203, true);
// add_image_size('thumbnailer',305,218, true);









// the_post_thumbnail('thumbnail');       // Thumbnail (default 150px x 150px max)
// the_post_thumbnail('medium');          // Medium resolution (default 300px x 300px max)
// the_post_thumbnail('large');           // Large resolution (default 640px x 640px max)
// the_post_thumbnail('full');            // Original image resolution (unmodified)
// the_post_thumbnail( array(100,100) );  // Other resolutions

//get path thumbnail by post id
function media_get_path_image_from_post_id($post_id, $size ="thumbnail", $icon = ""){
  $post_thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size,  $icon);
  return $post_thumbnail_url[0];
}

// get path thumbnail first in content post
function media_get_path_image_first_content_post($post_content = '', $size='thumbnail'){
  global $default_image;
  $content = $post_content;
  if($post_content != ''){
    $content = $post_content;
  }
  $first_img = '';
  ob_start();
  ob_end_clean();
  preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches );
  if ( isset( $matches[1][0] ) && $matches[1][0] ) {      // any image there?
    $postimage = $matches[1][0]; // we need the first one only!
  }
  if ( isset($postimage) ) {
    $postimage_id = custom_get_attachment_id_from_url( $postimage );
      if($postimage_id){
      if(!empty($size)){
        $postthumb = wp_get_attachment_image_src( $postimage_id,$size);
        $postimage = $postthumb[0];
      }
      elseif ( false != wp_get_attachment_image_src( $postimage_id, 'thumbnail' ) ) {
        $postthumb = wp_get_attachment_image_src( $postimage_id, 'thumbnail' );
        $postimage = $postthumb[0];
      }else{
        $postthumb = wp_get_attachment_image_src( $postimage_id, 'full');
        $postimage = $postthumb[0];
      }
    }
  }else{
    $postimage = $default_image;
  }
  return $postimage;
}

function media_get_image_youtube($postId, $size_video = "default"){
  // $thumbnails = get_template_directory_uri()."/asset/app/img/no-image.png";;
  $url = media_get_first_embed($postId);
  
  if($url){
      $videoId  = media_get_code_from_youtube_url($url);
  }else{
      return $thumbnails;
  }

  if($videoId){
    $apikey = "AIzaSyDbA2hjKUge01FSktebNHVjf-22mYICbNQ";
    $data = @file_get_contents("https://www.googleapis.com/youtube/v3/videos?key=$apikey&part=snippet&id=$videoId");
    $json = json_decode($data, true);
    $thumbnails = $json['items'][0]['snippet']['thumbnails'][$size_video]['url'];
    // default - 120x90
    // medium - 320x180
    // high - 480x360
    // standard - 640x480
    // maxres - 1280x720
  }
  return $thumbnails;
}

 // get video
function media_get_first_embed($post_id,$checkGetUrl=1) {
    $post = get_post($post_id);
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    //$types = array('audio','video','object','embed','iframe');
    $embeds = get_media_embedded_in_content( $content);
    if( !empty($embeds) ) {
        //check what is the first embed containg video tag, youtube or vimeo
        foreach( $embeds as $embed ) {
            if( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {
                if($checkGetUrl){
                    preg_match('/src="([^"]+)"/', $embed, $match);
                    $url = $match[1];    
                }else{
                     $url = $embed;
                }
                return $url;
            }
        }

    } else {
        //No video embedded found
        return false;
    }

}

function media_get_code_from_youtube_url($url) 
{
    $pattern = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
    $pattern .= '(?:www\.)?';         #  Optional www subdomain.
    $pattern .= '(?:';                #  Group host alternatives:
    $pattern .=   'youtu\.be/';       #    Either youtu.be,
    $pattern .=   '|youtube\.com';    #    or youtube.com
    $pattern .=   '(?:';              #    Group path alternatives:
    $pattern .=     '/embed/';        #      Either /embed/,
    $pattern .=     '|/v/';           #      or /v/,
    $pattern .=     '|/watch\?v=';    #      or /watch?v=,    
    $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
    $pattern .=   ')';                #    End path alternatives.
    $pattern .= ')';                  #  End host alternatives.
    $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
    $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

// lay thoi gian cua video
function media_get_duration_in_seconds($postId){
    $totalSec = 0;
    $url = media_get_first_embed($postId);
    if($url){
        $videoId  = media_get_code_from_youtube_url($url);
    }else{
        return $totalSec;
    }
    if($videoId){

       $apikey = "AIzaSyDbA2hjKUge01FSktebNHVjf-22mYICbNQ";
       
       // $dur = @file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoId&key=$apikey");
       // $VidDuration =json_decode($dur, true);
       // foreach ($VidDuration['items'] as $vidTime)
       // {
       //     $VidDuration= $vidTime['contentDetails']['duration'];
       // }


        $url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoId&key=$apikey";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        $VidDuration =json_decode($data, true);
        if(count($VidDuration)){
            foreach ($VidDuration['items'] as $vidTime){
               $VidDuration= $vidTime['contentDetails']['duration'];
            }
        }


       @preg_match_all('/(\d+)/',$VidDuration,$parts);
       $hours = intval(floor($parts[0][0]/60) * 60 * 60);
       $minutes = intval($parts[0][0]%60);
       $seconds = intval($parts[0][1]);
       if($hours < 10){
        $hours = "0".$hours;
       }
       if($minutes < 10){
        $minutes = "0".$minutes;
       }
       if($seconds < 10){
        $seconds = "0".$seconds;
       }
       $totalSec = $hours.':'.$minutes.':'.$seconds;
       if($hours == 0){
            $totalSec = $minutes.':'.$seconds;
       }

   }
   return $totalSec;
}



function getDurationInSeconds($postId){
    $totalSec = 0;
    $url = get_first_embed_media($postId);
    if($url){
        $videoId  = parse_yturl($url);
    }else{
        return $totalSec;
    }
    if($videoId){
        $apikey = "AIzaSyDbA2hjKUge01FSktebNHVjf-22mYICbNQ";
        $url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoId&key=$apikey";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        $VidDuration =json_decode($data, true);
        if(count($VidDuration)){
            foreach ($VidDuration['items'] as $vidTime){
               $VidDuration= $vidTime['contentDetails']['duration'];
            }
        }
        @preg_match_all('/(\d+)/',$VidDuration,$parts);
        $hours = intval(floor($parts[0][0]/60) * 60 * 60);
        $minutes = intval($parts[0][0]%60);
        $seconds = intval($parts[0][1]);
        $totalSec = $hours.':'.$minutes.':'.$seconds;
        if($hours == 0){
            $totalSec = $minutes.':'.$seconds;
        }
    }
   return $totalSec;
}


function media_get_path_image_final($post_id, $post_content = "", $size ="thumbnail", $size_video = "default"){
  $image_src = media_get_path_image_from_post_id($post_id, $size);
  if($image_src == ""){
    $image_src = media_get_path_image_first_content_post( $post_content, $size);
    if($image_src == ""){
      // $image_src = media_get_image_youtube($post_id, $size_video);
      // $image_src = client_get_options('default-image')['url'];;
    }
  }
  return $image_src;
}


function media_view_image($post_id,$post_title = "", $post_content ="", $size="thumbnail", $size_video = "default", $class ="img-responsive", $attribute = "", $lazyload = false){
  $image_src = media_get_path_image_final($post_id, $post_content, $size, $size_video );
  if($lazyload){
    return '
      <img data-original="'.$image_src.'" class="'.$class.'" '.$attribute.' alt="'.$post_title.'"/>
      <noscript>
          <img src="'.$image_src.'" class="'.$class.'" '.$attribute.' alt="'.$post_title.'">
      </noscript>
    ';
  }else{
    return '<img src="'.$image_src.'" class="'.$class.'" '.$attribute.' alt="'.$post_title.'">';
  }
}


function custom_get_attachment_id_from_url( $attachment_url = '' ) {

  global $wpdb;
  $attachment_id = false;

  // If there is no url, return.
  if ( '' == $attachment_url ) {
    return;
  }

  // Get the upload directory paths
  $upload_dir_paths = wp_upload_dir();

  // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
  if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

    // If this is the URL of an auto-generated thumbnail, get the URL of the original image
    $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

    // Remove the upload path base directory from the attachment URL
    $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

    // Finally, run a custom database query to get the attachment ID from the modified attachment URL
    $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

  }
  return apply_filters( 'custom_get_attachment_id_from_url', $attachment_id, $attachment_url );
} 

// function media_get_id_youtube($url){
//   $matches = "";
//   preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
//   return $matches;
// }

// function theme_oembed_videos() {
//   global $post;
//   // Here is a sample array of patterns for supported video embeds from wp-includes/class-wp-embed.php
//   $pattern_array = array(
//       '#https://youtu\.be/.*#i',
//       '#https://(www\.)?youtube\.com/playlist.*#i',
//       '#https://(www\.)?youtube\.com/watch.*#i',
//       '#http://(www\.)?youtube\.com/watch.*#i',
//       '#http://(www\.)?youtube\.com/playlist.*#i',
//       '#http://youtu\.be/.*#i',
//       '#https?://wordpress.tv/.*#i',
//       '#https?://(.+\.)?vimeo\.com/.*#i'
//   );

//   foreach ($pattern_array as $pattern) {

//       if (preg_match_all($pattern, $post->post_content, $matches)) {
//           return wp_oembed_get( $matches[0] );
//       }
//       return false;

//   }
// }

/* Bỏ dấu tiếng việt */
function vn_to_str ($str, $replace="-"){
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace(' ',$replace,$str);
    return $str;
}

function wp_modify_uploaded_file_names($filename){
    $charlist = "áàảãạăắặằẳẵâấầẩẫậđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰÝỲỶỸỴ";
    $info           = pathinfo($filename);
    $random_number  = rand(10000,99999);
    $ext            = empty($info['extension']) ? '' : '.' . $info['extension'];
    $name           = basename($filename, $ext);
    $name           = trim($name,'.');
    $check = addcslashes($name,$charlist);
    if (strcmp ($name ,$check ) !=0) {
      $name         = vn_to_str($name);
      $name = $name .'-'.$random_number . $ext;
    }else{
      $name = $name.$ext;
    }
    return $name;
}
add_filter('sanitize_file_name', 'wp_modify_uploaded_file_names', 10);