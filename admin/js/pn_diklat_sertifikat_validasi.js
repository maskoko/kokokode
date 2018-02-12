$(document).ready(function() { 	

	 $("#ptk_form").validate();
	
	//------------- Datepicker -------------//
	if($('#tgl_lahir').length) {
		$("#tgl_lahir").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}

		
	
});