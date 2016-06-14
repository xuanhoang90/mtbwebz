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
	);