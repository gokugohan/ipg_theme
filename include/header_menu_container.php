<div class="logo-menu-container" style="background-color: #9ec92b">

    <div class="pageheader">
        <div class="container" >
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12 logo-container">
                    <a href="<?php echo site_url(); ?>">
                        <div class="logo">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png' ?>"
                                 class="img-fluid rounded">
                        </div>
                    </a>
                </div>

                <!-- <div class="col-md-2">
                    <a href="/">
                        <div class="logo">
                            <img src="img/ipg/logo.png" class="img-fluid rounded">
                        </div>
                    </a>
                </div> -->
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="pageheader-title-container">
                        <a asp-action="Index" asp-controller="Home" asp-area="">
                            <div class="logo-sm">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png' ?>"
                                     class="img-fluid rounded">
                            </div>
                        </a>
                        <h2 class="header-title">INSTITUTO DO PETRÓLEO E GEOLOGIA</h2>
                        <cite class="citation">To be a credible Geoscience Research Institution in the
                            world</cite>

                    </div>
                    <hr>

                </div>

                <div class="col-md-2 col-sm-12 col-xs-12 hide-on-small-and-down">
                    <a href="http://timor-leste.gov.tl/">
                        <div class="logo bg-transparent">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo_rdtl.png' ?>"
                                 class="img-fluid rounded">
                        </div>
                    </a>
                </div>
            </div>
            <nav id="navbar" class="navbar navbar-light">
            <?php include_menu_manual(); ?>
            </nav>
        </div>
    </div>
</div>
