<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_member = new Skin_Member();
	class Skin_Member{
		public function __construct(){
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_member');
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
		public function MainContent(){
			global $CMS, $DB;
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
								<div class="row"><form method="POST" action="#">
									<div class="col-xs-12 col-md-12 col-sm-12">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_name']}</h3>
											</div>
											<div class="box-body">
												<table class="table table-bordered">
													<tbody>
														<tr class="theader">
															<th width="5%">ID</th>
															<th>From</th>
															<th>Title</th>
															<th>Content</th>
															<th width="20%">Action</th>
														</tr>
HERE;
													$ContactList = $this->GetContactListData();
													foreach($ContactList as $oneContact){
														//check status
														if($oneMenu['status'] == "1"){
															$unread = "unread";
														}else{
															$unread = "";
														}
														if(strlen($oneContact['content']) > 50){
															$content = substr($oneContact['content'], 0, 50)."...";
														}else{
															$content = $oneContact['content'];
														}
														$output .=<<<HERE
														<tr class="contact-row {$unread}">
															<td>{$oneContact['id']}</td>
															<td><p class="list-name">{$oneContact['from_name']}</p><p class="list-mail">{$oneContact['from_email']}</p></td>
															<td><p class="list-title">{$oneContact['title']}</p></td>
															<td><p class="list-content">{$content}</p></td>
															<td>
																<a class="act view" target="_blank" href="{$CMS->vars['root_domain']}/?site=admin&page=contact&action=view&id={$oneContact['id']}"><i class='fa fa-eye'></i> View</a>
																<a class="act delete" target="_blank" href="{$CMS->vars['root_domain']}/?site=admin&page=contact&action=delete&id={$oneContact['id']}"><i class='fa fa-trash'></i> Delete</a>
															</td>
														</tr>
HERE;
													}
													if(!$ContactList){
														$output .=<<<HERE
														<tr>
															<td colspan="5">Empty</td>
														</tr>
HERE;
													}
													$output .=<<<HERE
													</tbody>
												</table>
											</div>
											<div class="box-footer clearfix">
												<ul class="pagination pagination-sm no-margin pull-right">
													<li><a href="#">«</a></li>
													<li><a href="#">1</a></li>
													<li><a href="#">»</a></li>
												</ul>
											</div>
										</div>
									</div>
								</form></div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
		public function GetMemberListData(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM contact ORDER BY id DESC LIMIT 0,10");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
	}