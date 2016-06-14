<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_change_tpl = new Skin_ChangeTpl();
	class Skin_ChangeTpl{
		public function __construct(){
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_change_tpl');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
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
		public function MainContent(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_viewlist']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_main_page_viewlist']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row acp-table-padding-bottom">
									<div class="col-xs-12 col-sm-12 col-md-3 pull-right">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_current_tpl']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body">
												<div class="hover01 col-xs-12">
													<div>
														<figure><img src="{$CMS->vars['root_domain']}/themes/{$CMS->vars['tpl_name']}/screenshoot.jpg" /></figure>
													</div>
												</div>
											</div><!-- /.box-body -->
											<div class="box-footer clearfix">
												<a class="x-btn" href="{$CMS->vars['root_domain']}/?site=admin&page=edit_tpl&action=viewlist">
													<i class="fa fa-cogs"></i> Customize
												</a>
											</div>
										</div><!-- /.box -->
										
									</div>
									<div class="col-xs-12 col-sm-12 col-md-9 contain-change-tpl">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_viewlist']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body">
HERE;
											//scan theme
											$themes = array_diff(glob('themes/*', GLOB_ONLYDIR), array('themes/secret'));
											foreach($themes as $templates){
												if($templates == "themes/".$CMS->vars['tpl_name']){
													$output .=<<<HERE
														<div class="hover12 col-xs-12 col-sm-6 col-md-4">
															<div>
																<figure class="contain-tpl">
																	<img src="{$CMS->vars['root_domain']}/{$templates}/screenshoot.jpg" />
																	<div class="quick-act">
																		<a class="tpl-act" href="#"><i class="fa fa-get-pocket"></i> Current</a>
																	</div>
																</figure>
															</div>
														</div>
HERE;
												}else{
													$tmp = explode("/",$templates);
													$output .=<<<HERE
														<div class="hover12 col-xs-12 col-sm-6 col-md-4">
															<div>
																<figure class="contain-tpl">
																	<img src="{$CMS->vars['root_domain']}/{$templates}/screenshoot.jpg" />
																	<div class="quick-act">
																		<a class="tpl-act apply" href="{$CMS->vars['root_domain']}/?site=admin&page=change_tpl&action=applychange&tplname={$tmp[1]}"><i class="fa fa-get-pocket"></i> Use</a>
																		<a class="tpl-act preview" href="#"><i class="fa fa-eye"></i> Preview</a>
																	</div>
																</figure>
															</div>
														</div>
HERE;
												}
												
											}
											$output .=<<<HERE
											</div><!-- /.box-body -->
											<div class="box-footer clearfix">
												<ul class="pagination pagination-sm no-margin pull-right">
													<li><a href="#">«</a></li>
													<li><a href="#">1</a></li>
													<li><a href="#">»</a></li>
												</ul>
											</div>
										</div><!-- /.box -->
										
									</div>
								</div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
	}