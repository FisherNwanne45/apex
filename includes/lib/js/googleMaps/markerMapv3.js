var geocoder;
var bounds;
var popup;

var markerMap = function(locations, selector, googleMap) {
	labels = $$(selector);
	
	geocoder = new google.maps.Geocoder();
	bounds   = new google.maps.LatLngBounds();

	locations.each(function(junk, i) {
		var point  = new google.maps.LatLng(locations[i].latitude, locations[i].longitude);
		var marker = new google.maps.Marker({position: point, map: googleMap});
		locations[i].point	= point;
		locations[i].marker = marker;

		bounds.extend(point);
		googleMap.fitBounds(bounds);

		if (labels[i] != null) {
			labels[i].addEvent("click", function(event) {
				var contents = '<div class="googleMap-InfoWindow">';
				contents += '<h2>' + locations[i].name + '</h2>';
				contents += '<p class="map-address">' + locations[i].address + '</p>';

				if (locations[i].phones) {
					contents += '<p class="map-phones">';
					contents += locations[i].phones.join('<br />');
					contents += '</p>';
				}
				contents = contents + '</div>';
				googleMap.panTo(locations[i].point);
				if (typeof popup != "undefined")
				{
					popup.close();
				}
				popup = new google.maps.InfoWindow({map: googleMap, content: contents, anchor: locations[i].marker});
			});

			// This will 'click' the tab to which the marker refers.
			google.maps.event.addDomListener(marker, "click", function(e) {
				labels[i].fireEvent('click', e);
			});
		}
	});
};