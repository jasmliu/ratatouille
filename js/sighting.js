$(document).ready(function () {
	if (qs() != null) {
		query();
	}
});

function qs() {
	var query = window.location.search.substring(1);
	var pos = query.indexOf('=');
	if (pos > 0) {
		var id = query.substring(pos + 1, query.length);
	}
	return id;
}

function query() {
	var id = qs();
	if ($("#id").val() != "") {
		id = $("#id").val();
	}
	console.log("searching for sighting " + id);
  	$.post(
    "php/jsonfeed.php",
    {id: id},
    function(data) {
		console.log("Query completed!");
		data = jQuery.parseJSON(data);
		console.log(data);
		var str = "";
		for (var i = 0; i < data.length; i++) {
			str += '<tr><td>' + data[i].id + '</td>';
			str += '<td>' + data[i].date + '</td>';
			str += '<td>' + data[i].loc_type + '</td>';
			str += '<td>' + data[i].zip + '</td>';
			str += '<td>' + data[i].address + '</td>';
			str += '<td>' + data[i].borough + '</td>';
			str += '<td>' + data[i].city + '</td>';
			str += '<td>' + data[i].lat + '</td>';
			str += '<td>' + data[i].lng + '</td></tr>';
		}
		console.log(str);
		$('#id').val(id);
		$('#rats > tbody > tr').remove();
		$('#rats > tbody:last-child').append(str);
	});
}