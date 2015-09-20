    var map;
	var markers = [];
	var infoWindow;
	var locationSelect;

	function load() {
		map = new google.maps.Map(document.getElementById("map-canvas"), {
			position: navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(initialLocation);
            }),
			zoom: 15, // The initial zoom level when your map loads (0-20)
			minZoom: 4, // Minimum zoom level allowed (0-20)
			maxZoom: 17, // Maximum soom level allowed (0-20)
			zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT // Change to SMALL to force just the + and - buttons.
			},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
            // All of the below are set to true by default, so simply remove if set to true:
			panControl:false, // Set to false to disable
			mapTypeControl:false, // Disable Map/Satellite switch
			scaleControl:false, // Set to false to hide scale
			streetViewControl:false, // Set to disable to hide street view
			overviewMapControl:false, // Set to false to remove overview control
			rotateControl:false // Set to false to disable rotate control
		});
		infoWindow = new google.maps.InfoWindow();

		locationSelect = document.getElementById("locationSelect");
		locationSelect.onchange = function() {
			var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
			if (markerNum != "none"){
				google.maps.event.trigger(markers[markerNum], 'click');
			}
		};
	}

	function searchLocations() {
		var address = document.getElementById("addressInput").value;
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({address: address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				searchLocationsNear(results[0].geometry.location);
			} else {
				alert(address + ' not found');
			}
		});
	}

	function clearLocations() {
		infoWindow.close();
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}
		markers.length = 0;

		locationSelect.innerHTML = "";
		var option = document.createElement("option");
		option.value = "none";
		option.innerHTML = "See all results:";
		locationSelect.appendChild(option);
	}

	function searchLocationsNear(center) {
		clearLocations();

		var radius = document.getElementById('radiusSelect').value;
		var searchUrl = 'phpsqlsearch_genxml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
		downloadUrl(searchUrl, function(data) {
			var xml = parseXml(data);
			var markerNodes = xml.documentElement.getElementsByTagName("marker");
			var bounds = new google.maps.LatLngBounds();
			for (var i = 0; i < markerNodes.length; i++) {
				var name = markerNodes[i].getAttribute("name");
				var address = markerNodes[i].getAttribute("address");
                var id = markerNodes[i].getAttribute("id");

				var distance = parseFloat(markerNodes[i].getAttribute("distance"));
				var latlng = new google.maps.LatLng(
					parseFloat(markerNodes[i].getAttribute("lat")),
					parseFloat(markerNodes[i].getAttribute("lng")));

					createOption(name, distance, id);
					createMarker(latlng, name, address, id);
					bounds.extend(latlng);
				}
				map.fitBounds(bounds);
				locationSelect.style.visibility = "visible";
				locationSelect.onchange = function() {
					var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
					google.maps.event.trigger(markers[markerNum], 'click');
				};
			});
		}

		function createMarker(latlng, name, address, id) {
			var marker = new google.maps.Marker({
				map: map,
				position: latlng
			});
            var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
                content:'<div class ="infowindow-text">' +
                                           '<h2>' + name + '</h2>' +
                                           '<h4><u>Bathroom Address:</u></h4>' +
                                           '<h4>' + address + '</h4>' +
                                           '<h6><a href="/bathrooms/'+id+'">Click for more information</a></h6>' +
                        '</div>' // HTML contents of the InfoWindow
            });
            google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
                infowindow.open(map,marker); // Open our InfoWindow
            });
			markers.push(marker);
		}

		function createOption(name, distance, num) {
			var option = document.createElement("option");
			option.value = num;
			option.innerHTML = name + "(" + distance.toFixed(1) + ")";
			locationSelect.appendChild(option);
		}

		function downloadUrl(url, callback) {
			var request = window.ActiveXObject ?
			new ActiveXObject('Microsoft.XMLHTTP') :
			new XMLHttpRequest;

			request.onreadystatechange = function() {
				if (request.readyState == 4) {
					request.onreadystatechange = doNothing;
					callback(request.responseText, request.status);
				}
			};

			request.open('GET', url, true);
			request.send(null);
		}

		function parseXml(str) {
			if (window.ActiveXObject) {
				var doc = new ActiveXObject('Microsoft.XMLDOM');
				doc.loadXML(str);
				return doc;
			} else if (window.DOMParser) {
				return (new DOMParser).parseFromString(str, 'text/xml');
			}
		}

		function doNothing() {}
