jQuery(function(){
	jQuery(".kirjautuminen form").append(jQuery(".kirjautuminen #wp-submit"));
	jQuery(".kirjautuminen #forgotText").insertAfter(jQuery(".kirjautuminen form"));
	jQuery(".kirjautuminen form a").insertAfter(jQuery(".kirjautuminen form"));
	jQuery(".kirjautuminen form").append(jQuery(".kirjautuminen #forgotText"));
	
	jQuery("#postbox").css("display", "none");
	jQuery("#avaa_postbox").on("click", function(){
		if (jQuery("#postbox").css("display") == "none") {
			jQuery("#postbox").css("display", "block");
		} else {
			jQuery("#postbox").css("display", "none");
		}
	});
	jQuery("#mobilevalikko").on("click", function(){
		if (jQuery("#sidebar").css("display") == "none") {
			jQuery("#mobilevalikko").css("background", "#ddd");
			jQuery("#sidebar").css("display", "block");
		} else {
			jQuery("#mobilevalikko").css("background", "transparent");
			jQuery("#sidebar").css("display", "none");
		}
	});
		
	jQuery(".aiherivi").click(function(){
		window.location.href = jQuery(this).find("a").attr("href");
	});
	
	jQuery(".activity-inner a").attr("target", "_blank");
	jQuery('.activity-read-more a').attr("target", "_self");
	
	//jQuery('.plus-group-header').insertAfter( ".proksi-group-desc" );
	//jQuery('.gtags-header').insertAfter( ".proksi-group-desc" );
	//jQuery('.proksi-group-desc').jTruncate();
	


});


jQuery(window).resize(function() {
		if (jQuery("#mobilevalikko").css("display") == "none") {
			jQuery("#sidebar").css("display", "block");
		}
		if (jQuery("#mobilevalikko").css("display") == "block") {
			jQuery("#sidebar").css("display", "none");
		}
	});