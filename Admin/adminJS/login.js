$(document).ready(function () {
    $('.btn').click(function(e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        if(username != "" && password != "") {
            $('#error').html('');
            $.ajax({
                url: "login.php",
                type: "POST",
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
                    if (response.indexOf('admin Logged in') >= 0) {
                        window.location = "Dashboard.php";
                    } else {
                        $('#error').html('<i class="fa-solid fa-circle-exclamation px-1"></i>'+ response);
                    }
                }
            });
        } else {
            $('#error').html('<i class="fa-solid fa-circle-exclamation px-1"></i> Please fill all the input fields !');
        }
    })
});