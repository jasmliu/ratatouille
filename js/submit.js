$(document).ready(function(){
    $("#submit").click(function(){

    var date = $('#date').val();
    var loc_type = $('#loc_type').val();
    var zip = $('#zip').val();
    var address = $('#address').val();
    var borough = $('#borough').val();
    var city = $('#city').val();
    var lat = $('#lat').val();
    var lng = $('#lng').val();

    $.post(
        "php/addrat.php",
        {date:date, loc_type:loc_type, zip:zip, address:address, borough:borough, city:city, lat:lat, lng:lng},
        function(data) {
            var response = jQuery.parseJSON(data);
            if (response.error) {
                console.log("add sighting failed");
                alert(response.msg);
            } else {
                console.log("add sighting successful");
                alert(response.msg);
            }
        });
    });
});
