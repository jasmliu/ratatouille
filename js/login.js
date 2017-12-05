$(document).ready(function(){
    $("#login").click(function(){

    var username = $("#username").val();
    var password = $("#password").val();

    $.post(
        "php/authenticate/login.php",
        { username: username, password:password },
        function(data) {
            var response = jQuery.parseJSON(data);
            if (response.error) {
                console.log("login failed");
                alert(response.msg);
            } else {
                console.log("login successful");
                window.location = 'index.html';
            }
        });
    });
});
