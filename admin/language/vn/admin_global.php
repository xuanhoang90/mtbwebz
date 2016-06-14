<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_control_nav_setting_title' => 'Cài đặt chung',
		'acp_control_nav_genaral_setting_notice' => 'Thông báo',
		'acp_control_nav_genaral_setting_notice_desc' => 'Phiên bản này chưa hỗ trợ',
		'acp_topbar_user_profile' => 'Tài khoản',
		'acp_topbar_user_logout' => 'Thoát',
		'acp_attachment_window_quick_access' => 'Thêm hình ảnh',
		'acp_menu_window_quick_access' => 'Chọn menu',
		'acp_slider_window_quick_access' => 'Chọn slider',
		'acp_page_window_quick_access' => 'Chọn Page',
		'lang_translate_of' => 'của',
		'lang_translate_used' => 'đã sử dụng',
		'acp_attachment_window_attm_list' => 'Danh sách hình ảnh',
		'acp_attachment_window_upload_btn' => 'Tải lên',
		'acp_attachment_window_apply_btn' => 'Áp dụng',
		'acp_attachment_window_cancel_btn' => 'Hủy bỏ',
		'acp_attachment_window_fake_loading' => 'Đang tải ... ',
	);