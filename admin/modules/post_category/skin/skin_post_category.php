<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_post_category = new Skin_PostCategory();
	class Skin_PostCategory{
		public function __construct(){
			return true;
		}
		public function PageDefault(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_post_category');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/admin_table.css" rel="stylesheet" type="text/css" />
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
		public function QuickAction(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
				<div class="quickaccess">
					<a class="add action" href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=add"><i class="fa fa-plus"></i></a>
				</div>
HERE;
			return $output;
		}
		public function MainContent(){
			global $CMS, $DB;
			if(intval($CMS->input['page_number'])){
				$currentPage = intval($CMS->input['page_number']);
			}else{
				$currentPage = 1;
			}
			if(intval($CMS->input['item_per_page'])){
				$ItemsPerPage = intval($CMS->input['item_per_page']);
			}else{
				$ItemsPerPage = 10;
			}
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
									<div class="col-xs-12 contain-change-tpl">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_viewlist']}</h3>
												<div class="btn-group pull-right">
													<a class="btn btn-default">
														{$ItemsPerPage} {$CMS->vars['lang']['acp_object_itemperpage']}
													</a>
													<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu">
														<li><a href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=viewlist&page_number={$currentPage}&item_per_page=10">10 {$CMS->vars['lang']['acp_object_itemperpage']}</a></li>
														<li><a href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=viewlist&page_number={$currentPage}&item_per_page=10">20 {$CMS->vars['lang']['acp_object_itemperpage']}</a></li>
														<li><a href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=viewlist&page_number={$currentPage}&item_per_page=10">30 {$CMS->vars['lang']['acp_object_itemperpage']}</a></li>
														<li><a href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=viewlist&page_number={$currentPage}&item_per_page=10">40 {$CMS->vars['lang']['acp_object_itemperpage']}</a></li>
														<li><a href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=viewlist&page_number={$currentPage}&item_per_page=10">50 {$CMS->vars['lang']['acp_object_itemperpage']}</a></li>
													</ul>
												</div>
											</div><!-- /.box-header -->
											<div class="box-body">
												<table class="table table-bordered">
													<tbody>
														<tr class="theader">
															<th width="10%"><p class="table-label">{$CMS->vars['lang']['acp_table_select_btn']}</p>
																<div class="btn-group pull-right">
																	<a class="select-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="caret"></span>
																	</a>
																	<ul class="dropdown-menu">
																		<li><a href="#">{$CMS->vars['lang']['acp_table_select_btn_all']}</a></li>
																		<li><a href="#">{$CMS->vars['lang']['acp_table_select_btn_deselect']}</a></li>
																	</ul>
																</div>
																<!--<div class='checkbox checkbox-info checkbox-circle'><input type="checkbox" checked="" id="checkbox8"><label for="checkbox8">Check</label></div>-->
															</th>
															<th width="5%"><p class="table-label">{$CMS->vars['lang']['acp_table_th_id']}</p>
																<div class="btn-group pull-right">
																	<a class="select-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="caret"></span>
																	</a>
																	<ul class="dropdown-menu">
																		<li><a href="#">{$CMS->vars['lang']['acp_table_th_sort_asc']}</a></li>
																		<li><a href="#">{$CMS->vars['lang']['acp_table_th_sort_desc']}</a></li>
																	</ul>
																</div>
															</th>
															<th width="7%"><p class="table-label">{$CMS->vars['lang']['acp_table_th_image']}</p></th>
															<th><p class="table-label">{$CMS->vars['lang']['acp_table_th_name']}</p>
																<div class="btn-group pull-right">
																	<a class="select-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="caret"></span>
																	</a>
																	<ul class="dropdown-menu">
																		<li><a href="#">{$CMS->vars['lang']['acp_table_th_sort_az']}</a></li>
																		<li><a href="#">{$CMS->vars['lang']['acp_table_th_sort_za']}</a></li>
																	</ul>
																</div>
															</th>
															<th><p class="table-label">{$CMS->vars['lang']['acp_table_th_category']}</p>
																<div class="btn-group pull-right">
																	<a class="select-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<span class="caret"></span>
																	</a>
																	<ul class="dropdown-menu">
																		<li><a href="#">{$CMS->vars['lang']['acp_table_th_sort_az']}</a></li>
																		<li><a href="#">{$CMS->vars['lang']['acp_table_th_sort_za']}</a></li>
																	</ul>
																</div>
															</th>
															<th width="30%">{$CMS->vars['lang']['acp_table_th_action']}</th>
															<th width="5%">{$CMS->vars['lang']['acp_table_th_status']}</th>
														</tr>
HERE;
														$data = $CMS->main_object->LoadObjectTypeListData("post_category", $currentPage, $ItemsPerPage);
														foreach($data as $object){
															if($object['status'] == "1"){
																$checked = "checked";
															}else{
																$checked = "";
															}
															if(!$parent = $CMS->main_object->GetNameParentObject($object['parent'])){
																$parent['name'] = "<i>{$CMS->vars['lang']['acp_status_noparent']}</i>";
															}
															$output .=<<<HERE
																<tr>
																	<td>
																		<div class='checkbox checkbox-info checkbox-circle'>
																			<input type="checkbox" checked="" id="checkbox{$object['object_id']}"><label for="checkbox{$object['object_id']}"></label>
																		</div>
																	</td>
																	<td>{$object['object_id']}</td>
																	<td><img class="object-avatar" src="{$object['image']}" alt="{$object['image']}"/></td>
																	<td><p class="pagename">{$object['name']}</p></td>
																	<td>{$parent['name']}</td>
																	<td>
																		<a class="act edit" target="_blank" href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=edit&id={$object['object_id']}"><i class='fa fa-edit'></i> {$CMS->vars['lang']['acp_table_th_action_edit']}</a>
																		<a class="act preview" target="_blank" href="#"><i class='fa fa-eye'></i> {$CMS->vars['lang']['acp_table_th_action_preview']}</a>
																		<a class="act clone" target="_blank" href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=clone&id={$object['object_id']}"><i class='fa fa-clone'></i> {$CMS->vars['lang']['acp_table_th_action_clone']}</a>
																		<a class="act delete" target="_blank" href="{$CMS->vars['root_domain']}?site=admin&page=post_category&action=delete&id={$object['object_id']}"><i class='fa fa-trash'></i> {$CMS->vars['lang']['acp_table_th_action_delete']}</a>
																	</td>
																	<td>
																		<input type="checkbox" {$checked} data-toggle="toggle" data-on="<i class='fa fa-eye'></i> {$CMS->vars['lang']['acp_table_th_status_enable']}" data-off="<i class='fa fa-eye-slash'></i> {$CMS->vars['lang']['acp_table_th_status_disable']}">
																	</td>
																</tr>
HERE;
														}
													$output .=<<<HERE
													</tbody>
													<script>
														$(function(){
															$(".delete").click(function(e){
																e.preventDefault();
																$(".table-bordered").find("tr").removeClass("remove-tr");
																$(this).parent().parent().addClass("remove-tr");
																if(confirm("Are you sure?")){
																	var _LinkDelete = $(this).attr("href");
																	$.ajax({
																		method: "POST",
																		url: _LinkDelete,
																		data: {}
																	}).done(function(data){
																		data = JSON.parse(data);
																		if(data.status == "success"){
																			$(".remove-tr").fadeOut(300);
																		}else{
																			alert(data.reason);
																		}
																	})
																}
															})
														})														
													</script>
												</table>
											</div><!-- /.box-body -->
											<div class="box-footer clearfix">
												<div class="btn-group">
													<a class="btn btn-default">
														{$CMS->vars['lang']['acp_table_th_action']}
													</a>
													<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu">
														<li><a href="#"><i class='fa fa-check-square-o'></i> {$CMS->vars['lang']['acp_table_select_btn_all']}</a></li>
														<li role="separator" class="divider"></li>
														<li><a href="#"><i class='fa fa-trash'></i> {$CMS->vars['lang']['acp_table_th_action_deleteall']}</a></li>
													</ul>
												</div>
												{$CMS->admin['skin_global']->ObjectPageNav("post_category", $currentPage, $ItemsPerPage)}
											</div>
										</div><!-- /.box -->
										
									</div>
								</div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
						{$this->QuickAction()}
HERE;
			return $output;
		}
		public function CreatePostCategory(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_post_category');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/fileupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
			<link href="{$CMS->admin['style_dir']}/plugins/fileupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
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
			<script src="{$CMS->admin['style_dir']}/plugins/selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/object_editor.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/jquery.filer.min.js" type="text/javascript" ></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/setup.js" type="text/javascript" ></script>
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

						{$this->FormPostCategory()}

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function EditPostCategory(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_post_category');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/fileupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
			<link href="{$CMS->admin['style_dir']}/plugins/fileupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
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
			<script src="{$CMS->admin['style_dir']}/plugins/selectpicker/js/bootstrap-select.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/object_editor.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/jquery.filer.min.js" type="text/javascript" ></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/setup.js" type="text/javascript" ></script>
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
HERE;
					//Setup object data
					if($CMS->main_object->SetupObjectData("post_category", $CMS->input['id'])){
						$output .= $this->FormPostCategory();
					}else{
						//object not found
						$output .= $this->ObjectNotFound();
					}
					$output.=<<<HERE
						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function ObjectNotFound(){
			global $CMS, $DB;
			$output = "";
			$form_title = $CMS->vars['lang']['acp_main_page_'.$CMS->input['action'].'_post_category'];
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$form_title}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$form_title}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content"><form class="form-horizontal" role="form">
								<h3 class="object-not-found"><i class="fa fa-recycle"></i> {$CMS->vars['lang']['acp_object_not_found']}</h3>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
		public function FormPostCategory(){
			global $CMS, $DB;
			$output = "";
			if($CMS->input['id'] != ""){
				$exUrl = "&id=".$CMS->input['id'];
			}else{
				$exUrl = "";
			}
			$langAcess = $CMS->vars['language_access'];
			$form_title = $CMS->vars['lang']['acp_main_page_'.$CMS->input['action'].'_post_category'];
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$form_title}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$form_title}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content"><form class="form-horizontal" role="form" method="POST" action="{$CMS->vars['root_domain']}/?site=admin&page=post_category&action={$CMS->input['action']}_do{$exUrl}">
								<div class="row acp-table-padding-bottom">
									<div class="col-md-9 col-sm-12 col-xs-12">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$form_title}</h3>
												{$this->LanguageSelect($langAcess)}
											</div><!-- /.box-header -->
											<div class="box-body">
												
												<div class="form-group">
													{$this->ObjectNameInput($langAcess)}
												</div>
												<div class="form-group">
													{$this->ObjectFriendURLInput($langAcess)}
												</div>
												<div class="form-group">
													{$this->ObjectMetaKeywordInput($langAcess)}
												</div>
												<div class="form-group">
													{$this->ObjectShortDescriptionInput($langAcess)}
												</div>
												<div class="form-group">
													{$this->ObjectContentInput($langAcess)}
												</div>
												
											</div><!-- /.box-body -->
											<div class="box-footer clearfix">
											
											</div>
										</div><!-- /.box -->
										
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_object_extend_info']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body">
												<div class="form-group">
													{$this->ObjectThumbnailInput($langAcess)}
												</div>
												<div class="form-group">
													{$this->ObjectCategoryInput($langAcess)}
												</div>
												<div class="form-group">
													{$this->ObjectTagInput($langAcess)}
													<div id="x-tag-auto-complete"></div>
												</div>
											</div><!-- /.box-body -->
											<div class="box-footer clearfix">
											
											</div>
										</div><!-- /.box -->
										
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="object_action_btn">
											<button type="submit" class="act save"><i class="fa fa-check"></i> {$CMS->vars['lang']['acp_object_save']}</button>
											<a class="act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i> {$CMS->vars['lang']['acp_object_backtohome']}</a>
										</div>
									</div>
								</div>
							</form></section><!-- /.content -->
						</div><!-- /.content-wrapper -->
						{$CMS->admin['skin_global']->AttachmentImage()}
						
						<script>
							$(function(){
								//action change thumbnail
								$(".object_thumbnail").find(".x-attachment-select-one").click(function(){
									$(".x-custom-action").addClass("target-object-thumbnail");
								})
								$(document).on("click", ".target-object-thumbnail", function(){
									$(this).removeClass("target-object-thumbnail");
									var _Replace = $("#w-attachment-list").find(".x-attachment-item-selected").find("img").attr("src");
									$(".object_thumbnail").each(function(){
										$(this).find("img").attr({"src":_Replace});
										$(this).find("input").val(_Replace);
									})
								})
								//action insert picture to editor
								$(".x_obj_input").find(".x-attachment-select-multi").click(function(){
									$(".x-custom-action").addClass("target-insert-picture-to-editor");
									$(".x_obj_input").removeClass("insert-picture-to-this-editor");
									$(this).addClass("insert-picture-to-this-editor");
								})
								$(document).on("click", ".target-insert-picture-to-editor", function(){
									$(this).removeClass("target-insert-picture-to-editor");
									var _PicturesSelected = $("#x-attachment-list-selected-tmp-data").val();
									_PicturesSelected = _PicturesSelected.split(",");
									var _DataExtend = "";
									_PicturesSelected.forEach(function(entry){
										if(entry != ""){
											//set element <img/> -> add to editor
											_DataExtend += '<img src="'+entry+'" alt="'+entry+'" />';
										}
									})
									//find editor active
									var _CurrentLangId = $(".object_editor_lang_selected").val();
									var _EditorContent = CKEDITOR.instances['object_data_'+_CurrentLangId+'_content'].getData();
									//return value to editor 
									CKEDITOR.instances['object_data_'+_CurrentLangId+'_content'].setData(_EditorContent + _DataExtend);
								})
								$(".object_action_btn").find(".backtohome").click(function(e){
									e.preventDefault();
									if(confirm("Are you sure?")){
										window.location.href="{$CMS->vars['root_domain']}/taka_acp";
									}
								})
							})
						</script>
HERE;
			return $output;
		}
		public function LanguageSelect($langAcess = false){
			global $CMS, $DB;
			$output = "";
			$output .=<<<HERE
				<div class="btn-group pull-right">
					<select class="selectpicker show-tick form-control bs-select-hidden object_editor_lang_selected">
HERE;
			foreach($langAcess as $key=>$lgg){
				if($key == $CMS->vars['language']){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$output .=<<<HERE
					<option value="{$lgg['id']}" {$selected}>{$lgg['name']}</option>
HERE;
			}
			$output .=<<<HERE
					</select>
				</div>
HERE;
			return $output;
		}
		public function ObjectNameInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['name'] != ""){
					$val = $OBJECT[$lgg['id']]['name'];
				}else{
					$val = "";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-3" for="object_name">{$lang['acp_object_editor_name']}:</label>
						<div class="col-md-9">
							<input type="text" class="form-control object_data_name object_data_{$lgg['id']}_name" name="object_data[{$lgg['id']}][name]" id="object_data_{$lgg['id']}_name" placeholder="{$lang['acp_object_editor_name']}" value="{$val}" />
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function ObjectFriendURLInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['nice_url'] != ""){
					$val = $OBJECT[$lgg['id']]['nice_url'];
				}else{
					$val = "";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-3" for="object_nice_url">{$lang['acp_object_editor_niceurl']}:</label>
						<div class="col-md-9">
							<input type="text" class="form-control object_data_nice_url object_data_{$lgg['id']}_nice_url" name="object_data[{$lgg['id']}][nice_url]" id="object_data_{$lgg['id']}_nice_url" placeholder="{$lang['acp_object_editor_niceurl']}" value="{$val}" />
						</div>
						<div class="col-md-9 col-md-offset-3">
							<p class="object_link_preview object_link_preview_{$lgg['id']}"><i class="fa fa-chrome"></i> {$lang['acp_object_editor_niceurl_real']}: <span>http://mtbweb.com/post_category/<i class="nice_url_preview" style="color: red;">{$val}</i></span></p>
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function ObjectMetaKeywordInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['meta_keyword'] != ""){
					$val = $OBJECT[$lgg['id']]['meta_keyword'];
				}else{
					$val = "";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-3" for="object_meta_keyword">{$lang['acp_object_editor_meta_keyword']}:</label>
						<div class="col-md-9">
							<input type="text" class="form-control object_data_meta_keyword object_data_{$lgg['id']}_meta_keyword" name="object_data[{$lgg['id']}][meta_keyword]" id="object_data_{$lgg['id']}_meta_keyword" placeholder="{$lang['acp_object_editor_meta_keyword']}" value="{$val}" />
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function ObjectShortDescriptionInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['short_description'] != ""){
					$val = $OBJECT[$lgg['id']]['short_description'];
				}else{
					$val = "";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-3" for="object_short_description">{$lang['acp_object_editor_shortdescription']}:</label>
						<div class="col-md-9">
							<textarea class="form-control object_data_short_description object_data_{$lgg['id']}_short_description" id="object_data_{$lgg['id']}_short_description" name="object_data[{$lgg['id']}][short_description]" placeholder="{$lang['acp_object_editor_shortdescription']}">{$val}</textarea>
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function ObjectContentInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['content'] != ""){
					$val = $OBJECT[$lgg['id']]['content'];
				}else{
					$val = "";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-3" for="object_content">{$lang['acp_object_editor_content']}:</label>
						<div class="col-md-9">
							<textarea class="form-control object_data_content object_data_{$lgg['id']}_content" id="object_data_{$lgg['id']}_content" name="object_data[{$lgg['id']}][content]" placeholder="{$lang['acp_object_editor_content']}">{$val}</textarea>
							<a class="btn btn-primary pull-right x-attachment-select-multi" id="editor-insert-picture-{$lgg['id']}" style="margin-top: 5px;" data-toggle="modal" data-target="#window-attachment-quickaccess"><i class="fa fa-photo"></i> Insert picture</a>
							<script>
								$(function(){
									CKEDITOR.replace( 'object_data_{$lgg['id']}_content' );
									CKEDITOR.config.title = false;
								})
							</script>
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function ObjectThumbnailInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['image'] != ""){
					$val = $CMS->vars['root_domain']."/".$OBJECT[$lgg['id']]['image'];
				}else{
					$val = "{$CMS->admin['style_dir']}/images/default_image.png";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-12 col-sm-3 col-xs-12 x-label-left" for="object_image">{$lang['acp_object_editor_image']}:</label>
						<div class="col-md-12 col-sm-9 col-xs-12">
							<div class="form-control object_thumbnail">
								<div class="x-change-object-thumbnail">
									<a class="btn btn-primary x-attachment-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-attachment-quickaccess"><i class="fa fa-photo"></i> Select</a>
								</div>
								<img src="{$val}" alt="{$val}" />
								<input type="hidden" class="form-control object_data_image object_data_{$lgg['id']}_image" name="object_data[{$lgg['id']}][image]" id="object_data_{$lgg['id']}_image" placeholder="Thumbnail" value="{$val}" />
							</div>
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function NewInArray($val = false, $arr = false){
			if(is_array($arr)){
				foreach($arr as $tmp){
					if($val == $tmp){
						return true;
					}
				}
				return false;
			}else{
				if($val == $arr){
					return true;
				}else{
					return false;
				}
			}
		}
		public function CreateListCategoryInSelect($lang = "1", $parent = 0, $type = "post_category", $tab = ""){
			global $CMS, $DB, $OBJECT;
			$output = "";
			//$tab = ":_";
			$data = $CMS->main_object->LoadObjectDataByOption($parent, $lang, $type = "post_category");
			if($data){
				foreach($data as $cat){
					if($OBJECT[$lang]['parent'] != ""){
						$tmp = explode(",",$OBJECT[$lang]['parent']);
						if($this->NewInArray($cat['id'], $tmp)){
							$check = "selected='selected'";
						}else{
							$check = "";
						}
					}else{
						$check = "";
					}
					if($cat['parent'] == "0"){
						$output .=<<<HERE
						<optgroup>
							<option {$check} value="{$cat['id']}">{$cat['name']}</option>
							{$this->CreateListCategoryInSelect($lang, $cat['id'], "post_category", $tab.":_")}
						</optgroup>
HERE;
					}else{
						$output .=<<<HERE
							<option {$check} value="{$cat['id']}">{$tab}{$cat['name']}</option>
							{$this->CreateListCategoryInSelect($lang, $cat['id'], "post_category", $tab.":_")}
HERE;
					}					
				}
			}
			return $output;
		}
		public function ObjectCategoryInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			$tab = ":_";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}">
						<label class="control-label col-md-12 col-sm-3 col-xs-12 x-label-left" for="object_parent">{$lang['acp_object_editor_categoryselect']}:</label>
						<div class="col-md-12 col-sm-9 col-xs-12">
							<select id="object_data_{$lgg['id']}_parent" name="object_data[{$lgg['id']}][parent][]" class="object_data_parent object_data_{$lgg['id']}_parent object_data_parent_list selectpicker bs-select-hidden form-control" multiple="" data-size="10" data-live-search="true" data-live-search-placeholder="{$lang['acp_object_editor_categoryselect']}" data-actions-box="true">
								{$this->CreateListCategoryInSelect($lgg['id'])}
							</select>
						</div>
					</div>
