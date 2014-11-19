<div  class="ui-content">
    <div class="alert alert-danger registerError"></div>
    <div class="alert alert-success"></div>
    <form id="pie_regiser_form" enctype="multipart/form-data">
        <input type="hidden" name="sn" value="0" />
        <div style="height:0px;overflow:hidden">
            <input name="image[]" id="fileInput" title="Choose a file to upload" multiple="" type="file" />
        </div>
        <div class="alignCenter">
            <img class="createAccountPic" width="80" src="<?= $this->config->item('mobileThemeURL') ?>assets/img/Portrait_placeholder.png"  />
        </div>
        <div class="ui-field-contain">
            <input type="text" data-clear-btn="false" name="firstname" id="firstname" value="" placeholder="First name" />
        </div>
        <div class="ui-field-contain">
             <input type="text" data-clear-btn="false" name="lastname" id="lastname" value="" placeholder="Last name" />
        </div>
        <div class="ui-field-contain">
            <input type="email" data-clear-btn="false" name="email" id="email" value="" placeholder="E-mail address" />
        </div>
        <div class="ui-field-contain">
            <input type="password" data-clear-btn="false" name="password" id="password" placeholder="Password" value="" autocomplete="off" />
        </div>
        <div class="ui-field-contain">
            <input type="password" data-clear-btn="false" name="confirm_password" id="confirm_password" placeholder="Password confirm" value="" autocomplete="off" />
        </div>
        <button type="submit" id="submit" class="ui-shadow ui-btn ui-corner-all redBgColor">Submit</button>
        
    </form>

</div>
<script>
    $(".createAccountPic").click(function () {
        $("#fileInput").click();
    });
</script>