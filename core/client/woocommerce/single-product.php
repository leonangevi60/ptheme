<?php
/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
  global $product;
  
  $args['posts_per_page'] = 5;
  return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
  $args['posts_per_page'] = 5; // 4 related products
  $args['columns'] = 2; // arranged in 2 columns
  return $args;
}



function get_attributes_details($post_id, $type = array()){
	$attributes = [
		'global' => [
			'thong_tin_chung',
		],
		'mobile' => [
			'man_hinh_mobile',
			'chup_hinh_quay_phim',
			'cpu_ram',
			'bo_nho_luu_tru',
			'thiet_ke_trong_luong',
			'thong_tin_pin',
			'ket_noi_cong_giao_tiep',
			'giai_tri_ung_dung',
		],
		'macbook' => [
			'bo_xu_ly',
			'bo_mach',
			'chipset_mobile',
			'bo_nho',
			'ram_mobile',
			'dia_cung',
			'chip_do_hoa_gpu',
			'man_hinh_laptop',
			'do_hoa',
			'am_thanh',
			'dia_quang',
			'tinh_nang_mo_rong_cong_giao_tiep',
			'giao_tiep_mang',
			'pin_battery',
			'he_dieu_hanh_phan_mem_san_co_os',
			'kich_thuoc_trong_luong'
		],
	];
	if(!empty($type)){
		$list_attributes = $attributes['global'];
		foreach ($type as $key => $value) {
			if(!is_array($value) && isset($attributes[$value]) && !empty($attributes[$value])){
				$list_attributes = array_merge($list_attributes, $attributes[$value]);
			}
		}
	}else{
		$list_attributes = array();
		foreach ($attributes as $key => $value) {
			$list_attributes = array_merge($list_attributes, $attributes[$key]);
		}
	}
	// $list_attributes = array_merge($attributes['global'], $attributes['mobile'], $attributes['macbook']);
	$view_attributes = '';
	foreach ($list_attributes as $key_att => $value_att) {

		$attribute = get_field_object($value_att, get_the_ID());
		
		$sub_attributes = '';
		if(isset($attribute['sub_fields']) && !empty(isset($attribute['sub_fields']))){
			foreach ($attribute['sub_fields'] as $key_sub_field => $value_sub_field) {
				if($value_sub_field['name'] != 'product_type' && $attribute['value'][$value_sub_field['name']] != ""){
					$sub_attributes .= '
						<tr>
                            <td>
                                '.$value_sub_field['label'].'
                            </td>
                            <td>
                                '.$attribute['value'][$value_sub_field['name']].'
                            </td>
                        </tr>
					';
				}
			}
		}
		if($sub_attributes != ""){
			$view_attributes .= '<tr>';
			$view_attributes .= '
				<td colspan="2" rowspan="1">
	                <strong>'.$attribute['label'].'<strong>
	            </td>
			';
			$view_attributes .= '<tr>';

			$view_attributes .= $sub_attributes;
		}
	}
	echo $view_attributes;
}


