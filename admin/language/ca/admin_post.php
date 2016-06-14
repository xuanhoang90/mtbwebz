<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_main_page_title' => 'TAKA->Dashboard',
		'acp_main_master_title' => 'Dashboard',
		'acp_main_page_name' => 'Bài viết',
		'acp_main_page_viewlist' => 'Danh sách bài viết',
		'acp_main_page_add_post' => 'Tạo bài mới',
		'acp_main_page_edit_post' => 'Chỉnh sửa',
		'acp_main_object_extend_info' => 'Thông tin thêm',
	);