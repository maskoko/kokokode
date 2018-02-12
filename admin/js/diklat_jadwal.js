$(document).ready(function() { 	

	/* $("#admin_form").validate({
	  jml_jam: {
		field: {
		  required: true,
		  number: true
		}
	  }
	}); */

	if($('#jadwal_tgl_dari').length) {
		$("#jadwal_tgl_dari").datepicker({
			dateFormat: "dd/mm/yy",
                        defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        onSelect: function( selectedDate ) {
                            $( "#jadwal_tgl_sampai" ).datepicker( "option", "minDate", selectedDate );			
                        }
                });
	}

	if($('#jadwal_tgl_sampai').length) {
		$("#jadwal_tgl_sampai").datepicker({
			dateFormat: "dd/mm/yy",
                        defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        onSelect: function( selectedDate ) {
                            $( "#jadwal_tgl_dari" ).datepicker( "option", "maxDate", selectedDate );
                        }			
                });
	}	
	
	$('#diklatid').select2({placeholder: "Select"});	
	
	if($('#tgl_mulai').length) {
		$("#tgl_mulai").datepicker({
			dateFormat: "dd/mm/yy",
                        defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        onSelect: function( selectedDate ) {
                            $( "#tgl_akhir" ).datepicker( "option", "minDate", selectedDate );			
                        }
                });
	}

	if($('#tgl_akhir').length) {
		$("#tgl_akhir").datepicker({
			dateFormat: "dd/mm/yy",
                        defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        onSelect: function( selectedDate ) {
                            $( "#tgl_mulai" ).datepicker( "option", "maxDate", selectedDate );
                        }			
                });
	}

	if($('#reg_mulai').length) {
		$("#reg_mulai").datepicker({
			dateFormat: "dd/mm/yy",
                        defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        onSelect: function( selectedDate ) {
                            $( "#reg_akhir" ).datepicker( "option", "minDate", selectedDate );			
                        }
                });
	}

	if($('#reg_akhir').length) {
		$("#reg_akhir").datepicker({
			dateFormat: "dd/mm/yy",
                        defaultDate: "+1w",
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        onSelect: function( selectedDate ) {
                            $( "#reg_mulai" ).datepicker( "option", "maxDate", selectedDate );
                        }			
                });
	}
	
	
});