function get_attributes_simple($post_id, $type = array()){
	$attributes = [
		'mobile' => [
			[
				'name' => 'Màn hình',
				'parent' => 'man_hinh_mobile',
				'value' => [
					'chuan_man_hinh',
					'man_hinh_rong',
					'do_phan_giai',
				]
			],
			[
				'name' => 'CPU',
				'parent' => 'cpu_ram',
				'value' => [
					'chipset_mobile',
					'so_nhan',
					'toc_do_cpu_mobile'
				]
			],
			[
				'name' => 'RAM',
				'parent' => 'cpu_ram',
				'value' => [
					'ram_mobile',
				]
			],
			[
				'name' => 'Hệ điều hành',
				'parent' => 'thong_tin_chung',
				'value' => [
					'he_dieu_hanh',
				]
			],
			[
				'name' => 'Camera chính',
				'parent' => 'chup_hinh_quay_phim',
				'value' => [
					'camera_sau',
					'quay_phim'
				]
			],
			[
				'name' => 'Camera phụ',
				'parent' => 'chup_hinh_quay_phim',
				'value' => [
					'camera_truoc'
				]
			],
			[
				'name' => 'Bộ nhớ trong',
				'parent' => 'bo_nho_luu_tru',
				'value' => [
					'bo_nho_trong_rom'
				]
			],
			[
				'name' => 'Thẻ nhớ ngoài đến',
				'parent' => 'bo_nho_luu_tru',
				'value' => [
					'the_nho_ngoai'
				]
			],
			[
				'name' => 'Dung lượng pin',
				'parent' => 'thong_tin_pin',
				'value' => [
					'dung_luong_pin'
				]
			]
		],
		'macbook' => [
			[
				'name' => 'CPU',
				'parent' => 'bo_xu_ly',
				'value' => [
					'hang_cpu',
					'loai_cpu',
					'toc_do_cpu',
					'cong_nghe_cpu'
				]
			],
			[
				'name' => 'RAM',
				'parent' => 'bo_nho',
				'value' => [
					'dung_luong_ram',
					'loai_ram',
					'toc_do_bus'
				]
			],
			[
				'name' => 'Đĩa cứng',
				'parent' => 'dia_cung',
				'value' => [
					'dung_luong_dia_cung',
					'loai_o_dia'
				]
			],
			[
				'name' => 'Màn hình rộng',
				'parent' => 'man_hinh_laptop',
				'value' => [
					'kich_thuoc_man_hinh',
					'do_phan_giai_w_x_h',
					'cong_nghe_mh'
				]
			],
			[
				'name' => 'Đồ họa',
				'parent' => 'do_hoa',
				'value' => [
					'chipset_do_hoa',
					'bo_nho_do_hoa',
					'thiet_ke_card'
				]
			],
			[
				'name' => 'Đĩa quang',
				'parent' => 'dia_quang',
				'value' => [
					'tich_hop',
					'loai_dia_quang'
				]
			],
			[
				'name' => 'HĐH theo máy',
				'parent' => 'he_dieu_hanh_phan_mem_san_co_os',
				'value' => [
					'hdh_kem_theo_may'
				]
			],
			[
				'name' => 'PIN/Battery',
				'parent' => 'pin_battery',
				'value' => [
					'thong_so_pin'
				]
			],
			[
				'name' => 'Trọng lượng (Kg)',
				'parent' => 'kich_thuoc_trong_luong',
				'value' => [
					'trong_luong_kg'
				]
			]
		],
	];
	if(!empty($type)){
		$list_attributes = array();
		foreach ($type as $key => $value) {
			if(!is_array($value) && isset($attributes[$value]) && !empty($attributes[$value])){
				$list_attributes = array_merge($list_attributes, $attributes[$value]);
			}
		}
		$view_attributes = '';
		foreach ($list_attributes as $key_att => $value_att) {
			$data_info = array();
			$data_content = get_field($value_att['parent'], $post_id);
			foreach ($value_att['value'] as $key => $value) {
				if($data_content[$value] != ""){
					$data_info[] = $data_content[$value];
				}
			}
			
			if(!empty($data_info)){
				$view_attributes .= '<tr>';
				$view_attributes .= '<td><b>'.$value_att['name'].'</b></td>';
				$view_attributes .= '<td>'.implode(",", $data_info).'</td>';
				$view_attributes .= '</tr>';
			}
		}
		return $view_attributes;

	}else{
		return null;
	}
}



function get_attributes_post($post_id, $type="detail"){
	
	$thong_tin_chung = get_field('thong_tin_chung', get_the_ID());
	if(isset($thong_tin_chung['product_type']) && $thong_tin_chung['product_type'] != ""){
		if($type == "detail"){
			get_attributes_details($post_id, [$thong_tin_chung['product_type']]);
		}else{
			return get_attributes_simple($post_id, [$thong_tin_chung['product_type']]);
		}
	}else{
		if($type == "detail"){
			get_attributes_details($post_id);
		}else{
			return get_attributes_simple($post_id);
		}
	}
}