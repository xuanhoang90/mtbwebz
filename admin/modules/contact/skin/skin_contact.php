<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_contact = new Skin_Contact();
	class Skin_Contact{
		public function __construct(){
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_contact');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/admin_contact.css" rel="stylesheet" type="text/css" />
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
		public function ReadContact(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_contact');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/image_hover.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/admin_contact.css" rel="stylesheet" type="text/css" />
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
			<script src="{$CMS->admin['style_dir']}/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
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

						{$this->ContactContent()}

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
														if($oneContact['status'] == "1"){
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
											{$this->ContactPageNav()}
										</div>
									</div>
								</form></div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
		public function ContactContent(){
			global $CMS, $DB;
			$output = "";
			$contactData = $this->GetContactData();
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
												<h3 class="box-title">
													{$contactData['title']}
												</h3>
												<p class="contact-from">From: {$contactData['from_name']}<br/>{$contactData['from_email']}</p>
											</div>
											<div class="box-body" style="background: #eee; margin: 5px; padding: 5px; min-height: 200px; line-height: 25px; font-size: 13px; ">
												{$contactData['content']}
											</div>
											<div class="box-footer with-border">
												<form>
													<textarea class="rep_contact" id="rep_contact" name="rep_contact"></textarea>
													<hr/>
													<input class="btn btn-primary" type="submit" name="submit" value="Reply" />
													<script>
														$(function(){
															CKEDITOR.replace( 'rep_contact' );
															CKEDITOR.config.title = false;
														})
													</script>
												</form>
											</div>
										</div>
									</div>
								</form></div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
		public function GetContactListData(){
			global $CMS, $DB;
			if(intval($CMS->input['page_number'])){
				$page_number = intval($CMS->input['page_number']);
			}else{
				$page_number = 1;
			}
			$ipp = 10;
			$start = ($page_number - 1)*$ipp;
			$sql_add = "{$start}, {$ipp}";
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM contact ORDER BY id DESC LIMIT {$sql_add}");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
		public function GetContactData(){
			global $CMS, $DB;
			$contactID = intval($CMS->input['id']);
			$DB->query("use ".WEBSITE_DBNAME);
			//set read
			$DB->query("UPDATE contact SET status = '0' WHERE id = '{$contactID}'");
			$sql = $DB->query("SELECT * FROM contact WHERE id = '{$contactID}'");
			if($data = $sql->fetchAll()){
				return $data[0];
			}else{
				return false;
			}
		}
		public function ContactPageNav(){
			global $CMS, $DB;
			if(intval($CMS->input['page_number'])){
				$page_number = intval($CMS->input['page_number']);
			}else{
				$page_number = 1;
			}
			$ipp = 10;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT COUNT(*) as total FROM contact");
			if($data = $sql->fetchAll()){
				$total = $data[0]['total'];
			}else{
				$total = 1;
			}
			$totalPage = ceil($total/$ipp);
			$output = "";
			$next = $page_number + 1;
			if($next < 0 || $next > $totalPage){
				$next = "#";
			}
			$prev = $page_number - 1;
			if($prev < 0){
				$prev = "#";
			}
			$output .=<<<HERE
				<div class="box-footer clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
HERE;
				if($prev != "#"){
					$output.=<<<HERE
						<li><a href="{$CMS->vars['root_domain']}/?site=admin&page=contact&action=viewlist&page_number={$prev}">«</a></li>
HERE;
				}else{
					$output.=<<<HERE
						<li><a href="#">«</a></li>
HERE;
				}
				for($i = 5; $i > 0; $i--){
					$prevPage = $page - $i;
					if($prevPage > 0){
						$output.=<<<HERE
						<li><a href="{$CMS->vars['root_domain']}/?site=admin&page=contact&action=viewlist&page_number={$prevPage}">{$prevPage}</a></li>
HERE;
					}
				}
					$output.=<<<HERE
						<li><a href="#">{$page_number}</a></li>
HERE;
				for($i = 0; $i < 5; $i++){
					$nextPage = $page + $i;
					if($nextPage > 0 && $nextPage < $totalPage){
						$output.=<<<HERE
						<li><a href="{$CMS->vars['root_domain']}/?site=admin&page=contact&action=viewlist&page_number={$nextPage}">{$nextPage}</a></li>
HERE;
					}
				}
				if($next != "#"){
					$output.=<<<HERE
						<li><a href="{$CMS->vars['root_domain']}/?site=admin&page=contact&action=viewlist&page_number={$next}">»</a></li>
HERE;
				}else{
					$output.=<<<HERE
						<li><a href="#">»</a></li>
HERE;
				}
					$output.=<<<HERE
					</ul>
				</div>
HERE;
			return $output;
		}
	}