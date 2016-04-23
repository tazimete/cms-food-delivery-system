!function ($) {

  $(function(){
		gmap_markers = new GMaps({
			el: '#gmap_marker',
			lat: 51.500902,
			lng: -0.124531,
			zoom: 2
		});
		gmap_markers.addMarker({
			lat: 51.500891,
			lng: -0.123347,
			title: 'Marker',
			infoWindow: {
				content: 'Info content here...'
			}
		});

		map = new GMaps({
			div: '#gmap_geocoding',
			lat: -12.043333,
			lng: -77.028333,
			zoom:3
		});
		$('#geocoding_form').submit(function(e){
			e.preventDefault();
			GMaps.geocode({
			  address: $('#address').val().trim(),
			  callback: function(results, status){
			    if(status=='OK'){
			      var latlng = results[0].geometry.location;
			      map.setCenter(latlng.lat(), latlng.lng());
			      map.addMarker({
			        lat: latlng.lat(),
			        lng: latlng.lng()
			      });
			    }
			  }
			});
		});

  });
}(window.jQuery);