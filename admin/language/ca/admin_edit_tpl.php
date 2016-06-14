<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_main_page_title' => 'TAKA->Dashboard',
		'acp_main_master_title' => 'Dashboard',
		'acp_main_page_name' => 'Chỉnh sửa giao diện',
		'acp_main_page_viewlist' => 'Danh sách các trang giao diện',
		'window_addrowlayout_title' => 'Thêm dòng giao diện',
		'window_settingframe_title' => 'Tùy chỉnh giao diện',
		'window_settingblock_title' => 'Cài đặt khối giao diện',
	);