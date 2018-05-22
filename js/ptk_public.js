$(document).ready(function() { 	

        // -- filter --
        $("#filter_form").validate({

            rules: {
                        searchtext: {
                                minlength: 4,
                                maxlength: 50
                        }
            },
            messages: {
                        required: "Silahkan isi!",
                        searchtext: {
                                minlength: "Silahkan isi minimal 4 karakter!"
                        }
            }            
        });

});