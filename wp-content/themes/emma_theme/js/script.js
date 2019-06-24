$(document).ready(function() {
    
	var worksDropDown = document.getElementsByClassName('works-dropdown')[0];
	var subMenu = document.getElementsByClassName('sub-menu')[0];
	$(worksDropDown).hover(function() {
		$(subMenu).css("display", "block");
	}, function() {
		$(subMenu).css("display", "none");
	})

	$("#enquire-form-close-btn").click(function() {
		$(".enquire-form-container").css("display", "none");
		$("#enquire-form-close-btn").css("display", "none");
	});
	$("#enquire-click-p").click(function() {
		$(".enquire-form-container").css("display", "flex");
		$("#enquire-form-close-btn").css("display", "block");
	})
    
});