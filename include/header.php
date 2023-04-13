<div class="header-container">
    <!--    <div class="header-container-logo-title">-->
    <header class="header-container-logo-title">
        <a href="<?php bloginfo('url') ?>">
            <img class="img-responsive center logo" src="<?= get_stylesheet_directory_uri() ?>/images/logo.png" alt="Home" title="Home">
        </a>        
        <div class="header-container-title hide-on-med-and-down">
            <h1 class="titulo-header header">
                <?= get_general_setting('ipg_description_name'); ?>
            </h1>                        
        </div>                        
    </header>        
    <!--    </div>-->
</div>
<nav class="nav-menu">
    <div class="nav-wrapper">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!--            <a href="#" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/read_more_16.png" alt="" />
                        </a>-->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hide-on-large-only" href="#">IPG-IP</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            ipg_bootstrap_nav_menu();            
            ?>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>