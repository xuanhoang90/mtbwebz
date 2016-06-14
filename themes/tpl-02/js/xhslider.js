$(function(){
	//slider auto play
	setInterval(function(){
		$(".tpl-01-block-post-list").each(function(){
			if($(this).hasClass("tpl-01-block-post-list-large")){
				var _CurrentSlider = $(this).find(".x-nav-btn-slider").find(".active").attr("data");
				var _MaxSlider = $(this).find(".list-post").children().length;
				if(_CurrentSlider < _MaxSlider){
					_CurrentSlider ++;
				}else{
					_CurrentSlider = 1;
				}
				$(this).find(".one-post").hide();
				$(this).find(".post-" + _CurrentSlider).fadeIn(1000);
				$(this).find(".slider-btn-switch").removeClass("active").each(function(){
					var _tmp = $(this).attr("data");
					if(_tmp == _CurrentSlider){
						$(this).addClass("active");
					}
				});
			}
		})
	}, 10000);
	//slider button event
	$(document).on("click",".slider-btn-switch", function(e){
		e.preventDefault();
		var _CurrentSlider = $(this).attr("data");
		var _Parent = $(this).parent().parent();
		var _MaxSlider = _Parent.find(".list-post").children().length;
		if(_CurrentSlider < _MaxSlider){
			_CurrentSlider ++;
		}else{
			_CurrentSlider = 1;
		}
		_Parent.find(".one-post").hide();
		_Parent.find(".post-" + _CurrentSlider).fadeIn(500);
		_Parent.find(".slider-btn-switch").removeClass("active");
		$(this).addClass("active");
	})
})