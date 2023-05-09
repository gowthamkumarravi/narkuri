var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
				lat: lat,
				lng: lng
			  });
			   
			   var marker = map.addMarker({
		            lat: lat,
					lng: lng,
		            title: title,
		            infoWindow: {
		                content: add
		            }
		        });

			   marker.infoWindow.open(map, marker);
			  
			});
			//alert('active');
			
        }
    };

}();