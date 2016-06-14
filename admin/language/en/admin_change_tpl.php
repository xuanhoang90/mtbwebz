<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_main_page_title' => 'TAKA->Dashboard',
		'acp_main_master_title' => 'Dashboard',
		'acp_main_page_name' => 'Thay đổi giao diện',
		'acp_main_page_viewlist' => 'Danh sách giao diện',
		'acp_main_page_current_tpl' => 'Giao diện đang dùng',
		'acp_main_page_apply_tpl' => 'Sử dụng',
		'acp_main_page_preview_tpl' => 'Xem trước',
		'acp_main_page_buy_tpl' => 'Mua giao diện',
	);