$(function(){
	/***********************************************
	 *	X-Slider
	 *	Written by: Xuan Hoang
	 * 	Project: XHFramework
	 * 	2015
	 ***********************************************/
	//Animation
	var _AnimateInData = ['puffIn', 'spaceInUp', 'spaceInLeft', 'spaceInRight', 'spaceInDown', 'boingInUp', 'foolishIn', 'tinUpIn', 'tinLeftIn', 'tinRightIn', 'tinDownIn', 'swap', 'twisterInUp', 'twisterInDown', 'vanishIn', 'swashIn'];
	var _AnimateOutData = ['openDownLeftOut', 'spaceOutUp', 'spaceOutLeft', 'spaceOutRight', 'spaceOutDown', 'boingOutDown', 'bombRightOut', 'bombLeftOut', 'tinUpOut', 'tinLeftOut', 'tinRightOut', 'tinDownOut', 'holeOut', 'foolishOut', 'swashOut', 'puffOut', 'rotateUp', 'rotateLeft', 'rotateRight', 'rotateDown', 'slideUp', 'slideLeft', 'slideRight', 'slideDown', 'vanishOut'];
	var _AnimateInSub = function(_this){
		_this.removeClass("magicslidertime");
		_this.addClass("magicslidertime");
		_this.fadeIn();
		for(i = 0; i <= _AnimateOutData.length; i++){
			_this.removeClass(_AnimateOutData[i]);
		}
		for(i = 0; i <= _AnimateInData.length; i++){
			_this.removeClass(_AnimateInData[i]);
		}
		var _ran = Math.floor((Math.random() * _AnimateInData.length));
		_this.addClass(_AnimateInData[_ran]);
	}
	var _AnimateIn = function(_this){
		_this.removeClass("magicslidertime");
		_this.addClass("magicslidertime");
		_this.fadeIn();
		for(i = 0; i <= _AnimateOutData.length; i++){
			_this.removeClass(_AnimateOutData[i]);
		}
		for(i = 0; i <= _AnimateInData.length; i++){
			_this.removeClass(_AnimateInData[i]);
		}
		var _ran = Math.floor((Math.random() * _AnimateInData.length));
		_this.addClass(_AnimateInData[_ran]);
		_this.addClass("current");
		_this.find(".x-slider-sub-item").hide();
		var _delay = Math.floor((Math.random() * 10) + 1);
		if(_delay < 5){
			_delay = 5;
		}
		_delay *= 100;
		var _i = 1;
		_this.find(".x-slider-sub-item").each(function(){
			$(this).delay(_i*_delay).fadeIn();
			_AnimateInSub($(this));
			_i++;
		});
	}
	var _AnimateOut = function(_this){
		for(i = 0; i <= _AnimateOutData.length; i++){
			_this.removeClass(_AnimateOutData[i]);
		}
		for(i = 0; i <= _AnimateInData.length; i++){
			_this.removeClass(_AnimateInData[i]);
		}
		var _ran = Math.floor((Math.random() * _AnimateOutData.length));
		_this.addClass(_AnimateOutData[_ran]);
		_this.fadeOut();
		_this.removeClass("current");
	}
	var _ResetSliderSize = function(_this){
		var _SliderWidth = _this.width();
		var _SliderHeight = _SliderWidth * 5 / 8;
		_this.css({"height": _SliderHeight});
		_this.find(".x-slider-sub-item").each(function(){
			var _Top = parseInt($(this).attr("data-top"));
			var _Left = parseInt($(this).attr("data-left"));
			var _Width = parseInt($(this).attr("data-width"));
			var _Height = parseInt($(this).attr("data-height"));
			var _NewTop = parseInt(_Top * _SliderHeight / 500);
			var _NewLeft = parseInt(_Left * _SliderWidth / 800);
			var _NewWidth = parseInt(_Width * _SliderWidth / 800);
			var _NewHeight = parseInt(_Height * _SliderHeight / 500);
			$(this).css({"top": _NewTop + "px", "left": _NewLeft + "px", "width": _NewWidth + "px", "height": _NewHeight + "px",})
		})
	}
	$(".x-slider").each(function(){
		_ResetSliderSize($(this));
	})
	$(window).resize(function(){
		$(".x-slider").each(function(){
			_ResetSliderSize($(this));
		})
	})
	$.fn.XSlider = function(){
		return this.each(function(){
			$(this).XSliderThis();
		});
	}
	$.fn.XSliderThis = function(){
		var _SliderWidth = this.width();
		var _SliderHeight = _SliderWidth * 5 / 8;
		this.css({"height": _SliderHeight});
		var _Counter = this.find(".slider").find(".x-item").length;
		//set attributes
		var _tmp = 1;
		this.find(".slider").find(".x-item").each(function(){
			$(this).addClass("item-"+_tmp).attr({"data": _tmp});
			_tmp ++;
		})
		//append nav
		var _ExHtml = "";
		for(_tmp = 1; _tmp <= _Counter; _tmp ++){
			_ExHtml += "<span class='xbtn' data='"+_tmp+"'></span>";
		}
		this.find(".slider").find(".x-item").hide();
		this.find(".slider").find(".x-item").first().addClass("current").show();
		this.find(".nav-btn").html(_ExHtml);
		this.find(".nav-btn").find(".xbtn").first().addClass("active");
		_this = this;
		function LoopMaster(_this){
			var _LoopTime = Math.floor((Math.random() * 10) + 1);
			if(_LoopTime < 5){
				_LoopTime = 5;
			}
			_LoopTime *= 1000;
			setInterval(function(){
				var _Num = parseInt(_this.find(".current").attr("data"));
				var _Next = _Num + 1;
				var _Max =  _this.find(".slider").find(".x-item").length;
				if(_Next > _Max){
					_Next = 1;
				}
				_NavContent(_this, _Next);
			},_LoopTime);
		}
		LoopMaster(_this);
	}
	
	$(document).on("click", ".x-slider .nav-btn .xbtn", function(e){
		e.preventDefault();
		var _Num = $(this).attr("data");
		$(this).parent().parent().find(".nav-btn").find(".xbtn").removeClass("active");
		$(this).addClass("active");
		_AnimateOut($(this).parent().parent().find(".current"));
		_AnimateIn($(this).parent().parent().find(".item-"+_Num));
	})
	
	var _NavContent = function(_this, val){
		_this.find(".nav-btn").find(".xbtn").removeClass("active");
		_this.find(".nav-btn").find(".xbtn").each(function(){
			var _test = $(this).attr("data");
			if(_test == val){
				$(this).addClass("active");
			}
		})
		_AnimateOut(_this.find(".current"));
		_AnimateIn(_this.find(".item-"+val));
	}
	
	$(document).on("click", ".x-slider .x-btn .act", function(e){
		e.preventDefault();
		var _Num = parseInt($(this).parent().parent().find(".current").attr("data"));
		var _Next = _Num + 1;
		var _Prev = _Num - 1;
		var _Max =  $(this).parent().parent().find(".slider").find(".x-item").length;
		if(_Next > _Max){
			_Next = 1;
		}
		if(_Prev < 1){
			_Prev = _Max;
		}
		if($(this).hasClass("next")){
			_NavContent($(this).parent().parent(), _Next);
		}
		if($(this).hasClass("prev")){
			_NavContent($(this).parent().parent(), _Prev);
		}
	})
	
	$(".x-slider").XSlider();
})