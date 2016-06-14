	$(document).ready(function(e) {
        $('.dale-main-menu').parent().parent().parent().parent().parent().parent().scrollToFixed();
    });
	
	
	//append service icon
	$(function(){
		$(".append-paw").find("h3").before("<div class='service-list-col1'><i class='fa fa-paw'></i></div>");
		$(".append-gear").find("h3").before("<div class='service-list-col1'><i class='fa fa-gear'></i></div>");
		$(".append-apple").find("h3").before("<div class='service-list-col1'><i class='fa fa-apple'></i></div>");
		$(".append-medkit").find("h3").before("<div class='service-list-col1'><i class='fa fa-medkit'></i></div>");
		$(".quote-right").find("h3").before("<i class='fa fa-quote-right'></i>");
		
		$(".append-magic").find("h3").before("<div class='service-list-col1'><i class='fa fa-magic'></i></div>");
		$(".append-gift").find("h3").before("<div class='service-list-col1'><i class='fa fa-gift'></i></div>");
		$(".append-dashboard").find("h3").before("<div class='service-list-col1'><i class='fa fa-dashboard'></i></div>");
		
		var _tmp = $(".service-append-gear").find("h1").html();
		$(".service-append-gear").find("h1").html("<i class='fa fa-gear'></i> " + _tmp);
		
		var _tmp = $(".service-append-pencil").find("h1").html();
		$(".service-append-pencil").find("h1").html("<i class='fa fa-pencil'></i> " + _tmp);
		
		var _tmp = $(".service-append-rocket").find("h1").html();
		$(".service-append-rocket").find("h1").html("<i class='fa fa-rocket'></i> " + _tmp);
		
		$(".service-append-trophy").find("h3").before("<i class='fa fa-trophy'></i>");
		$(".service-append-eye").find("h3").before("<i class='fa fa-eye'></i>");
		$(".service-append-flask").find("h3").before("<i class='fa fa-flask'></i>");
		$(".service-append-expand").find("h3").before("<i class='fa fa-expand'></i>");
		$(".service-append-bug").find("h3").before("<i class='fa fa-bug'></i>");
		$(".service-append-coffee").find("h3").before("<i class='fa fa-coffee'></i>");
		
		var _tmp = $(".append-twitter-square").find("h3").html();
		$(".append-twitter-square").find("h3").html("<i class='fa fa-twitter-square'></i> " + _tmp);
		
		var _tmp = $(".append-rocket").find("h3").html();
		$(".append-rocket").find("h3").html("<i class='fa fa-rocket'></i> " + _tmp);
		
		var _tmp = $(".append-rss").find("h3").html();
		$(".append-rss").find("h3").html("<i class='fa fa-rss'></i> " + _tmp);
		
		
		$(".dale-footer-top").parent().parent().parent().parent().parent().parent().addClass("x-bg-parallax").attr({"data-stellar-background-ratio":"0.3"});
		$(".x-bg-parallax").find(".row").first().before("<div class='dale-footer-faker-bg'></div>");
		
		var _HeightOffset = $(".dale-footer-top").height();
		$(".dale-footer-faker-bg").css({"top": _HeightOffset + 150});
		
		$(".dale-block-present").parent().parent().parent().parent().parent().parent().attr({"data-stellar-background-ratio":"0.4"});
		
		$(window).stellar();
	})
	
	//dale: append search box
	$(function(){
		$(".dale-main-menu").find(".dale-search-item").find(".fa-search").click(function(e){
			e.preventDefault();
			$(".dale-main-menu").find(".dale-search-item").find(".fa-times").show();
			$(".dale-main-menu").find(".dale-search-item").find(".fa-search").hide();
			$(".dale-main-menu").find(".search-field").show();
		});
		$(".dale-main-menu").find(".dale-search-item").find(".fa-times").click(function(e){
			e.preventDefault();
			$(".dale-main-menu").find(".dale-search-item").find(".fa-times").hide();
			$(".dale-main-menu").find(".dale-search-item").find(".fa-search").show();
			$(".dale-main-menu").find(".search-field").hide();
		});
	})
$(function(){
	function initialize() {
	  var mapProp = {
		center:new google.maps.LatLng($("#googleMap").attr("data-lat"),$("#googleMap").attr("data-log")),
		zoom:$("#googleMap").attr("data-zoom"),
		mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
	}
	google.maps.event.addDomListener(window, 'load', initialize);
})