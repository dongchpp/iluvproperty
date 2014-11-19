<div id="loginRegisterPage">
    <div id="loginBox">
        <div class="loginBoxInnerFrame">
            <h2>Login</h2>
            <div class="piereg_container">
                <div class="piereg_login_container">
                    <div class="piereg_login_wrapper">
                        <form id="loginform"  class="piereg_loginform" >
                            <div class="alert alert-danger loginError"></div>
                            <p>
                                <input type="email" name="login_email" id="login_email" class="input" value="" size="20" placeholder="E-mail">
                            </p>
                            <p>
                                <input type="password" name="login_password" id="login_password" class="input" value="" size="20" placeholder="Password">
                            </p>
                            <p class="submit">
                                <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-lg btn-primary" value="Sign In">
                            </p>
                            <p class="forgetmenot">
                                <label for="rememberme">
                                    <input type="checkbox" name="rememberme" id="rememberme" value="forever">
                                    Remember Me </label>
                            </p>
                            <p id="nav"><a href="#" title="Password Lost and Found">Lost your password?</a> </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="registerBox">
        <div class="registerBoxInnerFrame">
            <h2>Register</h2>
            <div class="pieregformWrapper pieregWrapper">
                <div id="pie_register_reg_form">
                    <form  id="pie_regiser_form">
                        <div class="alert alert-danger registerError"></div>
                        <div class="alert alert-success"></div>
                        <ul id="pie_register">
                            <li class="fields halfL">
                                <div class="fieldset">
                                    <input type="text" value="" placeholder="First name" id="firstname" type="text" name="firstname">
                                </div>
                            </li>
                            <li class="fields  halfR">
                                <div class="fieldset">
                                    <input type="text" value="" placeholder="Last name" id="lastname" type="text" name="lastname">
                                </div>
                            </li>
                            <li class="fields">
                                <div class="fieldset">
                                    <input type="text" value="" placeholder="E-mail" name="email" id="email">
                                </div>
                            </li>
                            <li class="fields  halfL">
                                <div class="fieldset">
                                    <input id="password" name="password" type="password" placeholder="Password">
                                </div>
                            </li>
                            <li class="fields  halfR">
                                <div class="fieldset">
                                    <input id="confirm_password" name="confirm_password" type="password" placeholder="Password confirm">
                                </div>
                            </li>
                            <li class="fields">
                                <div class="fieldset">
                                    <div class="radio_wrap">
                                        <input type="checkbox"  class="input_fields radio_fields" id="agree" type="checkbox" name="agree" value="1" checked="checked"> Please accept Terms &amp; Conditions.
                                    </div>
                                </div>
                            </li>
                            <li class="fields">
                                <div class="fieldset piereg_submit_button">
                                    <input type="submit" value="Register" class="btn btn-lg btn-primary" name="pie_submit">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clearBoth"></div>
</div>