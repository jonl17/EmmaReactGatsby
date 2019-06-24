tinymce.PluginManager.add('textformatsloader', function( editor ) {
	
	var jsonString = jQuery.trim(jQuery("#formatsmanager_json").val());
	if(typeof jsonString != "undefined" && jsonString != ""){
		var jsonObject = JSON.parse(jsonString);

		// create text formats css for tinymce iframe
		var i, defaultFormatIx;

		// first add "Default" Text Format
		for(var i in jsonObject){
			if(jsonObject[i].formatname == "Default"){
				defaultFormatIx = i;
				break;
			}
		}
		var fontsizemu = jsonObject[defaultFormatIx].fontsizemu;
		if(typeof fontsizemu == "undefined"){
			fontsizemu = 'px';
		}
		var textindent = jsonObject[defaultFormatIx].textindent;
		if(typeof textindent == "undefined"){
			textindent = '0';
		}

		var phone_fontsize = jsonObject[defaultFormatIx]['phone-fontsize'];
		if(typeof phone_fontsize == "undefined"){
			phone_fontsize = 16;
		}
		var phone_fontsizemu = jsonObject[defaultFormatIx]['phone-fontsizemu'];
		if(typeof phone_fontsizemu == "undefined"){
			phone_fontsizemu = 'px';
		}
		var phone_spacetop = jsonObject[defaultFormatIx]['phone-spacetop'];
		if(typeof phone_spacetop == "undefined"){
			phone_spacetop = 0;
		}
		var phone_spacebottom = jsonObject[defaultFormatIx]['phone-spacebottom'];
		if(typeof phone_spacebottom == "undefined"){
			phone_spacebottom = 20;
		}

		var phone_spacetopmu = jsonObject[defaultFormatIx]['phone-spacetopmu'];
		if(typeof phone_spacetopmu == "undefined"){
			phone_spacetopmu = 'px';
		}
		var phone_spacebottommu = jsonObject[defaultFormatIx]['phone-spacebottommu'];
		if(typeof phone_spacebottommu == "undefined"){
			phone_spacebottommu = 'px';
		}
		var spacetopmu = jsonObject[defaultFormatIx]['spacetopmu'];
		if(typeof spacetopmu == "undefined"){
			spacetopmu = 'px';
		}
		var spacebottommu = jsonObject[defaultFormatIx]['spacebottommu'];
		if(typeof spacebottommu == "undefined"){
			spacebottommu = 'px';
		}

		var caps = '';
		if( typeof jsonObject[defaultFormatIx]['caps'] != "undefined" && jsonObject[defaultFormatIx]['caps'] == true ){
			caps = 'text-transform:uppercase;';
		}else{
			caps = 'text-transform:none;';
		}
		var italic = '';
		if( typeof jsonObject[defaultFormatIx]['italic'] != "undefined" && jsonObject[defaultFormatIx]['italic'] == true ){
			italic = 'font-style:italic;';
		}else{
			italic = 'font-style:normal;';
		}
		var underline = '';
		if( typeof jsonObject[defaultFormatIx]['underline'] != "undefined" && jsonObject[defaultFormatIx]['underline'] == true ){
			underline = 'text-decoration:underline;';
		}else{
			underline = 'text-decoration:none;';
		}
		var borderbottom = '';
		if( typeof jsonObject[defaultFormatIx]['borderbottom'] != "undefined" && jsonObject[defaultFormatIx]['borderbottom'] == true ){
			borderbottom = 'border-bottom:1px solid;';
		}else{
			borderbottom = 'border-bottom:none;';
		}

		var css = String()
			+'body#tinymce{'
				+'font-family:'+jsonObject[defaultFormatIx].fontfamily+';'
				+'font-size:'+jsonObject[defaultFormatIx].fontsize+fontsizemu+';'
				+'color:'+jsonObject[defaultFormatIx].color+';'
				+'letter-spacing:'+jsonObject[defaultFormatIx].letterspacing+'em;'
				+'text-align:'+jsonObject[defaultFormatIx].textalign+';'
				+'font-weight:'+jsonObject[defaultFormatIx].fontweight+';'
				+caps+italic+borderbottom
			+'}'
			+'p{'
				+'margin:'+jsonObject[defaultFormatIx].spacetop+spacetopmu+' 0 '+jsonObject[defaultFormatIx].spacebottom+spacebottommu+' 0;'
				+'line-height:'+jsonObject[defaultFormatIx].lineheight+';'
				+'text-indent:'+textindent+'em;'
				+underline
			+'}';

		// phone default textformat
		css += String()
		+'body#tinymce.phone-textformats{'
			+'font-size:'+phone_fontsize+phone_fontsizemu+';'
		+'}'
		+'body#tinymce.phone-textformats p{'
			+'margin:'+phone_spacetop+phone_spacetopmu+' 0 '+phone_spacebottom+phone_spacebottommu+' 0;'
		+'}';

		// add all custom textformats
		for(i=0; i<jsonObject.length; i++){
			var fontsizemu = jsonObject[i].fontsizemu;
			if(typeof fontsizemu == "undefined"){
				fontsizemu = 'px';
			}
			var textindent = jsonObject[i].textindent;
			if(typeof textindent == "undefined"){
				textindent = '0';
			}

			var phone_fontsize = jsonObject[i]['phone-fontsize'];
			if(typeof phone_fontsize == "undefined"){
				phone_fontsize = 16;
			}
			var phone_fontsizemu = jsonObject[i]['phone-fontsizemu'];
			if(typeof phone_fontsizemu == "undefined"){
				phone_fontsizemu = 'px';
			}
			var phone_spacetop = jsonObject[i]['phone-spacetop'];
			if(typeof phone_spacetop == "undefined"){
				phone_spacetop = 0;
			}
			var phone_spacebottom = jsonObject[i]['phone-spacebottom'];
			if(typeof phone_spacebottom == "undefined"){
				phone_spacebottom = 20;
			}

			var phone_spacetopmu = jsonObject[i]['phone-spacetopmu'];
			if(typeof phone_spacetopmu == "undefined"){
				phone_spacetopmu = 'px';
			}
			var phone_spacebottommu = jsonObject[i]['phone-spacebottommu'];
			if(typeof phone_spacebottommu == "undefined"){
				phone_spacebottommu = 'px';
			}
			var spacetopmu = jsonObject[i]['spacetopmu'];
			if(typeof spacetopmu == "undefined"){
				spacetopmu = 'px';
			}
			var spacebottommu = jsonObject[i]['spacebottommu'];
			if(typeof spacebottommu == "undefined"){
				spacebottommu = 'px';
			}

			var caps = '';
			if( typeof jsonObject[i]['caps'] != "undefined" && jsonObject[i]['caps'] == true ){
				caps = 'text-transform:uppercase;';
			}else{
				caps = 'text-transform:none;';
			}
			var italic = '';
			if( typeof jsonObject[i]['italic'] != "undefined" && jsonObject[i]['italic'] == true ){
				italic = 'font-style:italic;';
			}else{
				italic = 'font-style:normal;';
			}
			var underline = '';
			if( typeof jsonObject[i]['underline'] != "undefined" && jsonObject[i]['underline'] == true ){
				underline = 'text-decoration:underline;';
			}else{
				underline = 'text-decoration:none;';
			}
			var borderbottom = '';
			if( typeof jsonObject[i]['borderbottom'] != "undefined" && jsonObject[i]['borderbottom'] == true ){
				borderbottom = 'border-bottom:1px solid;';
			}else{
				borderbottom = 'border-bottom:none;';
			}

			css += String()
			+'._'+jsonObject[i].formatname+'{'
				+'font-family:'+jsonObject[i].fontfamily+';'
				+'font-size:'+jsonObject[i].fontsize+fontsizemu+';'
				+'color:'+jsonObject[i].color+';'
				+'letter-spacing:'+jsonObject[i].letterspacing+'em;'
				+'margin-bottom:'+jsonObject[i].spacebottom+spacebottommu+';'
				+'margin-top:'+jsonObject[i].spacetop+spacetopmu+';'
				+'line-height:'+jsonObject[i].lineheight+';'
				+'text-align:'+jsonObject[i].textalign+';'
				+'font-weight:'+jsonObject[i].fontweight+';'
				+'text-indent:'+textindent+'em;'
				+caps+italic+borderbottom+underline
			+'}';

			// phone 
			css += String()
			+'body#tinymce.phone-textformats ._'+jsonObject[i].formatname+'{'
				+'font-size:'+phone_fontsize+phone_fontsizemu+';'
				+'margin-bottom:'+phone_spacebottom+phone_spacebottommu+';'
				+'margin-top:'+phone_spacetop+phone_spacetopmu+';'
			+'}';
		}

		editor.on('PreInit', function(e){
            editor.contentStyles.push(css);
        });
	}

} );