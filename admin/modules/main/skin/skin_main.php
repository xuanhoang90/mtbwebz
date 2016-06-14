<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_main = new Skin_Main();
	class Skin_Main{
		public function __construct(){
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_main');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
CSS;
			$plugin = <<<CSS
			<!-- SlimScroll -->
			<script src="{$CMS->admin['style_dir']}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
			<!-- FastClick -->
			<script src="{$CMS->admin['style_dir']}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}plugins/chartjs/Chart.min.js" type="text/javascript"></script>
			<!-- AdminLTE App -->
			<script src="{$CMS->admin['style_dir']}/dist/js/app.min.js" type="text/javascript"></script>
			<!-- AdminLTE for demo purposes -->
			<!--<script src="{$CMS->admin['style_dir']}/dist/js/demo.js" type="text/javascript"></script>-->
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

						{$this->MainContent()}

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function GetPageInfo(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT value FROM config WHERE `key`='config_info' ");
			if($data = $sql->fetchAll()){
				return unserialize($data[0]['value']);
			}else{
				return;
			}
		}
		public function MainContent(){
			global $CMS, $DB;
			$pageInfo = $this->GetPageInfo();
			$output = "";
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_name']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_main_page_name']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-xs-12 col-md-12 col-sm-12">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">Over view</h3>
											</div>
											<div class="box-body">
												<div class="col-lg-3 col-md-6">
													<div class="panel panel-primary">
														<div class="panel-heading">
															<div class="row">
																<div class="col-xs-3">
																	<i class="fa fa-file-text fa-5x"></i>
																</div>
																<div class="col-xs-9 text-right">
																	<div class="huge">100</div>
																	<div>Posts</div>
																</div>
															</div>
														</div>
														<a href="{$CMS->vars['root_domain']}?site=admin&page=post&action=viewlist">
															<div class="panel-footer">
																<span class="pull-left">View Details</span>
																<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
																<div class="clearfix"></div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-lg-3 col-md-6">
													<div class="panel panel-primary">
														<div class="panel-heading">
															<div class="row">
																<div class="col-xs-3">
																	<i class="fa fa-shopping-cart fa-5x"></i>
																</div>
																<div class="col-xs-9 text-right">
																	<div class="huge">100</div>
																	<div>Products!</div>
																</div>
															</div>
														</div>
														<a href="{$CMS->vars['root_domain']}?site=admin&page=product&action=viewlist">
															<div class="panel-footer">
																<span class="pull-left">View Details</span>
																<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
																<div class="clearfix"></div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-lg-3 col-md-6">
													<div class="panel panel-primary">
														<div class="panel-heading">
															<div class="row">
																<div class="col-xs-3">
																	<i class="fa fa-user-secret fa-5x"></i>
																</div>
																<div class="col-xs-9 text-right">
																	<div class="huge">100</div>
																	<div>Customers!</div>
																</div>
															</div>
														</div>
														<a href="{$CMS->vars['root_domain']}?site=admin&page=customer&action=viewlist">
															<div class="panel-footer">
																<span class="pull-left">View Details</span>
																<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
																<div class="clearfix"></div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-lg-3 col-md-6">
													<div class="panel panel-primary">
														<div class="panel-heading">
															<div class="row">
																<div class="col-xs-3">
																	<i class="fa fa-calendar-check-o fa-5x"></i>
																</div>
																<div class="col-xs-9 text-right">
																	<div class="huge">100</div>
																	<div>Orders!</div>
																</div>
															</div>
														</div>
														<a href="{$CMS->vars['root_domain']}?site=admin&page=order&action=viewlist">
															<div class="panel-footer">
																<span class="pull-left">View Details</span>
																<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
																<div class="clearfix"></div>
															</div>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!--<div class="col-xs-12 col-md-9 col-sm-12">
										<div class="col-12">
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">{$CMS->vars['lang']['acp_menu_prods']}</h3>
												</div>
												<div class="box-body">
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-cart-plus text-green"></i> {$CMS->vars['lang']['acp_menu_item_product_add']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-list-ul text-green"></i> {$CMS->vars['lang']['acp_menu_item_product_list']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-cubes text-green"></i> {$CMS->vars['lang']['acp_menu_item_product_prop']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-calendar-check-o text-green"></i> {$CMS->vars['lang']['acp_menu_item_product_order']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-bar-chart-o text-green"></i> {$CMS->vars['lang']['acp_menu_item_product_store']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-envelope text-green"></i> {$CMS->vars['lang']['acp_menu_item_product_feedback']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-plus-circle text-green"></i> {$CMS->vars['lang']['acp_menu_item_productcat_add']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-list-ul text-green"></i> {$CMS->vars['lang']['acp_menu_header_productcat']}</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">{$CMS->vars['lang']['acp_menu_header_post']}</h3>
												</div>
												<div class="box-body">
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-pencil text-green"></i> {$CMS->vars['lang']['acp_menu_item_post_add']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-list-ul text-green"></i> {$CMS->vars['lang']['acp_menu_item_post_list']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-plus-circle text-green"></i> {$CMS->vars['lang']['acp_menu_item_postcat_add']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-list-ul text-green"></i> {$CMS->vars['lang']['acp_menu_header_postcat']}</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">{$CMS->vars['lang']['acp_menu_system']}</h3>
												</div>
												<div class="box-body">
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-wrench text-green"></i> {$CMS->vars['lang']['acp_menu_header_system_config_setting']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-eraser text-green"></i> {$CMS->vars['lang']['acp_menu_header_system_config_changeinfo']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-globe text-green"></i> {$CMS->vars['lang']['acp_menu_header_system_config_language']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-dollar text-green"></i> {$CMS->vars['lang']['acp_menu_header_system_config_currentcy']}</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">{$CMS->vars['lang']['acp_menu_header_config_themes']}</h3>
												</div>
												<div class="box-body">
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-newspaper-o text-green"></i> {$CMS->vars['lang']['acp_menu_header_config_themes_changetpl']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-clipboard text-green"></i> {$CMS->vars['lang']['acp_menu_header_config_themes_custom']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-cubes text-green"></i> {$CMS->vars['lang']['acp_menu_header_config_module_manage']}</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">{$CMS->vars['lang']['acp_menu_member']}</h3>
												</div>
												<div class="box-body">
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-user text-green"></i> {$CMS->vars['lang']['acp_menu_header_member']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-user-plus text-green"></i> {$CMS->vars['lang']['acp_menu_header_member_add']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-share-alt text-green"></i> {$CMS->vars['lang']['acp_menu_header_member_manage']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-user-secret text-green"></i> {$CMS->vars['lang']['acp_menu_header_customer']}</a>
													</a>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">{$CMS->vars['lang']['acp_menu_media']}</h3>
												</div>
												<div class="box-body">
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-photo text-green"></i> {$CMS->vars['lang']['acp_menu_header_image']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-indent text-green"></i> {$CMS->vars['lang']['acp_menu_header_gallery']}</a>
													</a>
													<a class="btn btn-default btn-lg btn-app">
														<i class="fa fa-camera text-green"></i> {$CMS->vars['lang']['acp_menu_header_video']}</a>
													</a>
												</div>
											</div>
										</div>
									</div>-->
									<div class="col-md-9 col-xs-12 col-sm-6">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_webinfo']}</h3>
											</div>
											<div class="box-body contain-page-info">
												<p class="text">Page name: <span>{$pageInfo['pagename']}</span></p>
												<p class="text">Company: <span>{$pageInfo['company']}</span></p>
												<p class="text">Email contact: <span>{$pageInfo['email']}</span></p>
												<p class="text">Hotline: <span>{$pageInfo['phone']}</span></p>
												<p class="text">Blog: <span>{$pageInfo['blog']}</span></p>
												<a class="link" href="{$CMS->vars['root_domain']}?site=admin&page=config&action=info"><i class="fa fa-edit"></i> Edit page info</a>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-xs-12 col-sm-6">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_current_tpl']}</h3>
											</div>
											<div class="box-body">
												<div class="hover01 col-xs-12">
													<div>
														<figure><img src="{$CMS->vars['root_domain']}/themes/{$CMS->vars['tpl_name']}/screenshoot.jpg" /></figure>
													</div>
												</div>
												<div class="block-content">
													<hr/>
													<a class="btn btn-default btn-sm" href="{$CMS->vars['root_domain']}/?site=admin&page=change_tpl&action=viewlist">
														Change template
													</a>
													<a class="btn btn-default btn-sm" href="{$CMS->vars['root_domain']}/?site=admin&page=edit_tpl&action=viewlist">
														Customize
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
	}