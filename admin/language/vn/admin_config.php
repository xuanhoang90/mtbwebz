<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_main_page_title' => 'TAKA->Dashboard',
		'acp_main_master_title' => 'Dashboard',
		'acp_main_page_name' => 'Cấu hình',
		'acp_config_general' => 'Cấu hình chung',
		'acp_config_info' => 'Thông tin trang',
		'acp_config_language' => 'Cài đặt ngôn ngữ',
		'acp_config_currency' => 'Cài đặt tiền tệ',
		'acp_config_in_pagename' => 'Tên trang',
		'acp_config_in_company' => 'Tên công ty',
		'acp_config_in_email' => 'Email liên hệ',
		'acp_config_in_phone' => 'Số điện thoại',
		'acp_config_in_blog' => 'Blog liên quan',
		'acp_config_in_onoff_reglog' => 'Cho phép đăng ký / đăng nhập',
		'acp_config_in_onoff_cmt' => 'Cho phép đăng bình luận',
		'acp_config_in_onoff_maintenance' => 'Bảo trì hệ thống',
		'acp_config_btn_save' => 'Lưu',
		'acp_config_btn_backtohome' => 'Về trang chủ',
	);