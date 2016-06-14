{if $show_ggmap == "yes"}
	<div id="googleMap" style="width: auto;height:500px;"></div>
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script>
		function initialize(){
		  var mapProp = {
			center:new google.maps.LatLng({$ggmap_lat},{$ggmap_log}),
			zoom:{$ggmap_zoom},
			mapTypeId:google.maps.MapTypeId.ROADMAP
		  };
		  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
{/if}
{if $show_ctform == "yes"}
	<div class="contact-form">
		{if $contact_info}
			<div class="contact-info">
				<h1>Contact</h1>
				<div>
					<p>Company: {$contact_info.company}</p>
					<p>Email: {$contact_info.email}</p>
					<p>Hotline: {$contact_info.phone}</p>
				</div>
			</div>
		{/if}
		<form method="post">
			<div class="row form-group">
				<label class="control-label col-md-4" for="g_name">Your name: </label>
				<div class="col-md-8">
					<input type="text" class="form-control g_name" name="g_name" placeholder="Your name" value="" />
				</div>
			</div>
			<div class="row form-group">
				<label class="control-label col-md-4" for="g_email">Your email: </label>
				<div class="col-md-8">
					<input type="text" class="form-control g_email" name="g_email" placeholder="Your email" value="" />
				</div>
			</div>
			<div class="row form-group">
				<label class="control-label col-md-4" for="g_title">Title: </label>
				<div class="col-md-8">
					<input type="text" class="form-control g_title" name="g_title" placeholder="Title" value="" />
				</div>
			</div>
			<div class="row form-group">
				<label class="control-label col-md-4" for="g_content">Content: </label>
				<div class="col-md-8">
					<textarea name="editor" id="editor" style="width: 100%;" placeholder="Content"></textarea>
				</div>
			</div>
			<input type="submit" name="submit" value="Send" />
		</form>
	</div>
{/if}