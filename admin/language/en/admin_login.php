<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$language = array(
		'acp_login_page_title' => 'TAKA->Đăng nhập',
		'acp_login_title' => 'Đăng nhập TAKA Framework',
		'acp_login_input_name' => 'Tên đăng nhập',
		'acp_login_input_password' => 'Mật khẩu',
		'acp_login_input_submit' => 'Tiếp tục',
		'login_do_empty_request' => 'Tên đăng nhập và mật khẩu đâu?',
		'login_do_empty_username' => 'Chưa nhập tên đăng nhập kìa',
		'login_do_empty_password' => 'Quên mật khẩu à?',
		'login_do_success' => 'Đang vào trang quản trị',
		'login_do_username_invalid' => 'Tên đăng nhập không đúng',
		'login_do_password_false' => 'Sai mật khẩu',
		'login_do_username_and_password_invalid' => 'Tài khoản này không tồn tại',
	);