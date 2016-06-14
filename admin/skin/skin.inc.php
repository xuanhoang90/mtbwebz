<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	
	$CMS->admin['skin_global'] = new Skin_Admin();
	class Skin_Admin{
		public function __construct(){
			return true;
		}
		public function CustomModuleType(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_unit');
			$output="";
			$files = array_diff(scandir("unit"), array('..', '.'));
			foreach($files as $file){
				if (preg_match("/.php/i", $file)) {
					$tmp = explode(".", $file);
					$lang_val = "unitname_".$tmp[1];
					$output .=<<<HERE
					<option value="{$tmp[1]}">{$CMS->vars['lang'][$lang_val]}</option>
HERE;
				}
			}
			return $output;
		}
		public function header($title = "XHFw->Admin", $custom_style = ""){
			global $CMS, $DB;
			$output="";
			$output=<<<HERE
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{$title}</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.4 -->
		<link href="{$CMS->admin['style_dir']}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="{$CMS->admin['style_dir']}/font-awesome/css/font-awesome.min.css">
		<link href="{$CMS->admin['style_dir']}/ionicons.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Custom style -->
		
		<script src="{$CMS->admin['style_dir']}/js/jquery-2.1.4.min.js"></script>
		<link href="{$CMS->admin['style_dir']}/reset.css" rel="stylesheet">
		<link href="{$CMS->admin['style_dir']}/style.css" rel="stylesheet">
		
		<!-- Theme style -->
		<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
		<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		{$custom_style}
	</head>
HERE;
			return $output;
		}
		public function footer($plugin = ""){
			global $CMS, $DB;
			$output="";
			$output=<<<HERE
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{$CMS->admin['style_dir']}/js/jquery-2.1.4.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{$CMS->admin['style_dir']}/bootstrap/js/bootstrap.min.js"></script>
	{$plugin}
</html>
HERE;
			return $output;
		}
		
		public function top_bar(){
			global $CMS, $DB, $USER;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output =<<<HERE
		<header class="main-header">
			<!-- Logo -->
			<a href="{$CMS->vars['root_domain']}/taka_acp" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>TK</b>F</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>TK</b>Framework</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{$CMS->admin['style_dir']}/dist/img/riven.png" class="user-image" alt="User Image" />
								<span class="hidden-xs">{$USER->data['display_name']}</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="{$CMS->admin['style_dir']}/dist/img/riven.png" class="img-circle" alt="User Image" />
									<p>
									{$USER->data['display_name']}
									<small>{$USER->data['admin_type']}</small>
									</p>
								</li>
								<!-- Menu Body -->
								<!--<li class="user-body">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</li>-->
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default btn-flat">{$lang['acp_topbar_user_profile']}</a>
									</div>
									<div class="pull-right">
										<a href="{$CMS->vars['root_domain']}?site=admin&page=logout" class="btn btn-default btn-flat">{$lang['acp_topbar_user_logout']}</a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li>
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
HERE;
			return $output;
		}
		public function left_bar(){
			global $CMS, $DB, $USER;
			$CMS->admin['system']->LoadLanguage('admin_menu');
			$AdminMenu = $CMS->admin['system']->GetMenuItem();
			$output = "";
			$output =<<<HERE
		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{$CMS->admin['style_dir']}/dist/img/riven.png" class="img-circle" alt="User Image" />
					</div>
					<div class="pull-left info">
						<p>{$USER->data['display_name']}</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search..." />
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu x-sidebar-menu" style="padding-bottom: 50px;">
				
					
HERE;
				foreach($AdminMenu as $MenuItem){
					$root = $MenuItem['root'];
					$sub = $MenuItem['sub'];
					if($root['type'] == 'link'){
						if(is_array($sub)){
							$output.=<<<HERE
								<li class="treeview">
									<a href="{$root['link']}">
										<i class="fa {$root['icon']}"></i>
										<span> {$CMS->vars['lang'][$root['lang']]}</span>
										<span class="pull-right"><i class="fa fa-angle-down text-green"></i></span>
									</a>
									<ul class="treeview-menu">
HERE;
							foreach($sub as $submenu){
								$output.=<<<HERE
										<li><a href="{$CMS->vars['root_domain']}{$submenu['link']}"><i class="fa {$submenu['icon']}"></i> {$CMS->vars['lang'][$submenu['lang']]}</a></li>
HERE;
							}
							$output.=<<<HERE
									</ul>
								</li>
HERE;
						}else{
							$output.=<<<HERE
								<li><a href="{$root['link']}"><i class="fa {$root['icon']}"></i> <span>{$CMS->vars['lang'][$root['lang']]}</span></a></li>
HERE;
						}
					}else{
						$output.=<<<HERE
						<li class="header"> {$CMS->vars['lang'][$root['lang']]}</li>
HERE;
					}
				}
				$output.=<<<HERE
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>
		<script>
		$(function(){
			var _cur_url = window.location.href;
			//alert(_cur_urls);
			$(".x-sidebar-menu").find("li").each(function(){
				var _link = $(this).find("a").first().attr("href");
				if(typeof _link === 'undefined'){
					
				}else{
					var _compare = _cur_url.substring(0,_link.length);
					if(_link == _compare){
						$(this).addClass("active");
						if(!$(this).hasClass("treeview")){
							$(this).parent().parent().parent().addClass("active");
						}
					}
				}
			})
		})
		</script>
HERE;
			return $output;
		}
		
		public function footer_nav(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output =<<<HERE
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0.0
			</div>
			<strong>Copyright &copy; 2015 <a href="#">Xuân Hoàng</a>.</strong> All rights reserved.
		</footer>
HERE;
			return $output;
		}
		
		public function control_nav(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output =<<<HERE
		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane" id="control-sidebar-home-tab">
					<h3 class="control-sidebar-heading">{$lang['acp_control_nav_setting_title']}</h3>
					<div class="form-group">
						<label class="control-sidebar-subheading">
							{$lang['acp_control_nav_genaral_setting_notice']}
						</label>
						<p>
							{$lang['acp_control_nav_genaral_setting_notice_desc']}
						</p>
					</div>
					<!--<ul class="control-sidebar-menu">
						<li>
							<a href="javascript::;">
								<i class="menu-icon fa fa-birthday-cake bg-red"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
									<p>Will be 23 on April 24th</p>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript::;">
								<i class="menu-icon fa fa-user bg-yellow"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
									<p>New phone +1(800)555-1234</p>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript::;">
								<i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
									<p>nora@example.com</p>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript::;">
								<i class="menu-icon fa fa-file-code-o bg-green"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
									<p>Execution time 5 seconds</p>
								</div>
							</a>
						</li>
					</ul>--><!-- /.control-sidebar-menu -->

					<!--<h3 class="control-sidebar-heading">Tasks Progress</h3>-->
					<!--<ul class="control-sidebar-menu">
						<li>
							<a href="javascript::;">
								<h4 class="control-sidebar-subheading">
									Custom Template Design
									<span class="label label-danger pull-right">70%</span>
								</h4>
								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
								</div>
							</a>
						</li>
						<li>
						<a href="javascript::;">
							<h4 class="control-sidebar-subheading">
								Update Resume
								<span class="label label-success pull-right">95%</span>
							</h4>
							<div class="progress progress-xxs">
								<div class="progress-bar progress-bar-success" style="width: 95%"></div>
							</div>
						</a>
						</li>
						<li>
							<a href="javascript::;">
								<h4 class="control-sidebar-subheading">
									Laravel Integration
									<span class="label label-warning pull-right">50%</span>
								</h4>
								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
								</div>
							</a>
						</li>
						<li>
							<a href="javascript::;">
								<h4 class="control-sidebar-subheading">
									Back End Framework
									<span class="label label-primary pull-right">68%</span>
								</h4>
								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
								</div>
							</a>
						</li>
					</ul>--><!-- /.control-sidebar-menu -->

				</div><!-- /.tab-pane -->
				<!-- Stats tab content -->
				<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
				<!-- Settings tab content -->
				<div class="tab-pane" id="control-sidebar-settings-tab">
					<form method="post">
						<h3 class="control-sidebar-heading">{$lang['acp_control_nav_setting_title']}</h3>
						<div class="form-group">
							<label class="control-sidebar-subheading">
								{$lang['acp_control_nav_genaral_setting_notice']}
							</label>
							<p>
								{$lang['acp_control_nav_genaral_setting_notice_desc']}
							</p>
						</div>
						
						<!--<div class="form-group">
							<label class="control-sidebar-subheading">
							Report panel usage
							<input type="checkbox" class="pull-right" checked />
							</label>
							<p>
							Some information about this general settings option
							</p>
						</div>--><!-- /.form-group -->

						<!--<div class="form-group">
							<label class="control-sidebar-subheading">
							Allow mail redirect
							<input type="checkbox" class="pull-right" checked />
							</label>
							<p>
							Other sets of options are available
							</p>
						</div>--><!-- /.form-group -->

						<!--<div class="form-group">
							<label class="control-sidebar-subheading">
							Expose author name in posts
							<input type="checkbox" class="pull-right" checked />
							</label>
							<p>
							Allow the user to show his name in blog posts
							</p>
						</div>--><!-- /.form-group -->

						<!--<h3 class="control-sidebar-heading">Chat Settings</h3>-->

						<!--<div class="form-group">
							<label class="control-sidebar-subheading">
							Show me as online
							<input type="checkbox" class="pull-right" checked />
							</label>
						</div>--><!-- /.form-group -->

						<!--<div class="form-group">
							<label class="control-sidebar-subheading">
							Turn off notifications
							<input type="checkbox" class="pull-right" />
							</label>
						</div>--><!-- /.form-group -->

						<!--<div class="form-group">
							<label class="control-sidebar-subheading">
								Delete chat history
							<a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
							</label>
						</div>--><!-- /.form-group -->
					</form>
				</div><!-- /.tab-pane -->
			</div>
		</aside><!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
HERE;
			return $output;
		}
		
		public function AttachmentImage(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$total = ceiling($CMS->vars['webdata_size']/(1024*1024),0.5);
			$used = ceiling($CMS->main_attachment->SizeCounter()/(1024*1024),0.5);
			$percent = ceil($used*100/$total);
			$output .=<<<HERE
				<!-- Modal -->
				<div class="modal fade" id="window-attachment-quickaccess" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">{$CMS->vars['lang']['acp_attachment_window_quick_access']}</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
							
								<div class="box" style="margin: 0px !important;">
									<div class="box-header with-border">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<p class="webdata-used"><span class="usedval">{$used}</span> MB (<span class="percentage">{$percent} %</span>) {$CMS->vars['lang']['lang_translate_of']} <span class="totalval">{$total}</span> MB {$CMS->vars['lang']['lang_translate_used']}</p>
											<div class="progress webdata-progressbar">
												<div class="progress-bar" role="progressbar" aria-valuenow="{$percent}" aria-valuemin="0" aria-valuemax="100" style="width: {$percent}%;min-width: 2em;">
													{$percent}%
												</div>
											</div>
											<script>
												$(function(){
													var _CheckUsedStatus = $(".webdata-progressbar").find(".progress-bar").attr("aria-valuenow");
													if(_CheckUsedStatus < 50){
														$(".webdata-progressbar").find(".progress-bar").css({"background-color": "green"});
													}
													if(_CheckUsedStatus >= 50 && _CheckUsedStatus <= 90){
														$(".webdata-progressbar").find(".progress-bar").css({"background-color": "orange"});
													}
													if(_CheckUsedStatus > 90){
														$(".webdata-progressbar").find(".progress-bar").css({"background-color": "red"});
													}
												})
											</script>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12 pull-right">
											<div class="btn-group pull-right">
												<a class="w-attachment-im-btn-nav active btn btn-default" data-toggle="tab" href="#w-attachment-list"><i class="fa fa-photo"></i> {$CMS->vars['lang']['acp_attachment_window_attm_list']}</a>
												<a class="w-attachment-im-btn-nav btn btn-default" data-toggle="tab" href="#w-attachment-upload"><i class="fa fa-cloud-upload"></i> {$CMS->vars['lang']['acp_attachment_window_upload_btn']}</a>
												<script>
													$(function(){
														$(".w-attachment-im-btn-nav").click(function(e){
															e.preventDefault();
															$(".w-attachment-im-btn-nav").removeClass("active");
															$(this).addClass("active");
														})
													})
												</script>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="tab-content">
											<div id="w-attachment-list" class="tab-pane fade in active multi-select">
												{$this->ListAttachment()}
											</div>
											<div id="w-attachment-upload" class="tab-pane fade" data="{$CMS->vars['root_domain']}">
												<div class="col-xs-12 w-attachment-im-show" style="background: #f7f8fa;padding: 50px;">
													<!-- filer 3 -->
													<input type="file" multiple="multiple" name="files[]" id="dropdrag-upload" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif">
												</div>
											</div>
										</div>
										<input type="hidden" id="x-attachment-list-selected-tmp-data" value="" />
										<script>
											$(function(){
												var _AttachmentResetSelect = function(){
													$("#x-attachment-list-selected-tmp-data").val("");
													$(".x-attachment-item").removeClass("x-attachment-item-selected");
												}
												var _SaveSelectedList = function(action,img){
													if(action == "add"){
														var _PicturesSelected = $("#x-attachment-list-selected-tmp-data").val();
														var _NewData = _PicturesSelected + "," + img;
														$("#x-attachment-list-selected-tmp-data").val(_NewData);
													}
													if(action == "remove"){
														var _PicturesSelected = $("#x-attachment-list-selected-tmp-data").val();
														_PicturesSelected = _PicturesSelected.split(",");
														var _NewData = "";
														_PicturesSelected.forEach(function(entry){
															if(entry != img && entry != ""){
																_NewData += "," + entry;
															}
														})
														$("#x-attachment-list-selected-tmp-data").val(_NewData);
													}
												}
												$(document).on("click", ".x-attachment-item", function(e){
													e.preventDefault();
													if($("#w-attachment-list").hasClass("multi-select")){
														//check -> add & remove
														if(!$(this).hasClass("x-attachment-item-selected")){
															$(this).addClass("x-attachment-item-selected");
															var _ImgSrc = $(this).find("img").attr("src");
															_SaveSelectedList("add",_ImgSrc);
														}else{
															$(this).removeClass("x-attachment-item-selected");
															var _ImgSrc = $(this).find("img").attr("src");
															_SaveSelectedList("remove",_ImgSrc);
														}
													}else{
														$(".x-attachment-item").removeClass("x-attachment-item-selected");
														$(this).addClass("x-attachment-item-selected");
													}
												})
												$(document).on("click", ".x-attachment-select-multi", function(e){
													e.preventDefault();
													$("#w-attachment-list").addClass("multi-select");
													$("#w-attachment-list").removeClass("one-select");
													_AttachmentResetSelect();
												})
												$(document).on("click", ".x-attachment-select-one", function(e){
													e.preventDefault();
													$("#w-attachment-list").removeClass("multi-select");
													$("#w-attachment-list").addClass("one-select");
													_AttachmentResetSelect();
												})
												/* $("#w-attachment-list").find(".x-attachment-item").each(function(){
													if($(this).find("img").attr("src") == "http://mtbweb.com/data/data__mtbweb_com/upload/images/16.jpg"){
														$(this).addClass("x-attachment-item-selected");
													}
												}) */
												//load attachment page
												$(document).on("click", ".x-attachment-ajax-load-page", function(e){
													e.preventDefault();
													var _AjaxLink = $(this).attr("href");
													if(_AjaxLink != "#"){
														$("#w-attachment-list").find(".w-attachment-im-show").find(".ajax-fake-loading").show();
														$("#w-attachment-list").find(".x-attachment-ajax-load-page").removeClass("active");
														$(this).addClass("active");
														$.ajax({
															method: "POST",
															url: _AjaxLink,
															data: {}
														}).done(function(data) {
															$("#w-attachment-list").html(data);
															$("#w-attachment-list").find(".w-attachment-im-show").find(".ajax-fake-loading").hide();
														})
													}else{
														//do nothing
													}
												})
												//reload after upload success
												$(document).on("click", ".upload-success-must-reload", function(){
													var _AjaxLink = $(".w-attachment-im-show").find("#uploadsuccess-reloadlink").val();
													if(_AjaxLink != "#"){
														$("#w-attachment-list").find(".w-attachment-im-show").find(".ajax-fake-loading").show();
														$("#w-attachment-list").find(".x-attachment-ajax-load-page").removeClass("active");
														$(this).addClass("active");
														$.ajax({
															method: "POST",
															url: _AjaxLink,
															data: {}
														}).done(function(data) {
															$("#w-attachment-list").html(data);
															$("#w-attachment-list").find(".w-attachment-im-show").find(".ajax-fake-loading").hide();
														})
													}else{
														//do nothing
													}
													$(this).removeClass("upload-success-must-reload");
												})
											})
										</script>
									</div>
								</div>
								
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action" data-dismiss="modal">
										<i class="fa fa-check"></i> {$CMS->vars['lang']['acp_attachment_window_apply_btn']}
									</a>
								</div>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> {$CMS->vars['lang']['acp_attachment_window_cancel_btn']}</button>
							</div>
						</div>

					</div>
				</div>
HERE;
			return $output;
		}
		public function AttachmentPageNav($curPage = 1, $iPerPage = 18){
			global $CMS, $DB;
			$output = "";
			if($data = $CMS->main_attachment->LoadListAttachmentDataSize("image")){
				$attNum = $data;
				$maxPage = ceil($attNum/$iPerPage);
			}else{
				$attNum = 0;
				$maxPage = 1;
			}
			$nextPage = $curPage + 1;
			$prevPage = $curPage - 1;
			//check current page
			if($curPage >= $maxPage){
				$curPage = $maxPage;
				$nextPage = "#";
				$prevPage = $curPage - 1;
			}
			if(!$curPage){
				$curPage = 1;
				$nextPage = $curPage + 1;
				$prevPage = '#';
			}
			//check next, prev
			if(!$prevPage){
				$prevPage = '#';
			}
			if($nextPage > $maxPage){
				$nextPage = "#";
			}
			//out 
			if($prevPage != "#"){
				$output.=<<<HERE
				<div class="col-xs-12 clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a class="x-attachment-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=attachment&action=image_list&attachment_page={$prevPage}">«</a></li>
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a class="x-attachment-ajax-load-page disable" href="#">«</a></li>
HERE;
			}
			//list 5 page prev
			for($i = 5; $i > 0; $i--){
				$page = $curPage - $i;
				if($page > 0){
					$output.=<<<HERE
					<li><a class="x-attachment-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=attachment&action=image_list&attachment_page={$page}">{$page}</a></li>
HERE;
				}
			}
			//current page
			$output.=<<<HERE
						<li><a class="x-attachment-ajax-load-page active" href="#">{$curPage}</a></li>
HERE;
			//list 5 page next
			for($i = 1; $i <= 5; $i++){
				$page = $curPage + $i;
				if($page <= $maxPage){
					$output.=<<<HERE
					<li><a class="x-attachment-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=attachment&action=image_list&attachment_page={$page}">{$page}</a></li>
HERE;
				}
			}
			if($nextPage != "#"){
				$output.=<<<HERE
						<li><a class="x-attachment-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=attachment&action=image_list&attachment_page={$nextPage}">»</a></li>
					</ul>
				</div>
HERE;
			}else{
				$output.=<<<HERE
						<li><a class="x-attachment-ajax-load-page disable" href="#">»</a></li>
					</ul>
				</div>
HERE;
			}
			return $output;
		}
		public function ListAttachment(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$itemPerPage = 18;
			if($pageNum = intval($CMS->input['attachment_page'])){
				$Offset = $itemPerPage * ($pageNum - 1);
			}else{
				$pageNum = 1;
				$Offset = 0;
			}
			$limit = $Offset.",".$itemPerPage;
			if($data = $CMS->main_attachment->LoadListAttachmentData("image", $limit)){
				$output.=<<<HERE
				<div class="col-xs-12 w-attachment-directory">
					<ul class="pagination pagination-sm no-margin">
						<li><a href="#"><i class="fa fa-folder"></i> Uploads</a></li>
						<li><a href="#"><i class="fa fa-caret-right"></i> Folder 1</a></li>
						<li><a href="#"><i class="fa fa-caret-right"></i> Folder 1.1</a></li>
					</ul>
				</div>
				<div class="col-xs-12 w-attachment-im-show">
					<input type="hidden" name="reloadlink" id="uploadsuccess-reloadlink" value="{$CMS->vars['root_domain']}?site=admin&page=attachment&action=image_list&attachment_page=1" />
					<div class="ajax-fake-loading">
						<div class="loading">
							<p><i class="fa fa-circle-o-notch fa-spin"></i> {$CMS->vars['lang']['acp_attachment_window_fake_loading']}</p>
						</div>
					</div>
					<script>
						$(function(){
							var _PicturesSelected = $("#x-attachment-list-selected-tmp-data").val();
							_PicturesSelected = _PicturesSelected.split(",");
							$("#w-attachment-list").find(".w-attachment-im-show").find(".x-attachment-item").each(function(){
								var _ThisSrc = $(this).find("img").attr("src");
								if(_PicturesSelected.indexOf(_ThisSrc) > -1){
									$(this).addClass("x-attachment-item-selected");
								}
							})
						})
					</script>
HERE;
				foreach($data as $img){
					$output .=<<<HERE
					<div class="col-xs-6 col-sm-4 col-md-2">
						<a href="#" class="thumbnail x-attachment-item" style="height: 100px; overflow: hidden;"><span><i class="fa fa-check"></i></span>
							<img style="max-width: 100%; width: auto 9; height: auto; vertical-align: middle; border: 0; -ms-interpolation-mode: bicubic;" src="{$CMS->vars['root_domain']}/{$img['link']}" alt="{$CMS->vars['root_domain']}/{$img['link']}">
						</a>
					</div>
HERE;
				}
				$output .=<<<HERE
				</div>
				{$this->AttachmentPageNav($pageNum, $itemPerPage)}
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 w-attachment-im-show">
					<p>Empty</p>
				</div>
				{$this->AttachmentPageNav($pageNum, $itemPerPage)}
HERE;
			}
			return $output;
		}
		public function ObjectPageNav($type = "post", $curPage = 1, $iPerPage = 10){
			global $CMS, $DB;
			$output = "";
			if($data = $CMS->main_object->ObjectCount($type)){
				$attNum = $data;
				$maxPage = ceil($attNum/$iPerPage);
			}else{
				$attNum = 0;
				$maxPage = 1;
			}
			$nextPage = $curPage + 1;
			$prevPage = $curPage - 1;
			//check current page
			if($curPage >= $maxPage){
				$curPage = $maxPage;
				$nextPage = "#";
				$prevPage = $curPage - 1;
			}
			if(!$curPage){
				$curPage = 1;
				$nextPage = $curPage + 1;
				$prevPage = '#';
			}
			//check next, prev
			if(!$prevPage){
				$prevPage = '#';
			}
			if($nextPage > $maxPage){
				$nextPage = "#";
			}
			//out 
			if($prevPage != "#"){
				$output.=<<<HERE
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a class="" href="{$CMS->vars['root_domain']}?site=admin&page={$type}&action=viewlist&page_number={$prevPage}&item_per_page={$iPerPage}">«</a></li>
HERE;
			}else{
				$output.=<<<HERE
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a class="disable" href="#">«</a></li>
HERE;
			}
			//list 5 page prev
			for($i = 5; $i > 0; $i--){
				$page = $curPage - $i;
				if($page > 0){
					$output.=<<<HERE
					<li><a class="" href="{$CMS->vars['root_domain']}?site=admin&page={$type}&action=viewlist&page_number={$page}&item_per_page={$iPerPage}">{$page}</a></li>
HERE;
				}
			}
			//current page
			$output.=<<<HERE
						<li><a class="active" href="#">{$curPage}</a></li>
HERE;
			//list 5 page next
			for($i = 1; $i <= 5; $i++){
				$page = $curPage + $i;
				if($page <= $maxPage){
					$output.=<<<HERE
					<li><a class="" href="{$CMS->vars['root_domain']}?site=admin&page={$type}&action=viewlist&page_number={$page}&item_per_page={$iPerPage}">{$page}</a></li>
HERE;
				}
			}
			if($nextPage != "#"){
				$output.=<<<HERE
					<li><a class="" href="{$CMS->vars['root_domain']}?site=admin&page={$type}&action=viewlist&page_number={$nextPage}&item_per_page={$iPerPage}">»</a></li>
				</ul>
HERE;
			}else{
				$output.=<<<HERE
					<li><a class="disable" href="#">»</a></li>
				</ul>
HERE;
			}
			return $output;
		}
		public function ObjectInsert(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output .=<<<HERE
				<!-- Modal -->
				<div class="modal fade w-object-select-multi" id="window-object-quickaccess" role="dialog" data-type="All">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Object insert</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
								<div class="contain-xw-object-list row">
									<input type="hidden" name="ajaxgetobject" id="ajaxgetobject-link" value="{$CMS->vars['root_domain']}?site=admin&page=main&action=ajax_object_insert" />
									<div class="ajax-fake-loading">
										<div class="loading">
											<p><i class="fa fa-circle-o-notch fa-spin"></i> Loading ...</p>
										</div>
									</div>
									{$this->ListObject()}
								</div>
								<input type="hidden" id="x-object-list-selected-tmp-data" value="" />
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action">
										<i class="fa fa-check"></i> OK
									</a>
								</div>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
							</div>
						</div>

					</div>
				</div>
HERE;
			return $output;
		}
		public function ListObject(){
			global $CMS, $DB;
			//get params
			if(isset($CMS->input['obj_type'])){
				$Otype = $CMS->input['obj_type'];
			}else{
				$Otype = "All";
			}
			if(intval($CMS->input['obj_page'])){
				$Opage = intval($CMS->input['obj_page']);
			}else{
				$Opage = 1;
			}
			if(intval($CMS->input['obj_ippage'])){
				$Oippage = intval($CMS->input['obj_ippage']);
			}else{
				$Oippage = 20;
			}
			if(isset($CMS->input['target'])){
				$Otarget = $CMS->input['target'];
			}else{
				$Otarget = 0;
			}
			if(isset($CMS->input['parent'])){
				$Oparent = $CMS->input['parent'];
			}else{
				$Oparent = array(array("id"=>"0", "name"=>"Root"));
			}
			$output = "";
			//list limited -> append
			//max record -> page nav
			//parent -> dir 
			if($ObjectList = $CMS->main_object->LoadObjectByParent($Otarget, $Otype, $Opage, $Oippage)){
				//append list
				$output.=<<<HERE
				<div class="xw-object-list">
					<div class="col-xs-12 w-object-header">
						{$this->ObjectDirNav($Oparent, $Otarget)}
						<div class="btn-group no-margin pull-right">
							<a class="btn btn-default">
								{$Oippage} Items per page
							</a>
							<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu xw-obj-ipp" data="{$Oippage}">
								<li class="ipp"><a href="#" data="10">10 Items per page</a></li>
								<li class="ipp"><a href="#" data="20">20 Items per page</a></li>
								<li class="ipp"><a href="#" data="30">30 Items per page</a></li>
								<li class="ipp"><a href="#" data="40">40 Items per page</a></li>
								<li class="ipp"><a href="#" data="50">50 Items per page</a></li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 w-object-body">
						<div class="obj-item obj-item-header-fix row">
							<div class="col-xs-1">
								<p>...</p>
							</div>
							<div class="col-xs-1">
								<p>Image</p>
							</div>
							<div class="col-xs-4">
								<p>Name</p>
							</div>
							<div class="col-xs-3">
								<p>Type</p>
							</div>
							<div class="col-xs-3">
								<p>Date modify</p>
							</div>
						</div>
						<div class="contain-scroll">
HERE;
					foreach($ObjectList as $obj){
						$ob_type = "Not set";
						switch($obj['type']){
							case '1':
								$ob_type = "Post category";
								$link = $CMS->vars['root_domain']."/post_category/".$obj['nice_url'];
								break;
							case '2':
								$ob_type = "Product category";
								$link = $CMS->vars['root_domain']."/product_category/".$obj['nice_url'];
								break;
							case '3':
								$ob_type = "Post";
								$link = $CMS->vars['root_domain']."/".$obj['nice_url'];
								break;
							case '4':
								$ob_type = "Product";
								$link = $CMS->vars['root_domain']."/product/".$obj['nice_url'];
								break;
							default:
								$ob_type = "Not set";
								$link = "";
								break;
						}
						$icon = "";
						$customClass = "";
						if($obj['type'] == "1" || $obj['type'] == "2"){
							$icon = "<i class='fa fa-folder'></i>";
							$customClass = "obj-item-directory";
						}else if($obj['type'] == "3"){
							$icon = "<i class='fa fa-file-text'></i>";
							$customClass = "obj-item-terminal";
						}else{
							$icon = "<i class='fa fa-shopping-cart'></i>";
							$customClass = "obj-item-terminal";
						}
						$output.=<<<HERE
						<div class="obj-item {$customClass} row" data="{$obj['object_id']}">
							<div class="col-xs-1">
								<p class="o-id">{$icon}</p>
							</div>
							<div class="col-xs-1">
								<p><img class="o-img" style="max-width: 100%; display: block; margin: 0 auto; " src="{$obj['image']}"/></p>
							</div>
							<div class="col-xs-4">
								<p class="o-name" data="{$link}">{$obj['name']}</p>
							</div>
							<div class="col-xs-3">
								<p class="o-type">{$ob_type}</p>
							</div>
							<div class="col-xs-3">
								<p class="o-date">{$obj['date_updated']}</p>
							</div>
						</div>
HERE;
					}
				$output.=<<<HERE
						</div>
					</div>
					<div class="col-xs-12 w-object-footer">
						{$this->ObjectPageNav2($Otarget, $Otype, $Opage, $Oippage)}
					</div>
				</div>
HERE;
			}else{
				//empty
				//append list
				$output.=<<<HERE
				<div class="xw-object-list">
					<div class="col-xs-12 w-object-header">
						{$this->ObjectDirNav($Oparent, $Otarget)}
						<div class="btn-group no-margin pull-right">
							<a class="btn btn-default">
								{$Oippage} Items per page
							</a>
							<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu xw-obj-ipp" data="{$Oippage}">
								<li class="ipp"><a href="#" data="10">10 Items per page</a></li>
								<li class="ipp"><a href="#" data="20">20 Items per page</a></li>
								<li class="ipp"><a href="#" data="30">30 Items per page</a></li>
								<li class="ipp"><a href="#" data="40">40 Items per page</a></li>
								<li class="ipp"><a href="#" data="50">50 Items per page</a></li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 w-object-body">
						<div class="obj-item obj-item-header-fix row">
							<div class="col-xs-1">
								<p>...</p>
							</div>
							<div class="col-xs-1">
								<p>Image</p>
							</div>
							<div class="col-xs-4">
								<p>Name</p>
							</div>
							<div class="col-xs-3">
								<p>Type</p>
							</div>
							<div class="col-xs-3">
								<p>Date modify</p>
							</div>
						</div>
						<div class="contain-scroll">
							<div class="col-xs-12">
								<p>Empty</p>
							</div>
						</div>
					</div>
					<div class="col-xs-12 w-object-footer">
						{$this->ObjectPageNav2($Otarget, $Otype, $Opage, $Oippage)}
					</div>
				</div>
HERE;
			}
			$output.=<<<HERE
			<script>
				$(function(){
					var _CurrentSelected = $("#x-object-list-selected-tmp-data").val();
					_CurrentSelected = _CurrentSelected.split(",");
					$("#window-object-quickaccess").find(".w-object-body").find(".contain-scroll").find(".obj-item").each(function(){
						var _data = $(this).attr("data");
						if(_CurrentSelected.indexOf(_data) > -1){
							$(this).addClass("selected");
						}
					})
				})
			</script>
HERE;
			return $output;
		}
		public function ObjectDirNav($parent = false, $stop = false){
			global $CMS, $DB;
			$output = "";
			if($parent){
				$output .=<<<HERE
				<ul class="pagination pagination-sm no-margin xw-obj-parent-dir">
					<li class="direct"><a href="#" class="back"><i class="fa fa-arrow-left"></i></a></li>
HERE;
				foreach($parent as $par){
					if($stop){
						if($par['id'] == $stop){break;}
					}
					$data = json_encode($par);
					if($par['id'] == "0"){
						$output .=<<<HERE
							<li class="direct"><a class="changedir" href="#" data='{$data}'><i class="fa fa-folder"></i> {$par['name']}</a></li>
HERE;
					}else{
						$output .=<<<HERE
							<li class="direct"><a class="changedir" href="#" data='{$data}'><i class="fa fa-caret-right"></i> {$par['name']}</a></li>
HERE;
					}
					if(!$stop){break;}
				}
				if($stop){
					$name = $CMS->main_object->GetObjectName($stop);
					$data = array("id" => $stop, "name" => $name);
					$data = json_encode($data);
					$output .=<<<HERE
					<li class="direct"><a class="changedir" href="#" data='{$data}'><i class="fa fa-caret-right"></i> {$name}</a></li>
HERE;
				}
				$output .=<<<HERE
				</ul>
HERE;
			}
			return $output;
		}
		public function ObjectPageNav2($parent = false, $type = "All", $curPage = 1, $iPerPage = 20){
			global $CMS, $DB;
			$output = "";
			if($data = $CMS->main_object->ObjectCount2($parent, $type)){
				$attNum = $data;
				$maxPage = ceil($attNum/$iPerPage);
			}else{
				$attNum = 0;
				$maxPage = 1;
			}
			$nextPage = $curPage + 1;
			$prevPage = $curPage - 1;
			//check current page
			if($curPage >= $maxPage){
				$curPage = $maxPage;
				$nextPage = "#";
				$prevPage = $curPage - 1;
			}
			if(!$curPage){
				$curPage = 1;
				$nextPage = $curPage + 1;
				$prevPage = '#';
			}
			//check next, prev
			if(!$prevPage){
				$prevPage = '#';
			}
			if($nextPage > $maxPage){
				$nextPage = "#";
			}
			//out 
			if($prevPage != "#"){
				$output.=<<<HERE
				<ul class="pagination pagination-sm no-margin pull-right xw-obj-page-select">
					<li class="page"><a class="" href="#" data="{$prevPage}">«</a></li>
HERE;
			}else{
				$output.=<<<HERE
				<ul class="pagination pagination-sm no-margin pull-right xw-obj-page-select">
					<li class="page"><a class="disable" href="#" data="noproc">«</a></li>
HERE;
			}
			//list 5 page prev
			for($i = 5; $i > 0; $i--){
				$page = $curPage - $i;
				if($page > 0){
					$output.=<<<HERE
					<li class="page"><a class="" href="#" data="{$page}">{$page}</a></li>
HERE;
				}
			}
			//current page
			$output.=<<<HERE
						<li class="page"><a class="active" href="#"  data="noproc">{$curPage}</a></li>
HERE;
			//list 5 page next
			for($i = 1; $i <= 5; $i++){
				$page = $curPage + $i;
				if($page <= $maxPage){
					$output.=<<<HERE
					<li class="page"><a class="" href="#" data="{$page}">{$page}</a></li>
HERE;
				}
			}
			if($nextPage != "#"){
				$output.=<<<HERE
					<li class="page"><a class="" href="#" data="{$nextPage}">»</a></li>
				</ul>
HERE;
			}else{
				$output.=<<<HERE
					<li><a class="disable" href="#" data="noproc">»</a></li>
				</ul>
HERE;
			}
			return $output;
		}
		public function MenuSelect(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output .=<<<HERE
				<!-- Modal -->
				<div class="modal fade" id="window-menu-quickaccess" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">{$CMS->vars['lang']['acp_menu_window_quick_access']}</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
							
								<div class="box" style="margin: 0px !important;">
									<div class="box-body xw-menu-list">
										{$this->ListMenuSelect()}
									</div>
									<input type="hidden" id="x-menu-list-selected-tmp-data" value="" />
								</div>
								<script>
									$(function(){
										$(document).on("click", ".menu-slider-name-select", function(e){
											$(".menu-slider-name-select").removeClass("selected");
											$(this).addClass("selected");
										})
										//load menu page
										$(document).on("click", ".x-menu-ajax-load-page", function(e){
											e.preventDefault();
											var _AjaxLink = $(this).attr("href");
											if(_AjaxLink != "#"){
												$("#window-menu-quickaccess").find(".xw-menu-list").find(".ajax-fake-loading").show();
												$("#window-menu-quickaccess").find(".xw-menu-list").removeClass("active");
												$(this).addClass("active");
												$.ajax({
													method: "POST",
													url: _AjaxLink,
													data: {}
												}).done(function(data) {
													$("#window-menu-quickaccess").find(".xw-menu-list").html(data);
													$("#window-menu-quickaccess").find(".xw-menu-list").find(".ajax-fake-loading").hide();
												})
											}else{
												//do nothing
											}
										})
									})
								</script>
								
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action" data-dismiss="modal">
										<i class="fa fa-check"></i> {$CMS->vars['lang']['acp_attachment_window_apply_btn']}
									</a>
								</div>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> {$CMS->vars['lang']['acp_attachment_window_cancel_btn']}</button>
							</div>
						</div>

					</div>
				</div>
HERE;
			return $output;
		}
		public function ListMenuSelect(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$itemPerPage = 18;
			if($pageNum = intval($CMS->input['menu_page'])){
				$Offset = $itemPerPage * ($pageNum - 1);
			}else{
				$pageNum = 1;
				$Offset = 0;
			}
			$limit = $Offset.",".$itemPerPage;
			if($data = $this->LoadListMenuData($limit)){
				$output.=<<<HERE
				<div class="col-xs-12 w-menu-im-show">
					<div class="ajax-fake-loading">
						<div class="loading">
							<p><i class="fa fa-circle-o-notch fa-spin"></i> {$CMS->vars['lang']['acp_attachment_window_fake_loading']}</p>
						</div>
					</div>
HERE;
				foreach($data as $menu){
					$output .=<<<HERE
					<div class="col-xs-6 col-sm-4 col-md-4">
						<p class="menu-slider-name-select" data="{$menu['id']}"><i class="fa fa-th-list"></i> <span>{$menu['name']}</span></p>
					</div>
					
HERE;
				}
				$output .=<<<HERE
				</div>
				{$this->MenuPageNav($pageNum, $itemPerPage)}
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 w-menu-im-show">
					<p>Empty</p>
				</div>
				{$this->MenuPageNav($pageNum, $itemPerPage)}
HERE;
			}
			return $output;
		}
		public function LoadListMenuData($limit = 1000000){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT id, name FROM menu WHERE 1=1 ORDER BY id DESC LIMIT {$limit}");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
		public function MenuTotalRecord(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT sum(status) FROM menu");
			if($data = $sql->fetchAll()){
				return $data[0]['sum(status)'];
			}else{
				return false;
			}
		}
		public function MenuPageNav($curPage = 1, $iPerPage = 10){
			global $CMS, $DB;
			$output = "";
			if($data = $this->MenuTotalRecord()){
				$attNum = $data;
				$maxPage = ceil($attNum/$iPerPage);
			}else{
				$attNum = 0;
				$maxPage = 1;
			}
			$nextPage = $curPage + 1;
			$prevPage = $curPage - 1;
			//check current page
			if($curPage >= $maxPage){
				$curPage = $maxPage;
				$nextPage = "#";
				$prevPage = $curPage - 1;
			}
			if(!$curPage){
				$curPage = 1;
				$nextPage = $curPage + 1;
				$prevPage = '#';
			}
			//check next, prev
			if(!$prevPage){
				$prevPage = '#';
			}
			if($nextPage > $maxPage){
				$nextPage = "#";
			}
			//out 
			if($prevPage != "#"){
				$output.=<<<HERE
				<div class="col-xs-12 clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a class="x-menu-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=menu&action=menu_select&menu_page={$prevPage}">«</a></li>
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a class="x-menu-ajax-load-page disable" href="#">«</a></li>
HERE;
			}
			//list 5 page prev
			for($i = 5; $i > 0; $i--){
				$page = $curPage - $i;
				if($page > 0){
					$output.=<<<HERE
					<li><a class="x-menu-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=menu&action=menu_select&menu_page={$page}">{$page}</a></li>
HERE;
				}
			}
			//current page
			$output.=<<<HERE
						<li><a class="x-menu-ajax-load-page active" href="#">{$curPage}</a></li>
HERE;
			//list 5 page next
			for($i = 1; $i <= 5; $i++){
				$page = $curPage + $i;
				if($page <= $maxPage){
					$output.=<<<HERE
					<li><a class="x-menu-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=menu&action=menu_select&menu_page={$page}">{$page}</a></li>
HERE;
				}
			}
			if($nextPage != "#"){
				$output.=<<<HERE
						<li><a class="x-menu-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=menu&action=menu_select&menu_page={$nextPage}">»</a></li>
					</ul>
				</div>
HERE;
			}else{
				$output.=<<<HERE
						<li><a class="x-menu-ajax-load-page disable" href="#">»</a></li>
					</ul>
				</div>
HERE;
			}
			return $output;
		}
		//Slider
		public function SliderSelect(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output .=<<<HERE
				<!-- Modal -->
				<div class="modal fade" id="window-slider-quickaccess" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">{$CMS->vars['lang']['acp_slider_window_quick_access']}</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
							
								<div class="box" style="margin: 0px !important;">
									<div class="box-body xw-slider-list">
										{$this->ListSliderSelect()}
									</div>
									<input type="hidden" id="x-slider-list-selected-tmp-data" value="" />
								</div>
								<script>
									$(function(){
										$(document).on("click", ".slider-slider-name-select", function(e){
											$(".slider-slider-name-select").removeClass("selected");
											$(this).addClass("selected");
										})
										//load slider page
										$(document).on("click", ".x-slider-ajax-load-page", function(e){
											e.preventDefault();
											var _AjaxLink = $(this).attr("href");
											if(_AjaxLink != "#"){
												$("#window-slider-quickaccess").find(".xw-slider-list").find(".ajax-fake-loading").show();
												$("#window-slider-quickaccess").find(".xw-slider-list").removeClass("active");
												$(this).addClass("active");
												$.ajax({
													method: "POST",
													url: _AjaxLink,
													data: {}
												}).done(function(data) {
													$("#window-slider-quickaccess").find(".xw-slider-list").html(data);
													$("#window-slider-quickaccess").find(".xw-slider-list").find(".ajax-fake-loading").hide();
												})
											}else{
												//do nothing
											}
										})
									})
								</script>
								
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action" data-dismiss="modal">
										<i class="fa fa-check"></i> {$CMS->vars['lang']['acp_attachment_window_apply_btn']}
									</a>
								</div>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> {$CMS->vars['lang']['acp_attachment_window_cancel_btn']}</button>
							</div>
						</div>

					</div>
				</div>
HERE;
			return $output;
		}
		public function ListSliderSelect(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$itemPerPage = 18;
			if($pageNum = intval($CMS->input['slider_page'])){
				$Offset = $itemPerPage * ($pageNum - 1);
			}else{
				$pageNum = 1;
				$Offset = 0;
			}
			$limit = $Offset.",".$itemPerPage;
			if($data = $this->LoadListSliderData($limit)){
				$output.=<<<HERE
				<div class="col-xs-12 w-slider-im-show">
					<div class="ajax-fake-loading">
						<div class="loading">
							<p><i class="fa fa-circle-o-notch fa-spin"></i> {$CMS->vars['lang']['acp_attachment_window_fake_loading']}</p>
						</div>
					</div>
HERE;
				foreach($data as $menu){
					$output .=<<<HERE
					<div class="col-xs-6 col-sm-4 col-md-4">
						<p class="menu-slider-name-select" data="{$menu['id']}"><i class="fa fa-desktop"></i> <span>{$menu['name']}</span></p>
					</div>
					
HERE;
				}
				$output .=<<<HERE
				</div>
				{$this->SliderPageNav($pageNum, $itemPerPage)}
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 w-slider-im-show">
					<p>Empty</p>
				</div>
				{$this->SliderPageNav($pageNum, $itemPerPage)}
HERE;
			}
			return $output;
		}
		public function LoadListSliderData($limit = 1000000){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT id, name FROM slider WHERE 1=1 ORDER BY id DESC LIMIT {$limit}");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
		public function SliderTotalRecord(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT sum(status) FROM slider");
			if($data = $sql->fetchAll()){
				return $data[0]['sum(status)'];
			}else{
				return false;
			}
		}
		public function SliderPageNav($curPage = 1, $iPerPage = 10){
			global $CMS, $DB;
			$output = "";
			if($data = $this->SliderTotalRecord()){
				$attNum = $data;
				$maxPage = ceil($attNum/$iPerPage);
			}else{
				$attNum = 0;
				$maxPage = 1;
			}
			$nextPage = $curPage + 1;
			$prevPage = $curPage - 1;
			//check current page
			if($curPage >= $maxPage){
				$curPage = $maxPage;
				$nextPage = "#";
				$prevPage = $curPage - 1;
			}
			if(!$curPage){
				$curPage = 1;
				$nextPage = $curPage + 1;
				$prevPage = '#';
			}
			//check next, prev
			if(!$prevPage){
				$prevPage = '#';
			}
			if($nextPage > $maxPage){
				$nextPage = "#";
			}
			//out 
			if($prevPage != "#"){
				$output.=<<<HERE
				<div class="col-xs-12 clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a class="x-slider-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=slider&action=slider_select&slider_page={$prevPage}">«</a></li>
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a class="x-slider-ajax-load-page disable" href="#">«</a></li>
HERE;
			}
			//list 5 page prev
			for($i = 5; $i > 0; $i--){
				$page = $curPage - $i;
				if($page > 0){
					$output.=<<<HERE
					<li><a class="x-slider-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=slider&action=slider_select&slider_page={$page}">{$page}</a></li>
HERE;
				}
			}
			//current page
			$output.=<<<HERE
						<li><a class="x-slider-ajax-load-page active" href="#">{$curPage}</a></li>
HERE;
			//list 5 page next
			for($i = 1; $i <= 5; $i++){
				$page = $curPage + $i;
				if($page <= $maxPage){
					$output.=<<<HERE
					<li><a class="x-slider-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=slider&action=slider_select&slider_page={$page}">{$page}</a></li>
HERE;
				}
			}
			if($nextPage != "#"){
				$output.=<<<HERE
						<li><a class="x-slider-ajax-load-page" href="{$CMS->vars['root_domain']}?site=admin&page=slider&action=slider_select&slider_page={$nextPage}">»</a></li>
					</ul>
				</div>
HERE;
			}else{
				$output.=<<<HERE
						<li><a class="x-slider-ajax-load-page disable" href="#">»</a></li>
					</ul>
				</div>
HERE;
			}
			return $output;
		}
		//page
		public function PageSelect(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			$output .=<<<HERE
				<!-- Modal -->
				<div class="modal fade" id="window-page-quickaccess" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">{$CMS->vars['lang']['acp_page_window_quick_access']}</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
							
								<div class="box" style="margin: 0px !important;">
									<div class="box-body xw-page-list">
										{$this->ListPageSelect()}
									</div>
									<input type="hidden" id="x-page-list-selected-tmp-data" value="" />
								</div>
								<script>
									$(function(){
										$(document).on("click", ".page-name-select", function(e){
											$(".page-name-select").removeClass("selected");
											$(this).addClass("selected");
										})
									})
								</script>
								
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action" data-dismiss="modal">
										<i class="fa fa-check"></i> {$CMS->vars['lang']['acp_attachment_window_apply_btn']}
									</a>
								</div>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> {$CMS->vars['lang']['acp_attachment_window_cancel_btn']}</button>
							</div>
						</div>

					</div>
				</div>
HERE;
			return $output;
		}
		public function ListPageSelect(){
			global $CMS, $DB;
			$lang = $CMS->admin['system']->LoadLanguage('admin_global');
			$output = "";
			if($data = $this->LoadListPageData()){
				$output.=<<<HERE
				<div class="col-xs-12 w-page-im-show">
					<div class="ajax-fake-loading">
						<div class="loading">
							<p><i class="fa fa-circle-o-notch fa-spin"></i> {$CMS->vars['lang']['acp_attachment_window_fake_loading']}</p>
						</div>
					</div>
HERE;
				foreach($data as $page){
					$output .=<<<HERE
					<div class="col-xs-6 col-sm-4 col-md-4">
						<p class="page-name-select" data="{$CMS->vars['root_domain']}/{$page['nice_url']}"><i class="fa fa-desktop"></i> <span>{$page['name']}</span></p>
					</div>
					
HERE;
				}
				$output .=<<<HERE
				</div>
HERE;
			}else{
				$output.=<<<HERE
				<div class="col-xs-12 w-page-im-show">
					<p>Empty</p>
				</div>
HERE;
			}
			return $output;
		}
		public function LoadListPageData(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT name, nice_url FROM page_description WHERE lang_id='1' ");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
		public function FrameConfig($nice_url){
			global $CMS, $DB;
			return $CMS->frame[$nice_url]->Setting();
		}
	}