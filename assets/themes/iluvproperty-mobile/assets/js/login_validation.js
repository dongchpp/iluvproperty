$(document).ready(function () {
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
        errorPlacement: function (error, element) {

            error.insertAfter($(element).parent());
        },
        submitHandler: function () {
            $url = $base_url + 'login/submit/signin';
            $.post($url, $("#loginform").serialize(), function (data) {
                if (data == "true") {
                    location.href = $base_url + "admin/listing_mobile";
                } else {
                    $(".loginError").html(data);
                    $(".loginError").show();

                }
            });

            return false;
        }
    });
    // validate signup form on keyup and submit
    $("#pie_regiser_form").submit(function (e) {
        e.preventDefault();
    }).validate({
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
        errorPlacement: function (error, element) {

            error.insertAfter($(element).parent());
        },
        submitHandler: function () {

            //event.preventDefault();
            $url = $base_url + 'login/submit/register';
            $form = $("#pie_regiser_form");
            var fileSelect = document.getElementById('fileInput');
            var files = fileSelect.files;
            var formData = new FormData($form);
            // Loop through each of the selected files.
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                // Check the file type.
                if (!file.type.match('image.*')) {
                    continue;
                }

                // Add the file to the request.
                formData.append('image[]', file, file.name);
            }
            $("input").each(function () {
                if ($(this).attr('type') != "file") {
                    formData.append($(this).attr('name'), $(this).val());
                }
            });

            //formData.append();
            var xhr = new XMLHttpRequest();
            // Open the connection.
            xhr.open('POST', $url, true);
            // Set up a handler for when the request finishes.
            xhr.onload = function () {
                if (xhr.status === 200) {
                    if (xhr.responseText == "true") {
                        $(".alert-success").html("Thank you for registering. Please check your email to activate your account.");
                        $(".alert-success").show();
                        $(".registerError").hide();
                        $('#pie_regiser_form').trigger("reset");
                    } else {
                        $(".registerError").html(xhr.responseText);
                        $(".registerError").show();
                        $(".alert-success").hide();
                    }
                } else {
                    $(".registerError").html("Error While Posting");
                    $(".registerError").show();
                    $(".alert-success").hide();
                }
            };
            xhr.send(formData);
            return false;
        }
    });

    // propose username by combining first- and lastname
    $(".alert-danger").hide();
    $(".alert-success").hide();

});