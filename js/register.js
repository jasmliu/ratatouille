$(document).ready(function(){
    $("#register").click(function(){

    var username = $("#username").val();
    var password = $("#password").val();
    var confirm = $("#confirm").val();
    var account_type = $("#account_type:checked").val();

    $.post(
        "php/authenticate/register.php",
        { username:username, password:password, confirm:confirm, account_type:account_type},
        function(data) {
            var response = jQuery.parseJSON(data);
            console.log(response.error);
            if (response.error) {
                alert(response.msg);
            } else {
                window.location = 'login.html';
            }
        });
    });
});
