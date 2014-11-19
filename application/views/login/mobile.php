<div  class="ui-content">
    <div id="topLogo" class="alignCenter">
        <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/iluvproperty.png" width="250" height="28" alt="Iluvproperty.com" />
    </div>
    <form id="loginform">
        <div class="alert alert-danger loginError"></div>
        <div class="iconsText" >
            <input type="email" data-theme="a"  data-clear-btn="false" class="" name="login_email" id="login_email" placeholder="E-mail" />
            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/username.png">
            
        </div>
        <div class="iconsText">
            <input type="password" data-theme="a" data-clear-btn="false" name="login_password" id="login_password"  placeholder="Password" />
            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/password.png">
        </div>

        <button class="ui-btn ui-corner-all redBgColor">Sign In</button>
        <div class="alignCenter"><br/>
            <a class="hyperlink" data-ajax="false" href="<?= $this->config->item('base_url') ?>login/mobile_account">Create Account</a>
        </div>
    </form>
</div>