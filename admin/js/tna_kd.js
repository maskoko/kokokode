$(function() {
	
	 $("#admin_form").validate({
	  rules: {
		kdindex: {
		  required: true,
		  number: true
		}
	  }
	});

});