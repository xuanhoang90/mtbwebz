	$(document).ready(function(e) {
        $('.menu-header-with-logo').parent().scrollToFixed();
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