<?php
function get_yoastseo_info($post_id = "", $post_type = ""){
	if($post_id != ""){
		global $wpdb;
		$query = "
		    SELECT 
		        (SELECT `meta_value` FROM `$wpdb->postmeta` WHERE `meta_key` = '_yoast_wpseo_focuskw' AND post_id = $wpdb->posts.ID)  AS yfocuskw,
		        (SELECT `meta_value` FROM `$wpdb->postmeta` WHERE `meta_key` = '_yoast_wpseo_title' AND post_id = $wpdb->posts.ID)  AS ytitle,
		        (SELECT `meta_value` FROM `$wpdb->postmeta` WHERE `meta_key` = '_yoast_wpseo_metadesc' AND post_id = $wpdb->posts.ID)  AS ymetadesc,
		        $wpdb->posts.ID, $wpdb->posts.post_type FROM `$wpdb->posts`
		    WHERE id=".$post_id."
		    AND (SELECT `meta_value` FROM `$wpdb->postmeta` WHERE `meta_key` = '_yoast_wpseo_meta-robots-noindex' AND post_id = $wpdb->posts.ID)is null
		";

		if($post_type != ""){
			$query .= "
				AND ($wpdb->posts.post_type = 'page' OR $wpdb->posts.post_type = 'post' OR $wpdb->posts.post_type = '".$post_type."')
			";
		}
		$info_more = $wpdb->get_row($query);
	}else{
		$info_more = "Lỗi rồi";
	}
	
	return $info_more;
}
