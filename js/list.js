function setDates() {
  date_start = $("#date_start").val();
  date_end = $("#date_end").val();
  query(date_start, date_end);
}

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
		var str = "";
		for (var i = 0; i < data.length; i++) {
			str += "<tr data-href='" + data[i].id + "'><td>" + data[i].id + '</td>';
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
		$('#rats > tbody > tr').remove();
		$('#rats > tbody:last-child').append(str);
 		$('tr[data-href]').on("click", function() {
 			console.log($(this).data('href'));
 			window.location = 'sighting.html?id=' + $(this).data('href');
		});
	});
}

window.onload = function() {
  var date_start = '2017-08-22';
  var date_end = '2017-08-22';
  $('#date_start').val(date_start);
  $('#date_end').val(date_end);
  query(date_start, date_end);
}