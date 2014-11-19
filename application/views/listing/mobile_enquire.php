<div  class="ui-content">
    <div class="alert alert-danger registerError"></div>
    <div class="alert alert-success"></div>
    <form id="pie_regiser_form" enctype="multipart/form-data">
        <input type="hidden" name="sn" value="<?= $userProfileArr['sn'] ?>" />





        <div>
            <label>From: <?= $userProfileArr['firstName'] ?> <?= $userProfileArr['lastName'] ?></label>
            <label>To Agent: <?= $toUserArr['firstName'] ?> <?= $toUserArr['lastName'] ?></label>

            <input type="hidden" name="userSN" value="<?= $userProfileArr['sn'] ?>" />
            <input type="hidden" name="userAgentSN" value="<?= $toUserArr['sn'] ?>" />
            <input type="hidden" name="userListingSN" value="<?= $listingArr['sn'] ?>" />
            <input type="hidden" name="email" value="<?= $toUserArr['email'] ?>" />
            <input type="hidden" name="useremail" value="<?= $userProfileArr['email'] ?>" />


            <div>
                <label>Title:</label>
                <input type="text" name="subject" id="title" placeholder="Title" value="<?= (!empty($userListingArr) ? $userListingArr['title'] : "") ?>" />
            </div>
            <textarea rows="10" name="message" id="message" class="textarea_class" placeholder="my enquire"></textarea>
        </div>
        <button type="submit" id="submit" class="ui-shadow ui-btn ui-corner-all">Submit</button>
    </form>

</div>
<script>

    $(document).ready(function () {

        // validate signup form on keyup and submit
        $("#pie_regiser_form").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
//                subject: "required",
                message: "required"
            },
            messages: {
//                subject: "Please enter your firstname",
                message: "Please enter your message"
            },
            errorPlacement: function (error, element) {

                error.insertAfter($(element).parent());
            },
            submitHandler: function () {

                //event.preventDefault();
                $url = $base_url + 'admin/enquire_submit';
                $form = $("#pie_regiser_form");

                var formData = new FormData($form);

                $("input").each(function () {
                    if ($(this).attr('type') != "file") {
                        formData.append($(this).attr('name'), $(this).val());
                    }
                });

                $("textarea").each(function () {
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
                            $(".alert-success").html("Thank you for enquire, You message has been sent to  the agent!");

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

<style>
    .textarea_class {
        height: auto !important; /* !important is used to force override. */
    }
</style>