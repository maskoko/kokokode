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
	
	
});