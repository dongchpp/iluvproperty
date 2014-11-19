$().ready(function () {
    // validate login form on keyup and submit
    $("#loginform").validate({
        rules: {
            login_email: {
                required: true,
                email: true
            },
            login_password: {
                required: true
            }

        },
        messages: {
            login_email: "Please enter a valid email address",
            login_password: {
                required: "Please provide a password"
            }
        },
        submitHandler: function () {
            $url = $base_url + 'login/submit/signin';
            $.post($url, $("#loginform").serialize(), function (data) {
                if (data == "true") {
                    location.href = $base_url + "welcome/index";
                } else {
                    $(".loginError").html(data);
                    $(".loginError").show();

                }
            });

            return false;
        }
    });
    // validate signup form on keyup and submit
    $("#pie_regiser_form").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            confirm_password: {
                required: true,
                minlength: 3,
                equalTo: "#password",
                maxlength: 20
            },
            email: {
                required: true,
                email: true
            },
            agree: "required"
        },
        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                maxlength: "Your password not more than 20 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                maxlength: "Your password not more than 20 characters long",
                equalTo: "Password confirm and Password does not match"
            },
            email: "Please enter a valid email address",
            agree: "Please accept our policy"
        },
        submitHandler: function () {


            $url = $base_url + 'login/submit/register';
            $.post($url, $("#pie_regiser_form").serialize(), function (data) {
                console.log($.trim(data));
                if ($.trim(data) == "true") {
                    $(".alert-success").html("Thank you for registering. Please check your email to activate your account.");
                    $(".alert-success").show();
                    $(".registerError").hide();
                    $('#pie_regiser_form').trigger("reset");
                } else {
                    $(".registerError").html(data);
                    $(".registerError").show();
                    $(".alert-success").hide();
                }
            });
            return false;
        }
    });

    // propose username by combining first- and lastname
    $(".alert-danger").hide();
    $(".alert-success").hide();
});