$(document).ready(function() { 	

	$("#admin_form").validate({
	  rules: {
		jml_jam: {
		  required: true,
		  number: true
		}
	  }
	});

});