$(document).ready(function() { 	

	if($('#tgl_dari').length) {
		$("#tgl_dari").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1,
                    onSelect: function( selectedDate ) {
                        $( "#tgl_sampai" ).datepicker( "option", "minDate", selectedDate );			
                    }
                });
	}

	if($('#tgl_sampai').length) {
		$("#tgl_sampai").datepicker({
                    dateFormat: "dd/mm/yy",
                    defaultDate: "+1w",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1,
                    onSelect: function( selectedDate ) {
                        $( "#tgl_dari" ).datepicker( "option", "maxDate", selectedDate );
                    }			
                });
	}
		
});