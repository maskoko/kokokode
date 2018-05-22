$(document).ready(function() { 	

	/* $("#admin_form").validate({
	  jml_jam: {
		field: {
		  required: true,
		  number: true
		}
	  }
	}); */


	//------------- Combined picker -------------//
	if($('#reg_undang').length) {
		$('#reg_undang').datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}
	
	//------------- Datepicker -------------//
	if($('#reg_ulang').length) {
		$("#reg_ulang").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	
	
	
});