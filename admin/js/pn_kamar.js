$(function() {
	
	 $("#admin_form").validate({
	  rules: {
		jml_bed: {
		  required: true,
		  number: true
		}
	  }
	});

});