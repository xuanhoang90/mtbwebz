<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_config = new Skin_Config();
	class Skin_Config{
		public function __construct(){
			return true;
		}
		public function GeneralConfig(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_config');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/config.css" rel="stylesheet" type="text/css" />
CSS;
			$plugin = <<<CSS
			<!-- SlimScroll -->
			<script src="{$CMS->admin['style_dir']}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
			<!-- FastClick -->
			<script src="{$CMS->admin['style_dir']}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
			<!-- AdminLTE App -->
			<script src="{$CMS->admin['style_dir']}/dist/js/app.min.js" type="text/javascript"></script>
			<!-- AdminLTE for demo purposes -->
			<!--<script src="{$CMS->admin['style_dir']}/dist/js/demo.js" type="text/javascript"></script>-->
			<script src="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/info_config.js" type="text/javascript"></script>
CSS;
			$title = $CMS->vars['lang']['acp_main_page_title'];
			$output = "";
			$output .=<<<HERE
				{$CMS->admin['skin_global']->header($title, $custom_style)}
				<body class="skin-green fixed sidebar-mini">
					<!-- Site wrapper -->
					<div class="wrapper">
						{$CMS->admin['skin_global']->top_bar()}
						
						{$CMS->admin['skin_global']->left_bar()}

						<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_name']}</small>
									<small>{$CMS->vars['lang']['acp_config_general']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li><a href="#">{$CMS->vars['lang']['acp_main_page_name']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_config_general']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content"><form method="POST" action="#">
								<div class="x-config-input-wrap">
									<h1 class="config-title">{$CMS->vars['lang']['acp_config_general']}</h1>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_onoff_reg_log">{$CMS->vars['lang']['acp_config_in_onoff_reglog']}:</label>
									<div class="col-md-6">
										<input type="checkbox" checked="true" name="config_onoff_reg_log" data-toggle="toggle" data-on="<i class='fa fa-eye'></i> On" data-off="<i class='fa fa-eye-slash'></i> Off">
									</div>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_onoff_cmt">{$CMS->vars['lang']['acp_config_in_onoff_cmt']}:</label>
									<div class="col-md-6">
										<input type="checkbox" checked="true" name="config_onoff_cmt" data-toggle="toggle" data-on="<i class='fa fa-eye'></i> On" data-off="<i class='fa fa-eye-slash'></i> Off">
									</div>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_onoff_maintenance">{$CMS->vars['lang']['acp_config_in_onoff_maintenance']}:</label>
									<div class="col-md-6">
										<input type="checkbox" name="config_onoff_maintenance" data-toggle="toggle" data-on="<i class='fa fa-eye'></i> On" data-off="<i class='fa fa-eye-slash'></i> Off">
									</div>
								</div>
								<div class="x-config-input-wrap"><div class="object_action_btn">
									<button type="submit" class="act save"><i class="fa fa-check"></i> {$CMS->vars['lang']['acp_config_btn_save']}</button>
									<a class="act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i> {$CMS->vars['lang']['acp_config_btn_backtohome']}</a>
								</div></div>
							</form></section><!-- /.content -->
						</div><!-- /.content-wrapper -->

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function InfoConfig(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_config');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/config.css" rel="stylesheet" type="text/css" />
CSS;
			$plugin = <<<CSS
			<!-- SlimScroll -->
			<script src="{$CMS->admin['style_dir']}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
			<!-- FastClick -->
			<script src="{$CMS->admin['style_dir']}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
			<!-- AdminLTE App -->
			<script src="{$CMS->admin['style_dir']}/dist/js/app.min.js" type="text/javascript"></script>
			<!-- AdminLTE for demo purposes -->
			<!--<script src="{$CMS->admin['style_dir']}/dist/js/demo.js" type="text/javascript"></script>-->
			<script src="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/info_config.js" type="text/javascript"></script>
CSS;
			$title = $CMS->vars['lang']['acp_main_page_title'];
			//load config data
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT value FROM config WHERE `key` LIKE 'config_info'");
			if($data = $sql->fetchAll()){
				$data = unserialize($data[0]['value']);
				$pagename = $data['pagename'];
				$company = $data['company'];
				$email = $data['email'];
				$phone = $data['phone'];
				$blog = $data['blog'];
			}else{
				$pagename = '';
				$company = '';
				$email = '';
				$phone = '';
				$blog = '';
			}
			$output = "";
			$output .=<<<HERE
				{$CMS->admin['skin_global']->header($title, $custom_style)}
				<body class="skin-green fixed sidebar-mini">
					<!-- Site wrapper -->
					<div class="wrapper">
						{$CMS->admin['skin_global']->top_bar()}
						
						{$CMS->admin['skin_global']->left_bar()}

						<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_name']}</small>
									<small>{$CMS->vars['lang']['acp_config_info']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li><a href="#">{$CMS->vars['lang']['acp_main_page_name']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_config_info']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content admin-config-info"><form method="POST" action="#">
								<div class="x-config-input-wrap">
									<h1 class="config-title">{$CMS->vars['lang']['acp_config_info']}</h1>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_pagename">{$CMS->vars['lang']['acp_config_in_pagename']}:</label>
									<div class="col-md-6">
										<input type="text" class="form-control config_pagename" name="config_pagename" placeholder="{$CMS->vars['lang']['acp_config_in_pagename']}" value="{$pagename}" />
									</div>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_company">{$CMS->vars['lang']['acp_config_in_company']}:</label>
									<div class="col-md-6">
										<input type="text" class="form-control config_company" name="config_company" placeholder="{$CMS->vars['lang']['acp_config_in_company']}" value="{$company}" />
									</div>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_email">{$CMS->vars['lang']['acp_config_in_email']}:</label>
									<div class="col-md-6">
										<input type="text" class="form-control config_email" name="config_email" placeholder="{$CMS->vars['lang']['acp_config_in_email']}" value="{$email}" />
									</div>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_phone">{$CMS->vars['lang']['acp_config_in_phone']}:</label>
									<div class="col-md-6">
										<input type="text" class="form-control config_phone" name="config_phone" placeholder="{$CMS->vars['lang']['acp_config_in_phone']}" value="{$phone}" />
									</div>
								</div>
								<div class="x-config-input-wrap">
									<label class="control-label col-md-6" for="config_blog">{$CMS->vars['lang']['acp_config_in_blog']}:</label>
									<div class="col-md-6">
										<input type="text" class="form-control config_blog" name="config_blog" placeholder="{$CMS->vars['lang']['acp_config_in_blog']}" value="{$blog}" />
									</div>
								</div>
								<div class="x-config-input-wrap"><div class="object_action_btn save-info-config">
									<button type="submit" class="act save" data="{$CMS->vars['root_domain']}"><i class="fa fa-check"></i> {$CMS->vars['lang']['acp_config_btn_save']}</button>
									<a class="act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i> {$CMS->vars['lang']['acp_config_btn_backtohome']}</a>
								</div></div>
							</form></section><!-- /.content -->
						</div><!-- /.content-wrapper -->

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function LanguageConfig(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_config');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/config.css" rel="stylesheet" type="text/css" />
CSS;
			$plugin = <<<CSS
			<!-- SlimScroll -->
			<script src="{$CMS->admin['style_dir']}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
			<!-- FastClick -->
			<script src="{$CMS->admin['style_dir']}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
			<!-- AdminLTE App -->
			<script src="{$CMS->admin['style_dir']}/dist/js/app.min.js" type="text/javascript"></script>
			<!-- AdminLTE for demo purposes -->
			<!--<script src="{$CMS->admin['style_dir']}/dist/js/demo.js" type="text/javascript"></script>-->
			<script src="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/info_config.js" type="text/javascript"></script>
CSS;
			$title = $CMS->vars['lang']['acp_main_page_title'];
			$output = "";
			$output .=<<<HERE
				{$CMS->admin['skin_global']->header($title, $custom_style)}
				<body class="skin-green fixed sidebar-mini">
					<!-- Site wrapper -->
					<div class="wrapper">
						{$CMS->admin['skin_global']->top_bar()}
						
						{$CMS->admin['skin_global']->left_bar()}

						<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_name']}</small>
									<small>{$CMS->vars['lang']['acp_config_language']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li><a href="#">{$CMS->vars['lang']['acp_main_page_name']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_config_language']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content"><form method="POST" action="#">
								<div class="x-config-input-wrap">
									<h1 class="config-title">{$CMS->vars['lang']['acp_config_language']}</h1>
								</div>
								<div class="x-config-input-wrap"><div class="object_action_btn">
									<button type="submit" class="act save"><i class="fa fa-check"></i> {$CMS->vars['lang']['acp_config_btn_save']}</button>
									<a class="act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i> {$CMS->vars['lang']['acp_config_btn_backtohome']}</a>
								</div></div>
							</form></section><!-- /.content -->
						</div><!-- /.content-wrapper -->

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function CurrencyConfig(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_config');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/config.css" rel="stylesheet" type="text/css" />
CSS;
			$plugin = <<<CSS
			<!-- SlimScroll -->
			<script src="{$CMS->admin['style_dir']}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
			<!-- FastClick -->
			<script src="{$CMS->admin['style_dir']}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
			<!-- AdminLTE App -->
			<script src="{$CMS->admin['style_dir']}/dist/js/app.min.js" type="text/javascript"></script>
			<!-- AdminLTE for demo purposes -->
			<!--<script src="{$CMS->admin['style_dir']}/dist/js/demo.js" type="text/javascript"></script>-->
			<script src="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/info_config.js" type="text/javascript"></script>
CSS;
			$title = $CMS->vars['lang']['acp_main_page_title'];
			$output = "";
			$output .=<<<HERE
				{$CMS->admin['skin_global']->header($title, $custom_style)}
				<body class="skin-green fixed sidebar-mini">
					<!-- Site wrapper -->
					<div class="wrapper">
						{$CMS->admin['skin_global']->top_bar()}
						
						{$CMS->admin['skin_global']->left_bar()}

						<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_name']}</small>
									<small>{$CMS->vars['lang']['acp_config_currency']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li><a href="#">{$CMS->vars['lang']['acp_main_page_name']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_config_currency']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content"><form method="POST" action="#">
								<div class="x-config-input-wrap">
									<h1 class="config-title">{$CMS->vars['lang']['acp_config_currency']}</h1>
								</div>
								<div class="x-config-input-wrap"><div class="object_action_btn">
									<button type="submit" class="act save"><i class="fa fa-check"></i> {$CMS->vars['lang']['acp_config_btn_save']}</button>
									<a class="act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i> {$CMS->vars['lang']['acp_config_btn_backtohome']}</a>
								</div></div>
							</form></section><!-- /.content -->
						</div><!-- /.content-wrapper -->

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
	}