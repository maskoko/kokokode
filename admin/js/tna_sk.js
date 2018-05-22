$(function() {
	
	 $("#admin_form").validate({
	  rules: {
		skindex: {
		  required: true,
		  number: true
		}
	  }
	});

});