HERE;
			}
			return $output;
		}
		public function ObjectTagInput($langAcess = false){
			global $CMS, $DB, $OBJECT;
			$output = "";
			foreach($langAcess as $key=>$lgg){
				$lang = $CMS->admin['system']->SpecialLoadLanguage($key.'/admin_post_category');
				if($OBJECT[$lgg['id']]['tags'] != ""){
					$val = $OBJECT[$lgg['id']]['tags'];
				}else{
					$val = "";
				}
				if($OBJECT[$lgg['id']]['tags_slug'] != ""){
					$val1 = $OBJECT[$lgg['id']]['tags_slug'];
				}else{
					$val1 = "";
				}
				$output .=<<<HERE
					<div class="x_obj_input x_obj_input_{$lgg['id']}" data="{$CMS->vars['root_domain']}?site=admin&page=tags&action=ajax&subact=auto_complete&object_type=post_category">
						<label class="control-label col-md-12 col-sm-3 col-xs-12 x-label-left" for="object_tag">Tags:</label>
						<div class="col-md-12 col-sm-9 col-xs-12">
							<textarea class="form-control object_data_tag object_data_{$lgg['id']}_tag" name="object_data[{$lgg['id']}][tag]" id="object_data_{$lgg['id']}_tag" placeholder="Tags">{$val}</textarea>
							<input type="hidden" class="form-control object_data_tag_slug object_data_{$lgg['id']}_tag_slug" name="object_data[{$lgg['id']}][tag_slug]" id="object_data_{$lgg['id']}_tag_slug" placeholder="Tags slug" value="{$val1}" />
						</div>
					</div>
HERE;
			}
			return $output;
		}
	}