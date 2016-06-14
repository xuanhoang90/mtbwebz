<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_login = new Skin_Login();
	class Skin_Login{
		public function __construct(){
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_login');
			$custom_style = <<<CSS
			<link href="{$CMS->admin['style_dir']}/login.css" rel="stylesheet">
CSS;
			$plugin = <<<CSS
			<link href="{$CMS->admin['style_dir']}/login.css" rel="stylesheet">
CSS;
			$title = $lang['acp_login_page_title'];
			$output = "";
			$output .=<<<HERE
	{$CMS->admin['skin_global']->header($title, $custom_style)}
<body>
	<div class="form">
		<h2>{$lang['acp_login_title']}</h2>
		<form class="acp-login-form" method="POST" action="#">
			<input placeholder="{$lang['acp_login_input_name']}" class="username" type="text" name="username"/>
			<input placeholder="{$lang['acp_login_input_password']}" class="password" type="password" name="password"/>
			<div class="login-process">
				<p class="status please-wait"></p>
			</div>
			<button>{$lang['acp_login_input_submit']}</button>
		</form>
		<script>
			$(function(){
				$(document).ready(function(){
					$(".acp-login-form").find(".username").focus();
				})
				$(".acp-login-form").find("button").click(function(e){
					e.preventDefault();
					$(".acp-login-form").find(".login-process").find(".status").addClass("please-wait").removeClass("error");
					$(".acp-login-form").find(".login-process").find(".status").html("<i class='fa fa-cog fa-spin'></i> Loading...");
					var _UserName = $(".acp-login-form").find(".username").val();
					var _Password = $(".acp-login-form").find(".password").val();
					if(_Password != "" && _UserName != ""){
						$.ajax({
							method: "POST",
							url: "{$CMS->vars['root_domain']}/taka_acp/login?action=login_do",
							data: { username: _UserName, password: _Password}
						}).done(function(data) {
							data = $.parseJSON(data);
							if(data.status == "false"){
								//false
								$(".acp-login-form").find(".login-process").find(".status").html("<i class='fa fa-frown-o'></i> "+data.reason);
								$(".acp-login-form").find(".login-process").find(".status").removeClass("please-wait").addClass("error");
							}else{
								//success, redirect
								$(".acp-login-form").find(".login-process").find(".status").html("<i class='fa fa-check'></i> "+data.reason);
								$(".acp-login-form").find(".login-process").find(".status").addClass("please-wait").removeClass("error");
								window.location.href="{$CMS->vars['root_domain']}/taka_acp";
							}
						})
					}else{
						var _Error = "";
						if(_UserName == ""){
							_Error += "{$lang['login_do_empty_username']}";
						}
						if(_Password == ""){
							_Error += "{$lang['login_do_empty_password']}";
						}
						if(_Password == "" && _UserName == ""){
							_Error = "{$lang['login_do_empty_request']}";
						}
						$(".acp-login-form").find(".login-process").find(".status").html("<i class='fa fa-frown-o'></i> "+_Error);
						$(".acp-login-form").find(".login-process").find(".status").removeClass("please-wait").addClass("error");
					}
				})
			})
		</script>
	</div>
</body>
	{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
	}