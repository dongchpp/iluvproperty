<div  class="ui-content">
    <div class="alert alert-danger registerError"></div>
    <div class="alert alert-success"></div>
    <form id="pie_regiser_form" enctype="multipart/form-data">
        <input type="hidden" name="sn" value="<?= $userProfileArr['sn'] ?>" />
        <div style="height:0px;overflow:hidden">
            <input name="image[]" id="fileInput" title="Choose a file to upload" multiple="" type="file" />
        </div>
        <div class="alignCenter">
            <?php if (!empty($userProfileArr['imageName'])) { ?>
                <img class="createAccountPic" width="80" src="<?= $this->config->item('profileURL') . $userProfileArr['imageName'] ?>"  />
            <?php } else { ?>
                <img class="createAccountPic" width="80" src="<?= $this->config->item('mobileThemeURL') ?>assets/img/Portrait_placeholder.png"  />
            <?php } ?>
        </div>
        <div>
            <label>First name:</label>
            <input type="text" data-clear-btn="false" name="firstname" id="firstname" value="<?= $userProfileArr['firstName'] ?>" placeholder="First name" />
        </div>
        <div
            <label>Last Name:</label>
            <input type="text" data-clear-btn="false" name="lastname" id="lastname" value="<?= $userProfileArr['lastName'] ?>" placeholder="Last name" />
        </div>
        <div>
            <label>Email:</label>
            <input type="email" data-clear-btn="false" name="email" id="email" value="<?= $userProfileArr['email'] ?>" placeholder="E-mail address" />
        </div>
        <div>
            <label>Reset Password:</label>
            <input type="password" data-clear-btn="false" name="password" id="password" placeholder="Password" value="" autocomplete="off" />
        </div>
        <button type="submit" id="submit" class="ui-shadow ui-btn ui-corner-all redBgColor">Submit</button>
    </form>

</div>
<script>
    $(".createAccountPic").click(function () {
        $("#fileInput").click();
    });
    $(document).ready(function () {

        // validate signup form on keyup and submit
        $("#pie_regiser_form").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                firstname: "required",
                lastname: "required"
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname"
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
                    window.scrollTo(0, 0);
                    if (xhr.status === 200) {
                        if (xhr.responseText == "true") {
                            $(".alert-success").html("Saved!");
                            
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
</script>