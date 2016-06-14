$(function(){
	//save info config
	$(document).on("click", ".save-info-config .save", function(e){
		e.preventDefault();
		$(this).html("<i class='fa fa-cog fa-spin'></i> Save");
		var _Link = $(this).attr("data");
		var _PageName = $(".admin-config-info").find(".config_pagename").val();
		var _Company = $(".admin-config-info").find(".config_company").val();
		var _Email = $(".admin-config-info").find(".config_email").val();
		var _Phone = $(".admin-config-info").find(".config_phone").val();
		var _Blog = $(".admin-config-info").find(".config_blog").val();
		$.ajax({
			method: "POST",
			url: _Link+"?site=admin&page=config&action=ajax&sub_act=saveconfig_info",
			data: {pagename: _PageName, company: _Company, email: _Email, phone: _Phone, blog: _Blog}
		}).done(function() {
			$(".save-info-config").find(".save").html("<i class='fa fa-check'></i> Save");
		});
	})
})