$(document).ready(function() { 	

	/* $("#admin_form").validate({
	  jml_jam: {
		field: {
		  required: true,
		  number: true
		}
	  }
	}); */

	$('#sekolahid').select2({placeholder: "Select"});	
	
	if($('#tgl_lahir').length) {
		$("#tgl_lahir").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#tmt_pns').length) {
		$("#tmt_pns").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#tmt_pendidik').length) {
		$("#tmt_pendidik").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#tmt_sekolah').length) {
		$("#tmt_sekolah").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	

	if($('#tmt_kepalasekolah').length) {
		$("#tmt_kepalasekolah").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1
                });
	}	
		
});