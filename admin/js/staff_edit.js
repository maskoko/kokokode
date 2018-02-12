$(document).ready(function() { 	

	/* $("#admin_form").validate({
	  jml_jam: {
		field: {
		  required: true,
		  number: true
		}
	  }
	}); */

	//$('#lembagaid').select2({placeholder: "Select"});	
	
	if($('#tgl_lahir').length) {
		$("#tgl_lahir").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#tmt').length) {
		$("#tmt").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#tmtin').length) {
		$("#tmtin").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#rjabatan_tmt').length) {
		$("#rjabatan_tmt").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#rjabatan_akhir_tmt').length) {
		$("#rjabatan_akhir_tmt").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	
		
});