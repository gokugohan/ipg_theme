<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?>>
<head>
    <title><?= get_bloginfo('name'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/animate.css/animate.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/boxicons/css/boxicons.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/remixicon/remixicon.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/animate.css/animate.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/style.css' ?>">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&amp;display=swap">



    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/style.default.css' ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/custom.css' ?>">



    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/css/datatables.min.css' ?>">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->


    <?php
    if (is_front_page()) {
        ?>
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/vendor/leaflet/leaflet.css' ?>"/>

        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/MarkerCluster.css' ?>"/>
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/MarkerCluster.Default.css' ?>"/>

        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/L.Icon.Pulse.css' ?>"/>
        <?php
    }
    ?>
    <?php if (is_page("Events")) {
        ?>
        <link rel="stylesheet" type="text/css"
              href="<?php echo get_stylesheet_directory_uri() . '/css/calendar.min.css' ?>">
        <?php
    }
    ?>

    <?php
    wp_head();

    if (get_theme_mod('themeslug_logo')) {
        $url_img = esc_url(get_theme_mod('themeslug_logo'));
        $alt = esc_attr(get_bloginfo('name', 'display'));
    }
    ?>

    <style>
        body{
            /*width: 98% !important;*/
        }

        .logo-menu-container .navbar a:hover, .logo-menu-container .navbar .active,
        .logo-menu-container .navbar .active:focus, .logo-menu-container .navbar li:hover>a{
            background: #b5d65c;
            color: white !important;
        }

        .logo-menu-container .navbar .dropdown-menu li:hover>a,
        .logo-menu-container .navbar .dropdown-menu li a:hover{
            color: #b5d65c !important;
            background: transparent;
        }

        .mobile-nav-toggle {
            color: #aed24e;
        }
        .card-post-header {
            background: #add14c;
            height: 150px;
            background-size: cover;
        }

        .fixed-top {
            top: -40px;
            transform: translateY(40px);
            transition: transform 1s;
        }

        #modal-search{
            padding: 0 !important;

            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
        }

        #modal-search .modal-dialog{
            max-width: 100%;
            margin: 0 !important;
        }

        #modal-search .modal-content{
            position: relative;
            background-color: #f8f9fa;
            background-image: url(<?php echo get_stylesheet_directory_uri() .'/images/wave.png'?>);
            background-repeat: no-repeat;
            background-position: left;
            background-size: cover;
            border: none !important;
            border-radius: 0px !important;
            height: 100% !important;
        }

        #modal-search .modal-body{
            overflow: scroll;
        }
        #slide-recent-earthquake{
            font-size: 13px !important;
            font-style: italic;
        }

        #slide-recent-earthquake a{
            color: #fff !important;
        }
        #slide-recent-earthquake span.text-sm{
            font-size: .75rem;
        }
        span.eq{
            font-size: 13px;
        }
        marquee{
            margin-left: 122px;
        }

        #hero{
            background:#bedb71;
        }
        #hero .carousel-container{
            display: block;
            position: absolute;
            height: auto;
            padding: 0;
            bottom: 0;
            width: 100%;
        }
        #hero .carousel-container .container{
            background:#05050561;
            padding: 20px;
            border-radius: 20px;
        }
        #hero h2{
            font-size: 24px;
        }
        #hero p{
            width: 100% !important;
        }

        .carousel-bg{
            width: 100%;
        }
        .carousel-bg .carousel-item {
            background-color: darkslategrey;
            background-size: cover;
            background-position: center;
            min-height: 360px;
            height: 70vh;
        }

        .carousel-control-next, .carousel-control-prev{
            height: 40px;
            width: 40px;
            padding: 12px;
            top: 50%;
            bottom: auto;
            transform: translateY(-50%);
            background-color: #9ec92b;
        }
        .carousel-control-next:hover, .carousel-control-prev:hover{
            color: white;
        }


        .publication-item .badge.badge-primary{
            color: #6c757d!important;
            font-size: 12px;
            font-weight: normal;
            white-space: break-spaces;
            text-align: left;
        }

        li.mega-menu ul.dropdown-menu li{
            width: 50vw;
        }


        .earthquakes-legend{
            padding: 5px;
            /*margin: 0 0 !important;*/
        }

        .earthquakes-legend .legend-title {
            display: block;
            padding: 1px;
            font-size: 14px !important;
            font-weight: 700;
            text-transform: uppercase;
            color: #34495e;
        }

        .earthquakes-legend img.img-legend{
            width: 150px;
        }
        .eq-title{
            font-size: 16px;
            font-weight: bold;
            padding: 0;
            margin: 0;
            white-space: nowrap;
        }

        .leaflet-control-layers-base label span span{
            text-transform: uppercase;
            font-weight: 700;
            margin-left: 2px;
        }



    </style>

</head>
<body class="container-fluid border">

<!-- navbar-->
<header class="header">
    <div class="top-bar bg-dark text-white" id="header-logo-menu-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 bg-ipg-header-color py-2 text-center text-dark text-lg-left">
                    <p class="mb-0 text-small"><i class="fas fa-clock mr-2"></i>Opening hours: Mon - Fri 8:00 - 17:00
                    </p>
                </div>

                <div class="col-lg-7">
                    <span class="py-2 position-absolute eq">Recent earthquake:</span>
                    <marquee behavior="scroll" direction="left"
                             onmouseover="this.stop();" onmouseout="this.start();">
                        <span class="slide-recent-earthquake py-2" id="slide-recent-earthquake"></span>
                    </marquee>
                </div>
                <div class="col-lg-2 text-right py-2 text-center text-lg-right pl-0">
                    <ul class="list-inline mb-0">
						<li class="list-inline-item">
							<a class="font-weight-normal text-small reset-anchor" href="#"
                               data-toggle="modal" data-target="#modal-search"><i
                                        class="fas fa-search mr-2"></i></a>
						</li>
                        <li class="list-inline-item">
                            <a class="font-weight-normal text-small reset-anchor" href="tel:+670 3310179">+670 3310179</a></li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item"><a class="font-weight-normal text-small reset-anchor"
                                                        href="mailto:info@ipg.tl">info@ipg.tl</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <?php include('include/header_menu_container.php'); ?>
    </div>

</header>

