$(function(){
	//global variable
	var _globSliderSetting = $(".slider-setting");
	var _globSliderMasterTab = $(".acp-slider-master-tab");
	var _globSliderSlaverTab = $(".acp-slider-slaver-tab");
	var _globWindowAttQuickAccess = $("#window-attachment-quickaccess");
	var _globSelectImageFrom = $("#SelectImageFrom");
	var _globInsertSubElement = $("#InsertSubElement");
	var _globSettingSubEBlock = $(".setting-sub-e-block");
	//Drag - element set up
	//start, drag, stop, resize: function(){}
	var _ResetDrag = function(){
		$(".slaver-contain").find(".sl-unit").draggable({
			containment: "parent",
			stop: function(){
				var _Data = JSON.parse($(".ui-draggable-dragging").attr("data"));
				_Data.top = $(".ui-draggable-dragging").css("top");
				_Data.left = $(".ui-draggable-dragging").css("left");
				_Data.width = $(".ui-draggable-dragging").width();
				_Data.height = $(".ui-draggable-dragging").height();
				$(".ui-draggable-dragging").attr({"data": JSON.stringify(_Data)});
			},
		}).resizable({
			containment: "parent",
			handles: "all",
			resize: function(){
				$(".ui-resizable").removeClass("resize-this");
				$(".ui-resizable-resizing").addClass("resize-this");
			},
			stop: function(){
				var _Data = JSON.parse($(".resize-this").attr("data"));
				_Data.top = $(".resize-this").css("top");
				_Data.left = $(".resize-this").css("left");
				_Data.width = $(".resize-this").width();
				_Data.height = $(".resize-this").height();
				$(".resize-this").attr({"data": JSON.stringify(_Data)});
			},
		});
	}
	_ResetDrag();
	//startup
	var _ReloadSettingFrame = function(){
		var _SliderData = _globSliderSlaverTab.find(".active").attr("data");
		if(_SliderData && _SliderData.length > 0){
			_SliderData = JSON.parse(_SliderData);
			var _bgimg = _SliderData.bgimg;
			var _bgsize = _SliderData.bgsize;
		}else{
			//all data null
			var _bgimg = "/admin/skin/style/images/default_image.png";
			var _bgsize = "default_size";
		}
		_globSliderSetting.find(".set-main-image").find(".thumbnail").attr({"src":_bgimg});
		_globSliderSetting.find(".set-main-image-size").find(".image-size").val(_bgsize);
		return;
	}
	//action: delete, add slider
	var _ResetSliderID = function(){
		//slider count
		var _NumberOfSlider = _globSliderSlaverTab.find(".slider-item").length;
		//remove master tab
		_globSliderMasterTab.find(".select-item").remove();
		//remove slaver item id
		var i = 1;
		_globSliderSlaverTab.find(".slider-item").each(function(){
			$(this).attr({"id": "item-slaver-"+i});
			i++;
		})
		for(i = 1; i <= _NumberOfSlider; i++){
			_globSliderMasterTab.find(".add-item").before('<div class="select-item item-master" data="#item-slaver-'+i+'"><p class="num">'+i+'</p></div>');
		}
		return;
	}
	var _TabTartup = function(){
		_ResetSliderID();
		_globSliderMasterTab.find(".select-item").removeClass("active");
		_globSliderMasterTab.find(".select-item").first().addClass("active");
		var _Target = _globSliderMasterTab.find(".select-item").first().attr("data");
		_globSliderSlaverTab.find(".item-slaver").fadeOut().removeClass("active");
		_globSliderSlaverTab.find(_Target).fadeIn().addClass("active");
		_ReloadSettingFrame();
		return;
	}
	var _TabAddSuccess = function(){
		_globSliderMasterTab.find(".select-item").removeClass("active");
		_globSliderMasterTab.find(".select-item").last().addClass("active");
		var _Target = _globSliderMasterTab.find(".select-item").last().attr("data");
		_globSliderSlaverTab.find(".item-slaver").fadeOut().removeClass("active");
		_globSliderSlaverTab.find(_Target).fadeIn().addClass("active");
		_ReloadSettingFrame();
		return;
	}
	_TabTartup();
	//switch TAB
	$(document).on("click", ".acp-slider-master-tab .select-item", function(){
		if(!$(this).hasClass("active")){
			_globSliderMasterTab.find(".select-item").removeClass("active");
			$(this).addClass("active");
			var _Target = $(this).attr("data");
			_globSliderSlaverTab.find(".item-slaver").fadeOut().removeClass("active");
			_globSliderSlaverTab.find(_Target).fadeIn().addClass("active");
			_ReloadSettingFrame();
			_globSliderSlaverTab.find(".sl-unit").removeClass("sub-e-setting");
			_StartupSettingSubElement();
		}
	})
	//set slide bg
	$(".slider-main-image-change").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeIn();
		//remove: will add sub ele 
		_globWindowAttQuickAccess.removeClass("x-image-will-insert-subelement");
	})
	$(".slider-main-image-remove").click(function(e){
		e.preventDefault();
		var _Default = "/admin/skin/style/images/default_image.png";
		_globSliderSetting.find(".set-main-image").find(".thumbnail").attr({"src":_Default});
		_PreviewAfterSettingChange();
	})
	//insert sub element
	$(".acp-slider-slaver-action .insert").click(function(e){
		e.preventDefault();
		_globInsertSubElement.fadeIn();
		//remove: will add main slider
		_globWindowAttQuickAccess.removeClass("x-image-insert-to-main-slider").removeClass("x-object-insert-to-main-slider");
	})
	//close window
	_globSelectImageFrom.find(".close-this").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeOut();
	})
	_globInsertSubElement.find(".close-this").click(function(e){
		e.preventDefault();
		_globInsertSubElement.fadeOut();
	})
	//open object window
	_globInsertSubElement.find(".target-insert-image").click(function(e){
		e.preventDefault();
		_globInsertSubElement.fadeOut();
		_globWindowAttQuickAccess.addClass("x-image-will-insert-subelement");
	})
	_globInsertSubElement.find(".target-insert-text").click(function(e){
		e.preventDefault();
		_globInsertSubElement.fadeOut();
	})
	_globInsertSubElement.find(".target-insert-link").click(function(e){
		e.preventDefault();
		_globInsertSubElement.fadeOut();
	})
	_globSelectImageFrom.find(".target-from-gallery").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeOut();
		_globWindowAttQuickAccess.addClass("x-image-insert-to-main-slider");
	})
	_globSelectImageFrom.find(".target-from-post").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeOut();
		$("#window-object-quickaccess").addClass("x-object-insert-to-main-slider");
	})
	_globSelectImageFrom.find(".target-from-product").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeOut();
		$("#window-object-quickaccess").addClass("x-object-insert-to-main-slider");
	})
	_globSelectImageFrom.find(".target-from-postcat").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeOut();
		$("#window-object-quickaccess").addClass("x-object-insert-to-main-slider");
	})
	_globSelectImageFrom.find(".target-from-prodcat").click(function(e){
		e.preventDefault();
		_globSelectImageFrom.fadeOut();
		$("#window-object-quickaccess").addClass("x-object-insert-to-main-slider");
	})
	//remove unit
	$(document).on("click", ".unit-act .remove", function(e){
		e.preventDefault();
		if(confirm("Are you sure?!")){
			$(this).parent().parent().fadeOut().remove();
		}
	})
	//show advance setting
	$(".advance-setting").click(function(e){
		e.preventDefault();
		if(_globSliderSlaverTab.find(".sub-e-setting").length > 0){
			$(this).parent().find(".tab-advance-setting").slideToggle();
		}
	})
	$(".acp-slider-slaver-action").find(".delete").click(function(e){
		e.preventDefault();
		if(confirm("Are you sure?!")){
			_globSliderSlaverTab.find(".active").fadeOut().remove();
			_ResetSliderID();
			_TabTartup();
		}
	})
	_globSliderMasterTab.find(".add-item").click(function(e){
		e.preventDefault();
		_globSliderSlaverTab.append('<div class="slider-item item-slaver" data=""><div class="slaver-contain"></div></div>');
		_ResetSliderID();
		_TabAddSuccess();
	})
	
	//set, change main slider background
	//default: /admin/skin/style/images/default_image.png
	var _PreviewAfterSettingChange = function(){
		var _Default = "/admin/skin/style/images/default_image.png";
		var _BGimg = _globSliderSetting.find(".set-main-image").find(".thumbnail").attr("src");
		var _BGsize = _globSliderSetting.find(".set-main-image-size").find(".image-size").val();
		if(_BGimg == _Default){
			_BGimg = false;
		}
		var _CssAdd = "";
		switch(_BGsize){
			case 'default_size':
				_CssAdd = "90% 90%";
				break;
			case 'fix_width':
				_CssAdd = "100% auto";
				break;
			case 'fix_height':
				_CssAdd = "auto 100%";
				break;
			case 'stretch':
				_CssAdd = "100% 100%";
				break;
			default:
				_CssAdd = false;
				break;
		}
		var _NewSettingData = {
			bgimg: _BGimg,
			bgsize: _BGsize,
		};
		_globSliderSlaverTab.find(".active").attr({"data": JSON.stringify(_NewSettingData)}).css({"background-image": "url("+_BGimg+")", "background-size": _CssAdd});
	}
	$(document).on("click", ".x-image-insert-to-main-slider .x-custom-action", function(e){
		e.preventDefault();
		_globWindowAttQuickAccess.removeClass("x-image-insert-to-main-slider");
		var _Image = _globWindowAttQuickAccess.find(".x-attachment-item-selected").find("img").attr("src");
		//set image for setting block
		if(_Image != ""){
			_globSliderSetting.find(".set-main-image").find(".thumbnail").attr({"src":_Image});
			_PreviewAfterSettingChange();
		}
	})
	$(document).on("click", ".x-object-insert-to-main-slider .x-custom-action", function(e){
		e.preventDefault();
		$("#window-object-quickaccess").removeClass("x-object-insert-to-main-slider");
		var _Image = $("#window-object-quickaccess").find(".xw-object-list").find(".contain-scroll").find(".selected").find(".o-img").attr("src");
		//set image for setting block
		if(_Image != ""){
			_globSliderSetting.find(".set-main-image").find(".thumbnail").attr({"src":_Image});
			_PreviewAfterSettingChange();
		}
	})
	$(document).on("change", ".slider-setting .set-main-image-size .image-size", function(e){
		e.preventDefault();
		_PreviewAfterSettingChange();
	})
	//inset sub element
	//image
	$(document).on("click", ".x-image-will-insert-subelement .x-custom-action",function(e){
		e.preventDefault();
		_globWindowAttQuickAccess.removeClass("x-image-will-insert-subelement");
		var _Image = _globWindowAttQuickAccess.find(".x-attachment-item-selected").find("img").attr("src");
		//set image for setting block
		if(_Image != ""){
			//insert sub element
			//remove current active element
			_globSliderSlaverTab.find(".sl-unit").removeClass("sub-e-setting");
			_globSliderSlaverTab.find(".active").find(".slaver-contain").append('<div class="sl-unit sub-e-setting"><div class="unit-act"><a class="remove"><i class="fa fa-close"></i></a></div><div class="context contextimage"><img src="'+_Image+'" /></div></div>');
			//add data, set default size, default offset
			_globSliderSlaverTab.find(".sub-e-setting").css({"width": "150px", "height": "150px", "top": "0px", "left": "0px"});
			var _SubEdata = {
				type: "image",
				image: _Image,
				img_size: "stretch",
				width: "150px",
				height: "150px",
				top: "0px",
				left: "0px",
			};
			_globSliderSlaverTab.find(".sub-e-setting").attr({"data": JSON.stringify(_SubEdata)});
			_StartupSettingSubElement();
			_ResetDrag();
		}
	})
	//text
	$(document).on("click", "#window-subele-text-setting .x-custom-action",function(e){
		e.preventDefault();
		var _textText = $("#window-subele-text-setting").find(".add-subele-text").find("input").val();
		//set image for setting block
		if(_textText != ""){
			//insert sub element
			//remove current active element
			_globSliderSlaverTab.find(".sl-unit").removeClass("sub-e-setting");
			_globSliderSlaverTab.find(".active").find(".slaver-contain").append('<div class="sl-unit sub-e-setting"><div class="unit-act"><a class="remove"><i class="fa fa-close"></i></a></div><div class="context"><p>'+_textText+'</p></div></div>');
			//add data, set default size, default offset
			_globSliderSlaverTab.find(".sub-e-setting").css({"width": "200px", "height": "auto", "top": "0px", "left": "0px"});
			var _SubEdata = {
				type: "text",
				text: _textText,
				color: "#000000",
				font: "Arial",
				style: "normal",
				size: 14,
				align: "left",
				lheight: 25,
				width: "200px",
				height: "100px",
				top: "0px",
				left: "0px",
			};
			_globSliderSlaverTab.find(".sub-e-setting").attr({"data": JSON.stringify(_SubEdata)});
			_StartupSettingSubElement();
			_ResetDrag();
			$("#window-subele-text-setting").find(".add-subele-text").find("input").val("");
		}
	})
	//link
	$(document).on("click", "#window-subele-link-setting .x-custom-action",function(e){
		e.preventDefault();
		var _linkText = $("#window-subele-link-setting").find(".add-subele-link").find(".input-text").val();
		var _linkUrl = $("#window-subele-link-setting").find(".add-subele-link").find(".input-link").val();
		//set image for setting block
		if(_linkText != ""){
			//insert sub element
			//remove current active element
			_globSliderSlaverTab.find(".sl-unit").removeClass("sub-e-setting");
			_globSliderSlaverTab.find(".active").find(".slaver-contain").append('<div class="sl-unit sub-e-setting"><div class="unit-act"><a class="remove"><i class="fa fa-close"></i></a></div><div class="context"><a href="'+_linkUrl+'">'+_linkText+'</a></div></div>');
			//add data, set default size, default offset
			_globSliderSlaverTab.find(".sub-e-setting").css({"width": "200px", "height": "auto", "top": "0px", "left": "0px"});
			var _SubEdata = {
				type: "link",
				text: _linkText,
				url: _linkUrl,
				color: "#000000",
				font: "Arial",
				style: "normal",
				size: 14,
				align: "left",
				lheight: 25,
				width: "200px",
				height: "100px",
				top: "0px",
				left: "0px",
			};
			_globSliderSlaverTab.find(".sub-e-setting").attr({"data": JSON.stringify(_SubEdata)});
			_StartupSettingSubElement();
			_ResetDrag();
			$("#window-subele-link-setting").find(".add-subele-link").find(".input-text").val("");
			$("#window-subele-link-setting").find(".add-subele-link").find(".input-link").val("");
		}
	})
	//startup setting sub element
	var _StartupSettingSubElement = function(){
		//get data
		//data: type[text|link|image], text, url, color, font, size, style, image, img_size
		var _CurrentElementActive = _globSliderSlaverTab.find(".sub-e-setting");
		var _SettingBlock = _globSettingSubEBlock;
		var _Data = _CurrentElementActive.attr("data");
		if(_Data && _Data.length > 0){
			//color, size, font, style, align, lheight, text, link, image, image-size
			_Data = JSON.parse(_Data);
			switch(_Data.type){
				case 'text':
					var _textText = _Data.text;
					var _textColor = _Data.color;
					var _textFont = _Data.font;
					var _textStyle = _Data.style;
					var _textSize = _Data.size;
					var _textAlign = _Data.align;
					var _textLheight = _Data.lheight;
					_SettingBlock.find(".setting-for-element-type").hide().removeClass("active");
					_SettingBlock.find(".setting-for-element-type").each(function(){
						if($(this).hasClass("text")){
							//set new value and show
							$(this).show().addClass("active");
							$(this).find(".ele-text-link-edit").val(_textText);
							$(this).find(".text-color").val(_textColor);
							$(this).find(".textfont").val(_textFont);
							$(this).find(".textstyle").val(_textStyle);
							$(this).find(".text-size").val(_textSize);
							$(this).find(".line-height").val(_textLheight);
							$(this).find(".textalign").val(_textAlign);
						}
					});
					_RefreshSettingSubElement("text");
					break;
				case 'link':
					var _linkText = _Data.text;
					var _linkUrl = _Data.url;
					var _linkColor = _Data.color;
					var _linkFont = _Data.font;
					var _linkStyle = _Data.style;
					var _linkSize = _Data.size;
					var _linkAlign = _Data.align;
					var _linkLheight = _Data.lheight;
					_SettingBlock.find(".setting-for-element-type").hide().removeClass("active");
					_SettingBlock.find(".setting-for-element-type").each(function(){
						if($(this).hasClass("link")){
							//set new value and show
							$(this).show().addClass("active");
							$(this).find(".ele-text-link-edit").val(_linkText);
							$(this).find(".link-url").val(_linkUrl);
							$(this).find(".text-color").val(_linkColor);
							$(this).find(".textfont").val(_linkFont);
							$(this).find(".textstyle").val(_linkStyle);
							$(this).find(".text-size").val(_linkSize);
							$(this).find(".line-height").val(_linkLheight);
							$(this).find(".textalign").val(_linkAlign);
						}
					});
					_RefreshSettingSubElement("link");
					break;
				case 'image':
					var _imgSrc = _Data.image;
					var _imgSize = _Data.img_size;
					_SettingBlock.find(".setting-for-element-type").hide().removeClass("active");
					_SettingBlock.find(".setting-for-element-type").each(function(){
						if($(this).hasClass("image")){
							//set new value and show
							$(this).show().addClass("active");
							$(this).find(".image-src").attr({"src": _imgSrc});
							$(this).find(".image-size").val(_imgSize);
						}
					});
					_RefreshSettingSubElement("image");
					break;
				default:
					//hide all
					_SettingBlock.find(".setting-for-element-type").hide().removeClass("active");
					_SettingBlock.find(".tab-advance-setting").hide();
					break;
			}
		}else{
			//hide all
			_SettingBlock.find(".setting-for-element-type").hide().removeClass("active");
			_SettingBlock.find(".tab-advance-setting").hide();
		}
		return;
	}
	_StartupSettingSubElement();
	//sub element setting when click
	$(document).on("click", ".acp-slider-slaver-tab .sl-unit", function(e){
		e.preventDefault();
		_globSliderSlaverTab.find(".sl-unit").removeClass("sub-e-setting");
		$(this).addClass("sub-e-setting");
		_StartupSettingSubElement();
	})
	//Refresh preview: setting sub element 
	var _RefreshSettingSubElement = function(_type){
		if(_type){
			switch(_type){
				case 'text':
					//reset preview
					var _BlockSettingActive = _globSettingSubEBlock.find(".active");
					var _CurrentElementActive = _globSliderSlaverTab.find(".sub-e-setting");
					var _Context = _globSliderSlaverTab.find(".sub-e-setting").find(".context").find("p");
					
					var _textText = _BlockSettingActive.find(".ele-text-link-edit").val();
					var _textColor = _BlockSettingActive.find(".text-color").val();
					var _textFont = _BlockSettingActive.find(".textfont").val();
					var _textStyle = _BlockSettingActive.find(".textstyle").val();
					var _textSize = _BlockSettingActive.find(".text-size").val();
					var _textLheight = _BlockSettingActive.find(".line-height").val();
					var _textAlign = _BlockSettingActive.find(".textalign").val();
					var _Ewidth = _CurrentElementActive.width();
					var _Eheight = _CurrentElementActive.height();
					var _Etop = _CurrentElementActive.css("top");
					var _Eleft = _CurrentElementActive.css("left");
					
					_BlockSettingActive.find(".ele-text-link-edit").css({"text-align":_textAlign, "font-size": _textSize+"px", "color":_textColor, "font-family": _textFont});
					
					//reload sub elemt and reset data
					var _Edata = {
						type: "text",
						text: _textText,
						color: _textColor,
						font: _textFont,
						style: _textStyle,
						size: _textSize,
						lheight: _textLheight,
						align: _textAlign,
						top: _Etop,
						left: _Eleft,
						width: _Ewidth,
						height: _Eheight,
					};
					_CurrentElementActive.attr({"data": JSON.stringify(_Edata)});
					_Context.html(_textText).css({"text-align":_textAlign, "font-size": _textSize+"px", "color":_textColor, "font-family": _textFont, "line-height": _textLheight + "px"});
					switch(_textStyle){
						case 'normal':
							_Context.css({"font-weight": "normal", "text-decoration": "none", "font-style": "normal"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "normal", "text-decoration": "none", "font-style": "normal"});
							break;
						case 'bold':
							_Context.css({"font-weight": "bold", "text-decoration": "none", "font-style": "normal"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "bold", "text-decoration": "none", "font-style": "normal"});
							break;
						case 'underline':
							_Context.css({"font-weight": "normal", "text-decoration": "underline", "font-style": "normal"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "normal", "text-decoration": "underline", "font-style": "normal"});
							break;
						case 'italic':
							_Context.css({"font-weight": "normal", "text-decoration": "none", "font-style": "italic"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "normal", "text-decoration": "none", "font-style": "italic"});
							break;
						default:
							break;
					}
					break;
				case 'link':
					//reset preview
					var _BlockSettingActive = _globSettingSubEBlock.find(".active");
					var _CurrentElementActive = _globSliderSlaverTab.find(".sub-e-setting");
					var _Context = _globSliderSlaverTab.find(".sub-e-setting").find(".context").find("a");
					
					var _textText = _BlockSettingActive.find(".ele-text-link-edit").val();
					var _linkUrl = _BlockSettingActive.find(".link-url").val();
					var _textColor = _BlockSettingActive.find(".text-color").val();
					var _textFont = _BlockSettingActive.find(".textfont").val();
					var _textStyle = _BlockSettingActive.find(".textstyle").val();
					var _textSize = _BlockSettingActive.find(".text-size").val();
					var _textLheight = _BlockSettingActive.find(".line-height").val();
					var _textAlign = _BlockSettingActive.find(".textalign").val();
					var _Ewidth = _CurrentElementActive.width();
					var _Eheight = _CurrentElementActive.height();
					var _Etop = _CurrentElementActive.css("top");
					var _Eleft = _CurrentElementActive.css("left");
					
					_BlockSettingActive.find(".ele-text-link-edit").css({"text-align":_textAlign, "font-size": _textSize+"px", "color":_textColor, "font-family": _textFont});
					
					//reload sub elemt and reset data
					var _Edata = {
						type: "link",
						url: _linkUrl,
						text: _textText,
						color: _textColor,
						font: _textFont,
						style: _textStyle,
						size: _textSize,
						lheight: _textLheight,
						align: _textAlign,
						top: _Etop,
						left: _Eleft,
						width: _Ewidth,
						height: _Eheight,
					};
					_CurrentElementActive.attr({"data": JSON.stringify(_Edata)});
					_Context.html(_textText).attr({"href":_linkUrl}).css({"text-align":_textAlign, "font-size": _textSize+"px", "color":_textColor, "font-family": _textFont, "line-height": _textLheight + "px"});
					switch(_textStyle){
						case 'normal':
							_Context.css({"font-weight": "normal", "text-decoration": "none", "font-style": "normal"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "normal", "text-decoration": "none", "font-style": "normal"});
							break;
						case 'bold':
							_Context.css({"font-weight": "bold", "text-decoration": "none", "font-style": "normal"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "bold", "text-decoration": "none", "font-style": "normal"});
							break;
						case 'underline':
							_Context.css({"font-weight": "normal", "text-decoration": "underline", "font-style": "normal"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "normal", "text-decoration": "underline", "font-style": "normal"});
							break;
						case 'italic':
							_Context.css({"font-weight": "normal", "text-decoration": "none", "font-style": "italic"});
							_BlockSettingActive.find(".ele-text-link-edit").css({"font-weight": "normal", "text-decoration": "none", "font-style": "italic"});
							break;
						default:
							break;
					}
					break;
				case 'image':
					//reset preview
					var _BlockSettingActive = _globSettingSubEBlock.find(".active");
					var _CurrentElementActive = _globSliderSlaverTab.find(".sub-e-setting");
					var _Context = _globSliderSlaverTab.find(".sub-e-setting").find(".context").find("img");
					
					var _imgSrc = _BlockSettingActive.find(".image-src").attr("src");
					var _imgSize = _BlockSettingActive.find(".image-size").val();
					var _Ewidth = _CurrentElementActive.width();
					var _Eheight = _CurrentElementActive.height();
					var _Etop = _CurrentElementActive.css("top");
					var _Eleft = _CurrentElementActive.css("left");
					
					_CurrentElementActive.find(".image-src").attr({"src":_imgSrc});
					
					//reload sub elemt and reset data
					var _Edata = {
						type: "image",
						image: _imgSrc,
						img_size: _imgSize,
						top: _Etop,
						left: _Eleft,
						width: _Ewidth,
						height: _Eheight,
					};
					_CurrentElementActive.attr({"data": JSON.stringify(_Edata)});
					_Context.attr({"src":_imgSrc});
					switch(_imgSize){
						case 'default_size':
							_Context.css({"width": "auto", "height": "auto"});
							break;
						case 'fix_width':
							_Context.css({"width": "100%", "height": "auto"});
							break;
						case 'fix_height':
							_Context.css({"width": "auto", "height": "100%"});
							break;
						case 'stretch':
							_Context.css({"width": "100%", "height": "100%"});
							break;
						default:
							break;
					}
					break;
				default:
					break;
			}
		}
		return;
	}
	//setting sub element play and preview
	$(document).on("change", ".setting-sub-e-block .active .form-control", function(e){
		e.preventDefault();
		if(_globSettingSubEBlock.find(".active").hasClass("text")){
			_RefreshSettingSubElement("text");
		}
		if(_globSettingSubEBlock.find(".active").hasClass("link")){
			_RefreshSettingSubElement("link");
		}
		if(_globSettingSubEBlock.find(".active").hasClass("image")){
			_RefreshSettingSubElement("image");
		}
	})
	$(document).on("keyup", ".setting-sub-e-block .active .ele-text-link-edit", function(e){
		e.preventDefault();
		if(_globSettingSubEBlock.find(".active").hasClass("text")){
			_RefreshSettingSubElement("text");
		}
		if(_globSettingSubEBlock.find(".active").hasClass("link")){
			_RefreshSettingSubElement("link");
		}
		if(_globSettingSubEBlock.find(".active").hasClass("image")){
			_RefreshSettingSubElement("image");
		}
	})
	//change subelement image
	$(".subele-image-change").click(function(e){
		e.preventDefault();
		_globWindowAttQuickAccess.addClass("x-att-will-change-sub-element-image");
	})
	$(document).on("click", ".x-att-will-change-sub-element-image .x-custom-action",function(e){
		e.preventDefault();
		_globWindowAttQuickAccess.removeClass("x-att-will-change-sub-element-image");
		var _Image = _globWindowAttQuickAccess.find(".x-attachment-item-selected").find("img").attr("src");
		//set image for setting block
		if(_Image != ""){
			_globSettingSubEBlock.find(".active").find(".image-src").attr({"src": _Image});
			_RefreshSettingSubElement("image");
		}
	})
	//prevent click: link sub element 
	$(document).on("click", ".acp-slider-slaver-tab a", function(e){
		e.preventDefault();
	})
	//analytic sub item data 
	var _AnalyticSliderSubItem = function(ele){
		var _ListData = [];
		$(ele).find(".sl-unit").each(function(){
			if($(this).attr("data")){
				var _data = JSON.parse($(this).attr("data"));
			}else{
				var _data = {};
			}
			_ListData.push(_data);
		})
		return _ListData;
	}
	//analytic slider data
	var _AnalyticSliderData = function(){
		var _SliderData = [];
		$(".contain-slider-edit").find(".acp-slider-slaver-tab").find(".slider-item").each(function(){
			var _containSlaver = $(this).find(".slaver-contain");
			if($(this).attr("data")){
				var _data = JSON.parse($(this).attr("data"));
			}else{
				var _data = {};
			}
			var _SliderItemData = {
				data: _data,
				list_item: _AnalyticSliderSubItem(_containSlaver),
			};
			_SliderData.push(_SliderItemData);
		})
		return _SliderData;
	}
	//save data
	$(".custom-slider-btn-act").find(".imp-act").click(function(e){
		e.preventDefault();
		if($(this).hasClass("save")){
			$(".custom-slider-btn-act").find(".save").html("<i class='fa fa-cog fa-spin'></i> Save");
			var _Link = $(this).attr("href");
			var _SliderData = _AnalyticSliderData();
			$.ajax({
				method: "POST",
				url: _Link,
				data: { sliderdata: _SliderData, slidername: $(".main-slider-name").val()}
			}).done(function( data ) {
				data = JSON.parse(data);
				if(data.reload == "true"){
					window.location.href=data.status;
				}else{
					$(".custom-slider-btn-act").find(".save").html("<i class='fa fa-check'></i> Save");
				}
			});
		}
		if($(this).hasClass("preview")){
			alert("This version not support");
		}
		if($(this).hasClass("backtohome")){
			if(confirm("Are your sure to leave this page!?")){
				window.location.href=$(this).attr("href");
			}
		}
	})
})