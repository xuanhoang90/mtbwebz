<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_menu = new Skin_Menu();
	class Skin_Menu{
		public function __construct(){
			return true;
		}
		public function ListMenu(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_edit_tpl');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
CSS;
			$plugin = <<<CSS
			<!-- SlimScroll -->
			<script src="{$CMS->admin['style_dir']}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
			<!-- FastClick -->
			<script src="{$CMS->admin['style_dir']}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
			<!-- AdminLTE App -->
			<script src="{$CMS->admin['style_dir']}/dist/js/app.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/jQueryUI/jquery-ui.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.js" type="text/javascript"></script>
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

						{$this->ListAllMenu()}

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function EditMainMenu(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_edit_tpl');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/main_menu.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/w_object_insert.css" rel="stylesheet" type="text/css" />
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
			<script src="{$CMS->admin['style_dir']}/plugins/jQueryUI/jquery-ui.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/main_menu.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/jquery.nicescroll.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/w_object_insert.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/jquery.filer.min.js" type="text/javascript" ></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/setup.js" type="text/javascript" ></script>
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

						{$this->LoadMainMenu()}

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
					{$this->WindowAddItemNormal()}
					{$this->WindowAddItemMega()}
					{$this->WindowSelectItemType()}
					{$CMS->admin['skin_global']->ObjectInsert()}
					{$CMS->admin['skin_global']->AttachmentImage()}
					{$CMS->admin['skin_global']->PageSelect()}
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function LoadMainMenu(){
			global $CMS, $DB;
			$menuName = "";
			if(intval($CMS->input['id'])){
				$menu_id = $CMS->input['id'];
				$menuName = $this->LoadMenuName($menu_id);
			}else{
				$menu_id = false;
			}
			$output = "";
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_page_name_menu_edit']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_main_page_name_menu_edit']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-xs-12 col-md-8 contain-edit-mainmenu">
										<div class="menu-name-contain">
											<p class="label">Menu name: </p><input class="input-name x-master-name-input" placeholder="Menu name" name="menu_name" value="{$menuName}" /><p class="label"><i class="fa fa-edit"></i></p>
										</div>
										<div class="sortable sortable-edit-menu">
											{$this->AppendMenuData($menu_id)}
											<span class="add-item-master disabled"><i class="fa fa-plus fa-2x"></i></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="custom-menu-btn-act">
										<a class="imp-act save" href="{$CMS->vars['root_domain']}?site=admin&page=menu&action=savemenu&id={$menu_id}"><i class="fa fa-check"></i>Save</a>
										<a class="imp-act preview"><i class="fa fa-eye"></i>Preview</a>
										<a class="imp-act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i>Back to home</a>
									</div>
								</div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
		public function AppendSubMenuHTML($data){
			global $CMS, $DB;
			$output = "";
			$submenuType = $data['menutype'];
			$subItemList = $data['data'];
			$output.=<<<HERE
			<div class="submenu {$submenuType}">
HERE;
			foreach($subItemList as $item){
				$itemType = $item['type'];
				$itemData = $item['data'];
				$label = $itemData['name'];
				$image = $itemData['image'];
				$jsonData = json_encode($itemData);
				$output.=<<<HERE
				<div class="menu-item item-slaver {$itemType} xexpand" data='{$jsonData}'>
					<div class="quick-act">
						<i class="fa fa-close"></i>
						<i class="fa fa-cog"></i>
						<i class="fa fa-compress"></i>
					</div>
					<div class="item-data">
						<div class="icon-or-thumb">
							<img class="thumbnail" src="{$image}">
						</div>
						<div class="menu-label">
							<p>{$label}</p>
						</div>
					</div>
					{$this->AppendSubMenuHTML($item['sub_data'])}
					<span class="add-item-slaver disabled"><i class="fa fa-plus"></i></span>
				</div>
HERE;
			}
			$output.=<<<HERE
			</div>
HERE;
			return $output;
		}
		public function AppendMenuData($menu_id){
			global $CMS, $DB;
			$output = "";
			if($menu_id){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = $DB->query("SELECT * FROM menu WHERE id='{$menu_id}'");
				if($data = $sql->fetchAll()){
					$MenuData = unserialize($data[0]['data']);
					//append master item
					foreach($MenuData as $item){
						//item master 
						$itemData = $item['data'];
						$label = $itemData['name'];
						$image = $itemData['image'];
						$jsonData = json_encode($itemData);
						$output.=<<<HERE
						<div class="menu-item item-master xexpand" data='{$jsonData}'>
							<div class="quick-act">
								<i class="fa fa-close"></i>
								<i class="fa fa-cog"></i>
								<i class="fa fa-compress"></i>
							</div>
							<div class="item-data">
								<div class="icon-or-thumb">
									<img class="thumbnail" src="{$image}">
								</div>
								<div class="menu-label">
									<p>{$label}</p>
								</div>
							</div>
							{$this->AppendSubMenuHTML($item['sub_data'])}
							<span class="add-item-slaver disabled"><i class="fa fa-plus"></i></span>
						</div>
HERE;
					}
					return $output;
				}else{
					return $output;
				}
			}else{
				return $output;
			}
		}
		public function QuickAction(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
				<div class="quickaccess">
					<a class="add action" href="{$CMS->vars['root_domain']}?site=admin&page=menu&action=editmenu"><i class="fa fa-plus"></i></a>
				</div>
HERE;
			return $output;
		}
		public function ListAllMenu(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_menu_viewlist']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_main_menu_viewlist']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-xs-12 contain-change-tpl">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_menu_viewlist']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body">
												<table class="table table-bordered">
													<tbody>
														<tr class="theader">
															<th width="5%">ID</th>
															<th>Menu</th>
															<th width="20%">Action</th>
															<th width="15%">Status</th>
														</tr>
HERE;
													$MenuList = $this->GetMenuListData();
													foreach($MenuList as $oneMenu){
														//check status
														if($oneMenu['status'] == "1"){
															$checked = "checked";
														}else{
															$checked = "";
														}
														$output .=<<<HERE
														<tr class="menu-row">
															<td>{$oneMenu['id']}</td>
															<td><p class="pagename"><i class='fa {$oneMenu['icon']}'></i> {$oneMenu['name']}</p></td>
															<td>
																<a class="act edit" target="_blank" href="{$CMS->vars['root_domain']}/?site=admin&page=menu&action=editmenu&id={$oneMenu['id']}"><i class='fa fa-edit'></i> Edit</a>
																<a class="act delete-item" target="_blank" href="{$CMS->vars['root_domain']}/?site=admin&page=menu&action=deletemenu&id={$oneMenu['id']}"><i class='fa fa-trash'></i> Delete</a>
															</td>
															<td>
																<input type="checkbox" {$checked} data-toggle="toggle" data-on="<i class='fa fa-eye'></i> Enable" data-off="<i class='fa fa-eye-slash'></i> Disable">
															</td>
														</tr>
HERE;
													}
													if(!$MenuList){
														$output .=<<<HERE
														<tr>
															<td colspan="5">Empty</td>
														</tr>
HERE;
													}
													$output .=<<<HERE
													</tbody>
												</table>
											</div><!-- /.box-body -->
											<!--<div class="box-footer clearfix">
												<ul class="pagination pagination-sm no-margin pull-right">
													<li><a href="#">«</a></li>
													<li><a href="#">1</a></li>
													<li><a href="#">»</a></li>
												</ul>
											</div>-->
										</div><!-- /.box -->
										<script>
											$(function(){
												$(document).on("click", ".menu-row .delete-item", function(e){
													e.preventDefault();
													if(confirm("Are you sure?")){
														var _Link = $(this).attr("href");
														var _Target = $(this).parent().parent();
														$.ajax({
															method: "POST",
															url: _Link,
															data: {}
														}).done(function( data ){
															_Target.fadeOut().remove();
														});
													}
												})
											})
										</script>
									</div>
								</div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
						{$this->QuickAction()}
HERE;
			return $output;
		}
		public function WindowBlockConfig(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
						<div id="blockconfig">
							<div class="contain">
								<div class="header">
									<div class="title">
										<p><i class="fa fa-cogs"></i></li> {$CMS->vars['lang']['window_settingblock_title']}</p>
									</div>
									<div class="act-btn">
										<p class="close-this">Close <i class="fa fa-close"></i></li></p>
									</div>
								</div>
								<div class="body">
									<div class="setting-block">
										<div class="primary row-data form-horizontal">
											<div class="block-title row">
												<label class="control-label col-md-3" for="block_title">Title: </label>
												<div class="col-md-9">
													<input type="text" class="form-control edit-block-title" name="block_title" placeholder="Title" value="" />
												</div>
											</div>
											<div class="module-type row">
												<label class="control-label col-md-3" for="block_title">Module type: </label>
												<div class="col-md-9">
													<select name="module-type" class="form-control edit-module-type" data="{$CMS->vars['root_domain']}">
														<option value="default">--Select--</option>
														{$CMS->admin['skin_global']->CustomModuleType()}
													</select>
												</div>
											</div>
										</div>
										<div class="extend-custome-module-type row-data editor" data="">
											<p>Select module type</p>
										</div>
									</div>
								</div>
								<div class="footer">
									<div class="act-btn">
										<p class="apply-selected"><i class="fa fa-check"></i> Apply</p>
										<p class="close-this"><i class="fa fa-circle-o"></i> Cancel</p>
									</div>
								</div>
							</div>
						</div>
HERE;
			return $output;
		}
		public function WindowAddItemNormal(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
						<div id="AddItemNormal">
							<div class="contain">
								<div class="header">
									<div class="title">
										<p><i class="fa fa-cogs"></i></li> Add menu item (Normal)</p>
									</div>
									<div class="act-btn">
										<p class="close-this">Close <i class="fa fa-close"></i></li></p>
									</div>
								</div>
								<div class="body">
									<div class="row setting-frame">
										<div class="primary row-data form-horizontal">
											<div class="setting-init menu-item-link-input menu-item-object-can-edit">
												<div class="tab-master">
													<div class='checkbox checkbox-info checkbox-circle'>
														<input type="checkbox" checked="" id="checkbox_link_input" name="item_type" class="item-type-selection"><label for="checkbox_link_input"> Link normal</label>
													</div>
												</div>
												<div class="tab-slaver row">
													<div class="col-md-2">
														<img src="{$CMS->vars['root_domain']}/admin/skin/style/images/default_image.png" class="thumb" />
														<a class="btn btn-primary x-attachment-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-attachment-quickaccess"> Change image</a>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input class="name form-control" type="text" name="menu_object_name" placeholder="Object name">
														</div>
														<div class="form-group">
															<input class="link form-control" type="text" name="menu_object_link" placeholder="{$CMS->vars['root_domain']}/object link">
														</div>
													</div>
												</div>
											</div>
											<div class="setting-init menu-item-page menu-item-object-can-edit">
												<div class="tab-master">
													<div class='checkbox checkbox-info checkbox-circle'>
														<input type="checkbox" checked="" id="checkbox_page" name="item_type" class="item-type-selection"><label for="checkbox_page"> Page</label>
													</div>
												</div>
												<div class="tab-slaver row">
													<div class="col-md-2">
														<img src="{$CMS->vars['root_domain']}/admin/skin/style/images/default_image.png" class="thumb" />
														<a class="btn btn-primary x-attachment-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-attachment-quickaccess"> Change image</a>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input class="name form-control" type="text" name="menu_object_name" placeholder="Page name">
														</div>
														<div class="form-group">
															<input class="link form-control" type="text" name="menu_object_link" placeholder="{$CMS->vars['root_domain']}/page link">
														</div>
													</div>
													<div class="col-md-2">
														<a class="btn btn-primary" style="margin-top: 5px;" data-toggle="modal" data-target="#window-page-quickaccess"> Change</a>
													</div>
												</div>
											</div>
											<div class="setting-init menu-item-post menu-item-object-can-edit">
												<div class="tab-master">
													<div class='checkbox checkbox-info checkbox-circle'>
														<input type="checkbox" checked="" id="checkbox_post" name="item_type" class="item-type-selection"><label for="checkbox_post"> Post</label>
													</div>
												</div>
												<div class="tab-slaver row">
													<div class="col-md-2">
														<img src="{$CMS->vars['root_domain']}/admin/skin/style/images/default_image.png" class="thumb" />
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input class="name form-control" type="text" name="menu_object_name" placeholder="Object name">
														</div>
														<div class="form-group">
															<input class="link form-control" type="text" name="menu_object_link" placeholder="{$CMS->vars['root_domain']}/object link">
														</div>
													</div>
													<div class="col-md-2">
														<a class="btn btn-primary x-object-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-object-quickaccess"> Change</a>
													</div>
												</div>
											</div>
											<div class="setting-init menu-item-post-category menu-item-object-can-edit">
												<div class="tab-master">
													<div class='checkbox checkbox-info checkbox-circle'>
														<input type="checkbox" checked="" id="checkbox_post" name="item_type" class="item-type-selection"><label for="checkbox_post"> Post category</label>
													</div>
												</div>
												<div class="tab-slaver row">
													<div class="col-md-2">
														<img src="{$CMS->vars['root_domain']}/admin/skin/style/images/default_image.png" class="thumb" />
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input class="name form-control" type="text" name="menu_object_name" placeholder="Object name">
														</div>
														<div class="form-group">
															<input class="link form-control" type="text" name="menu_object_link" placeholder="{$CMS->vars['root_domain']}/object link">
														</div>
														<div class="form-group tree-append-option">
															<label class="control-label col-md-8" for="menu_tree">Auto append sub menu: </label>
															<div class="col-md-4">
																<input class="append-tree" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<a class="btn btn-primary x-object-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-object-quickaccess"> Change</a>
													</div>
												</div>
											</div>
											<div class="setting-init menu-item-product menu-item-object-can-edit">
												<div class="tab-master">
													<div class='checkbox checkbox-info checkbox-circle'>
														<input type="checkbox" checked="" id="checkbox_post" name="item_type" class="item-type-selection"><label for="checkbox_post"> Product</label>
													</div>
												</div>
												<div class="tab-slaver row">
													<div class="col-md-2">
														<img src="{$CMS->vars['root_domain']}/admin/skin/style/images/default_image.png" class="thumb" />
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input class="name form-control" type="text" name="menu_object_name" placeholder="Object name">
														</div>
														<div class="form-group">
															<input class="link form-control" type="text" name="menu_object_link" placeholder="{$CMS->vars['root_domain']}/object link">
														</div>
													</div>
													<div class="col-md-2">
														<a class="btn btn-primary x-object-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-object-quickaccess"> Change</a>
													</div>
												</div>
											</div>
											<div class="setting-init menu-item-product-category menu-item-object-can-edit">
												<div class="tab-master">
													<div class='checkbox checkbox-info checkbox-circle'>
														<input type="checkbox" checked="" id="checkbox_post" name="item_type" class="item-type-selection"><label for="checkbox_post"> Product category</label>
													</div>
												</div>
												<div class="tab-slaver row">
													<div class="col-md-2">
														<img src="{$CMS->vars['root_domain']}/admin/skin/style/images/default_image.png" class="thumb" />
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<input class="name form-control" type="text" name="menu_object_name" placeholder="Object name">
														</div>
														<div class="form-group">
															<input class="link form-control" type="text" name="menu_object_link" placeholder="{$CMS->vars['root_domain']}/object link">
														</div>
														<div class="form-group tree-append-option">
															<label class="control-label col-md-8" for="menu_tree">Auto append sub menu: </label>
															<div class="col-md-4">
																<input class="append-tree" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<a class="btn btn-primary x-object-select-one" style="margin-top: 5px;" data-toggle="modal" data-target="#window-object-quickaccess"> Change</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="footer">
									<div class="act-btn">
										<p class="apply-selected"><i class="fa fa-check"></i> Apply</p>
										<p class="close-this"><i class="fa fa-circle-o"></i> Cancel</p>
									</div>
								</div>
							</div>
						</div>
HERE;
			return $output;
		}
		public function WindowAddItemMega(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
						<div id="AddItemMega">
							<div class="contain">
								<div class="header">
									<div class="title">
										<p><i class="fa fa-cogs"></i></li> Add menu item (Mega)</p>
									</div>
									<div class="act-btn">
										<p class="close-this">Close <i class="fa fa-close"></i></li></p>
									</div>
								</div>
								<div class="body">
									<div class="select-mega-item-type">
										<div class="target-item-form">
											<p><i class="fa fa-dedent"></i> Form</p>
										</div>
										<div class="target-item-tab">
											<p><i class="fa fa-files-o"></i> Multi tab</p>
										</div>
										<div class="target-item-column">
											<p><i class="fa fa-columns"></i> Multi columns</p>
										</div>
										<div class="target-item-slider">
											<p><i class="fa fa-tv"></i> Slider</p>
										</div>
										<div class="target-item-gallery">
											<p><i class="fa fa-th"></i> Gallery</p>
										</div>
										<div class="target-item-html">
											<p><i class="fa fa-code"></i> HTML</p>
										</div>
										<div class="target-item-user">
											<p><i class="fa fa-user"></i> User area</p>
										</div>
										<div class="target-item-search">
											<p><i class="fa fa-search"></i> Search form</p>
										</div>
									</div>
								</div>
								<div class="footer">
									<div class="act-btn">
										<p class="apply-selected"><i class="fa fa-check"></i> Apply</p>
										<p class="close-this"><i class="fa fa-circle-o"></i> Cancel</p>
									</div>
								</div>
							</div>
						</div>
HERE;
			return $output;
		}
		public function WindowSelectItemType(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
						<div id="SelectItemType">
							<div class="contain">
								<div class="header">
									<div class="title">
										<p><i class="fa fa-cogs"></i></li> Select menu item type</p>
									</div>
									<div class="act-btn">
										<p class="close-this">Close <i class="fa fa-close"></i></li></p>
									</div>
								</div>
								<div class="body">
									<div class="select-menu-item-type">
										<div class="target-item-normal">
											<p><i class="fa fa-th-list"></i> Item normal</p>
										</div>
										<!--<div class="target-item-mega">
											<p><i class="fa fa-th-large"></i> Item mega</p>
										</div>-->
									</div>
								</div>
								<div class="footer">
									<div class="act-btn">
										<p class="apply-selected"><i class="fa fa-check"></i> Apply</p>
										<p class="close-this"><i class="fa fa-circle-o"></i> Cancel</p>
									</div>
								</div>
							</div>
						</div>
HERE;
			return $output;
		}
		public function GetMenuListData(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM menu WHERE lang_id='1' AND 1=1 ORDER BY id DESC");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
		public function LoadMenuName($id){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM menu WHERE id='{$id}'");
			if($data = $sql->fetchAll()){
				return $data[0]['name'];
			}else{
				return false;
			}
		}
	}