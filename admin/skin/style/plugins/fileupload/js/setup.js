$(document).ready(function() {
	$('#input1').filer();
	
	$('.file_input').filer({
		showThumbs: true,
		templates: {
			box: '<ul class="jFiler-item-list"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: true,
			removeConfirmation: true,
			_selectors: {
				list: '.jFiler-item-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action',
			}
		},
		addMore: true,
		files: [{
			name: "appended_file.jpg",
			size: 5453,
			type: "image/jpg",
			file: "http://dummyimage.com/158x113/f9f9f9/191a1a.jpg",
		},{
			name: "appended_file_2.png",
			size: 9503,
			type: "image/png",
			file: "http://dummyimage.com/158x113/f9f9f9/191a1a.png",
		}]
	});
	
	$('#dropdrag-upload').filer({
		limit: null,
		maxSize: null,
		extensions: null,
		changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
		showThumbs: true,
		appendTo: null,
		theme: "dragdropbox",
		templates: {
			box: '<ul class="jFiler-item-list"></ul>',
			item: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<li>{{fi-progressBar}}</li>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			itemAppend: '<li class="jFiler-item">\
						<div class="jFiler-item-container">\
							<div class="jFiler-item-inner">\
								<div class="jFiler-item-thumb">\
									<div class="jFiler-item-status"></div>\
									<div class="jFiler-item-info">\
										<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
									</div>\
									{{fi-image}}\
								</div>\
								<div class="jFiler-item-assets jFiler-row">\
									<ul class="list-inline pull-left">\
										<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
									</ul>\
									<ul class="list-inline pull-right">\
										<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
									</ul>\
								</div>\
							</div>\
						</div>\
					</li>',
			progressBar: '<div class="bar"></div>',
			itemAppendToEnd: false,
			removeConfirmation: false,
			_selectors: {
				list: '.jFiler-item-list',
				item: '.jFiler-item',
				progressBar: '.bar',
				remove: '.jFiler-item-trash-action',
			}
		},
		uploadFile: {
			url: $("#w-attachment-upload").attr("data") + "?site=admin&page=attachment&action=upload_image",
			data: {},
			type: 'POST',
			enctype: 'multipart/form-data',
			beforeSend: function(){},
			success: function(data, el){
				var parent = el.find(".jFiler-jProgressBar").parent();
				data = JSON.parse(data);
				if(data.status == "success"){
					el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
						$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
					});
					$(".w-attachment-im-btn-nav").addClass("upload-success-must-reload");
					$(".webdata-progressbar").find(".progress-bar").attr({"aria-valuenow": data.percent}).css({"width": data.percent+"%"}).html(data.percent+"%");
					$(".webdata-used").find(".usedval").html(data.used);
					$(".webdata-used").find(".percentage").html(data.percent+"%");
					$(".webdata-used").find(".totalval").html(data.total);
					if(data.percent < 50){
						$(".webdata-progressbar").find(".progress-bar").css({"background-color": "green"});
					}
					if(data.percent >= 50 && data.percent <= 90){
						$(".webdata-progressbar").find(".progress-bar").css({"background-color": "orange"});
					}
					if(data.percent > 90){
						$(".webdata-progressbar").find(".progress-bar").css({"background-color": "red"});
					}
				}else{
					el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
						$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
					});
				}
			},
			error: function(el){
				var parent = el.find(".jFiler-jProgressBar").parent();
				el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
					$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
				});
			},
			statusCode: {},
			onProgress: function(){},
		},
		dragDrop: {
			dragEnter: function(){},
			dragLeave: function(){},
			drop: function(){},
		},
		addMore: true,
		clipBoardPaste: true,
		excludeName: null,
		beforeShow: function(){return true},
		onSelect: function(){},
		afterShow: function(){},
		onRemove: function(){},
		onEmpty: function(){},
		captions: {
			button: "Choose Files",
			feedback: "Choose files To Upload",
			feedback2: "files were chosen",
			drop: "Drop file here to Upload",
			removeConfirmation: "Are you sure you want to remove this file?",
			errors: {
				filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
				filesType: "Only Images are allowed to be uploaded.",
				filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
				filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
			}
		}
	});
});