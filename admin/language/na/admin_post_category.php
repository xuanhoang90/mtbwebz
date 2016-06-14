<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_main_page_title' => 'TAKA->Dashboard',
		'acp_main_master_title' => 'Dashboard',
		'acp_main_page_name' => 'Danh mục bài viết',
		'acp_main_page_viewlist' => 'Danh sách danh mục bài viết',
	);