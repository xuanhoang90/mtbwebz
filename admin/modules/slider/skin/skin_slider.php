<?php
	//check access
	if (!defined('ROOT_ACCESS')) {
		echo "Access denies!";exit;
	}
	$CMS->skin_slider = new Skin_slider();
	class Skin_slider{
		public function __construct(){
			return true;
		}
		public function ListSlider(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_slider');
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

						{$this->ListAllSlider()}

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
					<a class="add action" href="{$CMS->vars['root_domain']}?site=admin&page=slider&action=add"><i class="fa fa-plus"></i></a>
				</div>
HERE;
			return $output;
		}
		public function ListAllSlider(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
					<!-- Content Wrapper. Contains page content -->
						<div class="content-wrapper">
							<!-- Content Header (Page header) -->
							<section class="content-header">
								<h1>
									{$CMS->vars['lang']['acp_main_master_title']}
									<small>{$CMS->vars['lang']['acp_main_slider_viewlist']}</small>
								</h1>
								<ol class="breadcrumb">
									<li><a href="#"><i class="fa fa-dashboard"></i> {$CMS->vars['lang']['acp_main_master_title']}</a></li>
									<li class="active"><a href="#">{$CMS->vars['lang']['acp_main_slider_viewlist']}</a></li>
								</ol>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row">
									<div class="col-xs-12 contain-change-tpl">
									
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_slider_viewlist']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body">
												<table class="table table-bordered">
													<tbody>
														<tr class="theader">
															<th width="5%">ID</th>
															<th>Slider</th>
															<th width="20%">Action</th>
															<th width="15%">Status</th>
														</tr>
HERE;
													$SliderList = $this->GetSliderListData();
													foreach($SliderList as $oneSlider){
														//check status
														if($oneSlider['status'] == "1"){
															$checked = "checked";
														}else{
															$checked = "";
														}
														$output .=<<<HERE
														<tr class="slider-row">
															<td>{$oneSlider['id']}</td>
															<td><p class="pagename"><i class='fa {$oneSlider['icon']}'></i> {$oneSlider['name']}</p></td>
															<td>
																<a class="act edit" target="_blank" href="{$CMS->vars['root_domain']}/?site=admin&page=slider&action=add&id={$oneSlider['id']}"><i class='fa fa-edit'></i> Edit</a>
																<a class="act delete-item" target="_blank" href="{$CMS->vars['root_domain']}/?site=admin&page=slider&action=deleteslider&id={$oneSlider['id']}"><i class='fa fa-trash'></i> Delete</a>
															</td>
															<td>
																<input type="checkbox" {$checked} data-toggle="toggle" data-on="<i class='fa fa-eye'></i> Enable" data-off="<i class='fa fa-eye-slash'></i> Disable">
															</td>
														</tr>
HERE;
													}
													if(!$SliderList){
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
												$(document).on("click", ".slider-row .delete-item", function(e){
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
		public function AddSlider(){
			global $CMS, $DB;
			$CMS->admin['system']->LoadLanguage('admin_slider');
			$custom_style = <<<CSS
			<!-- Theme style -->
			<link href="{$CMS->admin['style_dir']}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
			<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
			<link href="{$CMS->admin['style_dir']}/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/bootstrap-switch/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/jQueryUI/jquery-ui.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/acp_slider.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/checkbox.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/w_object_insert.css" rel="stylesheet" type="text/css" />
			<link href="{$CMS->admin['style_dir']}/plugins/fileupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
			<link href="{$CMS->admin['style_dir']}/plugins/fileupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
			<link href="{$CMS->admin['style_dir']}/plugins/spectrum/spectrum.css" type="text/css" rel="stylesheet" />
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
			<script src="{$CMS->admin['style_dir']}/js/acp_slider.js" type="text/javascript"></script>
			<!-- AdminLTE for demo purposes -->
			<!--<script src="{$CMS->admin['style_dir']}/dist/js/demo.js" type="text/javascript"></script>-->
			<script src="{$CMS->admin['style_dir']}/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/js/w_object_insert.js" type="text/javascript"></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/jquery.filer.min.js" type="text/javascript" ></script>
			<script src="{$CMS->admin['style_dir']}/plugins/fileupload/js/setup.js" type="text/javascript" ></script>
			<script src="{$CMS->admin['style_dir']}/plugins/spectrum/spectrum.js" type="text/javascript" ></script>
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

						{$this->MainSlider()}

						{$CMS->admin['skin_global']->footer_nav()}

						{$CMS->admin['skin_global']->control_nav()}
					</div><!-- ./wrapper -->
					{$this->WindowSelectImageFrom()}
					{$this->WindowInsertSubElement()}
					{$this->WindowSubElementSetting()}
					{$CMS->admin['skin_global']->ObjectInsert()}
					{$CMS->admin['skin_global']->AttachmentImage()}
				</body>
				{$CMS->admin['skin_global']->footer($plugin)}
HERE;
			return $output;
		}
		public function MainSlider($id = false){
			global $CMS, $DB;
			$sliderName = "";
			if(intval($CMS->input['id'])){
				$slider_id = $CMS->input['id'];
				$sliderName = $this->LoadSliderName($slider_id);
			}else{
				$slider_id = false;
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
									<div class="col-md-9 col-xs-12">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_slider_editing']}</h3>
												<div class="form-group pull-right col-md-6 col-sm-6 col-xs-12">
													<input class="main-slider-name form-control" type="text" placeholder="Slider name" value="{$sliderName}" />
												</div>
											</div><!-- /.box-header -->
											<div class="box-body box-body-slider-edit">
												<div class="contain-slider-edit">
													<div class="acp-slider-master-tab">
														<!--<div class="select-item item-master active" data="#item-slaver-1">
															<p class="num">1</p>
														</div>
														<div class="select-item item-master" data="#item-slaver-2">
															<p class="num">2</p>
														</div>
														<div class="select-item item-master" data="#item-slaver-3">
															<p class="num">3</p>
														</div>-->
														<div class="add-item item-master">
															<i class="fa fa-plus"></i>
														</div>
													</div>
													<div class="acp-slider-slaver-tab">
														{$this->AppendSliderData($slider_id)}
														<!--<div class="slider-item item-slaver active" id="item-slaver-1">
															<div class="slaver-contain">
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																	<div class="context">
																		<p class="text">Hello, Xuan Hoang</p>
																	</div>
																</div>
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
															</div>
														</div>
														<div class="slider-item item-slaver" id="item-slaver-2">
															<div class="slaver-contain">
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
															</div>
														</div>
														<div class="slider-item item-slaver" id="item-slaver-3">
															<div class="slaver-contain">
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
																<div class="sl-unit">
																	<div class="unit-act">
																		<a class="remove"><i class="fa fa-close"></i></a>
																	</div>
																</div>
															</div>
														</div>-->
													</div>
													<div class="acp-slider-slaver-action">
														<a class="action insert"><i class="fa fa-location-arrow"></i> Insert element</a>
														<a class="action delete"><i class="fa fa-trash"></i> Delete current slide</a>
													</div>
												</div>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class="col-md-3 col-xs-12 pull-right">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_element_setting']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body form-horizontal setting-sub-e-block">
												<div class="setting-for-element-type text active">
													<div class="form-group">
														<input class="ele-text-link-edit" type="text" placeholder="Element value" />
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="text_color">Color: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="text-color form-control" type='color' name='text_color' />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="font_size">Size: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="text-size form-control" type="number" value="14" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="line_height">Line height: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="line-height form-control" type="number" value="25" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="textfont">Font: </label>
														<div class="col-md-6">
															<select name="textfont" class="textfont form-control">
																<option value="Arial" style="font-family: 'Arial'">Arial</option>
																<option value="Times New Roman" style="font-family: 'Times New Roman'">Times New Roman</option>
																<option value="Georgia" style="font-family: 'Georgia'">Georgia</option>
																<option value="Serif" style="font-family: 'Serif'">Serif</option>
																<option value="Serif" style="font-style: italic; color: red; text-align: center;">More...</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="textstyle">Style: </label>
														<div class="col-md-6">
															<select name="textstyle" class="textstyle form-control">
																<option value="normal" style="font-style: normal">Normal</option>
																<option value="bold" style="font-weight: bold">Bold</option>
																<option value="underline" style="text-decoration: underline">Underline</option>
																<option value="italic" style="font-style: italic">Italic</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="textalign">Align: </label>
														<div class="col-md-6">
															<select name="textalign" class="textalign form-control">
																<option value="left">Left</option>
																<option value="right">Right</option>
																<option value="center">Center</option>
																<option value="justify">Justify</option>
															</select>
														</div>
													</div>
												</div>
												
												<div class="setting-for-element-type link">
													<div class="form-group">
														<input class="ele-text-link-edit" type="text" placeholder="Element value" />
													</div>
													<div class="form-group">
														<label class="control-label col-sm-3 col-xs-12" for="textlink">Link: </label>
														<div class="col-sm-9 col-xs-12">
															<input class="link-url form-control" type="text" placeholder="Element link" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="text_color">Color: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="text-color form-control" type='color' name='text_color' />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="font_size">Size: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="text-size form-control" type="number" value="14" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="line_height">Line height: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="line-height form-control" type="number" value="25" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="textfont">Font: </label>
														<div class="col-sm-6 col-xs-12">
															<select name="textfont" class="textfont form-control">
																<option value="Arial" style="font-family: 'Arial'">Arial</option>
																<option value="Times New Roman" style="font-family: 'Times New Roman'">Times New Roman</option>
																<option value="Georgia" style="font-family: 'Georgia'">Georgia</option>
																<option value="Serif" style="font-family: 'Serif'">Serif</option>
																<option value="Serif" style="font-style: italic; color: red; text-align: center;">More...</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="textstyle">Style: </label>
														<div class="col-sm-6 col-xs-12">
															<select name="textstyle" class="textstyle form-control">
																<option value="normal" style="font-style: normal">Normal</option>
																<option value="bold" style="font-weight: bold">Bold</option>
																<option value="underline" style="text-decoration: underline">Underline</option>
																<option value="italic" style="font-style: italic">Italic</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="textalign">Align: </label>
														<div class="col-md-6">
															<select name="textalign" class="textalign form-control">
																<option value="left">Left</option>
																<option value="right">Right</option>
																<option value="center">Center</option>
																<option value="justify">Justify</option>
															</select>
														</div>
													</div>
												</div>
												
												<div class="setting-for-element-type image">
													<div class="form-group">
														<img class="thum image-src" style="width: 90%; display: block; margin: 5px auto;" src="/admin/skin/style/images/default_image.png" />
														<a class="subele-image-change x-attachment-select-one" data-toggle="modal" data-target="#window-attachment-quickaccess"><i class="fa fa-photo"></i> Change</a>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="image_size">Image size: </label>
														<div class="col-sm-6 col-xs-12">
															<select class="form-control image-size" name="image_size">
																<option value="default_size">--Select--</option>
																<option value="fix_width">Fix Width</option>
																<option value="fix_height">Fix Height</option>
																<option value="stretch">Stretch</option>
															</select>
														</div>
													</div>
												</div>
												
												<a class="advance-setting"><i class="fa fa-dollar"></i> Advance</a>
												
												<div class="tab-advance-setting">
													<div class="form-group">
														<label class="control-label col-md-6 col-sm-6 col-xs-12" for="main_slider_effect_in">Slide in Effect: </label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" checked="" id="main_slider_effect_in_auto" name="item_type" class="main_slider_effect_in"><label for="main_slider_effect_in_auto"> Auto</label>
															</div>
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" id="main_slider_effect_in_custom" name="item_type" class="main_slider_effect_in"><label for="main_slider_effect_in_custom"> Custom:</label>
															</div>
															<select class="form-control" name="main_slider_effect_in_select">
																<option value="auto">--Select--</option>
																<option value="puffIn">Puff in</option>
																<option value="spaceInUp">Space in up</option>
																<option value="spaceInLeft">Space in left</option>
																<option value="spaceInRight">Space in right</option>
																<option value="spaceInDown">Space in down</option>
																<option value="boingInUp">Boing in up</option>
																<option value="foolishIn">Foolish in</option>
																<option value="tinUpIn">Tin up in</option>
																<option value="tinLeftIn">Tin left in</option>
																<option value="tinRightIn">Tin right in</option>
																<option value="tinDownIn">Tin down in</option>
																<option value="swap">Swap</option>
																<option value="twisterInUp">Twister in up</option>
																<option value="twisterInDown">Twister in down</option>
																<option value="vanishIn">Vanish in</option>
																<option value="swashIn">Swash in</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6 col-sm-6 col-xs-12" for="main_slider_effect_out">Slide out Effect: </label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" checked="" id="main_slider_effect_out_auto" name="main_slider_effect_out" class="main_slider_effect_out"><label for="main_slider_effect_out_auto"> Auto</label>
															</div>
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" id="main_slider_effect_out_custom" name="main_slider_effect_out" class="main_slider_effect_out"><label for="main_slider_effect_out_custom"> Custom:</label>
															</div>
															<select class="form-control" name="main_slider_effect_select">
																<option value="auto">--Select--</option>
																<option value="openDownLeftOut">Open down left out</option>
																<option value="spaceOutUp">Space out up</option>
																<option value="spaceOutLeft">Space out left</option>
																<option value="spaceOutRight">Space out right</option>
																<option value="spaceOutDown">Space out down</option>
																<option value="boingOutDown">Boing out down</option>
																<option value="bombRightOut">Bomb right out</option>
																<option value="bombLeftOut">Bomb left out</option>
																<option value="tinUpOut">Tin up out</option>
																<option value="tinLeftOut">Tin left out</option>
																<option value="tinRightOut">Tin right out</option>
																<option value="tinDownOut">Tin down out</option>
																<option value="holeOut">Hole out</option>
																<option value="foolishOut">Foolish out</option>
																<option value="swashOut">Swash out</option>
																<option value="puffOut">Puff out</option>
																<option value="rotateUp">Rotate up</option>
																<option value="rotateLeft">Rotate left</option>
																<option value="rotateRight">Rotate right</option>
																<option value="rotateDown">Rotate down</option>
																<option value="slideUp">Slide up</option>
																<option value="slideLeft">Slide left</option>
																<option value="slideRight">Slide right</option>
																<option value="slideDown">Slide down</option>
																<option value="vanishOut">Vanish out</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="display_order">Display order: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="display-order form-control" type='number' name='display_order' value="1" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="background_color">Background: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="background-color form-control" type='color' name='background_color' value="#ffffff" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="block_title">Border type: </label>
														<div class="col-md-6">
															<select name="border_type" class="border-type form-control">
																<option value="solid">______ Solid</option>
																<option value="dashed">--------- Dashed</option>
																<option value="dotted">............ Dotted</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-6 col-xs-12" for="border_color">Border color: </label>
														<div class="col-sm-6 col-xs-12">
															<input class="border-color form-control" type='color' name='border_color' />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="block_title">Border size: </label>
														<div class="col-md-6">
															<input class="border-size form-control" type="number" value="1">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="block_title">Border top: </label>
														<div class="col-md-6">
															<input class="border-top" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="block_title">Border left: </label>
														<div class="col-md-6">
															<input class="border-left" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="block_title">Border right: </label>
														<div class="col-md-6">
															<input class="border-right" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-6" for="block_title">Border bottom: </label>
														<div class="col-md-6">
															<input class="border-bottom" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No">
														</div>
													</div>
												</div>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
									<div class="col-md-9 col-xs-12">
										<div class="box">
											<div class="box-header with-border">
												<h3 class="box-title">{$CMS->vars['lang']['acp_main_page_slider_setting']}</h3>
											</div><!-- /.box-header -->
											<div class="box-body form-horizontal slider-setting">
												<div class="form-group set-main-image">
													<label class="control-label col-md-4 col-sm-6 col-xs-12" for="main_image">Main Image: </label>
													<div class="col-md-8 col-sm-6 col-xs-12">
														<img class="thumbnail" style="max-width: 250px;" src="/admin/skin/style/images/default_image.png" />
														<a class="slider-main-image-change"><i class="fa fa-photo"></i> Change</a>
														<a class="slider-main-image-remove"><i class="fa fa-trash"></i> No image</a>
													</div>
												</div>
												<div class="form-group set-main-image-size">
													<label class="control-label col-md-4 col-sm-6 col-xs-12" for="image_size">Image size: </label>
													<div class="col-md-8 col-sm-6 col-xs-12">
														<select class="image-size form-control" name="image_size">
															<option value="default_size">--Select--</option>
															<option value="fix_width">Fix Width</option>
															<option value="fix_height">Fix Height</option>
															<option value="stretch">Stretch</option>
														</select>
													</div>
												</div>
												<a class="advance-setting"><i class="fa fa-dollar"></i> Advance</a>
												<div class="tab-advance-setting">
													<div class="form-group">
														<label class="control-label col-md-4 col-sm-6 col-xs-12" for="main_slider_effect_in">Slide in Effect: </label>
														<div class="col-md-8 col-sm-6 col-xs-12">
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" checked="" id="main_slider_effect_in_auto" name="item_type" class="main_slider_effect_in"><label for="main_slider_effect_in_auto"> Auto</label>
															</div>
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" id="main_slider_effect_in_custom" name="item_type" class="main_slider_effect_in"><label for="main_slider_effect_in_custom"> Custom:</label>
															</div>
															<select class="form-control" name="main_slider_effect_in_select">
																<option value="auto">--Select--</option>
																<option value="puffIn">Puff in</option>
																<option value="spaceInUp">Space in up</option>
																<option value="spaceInLeft">Space in left</option>
																<option value="spaceInRight">Space in right</option>
																<option value="spaceInDown">Space in down</option>
																<option value="boingInUp">Boing in up</option>
																<option value="foolishIn">Foolish in</option>
																<option value="tinUpIn">Tin up in</option>
																<option value="tinLeftIn">Tin left in</option>
																<option value="tinRightIn">Tin right in</option>
																<option value="tinDownIn">Tin down in</option>
																<option value="swap">Swap</option>
																<option value="twisterInUp">Twister in up</option>
																<option value="twisterInDown">Twister in down</option>
																<option value="vanishIn">Vanish in</option>
																<option value="swashIn">Swash in</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4 col-sm-6 col-xs-12" for="main_slider_effect_out">Slide out Effect: </label>
														<div class="col-md-8 col-sm-6 col-xs-12">
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" checked="" id="main_slider_effect_out_auto" name="main_slider_effect_out" class="main_slider_effect_out"><label for="main_slider_effect_out_auto"> Auto</label>
															</div>
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" id="main_slider_effect_out_custom" name="main_slider_effect_out" class="main_slider_effect_out"><label for="main_slider_effect_out_custom"> Custom:</label>
															</div>
															<select class="form-control" name="main_slider_effect_select">
																<option value="auto">--Select--</option>
																<option value="openDownLeftOut">Open down left out</option>
																<option value="spaceOutUp">Space out up</option>
																<option value="spaceOutLeft">Space out left</option>
																<option value="spaceOutRight">Space out right</option>
																<option value="spaceOutDown">Space out down</option>
																<option value="boingOutDown">Boing out down</option>
																<option value="bombRightOut">Bomb right out</option>
																<option value="bombLeftOut">Bomb left out</option>
																<option value="tinUpOut">Tin up out</option>
																<option value="tinLeftOut">Tin left out</option>
																<option value="tinRightOut">Tin right out</option>
																<option value="tinDownOut">Tin down out</option>
																<option value="holeOut">Hole out</option>
																<option value="foolishOut">Foolish out</option>
																<option value="swashOut">Swash out</option>
																<option value="puffOut">Puff out</option>
																<option value="rotateUp">Rotate up</option>
																<option value="rotateLeft">Rotate left</option>
																<option value="rotateRight">Rotate right</option>
																<option value="rotateDown">Rotate down</option>
																<option value="slideUp">Slide up</option>
																<option value="slideLeft">Slide left</option>
																<option value="slideRight">Slide right</option>
																<option value="slideDown">Slide down</option>
																<option value="vanishOut">Vanish out</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-4 col-sm-6 col-xs-12" for="sub_ele_effect">Sub element effect: </label>
														<div class="col-md-8 col-sm-6 col-xs-12">
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" checked="" id="sub_ele_effect_auto" name="sub_ele_effect" class="sub_ele_effect"><label for="sub_ele_effect_auto"> Step by step</label>
															</div>
															<div class='checkbox checkbox-info checkbox-circle'>
																<input type="checkbox" id="sub_ele_effect_custom" name="sub_ele_effect" class="sub_ele_effect"><label for="sub_ele_effect_custom"> No delay</label>
															</div>
														</div>
													</div>
												</div>
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div>
								</div>
								<div class="row">
								
								</div>
								<div class="row">
									<div class="custom-slider-btn-act">
										<a class="imp-act save" href="{$CMS->vars['root_domain']}?site=admin&page=slider&action=saveslider&id={$slider_id}"><i class="fa fa-check"></i>Save</a>
										<a class="imp-act preview"><i class="fa fa-eye"></i>Preview</a>
										<a class="imp-act backtohome" href="{$CMS->vars['root_domain']}/taka_acp"><i class="fa fa-arrow-circle-o-left"></i>Back to home</a>
									</div>
								</div>
							</section><!-- /.content -->
						</div><!-- /.content-wrapper -->
HERE;
			return $output;
		}
		public function AppendSliderData($slider_id){
			global $CMS, $DB;
			$output = "";
			if($slider_id){
				$DB->query("use ".WEBSITE_DBNAME);
				$sql = $DB->query("SELECT * FROM slider WHERE id='{$slider_id}'");
				if($data = $sql->fetchAll()){
					$SliderData = unserialize($data[0]['data']);
					//append master item
					$i = 1;
					foreach($SliderData as $slide){
						//analytic main data
						$mainData = $slide['data'];
						$img = $mainData['bgimg'];
						$bgsize = $mainData['bgsize'];
						$jdata = json_encode($mainData);
						switch($bgsize){
							case 'default_size':
								$CssAdd = "90% 90%";
								break;
							case 'fix_width':
								$CssAdd = "100% auto";
								break;
							case 'fix_height':
								$CssAdd = "auto 100%";
								break;
							case 'stretch':
								$CssAdd = "100% 100%";
								break;
							default:
								$CssAdd = '';
								break;
						}
						$output.=<<<HERE
						<div data='{$jdata}' class="slider-item item-slaver" id="item-slaver-{$i}" style="display: block; background-image: url({$img}); background-size: {$CssAdd};">
							<div class="slaver-contain">
								{$this->AppendSubElementHTML($slide['list_item'])}
							</div>
						</div>
HERE;
						$i++;
					}
					return $output;
				}else{
					return $output;
				}
			}else{
				return $output;
			}
		}
		public function AppendSubElementHTML($data){
			global $CMS, $DB;
			$output = "";
			$i = 1;
			foreach($data as $elem){
				$type = $elem['type'];
				$jdata = json_encode($elem);
				switch($type){
					case 'image':
						switch($elem['img_size']){
							case 'default_size':
								$CssAdd = "width: auto; height: auto;";
								break;
							case 'fix_width':
								$CssAdd = "width: 100%; height: auto;";
								break;
							case 'fix_height':
								$CssAdd = "width: auto; height: 100%;";
								break;
							case 'stretch':
								$CssAdd = "width: 100%; height: 100%;";
								break;
							default:
								$CssAdd = '';
								break;
						}
						$output.=<<<HERE
						<div class="sl-unit" style="width: {$elem['width']}px; height: {$elem['height']}px; top: {$elem['top']}; left: {$elem['left']}; right: auto; bottom: auto;" data='{$jdata}'>
							<div class="unit-act">
								<a class="remove"><i class="fa fa-close"></i></a>
							</div>
							<div class="context contextimage">
								<img src="{$elem['image']}" style="{$CssAdd}">
							</div>
						</div>
HERE;
						break;
					case 'text':
						switch($elem['style']){
							case 'normal':
								$CssAdd = "font-weight: normal; text-decoration: none; font-style: normal;";
								break;
							case 'bold':
								$CssAdd = "font-weight: bold; text-decoration: none; font-style: normal;";
								break;
							case 'underline':
								$CssAdd = "font-weight: normal; text-decoration: underline; font-style: normal;";
								break;
							case 'italic':
								$CssAdd = "font-weight: normal; text-decoration: none; font-style: italic;";
								break;
							default:
								$CssAdd = '';
								break;
						}
						$output.=<<<HERE
						<div class="sl-unit" style="width: {$elem['width']}px; height: {$elem['height']}px; top: {$elem['top']}; left: {$elem['left']}; right: auto; bottom: auto;" data='{$jdata}'>
							<div class="unit-act">
								<a class="remove"><i class="fa fa-close"></i></a>
							</div>
							<div class="context">
								<p style="text-align: {$elem['align']}; font-size: {$elem['size']}px; color: {$elem['color']}; font-family: {$elem['font']}; line-height: {$elem['lheight']}px; {$CssAdd}">{$elem['text']}</p>
							</div>
						</div>
HERE;
						break;
					case 'link':
						switch($elem['style']){
							case 'normal':
								$CssAdd = "font-weight: normal; text-decoration: none; font-style: normal;";
								break;
							case 'bold':
								$CssAdd = "font-weight: bold; text-decoration: none; font-style: normal;";
								break;
							case 'underline':
								$CssAdd = "font-weight: normal; text-decoration: underline; font-style: normal;";
								break;
							case 'italic':
								$CssAdd = "font-weight: normal; text-decoration: none; font-style: italic;";
								break;
							default:
								$CssAdd = '';
								break;
						}
						$output.=<<<HERE
						<div class="sl-unit" style="width: {$elem['width']}px; height: {$elem['height']}px; top: {$elem['top']}; left: {$elem['left']}; right: auto; bottom: auto;" data='{$jdata}'>
							<div class="unit-act">
								<a class="remove"><i class="fa fa-close"></i></a>
							</div>
							<div class="context">
								<a href="{$elem['url']}" style="text-align: {$elem['align']}; font-size: {$elem['size']}px; color: {$elem['color']}; font-family: {$elem['font']}; line-height: {$elem['lheight']}px; {$CssAdd}">{$elem['text']}</a>
							</div>
						</div>
HERE;
						break;
					default:
						break;
				}
				$i++;
			}
			return $output;
		}
		public function WindowSelectImageFrom(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
						<div id="SelectImageFrom">
							<div class="contain">
								<div class="header">
									<div class="title">
										<p><i class="fa fa-cogs"></i></li> Select image from</p>
									</div>
									<div class="act-btn">
										<p class="close-this">Close <i class="fa fa-close"></i></li></p>
									</div>
								</div>
								<div class="body">
									<div class="select-image-from">
										<div class="target-from-gallery x-attachment-select-one" data-toggle="modal" data-target="#window-attachment-quickaccess">
											<p><i class="fa fa-photo"></i> Gallery</p>
										</div>
										<div class="target-from-post" data-toggle="modal" data-target="#window-object-quickaccess">
											<p><i class="fa fa-file-text"></i> Post</p>
										</div>
										<div class="target-from-product" data-toggle="modal" data-target="#window-object-quickaccess">
											<p><i class="fa fa-folder"></i> Product</p>
										</div>
										<div class="target-from-postcat" data-toggle="modal" data-target="#window-object-quickaccess">
											<p><i class="fa fa-file-text"></i> Post category</p>
										</div>
										<div class="target-from-prodcat" data-toggle="modal" data-target="#window-object-quickaccess">
											<p><i class="fa fa-folder"></i> Product category</p>
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
		public function WindowInsertSubElement(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
						<div id="InsertSubElement">
							<div class="contain">
								<div class="header">
									<div class="title">
										<p><i class="fa fa-cogs"></i></li> Select image from</p>
									</div>
									<div class="act-btn">
										<p class="close-this">Close <i class="fa fa-close"></i></li></p>
									</div>
								</div>
								<div class="body">
									<div class="select-element-type">
										<div class="target-insert-image x-attachment-select-one" data-toggle="modal" data-target="#window-attachment-quickaccess">
											<p><i class="fa fa-photo"></i> Image</p>
										</div>
										<div class="target-insert-text" data-toggle="modal" data-target="#window-subele-text-setting">
											<p><i class="fa fa-file-text"></i> Text</p>
										</div>
										<div class="target-insert-link" data-toggle="modal" data-target="#window-subele-link-setting">
											<p><i class="fa fa-globe"></i> Link</p>
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
		public function WindowSubElementSetting(){
			global $CMS, $DB;
			$output = "";
			$output =<<<HERE
			<!-- Modal -->
				<div class="modal fade" id="window-subele-text-setting" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Setting sub element (Text)</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
								<div class="add-subele-text form-horizontal">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-6 col-xs-12" for="text_insert">Text: </label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input class="form-control" type="text" />
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action" data-dismiss="modal">
										<i class="fa fa-check"></i> OK
									</a>
								</div>
								<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
							</div>
						</div>

					</div>
				</div>
			<!-- Modal -->
				<div class="modal fade" id="window-subele-link-setting" role="dialog">
					<div class="modal-dialog modal-lg">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Setting sub element (Link)</h4>
							</div>
							<div class="modal-body" style="padding: 0 !important;">
								<div class="add-subele-link form-horizontal">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-6 col-xs-12" for="link_insert">Text: </label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input class="input-text form-control" type="text" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-6 col-xs-12" for="link_href">Link: </label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input class="input-link form-control" type="text" />
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="btn-group pull-left">
									<a class="btn btn-primary x-custom-action" data-dismiss="modal">
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
		public function GetSliderListData(){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM slider WHERE lang_id='1' AND 1=1 ORDER BY id DESC");
			if($data = $sql->fetchAll()){
				return $data;
			}else{
				return false;
			}
		}
		public function LoadSliderName($id){
			global $CMS, $DB;
			$DB->query("use ".WEBSITE_DBNAME);
			$sql = $DB->query("SELECT * FROM slider WHERE id='{$id}'");
			if($data = $sql->fetchAll()){
				return $data[0]['name'];
			}else{
				return false;
			}
		}
	}