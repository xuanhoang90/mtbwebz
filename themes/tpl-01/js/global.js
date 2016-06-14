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