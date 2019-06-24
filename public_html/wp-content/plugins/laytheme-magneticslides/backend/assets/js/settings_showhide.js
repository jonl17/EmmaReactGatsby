var ms_showhide_settings = (function(){
	var stateMap = {
		slideOnPageClick: null,
		direction: null,
		navigationActive: null
	};

	var initModule = function(){
		stateMap.navigationActive = jQuery('#ms_navigation').is(':checked');
		stateMap.direction = jQuery('#ms_direction').val();
		stateMap.slideOnPageClick = jQuery('#ms_slideonclick').is(':checked');

		showhide_for_scrolling_direction();
		jQuery('#ms_direction').on('change', showhide_for_scrolling_direction);

		showhide_for_show_navigation();
		jQuery('#ms_navigation').on('change', showhide_for_show_navigation);

		showhide_for_slideonpageclick();
		jQuery('#ms_slideonclick').on('change', showhide_for_slideonpageclick);
		jQuery('#ms_direction').on('change', showhide_for_slideonpageclick);

		jQuery('#ms_fit_browser').on('change', showhide_for_dofit);
		showhide_for_dofit();
	};

	var showhide_for_dofit = function(){
		var dofit = jQuery('#ms_fit_browser').is(':checked');
		if(dofit){
			jQuery(document.getElementById("ms_fit_browser_maxdim").parentNode.parentNode).show();
		}
		else{
			jQuery(document.getElementById("ms_fit_browser_maxdim").parentNode.parentNode).hide();
		}
	};

	var showhide_for_scrolling_direction = function(){
		stateMap.direction = jQuery('#ms_direction').val();
		var hideWhenHorizontal = ['ms_scrollBar', 'ms_autoScrolling', 'ms_continuousVertical', 'ms_navigation_position'];
		var showWhenHorizontal = ['ms_continuousHorizontal'];

		var i;
		if(stateMap.direction == "vertical"){
			for(i=0; i<hideWhenHorizontal.length; i++){
				jQuery(document.getElementById(hideWhenHorizontal[i]).parentNode.parentNode).show();
			}
			for(i=0; i<showWhenHorizontal.length; i++){
				jQuery(document.getElementById(showWhenHorizontal[i]).parentNode.parentNode).hide();
			}

			stateMap.navigationActive = jQuery('#ms_navigation').is(':checked');
			if(!stateMap.navigationActive){
				jQuery(document.getElementById("ms_navigation_position").parentNode.parentNode).hide();
			}
		}
		else{
			// horizontal
			for(i=0; i<hideWhenHorizontal.length; i++){
				jQuery(document.getElementById(hideWhenHorizontal[i]).parentNode.parentNode).hide();
			}
			for(i=0; i<showWhenHorizontal.length; i++){
				jQuery(document.getElementById(showWhenHorizontal[i]).parentNode.parentNode).show();
			}
		}
	};

	var showhide_for_slideonpageclick = function(){
		stateMap.slideOnPageClick = jQuery('#ms_slideonclick').is(':checked');

		var toHide = ['ms_arrowup', 'ms_arrowdown', 'ms_arrowleft', 'ms_arrowright'];
		var verticalArrows = ['ms_arrowup', 'ms_arrowdown'];
		var horizontalArrows = ['ms_arrowleft', 'ms_arrowright'];

		var i;
		if(!stateMap.slideOnPageClick){
			for(i=0; i<toHide.length; i++){
				jQuery(document.getElementById(toHide[i]).parentNode.parentNode).hide();
			}
		}
		else{
			if(stateMap.direction == "horizontal"){
				for(i=0; i<verticalArrows.length; i++){
					jQuery(document.getElementById(verticalArrows[i]).parentNode.parentNode).hide();
				}
				for(i=0; i<horizontalArrows.length; i++){
					jQuery(document.getElementById(horizontalArrows[i]).parentNode.parentNode).show();
				}
			}
			else if(stateMap.direction == "vertical"){
				for(i=0; i<verticalArrows.length; i++){
					jQuery(document.getElementById(verticalArrows[i]).parentNode.parentNode).show();
				}
				for(i=0; i<horizontalArrows.length; i++){
					jQuery(document.getElementById(horizontalArrows[i]).parentNode.parentNode).hide();
				}				
			}
		}
	};

	var showhide_for_show_navigation = function(){
		stateMap.navigationActive = jQuery('#ms_navigation').is(':checked');

		var hideWhenNoNavigation = ['ms_navigation_space_around_in', 'ms_navigation_space_around', 'ms_navigation_space_between_circles', 'ms_navigation_position']
		
		var i;
		if(stateMap.navigationActive){
			for(i=0; i<hideWhenNoNavigation.length; i++){
				jQuery(document.getElementById(hideWhenNoNavigation[i]).parentNode.parentNode).show();
			}
			if(stateMap.direction == "horizontal"){
				jQuery(document.getElementById("ms_navigation_position").parentNode.parentNode).hide();
			}
		}
		else{
			// horizontal
			for(i=0; i<hideWhenNoNavigation.length; i++){
				jQuery(document.getElementById(hideWhenNoNavigation[i]).parentNode.parentNode).hide();
			}
		}
	};

	return {
		initModule : initModule
	}
}());

jQuery(document).ready(function(){
	ms_showhide_settings.initModule();
});