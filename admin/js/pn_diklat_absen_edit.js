$(document).ready(function() { 	

	/* $("#admin_form").validate({
	  jml_jam: {
		field: {
		  required: true,
		  number: true
		}
	  }
	}); */

	
	//------------- Datepicker -------------//
	if($('#tanggal').length) {
		$("#tanggal").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}

	//------------- Time entry (picker) -------------//
	$('#waktu').timeEntry({
		show24Hours: true,
		spinnerImage: ''
	});

	
});