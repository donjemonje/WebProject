
$(function () {

    $('#username').val("");
    $('#password').val("");

    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function (e) {
        $('#username').val("");
        $('#password').val("");

        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });




    //  Bind the event handler to the "submit" JavaScript event
    $('form').submit(function () {

        if ($('#username').val() !== "" || $('#password').val() !== "") {

            return true;
        }
        else {

            if ($('#username_r').val() == "") {
                $('#username_r_span').html('<b style="color:red;"> Name must contain only alphabets and space </b>');
                return false;
            }
            else {
                $('#username_r_span').html('');
            }

            if ($('#email').val() == "") {
                $('#email_span').html('<b style="color:red;"> Illigle email address </b>');

                return false;
            }
            else {
                $('#email_span').html('');
            }

            if ($('#password_r').val().length < 6) {
                $('#password_r_span').html('<b style="color:red;"> Password must be minimum of 6 characters </b>');
                return false;
            }
            else {
                $('#password_r_span').html('');
            }

            

            if ($('#password_r').val() != $('#confirm-password_r').val()) {
                $('#confirm-password_r_span').html('<b style="color:red;"> Password and Confirm Password doesnt match </b>');
                //$('#password_r_span').html('<b style="color:red;"> Password and Confirm Password doesnt match </b>');
                return false;
            }
            else {
                $('#confirm-password_r_span').html('');
                $('#password_r_span').html('');
            }
            return true;
        }

        
    });



});
