	 $(document).ready(function(){
		 
		/* Jl. Pesantren Cimahi */ 
		$("#gmap-1").gmap3({ 
		    action:'init',
			options:{
				center:[-6.87544, 107.56304],
				zoom: 15
				}
			},
			{ 
				action: 'addMarker',
				latLng:[-6.87544, 107.56304]
			}
		);
		
	 });
