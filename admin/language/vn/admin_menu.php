<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_menu_header' => 'Danh sách chức năng',
		'acp_menu_item_home' => 'Admin',
		'acp_menu_item_homepage' => 'Trang chủ',
		
		'acp_menu_prods' => 'Bán hàng',
		'acp_menu_header_product' => 'Sản phẩm',
		'acp_menu_item_product_add' => 'Thêm',
		'acp_menu_item_product_list' => 'Danh sách',
		'acp_menu_item_product_prop' => 'Thuộc tính',
		'acp_menu_item_product_order' => 'Đơn hàng',
		'acp_menu_item_product_store' => 'Kiểm kho',
		'acp_menu_item_product_feedback' => 'Hộp thư',
		'acp_menu_header_productcat' => 'Danh mục',
		'acp_menu_item_productcat_add' => 'Thêm',
		'acp_menu_item_productcat_list' => 'Danh sách',
		
		'acp_menu_posts' => 'Tin tức',
		'acp_menu_header_post' => 'Bài viết',
		'acp_menu_item_post_add' => 'Thêm',
		'acp_menu_item_post_list' => 'Danh sách',
		'acp_menu_header_postcat' => 'Danh mục',
		'acp_menu_item_postcat_add' => 'Thêm',
		'acp_menu_item_postcat_list' => 'Danh sách',
		
		'acp_menu_system' => 'Cài đặt',
		'acp_menu_header_system_config' => 'Cấu hình',
		'acp_menu_header_system_config_setting' => 'Thiết lập chung',
		'acp_menu_header_system_config_changeinfo' => 'Thông tin trang',
		'acp_menu_header_system_config_language' => 'Ngôn ngữ',
		'acp_menu_header_system_config_currentcy' => 'Tiền tệ',
		
		'acp_menu_header_config_themes' => 'Giao diện',
		'acp_menu_header_config_themes_changetpl' => 'Đổi gói giao diện',
		'acp_menu_header_config_themes_change_header' => 'Thay đổi header',
		'acp_menu_header_config_themes_change_footer' => 'Thay đổi footer',
		'acp_menu_header_config_themes_custom' => 'Tùy chỉnh',
		'acp_menu_header_config_module_manage' => 'Khối chức năng',
		
		'acp_menu_member' => 'Người dùng',
		'acp_menu_header_member' => 'Quản trị viên',
		'acp_menu_header_member_add' => 'Thêm',
		'acp_menu_header_member_manage' => 'Quản lý',
		
		'acp_menu_header_customer' => 'Người dùng',
		
		'acp_menu_header_contact' => 'Contact email',
		
		'acp_menu_media' => 'Thư viện',
		'acp_menu_header_image' => 'Hình ảnh',
		'acp_menu_header_image_add' => 'Upload',
		'acp_menu_header_image_manage' => 'Quản lý',
		
		'acp_menu_header_menu' => 'Menu',
		'acp_menu_header_config_mainmenu' => 'Thêm',
		'acp_menu_header_config_mainmenu_list' => 'Danh sách',
		
		'acp_menu_header_slider' => 'Slider',
		'acp_menu_header_slider_add' => 'Thêm',
		'acp_menu_header_slider_manage' => 'Danh sách',
		
		'acp_menu_header_gallery' => 'Albums',
		'acp_menu_header_gallery_add' => 'Thêm',
		'acp_menu_header_gallery_manage' => 'Quản lý',
		
		'acp_menu_header_video' => 'Videos',
		'acp_menu_header_video_add' => 'Thêm',
		'acp_menu_header_video_manage' => 'Quản lý',
	);