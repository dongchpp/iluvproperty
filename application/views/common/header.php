<div class="header-wrapper">
    <header class="container">
        <div class="row top">
            <div class="col-xs-12 col-sm-6 col-lg-6  logo"> <a href="index.html"><img src="<?= $this->config->item('defaultThemeURL') ?>assets/img/iluvPropertylogo.png" alt="I Luv Property" ></a> 

                <!-- Nav -->
                <div class="navbar-wrapper">
                    <div class="container">
                        <div class="navbar navbar-inverse navbar-static-top">
                            <div class="container">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                </div>
                                <div class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a href="#">Sell</a></li>
                                        <li><a href="#">Rent</a></li>
                                        <li><a href="#">Agents</a></li>
                                        <li><a href="#">Tips</a></li>
                                        <li><a href="#">Help</a></li>
                                        <li class="hide-desk"><a href="#">List Property</a></li>
                                        <li class="hide-desk"><a href="#">Sign In</a></li>
                                        <li class="hide-desk"><a href="#">Register</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nav end --> 

            </div>
            <!-- logo end -->

            <div class="col-xs-0 col-sm-6 col-lg-6 sign-in">
                <form action="#" accept-charset="utf-8">
                    <input type="search" value="Search" onblur="if (this.value == '') {
                                this.value = 'Search';
                            }" onfocus="if (this.value == 'Search') {
                                        this.value = '';
                                    }">
                </form>
                <a href="#" class="list hide-mob">List Property</a>
                <ul class="hide-mob">
                    <li><a href="#">sign in</a></li>
                    <li> | </li>
                    <li><a href="#">register</a></li>
                </ul>
            </div>
        </div>
    </header>
</div>
<!-- header-wrapper end -->