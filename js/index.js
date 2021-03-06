function query(date_start, date_end) {
	console.log("query request");
  	console.log("start date: " + date_start);
  	console.log("end date: " + date_end);
	$.post(
		"php/jsonfeed.php",
		{date_start: date_start, date_end: date_end},
		function(data) {
		console.log("Query completed!");
		data = jQuery.parseJSON(data);
		var ny= {lat: 40.7128, lng: -74.0060};
		var map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 10,
		  center: ny
		});
		for (var i = 0; i < data.length; i++) {
			var pos = new google.maps.LatLng(data[i].lat, data[i].lng);
			var marker = new google.maps.Marker({
			  position: pos,
			  map: map
			});
			var html = data[i].date + "<br>" + data[i].address + "<br>" + data[i].city;
			console.log(html);
			var infowindow = new google.maps.InfoWindow();
			bindInfoWindow(marker, map, infowindow, html, data[i].id);
		}
	});
}

function setDates() {
	var date_start = $("#date_start").val();
  	var date_end = $("#date_end").val();
  	query(date_start, date_end);
}

function bindInfoWindow(marker, map, infowindow, html, id) {
	marker.addListener('mouseover', function() {
        infowindow.setContent(html);
        infowindow.open(map, this);
    });

    marker.addListener('mouseout', function() {
		infowindow.close();
	});

	marker.addListener('click', function() {
		window.location = 'sighting.html?id=' + id;
	})
}

function initMap() {
	var canvas = document.getElementById('map');
	var location = {lat: 40.7128, lng: -74.0060};
	var options = {
		center: location,
		zoom: 10,
		scrollwheel: false,
	}
	var map = new google.maps.Map(canvas, options);
  	$('#date_start').val('2017-08-22');
  	$('#date_end').val('2017-08-22');
	$.post(
		"php/jsonfeed.php",
		{date_start: '2017-08-22', date_end: '2017-08-22'},
		function(data) {
		console.log("Query completed!");
		data = jQuery.parseJSON(data);
		var ny= {lat: 40.7128, lng: -74.0060};
		var map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 10,
		  center: ny
		});
		for (var i = 0; i < data.length; i++) {
			var pos = new google.maps.LatLng(data[i].lat, data[i].lng);
			var marker = new google.maps.Marker({
			  position: pos,
			  map: map
			});
			var html = data[i].date + "<br>" + data[i].address + "<br>" + data[i].city;
			console.log(html);
			var infowindow = new google.maps.InfoWindow();
			bindInfoWindow(marker, map, infowindow, html, data[i].id);
		}
	});
}

google.maps.event.addDomListener(window, 'load', initMap);