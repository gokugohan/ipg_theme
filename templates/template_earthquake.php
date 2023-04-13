<?php
/*
  Template Name: Earthquake Dashboard
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?>>
<head>
    <title><?=
        get_bloginfo('name') . " ";
        is_page() || is_category() ? wp_title('@') : "";
        ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="icon" href="http://ipg.tl/wp-content/uploads/2017/08/logo-150x150.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed"
          href="<?php bloginfo('url') ?>/wp/wp-content/uploads/2018/05/cropped-logo-65x65-180x180.png"/>
    <meta name="msapplication-TileImage"
          content="<?php bloginfo('url') ?>/wp/wp-content/uploads/2018/05/cropped-logo-65x65-270x270.png"/>

    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/earthquake/bootstrap4-alpha3.min.css' ?>">

    <!-- stylesheets -->
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/fonts/font-roboto.css'?>" rel="stylesheet">

    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css'?>" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/earthquake/style.css'?>" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/earthquake/dashboard.css'?>" rel="stylesheet">


</head>
<body>

<!-- header -->
<nav class="navbar navbar-fixed-top" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png' ?>"/>
            <div class="brand">
                <a href="/Earthquake">
                    <span class="hidden-xs-down m-r-3">Earthquake </span><span class="lead">IPG-IP</span>
                </a>

            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="fa fa-home fa-lg fa-fw" aria-hidden="true"></i>
                        <span>Home</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/Earthquake"><i class="fa fa-dashboard fa-lg fa-fw" aria-hidden="true"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Earthquake/Map">
                        <i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
                        <span>Map</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://geohazard.ipg.tl:83/earthquake/list">
                        <i class="fa fa-download fa-lg fa-fw" aria-hidden="true"></i>
                        <span>Download Data</span>
                    </a>
                </li>
            </ul>
            <div id="sidebar-toggle-button-menu">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</nav>
<!-- /header -->
<!-- page-content-wrapper -->
<div class="page-content-toggle" id="page-content-wrapper">
    <div class="container-fluid">

        <div class="row m-b-2">
            <div class="col-lg-6">
                <div class="card card-block">
                    <h4 class="card-title">Event with Magnitude >= <span id="current-magnitude"></span>
                        <select name="select-event-magnitude" id="select-event-magnitude" class="form-control custom-form-select"></select>
                    </h4>

                    <div id="event-magnitude-chart"><div class="loader"><p>Getting data</p></div></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-block">
                    <h4 class="card-title">Event Occurences in Region by Year <span id="current-year"></span> <select name="select-event-year" id="select-event-year" class="form-control custom-form-select"></select></h4>
                    <div id="current-year-event-chart"><div class="loader"><p>Getting data</p></div></div>
                </div>
            </div>
<!--            <div class="col-lg-4">-->
<!--                <div class="card card-block">-->
<!--                    <h4 class="card-title">Event by Depth</h4>-->
<!--                    <div id="event-depth-chart"></div>-->
<!--                </div>-->
<!--            </div>-->
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-block">
                    <h4 class="card-title m-b-2">Number of Occurences by Region
                        <input type="number" id="input-radius-occ-region" min="0" placeholder="Prefered radius <?= get_earthquake_setting('earthquake_radius'); ?>" class="form-control input-radius"/>
                    </h4>
                    <div id="number-of-occurences-by-location-chart"><div class="loader"><p>Getting data</p></div></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-block">
                    <h4 class="card-title m-b-2">Number of Occurences by Year
                        <input type="number" id="input-radius-occ-year" min="0" placeholder="Prefered radius <?= get_earthquake_setting('earthquake_radius'); ?>" class="form-control input-radius"/>
                    </h4>
                    <div id="number-of-occurences-by-year-chart"><div class="loader"><p>Getting data</p></div></div>
                </div>
            </div>

        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /page-content-wrapper -->
<span class="default-earthquake-radius">Default Radius: <?= get_earthquake_setting('earthquake_radius'); ?> km</span>

<input type="hidden" id="earthquake_url" value="<?= get_earthquake_setting('earthquake_url'); ?>">
<input type="hidden" id="earthquake_radius" value="<?= get_earthquake_setting('earthquake_radius'); ?>">
<input type="hidden" id="municipality_map"
       value="<?php echo get_stylesheet_directory_uri() . '/js/municipality.json' ?>">


<!--
<div id="preloader">
    <h2 class="preloader-title">Instituto do Petróleo e Geologia</h2>
</div>
-->
<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/jquery/jquery.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/funnel3d.js"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/earthquake/dashboard.js' ?>"></script>
<script>
    $(window).on('load', function () {
        if ($('#preloader').length) {
            $('#preloader').delay(100).fadeOut('slow', function () {
                $(this).remove();
            });

        }
    });

    $(document).ready(function (){
        $('#sidebar-toggle-button-menu').on('click',function (){
            $(".navbar-header ul.navbar-nav").toggleClass('show-menu');
        })
    })
</script>

</body>
</html>

