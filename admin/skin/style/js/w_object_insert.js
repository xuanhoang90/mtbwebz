$(function(){
	//global variable
	var _globWindowObjectQuickAccess = $("#window-object-quickaccess");
	var _globMenuItemChange = $(".x-menu-item-change-this");
	//select one object
	$(document).on("click", ".w-object-select-one .contain-scroll .obj-item", function(e){
		e.preventDefault();
		$(this).parent().find(".obj-item").removeClass("selected");
		$(this).addClass("selected");
		$("#x-object-list-selected-tmp-data").val($(this).attr("data"));
		
	})
	//reset selected - temp data
	var _ResetCurrentSelected = function(_id, _plus){
		_id = typeof _id !== 'undefined' ? _id : 0;
		_plus = typeof _plus !== 'undefined' ? _plus : 0;
		var _CurrentSelected = $("#x-object-list-selected-tmp-data").val();
		if(_plus){
			var _New = _CurrentSelected + "," + _id;
			$("#x-object-list-selected-tmp-data").val(_New);
		}else{
			var _Tmp = _CurrentSelected.split(",");
			var _New = "";
			_Tmp.forEach(function(entry){
				if(entry != _id && entry != ""){
					_New += "," + entry;
				}
			})
			$("#x-object-list-selected-tmp-data").val(_New);
		}
		return;
	}
	//multi select
	$(document).on("click", ".w-object-select-multi .contain-scroll .obj-item", function(e){
		e.preventDefault();
		if($(this).hasClass("selected")){
			$(this).removeClass("selected");
			_ResetCurrentSelected($(this).attr("data"), false);
		}else{
			$(this).addClass("selected");
			_ResetCurrentSelected($(this).attr("data"), true);
		}
	})
	//reload window
	var _ReloadWindowObject = function(_target, _page, _ipp, _parent){
		_target = typeof _target !== 'undefined' ? _target : 0;
		_page = typeof _page !== 'undefined' ? _page : 1;
		_ipp = typeof _ipp !== 'undefined' ? _ipp : 20;
		_parent = typeof _parent !== 'undefined' ? _parent : [];
		var _AjaxLink = $("#ajaxgetobject-link").val();
		var _ObjectType = _globWindowObjectQuickAccess.attr("data-type");
		$.ajax({
			method: "POST",
			url: _AjaxLink,
			data: {obj_type: _ObjectType, obj_page: _page, obj_ippage: _ipp, target: _target, parent: _parent}
		}).done(function(data) {
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".xw-object-list").remove();
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").hide();
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").append(data);
		})
	}
	//double click, load data
	$(document).on("dblclick", "#window-object-quickaccess .obj-item-directory", function(e){
		e.preventDefault();
		//load new data
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		var _Target = $(this).attr("data");
		var _Page = 1;
		var _ipPage = _globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-ipp").attr("data");
		var _Parent = [];
		_globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-parent-dir").find("li").each(function(){
			if(!$(this).find("a").hasClass("back")){
				var _data = JSON.parse($(this).find("a").attr("data"));
				_Parent.push(_data);
			}
		})
		_ReloadWindowObject(_Target, _Page, _ipPage, _Parent);
	})
	//Change direct
	$(document).on("click", "#window-object-quickaccess .xw-obj-parent-dir .direct", function(e){
		e.preventDefault();
		if(!$(this).find("a").hasClass("back")){
			//load new data
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
			var _Target = JSON.parse($(this).find("a").attr("data"));
			var _Page = 1;
			var _ipPage = _globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-ipp").attr("data");
			var _Parent = [];
			_globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-parent-dir").find("li").each(function(){
				if(!$(this).find("a").hasClass("back")){
					var _data = JSON.parse($(this).find("a").attr("data"));
					_Parent.push(_data);
				}
			})
			_ReloadWindowObject(_Target.id, _Page, _ipPage, _Parent);
		}else{
			//back 
			//load new data
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
			var _Page = 1;
			var _ipPage = _globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-ipp").attr("data");
			var _Parent = [];
			_globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-parent-dir").find("li").each(function(){
				if(!$(this).find("a").hasClass("back")){
					var _data = JSON.parse($(this).find("a").attr("data"));
					_Parent.push(_data);
				}
			})
			if(_Parent.length >= 2){
				var _Target = _Parent[_Parent.length - 2];
				_ReloadWindowObject(_Target.id, _Page, _ipPage, _Parent);
			}else{
				//do nothing
				_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").hide();
			}
		}
	})
	//page select
	$(document).on("click", "#window-object-quickaccess .xw-obj-page-select .page", function(e){
		e.preventDefault();
		//load new data
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		var _Page = $(this).find("a").attr("data");
		var _ipPage = _globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-ipp").attr("data");
		var _Parent = [];
		_globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-parent-dir").find("li").each(function(){
			if(!$(this).find("a").hasClass("back")){
				var _data = JSON.parse($(this).find("a").attr("data"));
				_Parent.push(_data);
			}
		})
		var _Target = _Parent[_Parent.length - 1];
		if(_Page != "noproc"){
			$(this).parent().find("a").removeClass("active");
			$(this).find("a").addClass("active");
			_ReloadWindowObject(_Target.id, _Page, _ipPage, _Parent);
		}else{
			//do nothing
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").hide();
		}
	})
	//ippage select
	$(document).on("click", "#window-object-quickaccess .xw-obj-ipp .ipp", function(e){
		e.preventDefault();
		//load new data
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		var _Page = 1;
		var _ipPage = $(this).find("a").attr("data");
		var _Parent = [];
		_globWindowObjectQuickAccess.find(".w-object-header").find(".xw-obj-parent-dir").find("li").each(function(){
			if(!$(this).find("a").hasClass("back")){
				var _data = JSON.parse($(this).find("a").attr("data"));
				_Parent.push(_data);
			}
		})
		var _Target = _Parent[_Parent.length - 1];
		if(_Page != "noproc"){
			_ReloadWindowObject(_Target.id, _Page, _ipPage, _Parent);
		}else{
			//do nothing
			_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").hide();
		}
	})
	//block config - select object link
	$(document).on("click", ".object-select", function(e){
		e.preventDefault();
		var _DataType = $(this).attr("data");
		var _globWindowObjectQuickAccess = $("#window-object-quickaccess");
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": _DataType});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_globWindowObjectQuickAccess.find(".x-custom-action").addClass("can-add-direct");
		_ReloadWindowObject();
	})
	//set object type and allow select val
	$(document).on("click", ".menu-item-post .x-object-select-one", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "post_and_cat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_ReloadWindowObject();
	})
	$(document).on("click", ".menu-item-post-category .x-object-select-one", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "postcat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_globWindowObjectQuickAccess.find(".x-custom-action").addClass("can-add-direct");
		_ReloadWindowObject();
	})
	$(document).on("click", ".menu-item-product .x-object-select-one", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "product_and_cat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_ReloadWindowObject();
	})
	$(document).on("click", ".menu-item-product-category .x-object-select-one", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "productcat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_globWindowObjectQuickAccess.find(".x-custom-action").addClass("can-add-direct");
		_ReloadWindowObject();
	})
	//slider insert object
	$(document).on("click", ".target-from-post", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "post_and_cat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		//$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_ReloadWindowObject();
	})
	$(document).on("click", ".target-from-product", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "product_and_cat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		//$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_ReloadWindowObject();
	})
	$(document).on("click", ".target-from-postcat", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "postcat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		//$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_globWindowObjectQuickAccess.find(".x-custom-action").addClass("can-add-direct");
		_ReloadWindowObject();
	})
	$(document).on("click", ".target-from-prodcat", function(e){
		e.preventDefault();
		_globWindowObjectQuickAccess.removeClass("w-object-select-multi");
		_globWindowObjectQuickAccess.removeClass("w-object-select-one");
		_globWindowObjectQuickAccess.addClass("w-object-select-one");
		_globWindowObjectQuickAccess.attr({"data-type": "productcat"});
		_globWindowObjectQuickAccess.find(".contain-xw-object-list").find(".ajax-fake-loading").show();
		_globMenuItemChange.removeClass("x-menu-item-change-this");
		//$(this).parent().parent().addClass("x-menu-item-change-this");
		_globWindowObjectQuickAccess.find(".x-custom-action").removeClass("can-add-direct");
		_globWindowObjectQuickAccess.find(".x-custom-action").addClass("can-add-direct");
		_ReloadWindowObject();
	})
	//apply change
	_globWindowObjectQuickAccess.find(".x-custom-action").click(function(e){
		e.preventDefault();
		var _globMenuItemChange = $(".x-menu-item-change-this");
		if($(this).hasClass("can-add-direct")){
			_globWindowObjectQuickAccess.find(".modal-footer").find("button").click();
			var _Selected = _globWindowObjectQuickAccess.find(".contain-scroll").find(".selected");
			var _Image = _Selected.find(".o-img").attr("src");
			var _ID = _Selected.attr("data");
			var _Name = _Selected.find(".o-name").html();
			var _Link = _Selected.find(".o-name").attr("data");
			_globMenuItemChange.find(".thumb").attr({"src": _Image});
			_globMenuItemChange.find(".name").attr({"data": _ID}).val(_Name);
			_globMenuItemChange.find(".link").val(_Link);
		}else{
			var _Selected = _globWindowObjectQuickAccess.find(".contain-scroll").find(".selected");
			if(_Selected.hasClass("obj-item-directory")){
				_Selected.dblclick();
			}else{
				_globWindowObjectQuickAccess.find(".modal-footer").find("button").click();
				var _Selected = _globWindowObjectQuickAccess.find(".contain-scroll").find(".selected");
				var _Image = _Selected.find(".o-img").attr("src");
				var _ID = _Selected.attr("data");
				var _Name = _Selected.find(".o-name").html();
				var _Link = _Selected.find(".o-name").attr("data");
				_globMenuItemChange.find(".thumb").attr({"src": _Image});
				_globMenuItemChange.find(".name").attr({"data": _ID}).val(_Name);
				_globMenuItemChange.find(".link").val(_Link);
			}
		}
	})
})