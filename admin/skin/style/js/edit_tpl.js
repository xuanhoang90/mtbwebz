$(function(){
	//prevent link click 
	$(".contain-change-tpl").find("a").click(function(e){
		e.preventDefault();
	})

	//global variable
	var _globSettingLayout = $("#settinglayout");
	var _globAddRowLayout = $("#addrowlayout");
	var _globContainChangeTpl = $(".contain-change-tpl");
	var _globChangeMainRow = $("#MainRowChange");
	//remove action main data
	$(".mainrow").find(".config-lvl-1").find(".fa-close").remove();
	$(".mainsubrow").find(".config-lvl-2").find(".fa-close").removeClass("fa-close").addClass("fa-edit");
	
	$(".mainblock").find(".config-lvl-4").find(".fa-close").remove();
	$(".mainblock").find(".config-lvl-4").find(".fa-cog").removeClass("fa-cog").addClass("fa-wrench");
	//set sort data
	var _ResetSort = function(){
		$(".sortable").sortable({
			items: ".justsortthis",
			//cancel: ".row-impt"
		});
		$(".has-child-level-1").sortable({
			items: ".has-child-level-2"
		});
		$(".has-child-level-2").sortable({
			items: ".has-child-level-3"
		});
		$(".has-child-level-3").sortable({
			items: ".block-layout"
		});
	}
	_ResetSort();
	//add row level 1
	var _AddRowLevel_1 = function(){
		var _RowData = "<div class='row-layout has-child-level-1 justsortthis row'><div class='config config-lvl-1 col-md-12'><i class='fa fa-close'></i><i class='fa fa-cog'></i></div><div class='add add-lvl-1 col-md-12'><i class='fa fa-plus'></i></div></div>";
		_globContainChangeTpl.find(".sortable").find(".row-footer").before(_RowData);
		_ResetSort();
	}
	$(".sortable").find(".addsubrow").click(function(e){
		e.preventDefault();
		_AddRowLevel_1();
	})
	//add row level 2
	$(document).on("click",".has-child-level-1 .add-lvl-1",function(e){
		e.preventDefault();
		$(".has-child-level-1").removeClass("active");
		$(this).parent().addClass("active");
		_globAddRowLayout.fadeIn(300);
	})
	//add row level 3
	var _AddRowLevel_3 = function(){
		var _RowData = "<div class='block-layout col-xs-12' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>#Block Title</a><i class='fa fa-close'></i><i class='fa fa-cog'></i></div><div class='block-content'>#content</div></div>";
		_globContainChangeTpl.find(".sortable").find(".child-active").find(".add-lvl-3").before(_RowData);
		_ResetSort();
	}
	$(document).on("click",".has-child-level-3 .add-lvl-3",function(e){
		e.preventDefault();
		$(".has-child-level-3").removeClass("child-active");
		$(this).parent().addClass("child-active");
		_AddRowLevel_3();
	})
	
	
	var _ColSize12 = "<div class='col-layout size-12 has-child-level-3 col-xs-12' data='12'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div>";
	var _ColSize9 = "<div class='col-layout size-9 has-child-level-3 col-xs-9' data='9'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div>";
	var _ColSize8 = "<div class='col-layout size-8 has-child-level-3 col-xs-8' data='8'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div>";
	var _ColSize6 = "<div class='col-layout size-6 has-child-level-3 col-xs-6' data='6'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div>";
	var _ColSize4 = "<div class='col-layout size-4 has-child-level-3 col-xs-4' data='4'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div>";
	var _ColSize3 = "<div class='col-layout size-3 has-child-level-3 col-xs-3' data='3'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div>";
	
	var _MainSize12 = "<div class='col-layout size-12 has-child-level-3 col-xs-12' data='12'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='block-layout col-xs-12 mainblock' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>Required</a><i class='fa fa-wrench'></i><div class='block-content'></div></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div></div>";
	var _MainSize9 = "<div class='col-layout size-9 has-child-level-3 col-xs-9' data='9'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='block-layout col-xs-12 mainblock' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>Required</a><i class='fa fa-wrench'></i><div class='block-content'></div></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div></div>";
	var _MainSize8 = "<div class='col-layout size-8 has-child-level-3 col-xs-8' data='8'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='block-layout col-xs-12 mainblock' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>Required</a><i class='fa fa-wrench'></i><div class='block-content'></div></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div></div>";
	var _MainSize6 = "<div class='col-layout size-6 has-child-level-3 col-xs-6' data='6'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='block-layout col-xs-12 mainblock' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>Required</a><i class='fa fa-wrench'></i><div class='block-content'></div></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div></div>";
	var _MainSize4 = "<div class='col-layout size-4 has-child-level-3 col-xs-4' data='4'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='block-layout col-xs-12 mainblock' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>Required</a><i class='fa fa-wrench'></i><div class='block-content'></div></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div></div>";
	var _MainSize3 = "<div class='col-layout size-3 has-child-level-3 col-xs-3' data='3'><div class='config config-lvl-3 col-md-12'><i class='fa fa-code'></i></div><div class='block-layout col-xs-12 mainblock' data=''><div class='config config-lvl-4 col-md-12'><a class='block-title'>Required</a><i class='fa fa-wrench'></i><div class='block-content'></div></div><div class='add add-lvl-3 col-xs-12'><i class='fa fa-plus'></i></div></div></div>";
	
	
	var _AddRow12 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize12+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow93 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize9+_ColSize3+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow39 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize3+_ColSize9+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow363 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize3+_ColSize6+_ColSize3+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow444 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize4+_ColSize4+_ColSize4+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow84 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize8+_ColSize4+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow48 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize4+_ColSize8+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow66 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize6+_ColSize6+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	var _AddRow3333 = function(){
		var _RowData = "<div class='row-layout has-child-level-2 col-xs-12'><div class='config config-lvl-2 col-md-12'><i class='fa fa-close'></i></div>"+_ColSize3+_ColSize3+_ColSize3+_ColSize3+"</div>";
		_globContainChangeTpl.find(".active").find(".add-lvl-1").before(_RowData);
		_ResetSort();
	}
	_globAddRowLayout.find(".apply-selected").click(function(){
		_globAddRowLayout.fadeOut(300);
		//add row data.
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-12")){
			_AddRow12();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-9-3")){
			_AddRow93();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-3-9")){
			_AddRow39();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-3-6-3")){
			_AddRow363();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-4-4-4")){
			_AddRow444();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-8-4")){
			_AddRow84();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-4-8")){
			_AddRow48();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-6-6")){
			_AddRow66();
		}
		if(_globAddRowLayout.find(".list-row").find(".selected").hasClass("data-3-3-3-3")){
			_AddRow3333();
		}
	})
	
	//close addrowlayout
	_globAddRowLayout.find(".close-this").click(function(){
		_globAddRowLayout.fadeOut(300);
	})
	_globAddRowLayout.find(".row-layout").click(function(){
		_globAddRowLayout.find(".row-layout").removeClass("selected");
		$(this).addClass("selected");
	})
	
	//close settinglayout
	_globSettingLayout.find(".close-this").click(function(){
		_globSettingLayout.fadeOut(300);
	})
	_globSettingLayout.find(".row-layout").click(function(){
		_globSettingLayout.find(".row-layout").removeClass("selected");
		$(this).addClass("selected");
	})
	
	//close blockconfig
	$("#blockconfig").find(".close-this").click(function(){
		$("#blockconfig").fadeOut(300);
	})
	$("#blockconfig").find(".row-layout").click(function(){
		$("#blockconfig").find(".row-layout").removeClass("selected");
		$(this).addClass("selected");
	})
	
	
	//delete block 
	$(document).on("click",".config .fa-close", function(e){
		e.preventDefault();
		if(confirm("Are you sure!?")){
			$(this).parent().parent().remove();
			_ResetSort();
		}
	})
	
	//config frame lvl 1 3
	$(document).on("click",".config-lvl-1 .fa-cog, .config-lvl-3 .fa-cog", function(e){
		e.preventDefault();
		_globSettingLayout.fadeIn(300);
		$(".has-child-level-1").removeClass("setting-this");
		$(".has-child-level-3").removeClass("setting-this");
		$(this).parent().parent().addClass("setting-this");
		var _Data = $(this).parent().parent().attr("data");
		_StartupRowPreview(_Data);
	})
	
	//config block layout
	var _StartBlockConfig = function(){
		$("#blockconfig").fadeIn(300);
		var _BlockData = "";
		_BlockData = $(".config-block").attr("data");
		$(".extend-custome-module-type").html("");
		if(_BlockData != ""){
			var _UnSeriData = JSON.parse( _BlockData );
			$("#blockconfig").find(".edit-block-title").val(_UnSeriData.title);
			$(".edit-module-type").val(_UnSeriData.moduleType);
			if(_UnSeriData.moduleType != "" && _UnSeriData.moduleType != "default"){
				var _Link = $(".edit-module-type").attr("data");
				$.ajax({
					method: "POST",
					url: _Link+"?site=admin&page=edit_tpl&action=ajax&sub_act=block_setting",
					data: { moduleType: _UnSeriData.moduleType, defaultData: _UnSeriData.moduleData }
				}).done(function( data ) {
					$(".extend-custome-module-type").html(data);
				});
			}else{
				$(".extend-custome-module-type").html('<p>Select module type</p>');
			}
		}else{
			$("#blockconfig").find(".edit-block-title").val('');
			$(".edit-module-type").val('default');
			$(".extend-custome-module-type").html('<p>Select module type</p>');
		}
	}
	
	$(document).on("click",".config-lvl-4 .fa-cog", function(e){
		e.preventDefault();
		$(".block-layout").removeClass("config-block");
		$(this).parent().parent().addClass("config-block",function(){
			_StartBlockConfig();
		});
	})
	
	//reload Block content after setting 
	var _ReloadBlockData = function(_ArrData){
		var _Link = $(".edit-module-type").attr("data");
		var _Data = JSON.parse(_ArrData);
		if(_Data.moduleType != "" && _Data.moduleType != "default"){
			$.ajax({
				method: "POST",
				url: _Link+"?site=admin&page=edit_tpl&action=ajax&sub_act=block_reload",
				data: { blockData:  _Data}
			}).done(function( data ) {
				$(".config-block").find(".block-content").html(data);
			});
		}
		//$(".config-block").find(".block-content").load(_Link+"?site=admin&page=edit_tpl&action=ajax&sub_act=block_reload&blockData="+$(".config-block").attr("data"));
	}
	
	//Get setting for custom module type
	$(".edit-module-type").change(function(e){
		e.preventDefault();
		var _ModuleType = $(this).val();
		var _Link = $(this).attr("data");
		$(".extend-custome-module-type").html("");
		if(_ModuleType != "" && _ModuleType != "default"){
			$.ajax({
				method: "POST",
				url: _Link+"?site=admin&page=edit_tpl&action=ajax&sub_act=block_setting",
				data: { moduleType: _ModuleType, defaultData: "" }
			}).done(function( data ) {
				$(".extend-custome-module-type").html(data);
			});
		}else{
			$(".extend-custome-module-type").html('<p>Select module type</p>');
		}
	})
	
	$(document).on("click","#blockconfig .apply-selected", function(e){
		e.preventDefault();
		$("#blockconfig").fadeOut(300);
		var _CustomTitle = $(".edit-block-title").val();
		var _CustomData = $(".extend-custome-module-type").find("form").first().serializeArray();
		$(".config-block").find(".block-title").html(_CustomTitle);
		var _SerilizeData = {
			title: _CustomTitle,
			moduleType: $(".edit-module-type").val(),
			moduleData: _CustomData,
		};
		var _Tmp = JSON.stringify( _SerilizeData );
		$(".config-block").attr({"data":""});
		$(".config-block").attr({"data":_Tmp});
		_ReloadBlockData(_Tmp);
	})
	
	//All page action
	var _AnalyticTplData = function(){
		//get all setting to array data
		
		var _SettingData = [];
		
		//loop row data
		$(".sortable").find(".has-child-level-1").each(function(){
			var _RowData = [];
			var _RowRequired = 0;
			//check row required
			if($(this).hasClass("mainrow")){
				var _RowRequired = 1;
			}
			//check row important
			var _RowImportant = 0;
			var _RowHeader = 0;
			var _RowFooter = 0;
			if($(this).hasClass("row-impt")){
				//check header
				var _RowImportant = 1;
				var _RowRequired = 1;
				if($(this).hasClass("row-header")){
					var _RowHeader = 1;
				}
				if($(this).hasClass("row-footer")){
					var _RowFooter = 1;
				}
			}
			if($(this).attr("data")){
				var _RowSetting = JSON.parse($(this).attr("data"));
			}else{
				var _RowSetting = [];
			}
			//loop subrow (col-xs-12)
			$(this).find(".has-child-level-2").each(function(){
				var _SubRowData = [];
				var _SubrowRequired = 0;
				//check subrow required
				if($(this).hasClass("mainsubrow")){
					var _SubrowRequired = 1;
				}
				//loop columb
				$(this).find(".has-child-level-3").each(function(){
					var _ColData = [];
					var _ColSize = $(this).attr("data");
					//loop block data
					$(this).find(".block-layout").each(function(){
						var _BlockRequired = 0;
						//check block required
						if($(this).hasClass("mainblock")){
							_BlockRequired = 1;
						}
						if($(this).attr("data").length){
							var _data = JSON.parse($(this).attr("data"));
						}else{
							var _data = "";
						}
						var _BlockData = {
							required: _BlockRequired,
							title: $(this).find(".config").find(".block-title").html(),
							data: _data
						};
						_ColData.push(_BlockData);
					})
					_ColData = {
						size: _ColSize,
						data: _ColData
					};
					_SubRowData.push(_ColData);
				})
				_SubRowData = {
					required: _SubrowRequired,
					data: _SubRowData
				}
				_RowData.push(_SubRowData);
			})
			_RowData = {
				required: _RowRequired,
				important: _RowImportant,
				header: _RowHeader,
				footer: _RowFooter,
				setting: _RowSetting,
				data: _RowData
			}
			_SettingData.push(_RowData);
		})
		
		return _SettingData;
	}
	var _ApplyChangeTpl = function(){
		//move draft data to page data
	}
	var _SaveDraftTpl = function(){
		//save draft before preview
	}
	var _PreviewTpl = function(){
		//save draft and preview 
	}
	$(".setting-tpl-btn-act").find(".imp-act").click(function(e){
		e.preventDefault();
		if($(this).hasClass("save")){
			$(".setting-tpl-btn-act").find(".save").html("<i class='fa fa-cog fa-spin'></i> Save");
			var _TplData = _AnalyticTplData();
			var _Link = $(".edit-module-type").attr("data");
			var _PageID = $(".containpageid").attr("data");
			$.ajax({
				method: "POST",
				url: _Link+"?site=admin&page=edit_tpl&action=ajax&sub_act=savechange&id="+_PageID,
				data: { tpldata: _TplData}
			}).done(function( data ) {
				$(".setting-tpl-btn-act").find(".save").html("<i class='fa fa-check'></i> Save");
			});
		}
		if($(this).hasClass("preview")){
			alert("This version not support");
		}
		if($(this).hasClass("backtohome")){
			if(confirm("Are your sure to leave this page!?")){
				var _Link = $(".edit-module-type").attr("data");
				window.location.href=_Link+"/taka_acp";
			}
		}
	})
	
	//setting block
	/* _globSettingLayout.find(".use-fullwidth").change(function(e){
		e.preventDefault();
		if($(this).prop("checked") == true){
			_globSettingLayout.find(".preview").find(".target").animate({"width": "100%"},300);
		}else{
			_globSettingLayout.find(".preview").find(".target").animate({"width": "85%"},300);
		}
	})
	_globSettingLayout.find(".background-fullwidth").change(function(e){
		e.preventDefault();
		var _Replace = _globSettingLayout.find(".background-image").val();
		if($(this).prop("checked") == true){
			_globSettingLayout.find(".preview").find(".target").css({"background-image": ""});
			_globSettingLayout.find(".preview").css({"background-image": "url("+_Replace+")"});
		}else{
			_globSettingLayout.find(".preview").css({"background-image": ""});
			_globSettingLayout.find(".preview").find(".target").css({"background-image": "url("+_Replace+")"});
		}
	}) */
	_globSettingLayout.find(".x-attachment-select-one").click(function(){
		$("#window-attachment-quickaccess").find(".x-custom-action").addClass("target-set-row-background");
	})
	$(document).on("click", ".target-set-row-background", function(){
		$(this).removeClass("target-set-row-background");
		var _Replace = $("#w-attachment-list").find(".x-attachment-item-selected").find("img").attr("src");
		_globSettingLayout.find(".preview").find(".background-image").val(_Replace).change();
	})
	_globSettingLayout.find(".apply-selected").click(function(e){
		e.preventDefault();
		_globSettingLayout.fadeOut();
		var _BGImage = _globSettingLayout.find(".background-image").val();
		var _WFull = _globSettingLayout.find(".use-fullwidth").prop("checked");
		var _BGFull = _globSettingLayout.find(".background-fullwidth").prop("checked");
		var _BGColor = _globSettingLayout.find(".background-color").val();
		var _BorderType = _globSettingLayout.find(".border-type").val();
		var _BorderColor = _globSettingLayout.find(".border-color").val();
		var _BorderSize = _globSettingLayout.find(".border-size").val();
		var _BorderTop = _globSettingLayout.find(".border-top").prop("checked");
		var _BorderLeft = _globSettingLayout.find(".border-left").prop("checked");
		var _BorderRight = _globSettingLayout.find(".border-right").prop("checked");
		var _BorderBottom = _globSettingLayout.find(".border-bottom").prop("checked");
		var _RowSetting = {
			bgurl: _BGImage,
			wfull: _WFull,
			bgfull: _BGFull,
			bgcolor: _BGColor,
			bordertype: _BorderType,
			bordersize: _BorderSize,
			bordercolor: _BorderColor,
			bordertop: _BorderTop,
			borderleft: _BorderLeft,
			borderright: _BorderRight,
			borderbottom: _BorderBottom,
		};
		$(".setting-this").attr({"data": JSON.stringify( _RowSetting )})
	})
	//startup row preview
	var _StartupRowPreview = function(data){
		if(data && data.length > 0){
			_Data = JSON.parse(data);
			var _BGImage = _Data.bgurl;
			if(_Data.wfull == "true"){
				_Data.wfull = true;
			}
			if(_Data.wfull == "false"){
				_Data.wfull = false;
			}
			var _WFull = _Data.wfull;
			if(_Data.bgfull == "true"){
				_Data.bgfull = true;
			}
			if(_Data.bgfull == "false"){
				_Data.bgfull = false;
			}
			var _BGFull = _Data.bgfull;
			var _BGColor = _Data.bgcolor;
			var _BorderType = _Data.bordertype;
			var _BorderColor = _Data.bordercolor;
			var _BorderSize = _Data.bordersize;
			if(_Data.bordertop == "true"){
				_Data.bordertop = true;
			}
			if(_Data.bordertop == "false"){
				_Data.bordertop = false;
			}
			var _BorderTop = _Data.bordertop;
			if(_Data.borderleft == "true"){
				_Data.borderleft = true;
			}
			if(_Data.borderleft == "false"){
				_Data.borderleft = false;
			}
			var _BorderLeft = _Data.borderleft;
			if(_Data.borderright == "true"){
				_Data.borderright = true;
			}
			if(_Data.borderright == "false"){
				_Data.borderright = false;
			}
			var _BorderRight = _Data.borderright;
			if(_Data.borderbottom == "true"){
				_Data.borderbottom = true;
			}
			if(_Data.borderbottom == "false"){
				_Data.borderbottom = false;
			}
			var _BorderBottom = _Data.borderbottom;
			
			if(_WFull == true){
				_globSettingLayout.find(".preview").find(".target").animate({"width": "100%"},100);
			}else{
				_globSettingLayout.find(".preview").find(".target").animate({"width": "85%"},100);
			}
			
			if(_BGFull == true){
				if(_BorderTop == true){
					var _CssBtop = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBtop = "none";
				}
				if(_BorderLeft == true){
					var _CssBleft = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBleft = "none";
				}
				if(_BorderRight == true){
					var _CssBright = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBright = "none";
				}
				if(_BorderBottom == true){
					var _CssBbot = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBbot = "none";
				}
				_globSettingLayout.find(".preview").find(".target").css({"background-image": "", "background-color": "", "border-top": "none", "border-left": "none", "border-right": "none", "border-bottom": "none"});
				_globSettingLayout.find(".preview").css({"background-image": "url("+_BGImage+")", "background-color": _BGColor, "border-top": _CssBtop, "border-left": _CssBleft, "border-right": _CssBright, "border-bottom": _CssBbot});
			}else{
				if(_BorderTop == true){
					var _CssBtop = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBtop = "none";
				}
				if(_BorderLeft == true){
					var _CssBleft = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBleft = "none";
				}
				if(_BorderRight == true){
					var _CssBright = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBright = "none";
				}
				if(_BorderBottom == true){
					var _CssBbot = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBbot = "none";
				}
				_globSettingLayout.find(".preview").css({"background-image": "", "background-color": "", "border-top": "none", "border-left": "none", "border-right": "none", "border-bottom": "none"});
				_globSettingLayout.find(".preview").find(".target").css({"background-image": "url("+_BGImage+")", "background-color": _BGColor, "border-top": _CssBtop, "border-left": _CssBleft, "border-right": _CssBright, "border-bottom": _CssBbot});
			}
		}else{
			var _BGImage = "";
			var _WFull = false;
			var _BGFull = false;
			var _BGColor = "white";
			var _BorderType = "solid";
			var _BorderColor = "white";
			var _BorderSize = 5;
			var _BorderTop = false;
			var _BorderLeft = false;
			var _BorderRight = false;
			var _BorderBottom = false;
			
			if(_WFull == true){
				_globSettingLayout.find(".preview").find(".target").animate({"width": "100%"},100);
			}else{
				_globSettingLayout.find(".preview").find(".target").animate({"width": "85%"},100);
			}
			
			if(_BGFull == true){
				if(_BorderTop == true){
					var _CssBtop = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBtop = "none";
				}
				if(_BorderLeft == true){
					var _CssBleft = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBleft = "none";
				}
				if(_BorderRight == true){
					var _CssBright = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBright = "none";
				}
				if(_BorderBottom == true){
					var _CssBbot = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBbot = "none";
				}
				_globSettingLayout.find(".preview").find(".target").css({"background-image": "", "background-color": "", "border-top": "none", "border-left": "none", "border-right": "none", "border-bottom": "none"});
				_globSettingLayout.find(".preview").css({"background-image": "url("+_BGImage+")", "background-color": _BGColor, "border-top": _CssBtop, "border-left": _CssBleft, "border-right": _CssBright, "border-bottom": _CssBbot});
			}else{
				if(_BorderTop == true){
					var _CssBtop = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBtop = "none";
				}
				if(_BorderLeft == true){
					var _CssBleft = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBleft = "none";
				}
				if(_BorderRight == true){
					var _CssBright = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBright = "none";
				}
				if(_BorderBottom == true){
					var _CssBbot = _BorderSize+"px "+_BorderType+" "+_BorderColor;
				}else{
					var _CssBbot = "none";
				}
				_globSettingLayout.find(".preview").css({"background-image": "", "background-color": "", "border-top": "none", "border-left": "none", "border-right": "none", "border-bottom": "none"});
				_globSettingLayout.find(".preview").find(".target").css({"background-image": "url("+_BGImage+")", "background-color": _BGColor, "border-top": _CssBtop, "border-left": _CssBleft, "border-right": _CssBright, "border-bottom": _CssBbot});
			}
		}
		_globSettingLayout.find(".background-image").val(_BGImage);
		_globSettingLayout.find(".use-fullwidth").prop("checked",_WFull).change();
		_globSettingLayout.find(".background-fullwidth").prop("checked", _BGFull).change();
		if(!_BGColor){
			_BGColor = "#d1d1d1";
		}
		_globSettingLayout.find(".background-color").val(_BGColor).change();
		if(!_BorderType){
			_BorderType = "solid";
		}
		_globSettingLayout.find(".border-type").val(_BorderType).change();
		if(!_BorderColor){
			_BorderColor = "#ffffff";
		}
		_globSettingLayout.find(".border-color").val(_BorderColor).change();
		if(!_BorderSize){
			_BorderSize = 5;
		}
		_globSettingLayout.find(".border-size").val(parseInt(_BorderSize)).change();
		_globSettingLayout.find(".border-top").prop("checked", _BorderTop).change();
		_globSettingLayout.find(".border-left").prop("checked", _BorderLeft).change();
		_globSettingLayout.find(".border-right").prop("checked", _BorderRight).change();
		_globSettingLayout.find(".border-bottom").prop("checked", _BorderBottom).change();
	}
	//function reset row preview
	var _ResetRowPreview = function(){
		var _BGImage = _globSettingLayout.find(".background-image").val();
		var _WFull = _globSettingLayout.find(".use-fullwidth").prop("checked");
		var _BGFull = _globSettingLayout.find(".background-fullwidth").prop("checked");
		var _BGColor = _globSettingLayout.find(".background-color").val();
		var _BorderType = _globSettingLayout.find(".border-type").val();
		var _BorderColor = _globSettingLayout.find(".border-color").val();
		var _BorderSize = _globSettingLayout.find(".border-size").val();
		var _BorderTop = _globSettingLayout.find(".border-top").prop("checked");
		var _BorderLeft = _globSettingLayout.find(".border-left").prop("checked");
		var _BorderRight = _globSettingLayout.find(".border-right").prop("checked");
		var _BorderBottom = _globSettingLayout.find(".border-bottom").prop("checked");
		
		if(_WFull == true){
			_globSettingLayout.find(".preview").find(".target").animate({"width": "100%"},100);
		}else{
			_globSettingLayout.find(".preview").find(".target").animate({"width": "85%"},100);
		}
		
		if(_BGFull == true){
			if(_BorderTop == true){
				var _CssBtop = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBtop = "none";
			}
			if(_BorderLeft == true){
				var _CssBleft = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBleft = "none";
			}
			if(_BorderRight == true){
				var _CssBright = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBright = "none";
			}
			if(_BorderBottom == true){
				var _CssBbot = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBbot = "none";
			}
			_globSettingLayout.find(".preview").find(".target").css({"background-image": "", "background-color": "", "border-top": "none", "border-left": "none", "border-right": "none", "border-bottom": "none"});
			_globSettingLayout.find(".preview").css({"background-image": "url("+_BGImage+")", "background-color": _BGColor, "border-top": _CssBtop, "border-left": _CssBleft, "border-right": _CssBright, "border-bottom": _CssBbot});
		}else{
			if(_BorderTop == true){
				var _CssBtop = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBtop = "none";
			}
			if(_BorderLeft == true){
				var _CssBleft = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBleft = "none";
			}
			if(_BorderRight == true){
				var _CssBright = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBright = "none";
			}
			if(_BorderBottom == true){
				var _CssBbot = _BorderSize+"px "+_BorderType+" "+_BorderColor;
			}else{
				var _CssBbot = "none";
			}
			_globSettingLayout.find(".preview").css({"background-image": "", "background-color": "", "border-top": "none", "border-left": "none", "border-right": "none", "border-bottom": "none"});
			_globSettingLayout.find(".preview").find(".target").css({"background-image": "url("+_BGImage+")", "background-color": _BGColor, "border-top": _CssBtop, "border-left": _CssBleft, "border-right": _CssBright, "border-bottom": _CssBbot});
		}
	}
	_globSettingLayout.find(".remove-bgimage").click(function(e){
		e.preventDefault();
		_globSettingLayout.find(".preview").find(".background-image").val("").change();
	})
	_globSettingLayout.find(".background-image, .use-fullwidth, .background-fullwidth, .background-color, .border-type, .border-color, .border-size, .border-top, .border-left, .border-right, .border-bottom").change(function(e){
		e.preventDefault();
		_ResetRowPreview();
	})
	
	//main subrow change
	$(document).on("click", "#MainRowChange .close-this", function(e){
		e.preventDefault();
		$("#MainRowChange").fadeOut(100);
	})
	$(document).on("click", ".mainsubrow .config-lvl-2 .fa-edit", function(e){
		e.preventDefault();
		$("#MainRowChange").fadeIn(100);
	})
	
	//change main row
	$(document).on("click", "#MainRowChange .row-layout", function(e){
		e.preventDefault();
		$("#MainRowChange .row-layout").removeClass("selected");
		$(this).addClass("selected");
	})
	var _ChangeRow12 = function(){
		var _RowData = _MainSize12;
		_globContainChangeTpl.find(".mainsubrow").find(".config").after(_RowData);
		_ResetSort();
	}
	var _ChangeRow93 = function(){
		var _RowData = _MainSize9+_ColSize3;
		_globContainChangeTpl.find(".mainsubrow").find(".config").after(_RowData);
		_ResetSort();
	}
	var _ChangeRow363 = function(){
		var _RowData = _ColSize3+_MainSize6+_ColSize3;
		_globContainChangeTpl.find(".mainsubrow").find(".config").after(_RowData);
		_ResetSort();
	}
	var _ChangeRow84 = function(){
		var _RowData = _MainSize8+_ColSize4;
		_globContainChangeTpl.find(".mainsubrow").find(".config").after(_RowData);
		_ResetSort();
	}
	var _ChangeRow66 = function(){
		var _RowData = _MainSize6+_ColSize6;
		_globContainChangeTpl.find(".mainsubrow").find(".config").after(_RowData);
		_ResetSort();
	}
	_globChangeMainRow.find(".apply-selected").click(function(){
		_globChangeMainRow.fadeOut(300);
		//get setting main block
		var _MainSetting = $(".mainsubrow").find(".mainblock").attr("data");
		//add row data.
		$(".mainsubrow").find(".col-layout").remove();
		if(_globChangeMainRow.find(".list-row").find(".selected").hasClass("data-12")){
			_ChangeRow12();
		}
		if(_globChangeMainRow.find(".list-row").find(".selected").hasClass("data-9-3")){
			_ChangeRow93();
		}
		if(_globChangeMainRow.find(".list-row").find(".selected").hasClass("data-3-6-3")){
			_ChangeRow363();
		}
		if(_globChangeMainRow.find(".list-row").find(".selected").hasClass("data-8-4")){
			_ChangeRow84();
		}
		if(_globChangeMainRow.find(".list-row").find(".selected").hasClass("data-6-6")){
			_ChangeRow66();
		}
		$(".mainsubrow").find(".mainblock").attr({"data": _MainSetting});
	})
	
	//radio button click
	$(document).on("click", ".radio-button", function(e){
		e.preventDefault();
		$(this).find("input").prop("checked", true).change();
	})
	//image-select click
	$(document).on("click", ".image-select", function(e){
		e.preventDefault();
		$(".image-select").removeClass("will-add-module-image");
		$(this).addClass("will-add-module-image");
	})
	//add image-select
	$(document).on("click", "#window-attachment-quickaccess .x-custom-action", function(e){
		e.preventDefault();
		var _ImageSelected = $("#window-attachment-quickaccess").find(".x-attachment-item-selected").find("img").attr("src");
		$(".will-add-module-image").parent().find(".image-src").val(_ImageSelected);
		$(".will-add-module-image").parent().find(".image-preview").attr({"src":_ImageSelected});
		$(".image-select").removeClass("will-add-module-image");
	})
	
	//object-select click
	$(document).on("click", ".object-select", function(e){
		e.preventDefault();
		$(".object-select").removeClass("will-add-module-object");
		$(this).addClass("will-add-module-object");
	})
	//add object-select
	$(document).on("click", "#window-object-quickaccess .x-custom-action", function(e){
		e.preventDefault();
		var _ObjectID = $("#window-object-quickaccess").find(".contain-scroll").find(".selected").attr("data");
		var _ObjectName = $("#window-object-quickaccess").find(".contain-scroll").find(".selected").find(".o-name").html();
		var _ObjectLink = $("#window-object-quickaccess").find(".contain-scroll").find(".selected").find(".o-name").attr("data");
		$(".will-add-module-object").parent().find(".link-preview").val(_ObjectLink);
		$(".will-add-module-object").parent().find(".object-link").val(_ObjectLink);
		$(".will-add-module-object").parent().find(".object-name").val(_ObjectName);
		$(".will-add-module-object").parent().find(".name-preview").html(_ObjectName);
		$(".will-add-module-object").parent().find(".object-id").val(_ObjectID);
		$(".object-select").removeClass("will-add-module-object");
	})
	
	//Complete menu select, slider select
	$(document).on("click", ".menu-slider-select", function(e){
		$(".menu-slider-select").removeClass("menu-slider-select-this");
		$(this).addClass("menu-slider-select-this");
	})
	$(document).on("click", "#window-menu-quickaccess .x-custom-action", function(e){
		e.preventDefault();
		var _MenuName = $("#window-menu-quickaccess").find(".w-menu-im-show").find(".selected").find("span").html();
		var _MenuID = $("#window-menu-quickaccess").find(".w-menu-im-show").find(".selected").attr("data");
		$(".menu-slider-select-this").parent().find(".menu-slider-name").html(_MenuName);
		$(".menu-slider-select-this").parent().find(".menu_name_input").val(_MenuName);
		$(".menu-slider-select-this").parent().find(".menu_id_input").val(_MenuID);
	})
	$(document).on("click", "#window-slider-quickaccess .x-custom-action", function(e){
		e.preventDefault();
		var _SliderName = $("#window-slider-quickaccess").find(".w-slider-im-show").find(".selected").find("span").html();
		var _SliderID = $("#window-slider-quickaccess").find(".w-slider-im-show").find(".selected").attr("data");
		$(".menu-slider-select-this").parent().find(".menu-slider-name").html(_SliderName);
		$(".menu-slider-select-this").parent().find(".slider_name_input").val(_SliderName);
		$(".menu-slider-select-this").parent().find(".slider_id_input").val(_SliderID);
	})
	
	//config main frame
	$(document).on("click",".mainblock .fa-wrench", function(e){
		e.preventDefault();
		$("#frameconfig").fadeIn(300);
	})
	$(document).on("click","#frameconfig .close-this", function(e){
		e.preventDefault();
		$("#frameconfig").fadeOut(300);
	})
	$(document).on("click","#frameconfig .apply-selected", function(e){
		e.preventDefault();
		$("#frameconfig").fadeOut(300);
	})
})