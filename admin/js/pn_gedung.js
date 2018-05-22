$(function() {
	
	 $("#admin_form").validate({
	  rules: {
		jml_kamar: {
		  required: true,
		  number: true
		}
	  }
	});

});