function url_slug(s, opt) {
	s = String(s);
	opt = Object(opt);
	
	var defaults = {
		'delimiter': '-',
		'limit': undefined,
		'lowercase': true,
		'replacements': {},
		'transliterate': (typeof(XRegExp) === 'undefined') ? true : false
	};
	
	// Merge options
	for (var k in defaults) {
		if (!opt.hasOwnProperty(k)) {
			opt[k] = defaults[k];
		}
	}
	
	var char_map = {
		// Latin
		'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C', 
		'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I', 
		'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O', 
		'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH', 
		'ß': 'ss',
		'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c', 
		'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i', 
		'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o', 
		'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th', 
		'ÿ': 'y',

		// Latin symbols
		'©': '(c)',

		// Greek
		'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
		'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
		'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
		'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
		'Ϋ': 'Y',
		'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
		'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
		'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
		'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
		'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

		// Turkish
		'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
		'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g', 

		// Russian
		'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
		'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
		'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
		'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
		'Я': 'Ya',
		'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
		'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
		'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
		'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
		'я': 'ya',

		// Ukrainian
		'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
		'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

		// Czech
		'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U', 
		'Ž': 'Z', 
		'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
		'ž': 'z', 

		// Polish
		'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z', 
		'Ż': 'Z', 
		'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
		'ż': 'z',

		// Latvian
		'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N', 
		'Š': 'S', 'Ū': 'u', 'Ž': 'Z', 
		'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
		'š': 's', 'ū': 'u', 'ž': 'z',
		
		//add by XH
		'đ': 'd', 'ế': 'e', 'ố': 'o', 'ạ': 'a', 'ụ':'u', 'ă' :'a', 'ơ': 'o', 'ư': 'u',
		'ả':'a', 'ỏ':'o', 'ẻ':'e', 'ủ':'u', 'ỉ': 'i', 'ẽ':'e', 'ũ':'u', 'ĩ':'i', 'õ':'o', 'ã': 'a',
		'ầ':'a', 'ề':'e', 'ồ':'o','ừ':'u', 'ự': 'u', 'ỳ':'y',
	};
	
	// Make custom replacements
	for (var k in opt.replacements) {
		s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
	}
	
	// Transliterate characters to ASCII
	if (opt.transliterate) {
		for (var k in char_map) {
			s = s.replace(RegExp(k, 'g'), char_map[k]);
		}
	}
	
	// Replace non-alphanumeric characters with our delimiter
	var alnum = (typeof(XRegExp) === 'undefined') ? RegExp('[^a-z0-9]+', 'ig') : XRegExp('[^\\p{L}\\p{N}]+', 'ig');
	s = s.replace(alnum, opt.delimiter);
	
	// Remove duplicate delimiters
	s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);
	
	// Truncate slug to max. characters
	s = s.substring(0, opt.limit);
	
	// Remove delimiter from ends
	s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');
	
	return opt.lowercase ? s.toLowerCase() : s;
}
$(function(){
	//start
	var _CurrentLang = $(".object_editor_lang_selected").val();
	$(".x_obj_input").hide();
	$(".x_obj_input_"+_CurrentLang).fadeIn(200);
	$(document).on("change", ".object_editor_lang_selected", function(){
		_CurrentLang = $(".object_editor_lang_selected").val();
		$(".x_obj_input").hide();
		$(".x_obj_input_"+_CurrentLang).show();
	})
	$(document).on("keyup", ".object_data_name", function(){
		var _CurrentLang = $(".object_editor_lang_selected").val();
		var _Slug = url_slug($(this).val());
		$("#object_data_"+_CurrentLang+"_nice_url").val(_Slug);
		$(".object_link_preview_"+_CurrentLang).find(".nice_url_preview").html(_Slug);
	})
	$(document).on("keyup", ".object_data_nice_url", function(){
		var _CurrentLang = $(".object_editor_lang_selected").val();
		var _Slug = url_slug($(this).val());
		$(this).val(_Slug);
		$(".object_link_preview_"+_CurrentLang).find(".nice_url_preview").html(_Slug);
	})
	$(document).on("change", ".object_data_tag", function(){
		var _CurrentLang = $(".object_editor_lang_selected").val();
		var _CurrentTags = $("#object_data_"+_CurrentLang+"_tag").val();
		var _Tmp = _CurrentTags.split(",");
		var _TagsSlug = "";
		_Tmp.forEach(function(entry){
			_TagsSlug += url_slug(entry) + ",";
		})
		$("#object_data_"+_CurrentLang+"_tag_slug").val(_TagsSlug);
	})
	/* $(document).on("keyup", ".object_data_tag", function(){
		var _CurrentLang = $(".object_editor_lang_selected").val();
		$("#x-tag-auto-complete").show();
		var _CurrentTags = $("#object_data_"+_CurrentLang+"_tag").val();
		$("#object_data_"+_CurrentLang+"_tag").attr({"data":_CurrentTags});
		var _Tmp = _CurrentTags.split(",");
		// alert(_Tmp[_Tmp.length-1]);
		var _AjaxLink = $("#object_data_"+_CurrentLang+"_tag").parent().parent().attr("data");
		$("#x-tag-auto-complete").html('<p class="tag-auto-complete-when-loading"><i class="fa fa-circle-o-notch fa-spin"></i> Loading ... </p>');
		$.ajax({
			method: "POST",
			url: _AjaxLink,
			data: {current_lang: _CurrentLang, tag_text: _Tmp[_Tmp.length-1]}
		}).done(function(data) {
			$("#x-tag-auto-complete").html(data);
		})
	})
	//hide auto-complete
	$(".object_data_tag").attr({"data":""});
	$(document).click(function(event) {
		var _CurrentLang = $(".object_editor_lang_selected").val();
		if(!$(event.target).closest('#x-tag-auto-complete').length) {
			if($('#x-tag-auto-complete').is(":visible")) {
				$('#x-tag-auto-complete').hide();
				var _ReturnTags = $("#object_data_"+_CurrentLang+"_tag").attr("data");
				$("#object_data_"+_CurrentLang+"_tag").attr({"data":""});
				$("#object_data_"+_CurrentLang+"_tag").val(_ReturnTags);
			}
		}        
	})
	$(document).on("mouseenter", "#x-tag-auto-complete .tag-item", function(){
		var _CurrentLang = $(".object_editor_lang_selected").val();
		var _CurrentTags = $("#object_data_"+_CurrentLang+"_tag").val();
		var _ExtTag = $(this).attr("data");
		var _Tmp = _CurrentTags.split(",");
		_Tmp[_Tmp.length-1] = _ExtTag;
		var _NewTags = _Tmp.join(",");
		$("#object_data_"+_CurrentLang+"_tag").val(_NewTags);
	})
	$(document).on("click", "#x-tag-auto-complete .tag-item", function(){
		var _CurrentLang = $(".object_editor_lang_selected").val();
		var _CurrentTags = $("#object_data_"+_CurrentLang+"_tag").val();
		var _ExtTag = $(this).attr("data");
		var _Tmp = _CurrentTags.split(",");
		_Tmp[_Tmp.length-1] = _ExtTag;
		var _NewTags = _Tmp.join(",") + ",";
		$("#object_data_"+_CurrentLang+"_tag").val(_NewTags).focus();
		$("#object_data_"+_CurrentLang+"_tag").attr({"data":_CurrentTags});
		$("#x-tag-auto-complete").hide();
	}) */
	//feild requied validate
	$(".object_action_btn").find(".save").click(function(e){
		var _Required = $(".object_data_1_name").val();
		if(_Required != ""){
			//ok submit
			//e.preventDefault();
			//console.log( $( "form" ).serializeArray() );
			/* $.ajax({
				method: "POST",
				url: "http://mtbweb.com/?site=admin&page=post&action=add_do",
				data: {data: $( "form" ).serializeArray()}
			}).done(function(data) {
				console.log(data);
			}) */
		}else{
			e.preventDefault();
			$(".object_editor_lang_selected").find(".dropdown-menu").find("li").first().find("a").click();
			$(".object_data_1_name").addClass("danger-status").attr({"placeholder":"This field is required at default language"});
		}
	})
	//#d2d6de
	$(".object_data_1_name").click(function(){
		$(this).removeClass("danger-status");
	})
})