<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?>>
<head>
    <title><?= get_bloginfo('name'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&amp;display=swap">

    <!-- theme stylesheet-->
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/css/style.default.css' ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/custom.css' ?>">



    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->


    <?php
    wp_head();

    if (get_theme_mod('themeslug_logo')) {
        $url_img = esc_url(get_theme_mod('themeslug_logo'));
        $alt = esc_attr(get_bloginfo('name', 'display'));
    }
    ?>



</head>
<body class="container-fluid border">
<header class="header">
    <div class="top-bar bg-dark text-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 bg-ipg-header-color py-2 text-center text-dark text-lg-left">
                    <p class="mb-0 text-small"><i class="fas fa-clock mr-2"></i>Opening hours: Mon - Fri 8:00 - 17:00
                    </p>
                </div>
                <div class="col-lg-8 text-right py-2 text-center text-lg-right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a class="font-weight-normal text-small reset-anchor" href="#"><i
                                        class="fas fa-mobile mr-2"></i>+670 3310179</a></li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item"><a class="font-weight-normal text-small reset-anchor"
                                                        href="mailto:info@ipg.tl"><i class="fas fa-envelope mr-2"></i>info@ipg.tl</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logo-menu-container" style="background-color: #9ec92b">

            <div class="pageheader">
                <div class="container">
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
                    <nav class="navbar navbar-expand-lg navbar-light py-1">
                        <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none"></a>
                        <button type="button" data-toggle="collapse" data-target="#navbarContent"
                                aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation"
                                class="navbar-toggler">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div id="navbarContent" class="collapse navbar-collapse">
                            <?php include_menu_manual(); ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="pt-0 py-5 bg-light">
    <div class="container-fluid py-5">
        <header class="mb-5 text-center">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <p class="h2 text-uppercase text-primary"><?=the_title();?></p>
                    <hr>
                    <br>
                </div>
            </div>
        </header>
        <div class="row align-items-stretch">


            <div class="col-sm-12">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        ?>
                        <div class="news-content">

                            <?php the_content(); ?>
                        </div>
                        <?php
                    }
                } else {
                    echo('No content yet.');
                }
                ?>
            </div>
        </div><!-- /row -->
    </div>

</div>
<?php
get_footer();

