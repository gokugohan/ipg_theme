<?php
/*
  Template Name: Earthquake Map
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
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/fonts/font-roboto.css' ?>" rel="stylesheet">

    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' ?>"
          rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/earthquake/style.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/custom.css' ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/earthquake.css' ?>">

    <link href="//fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/vendor/leaflet/leaflet.css' ?>"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/MarkerCluster.css' ?>"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/MarkerCluster.Default.css' ?>"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/L.Icon.Pulse.css' ?>"/>

    <style>


        .earthquakes-legend {
            padding: 5px;
            /*margin: 0 0 !important;*/
            background: #fff !important;
        }

        .earthquakes-legend .legend-title {
            display: block;
            padding: 1px;
            font-size: 14px !important;
            font-weight: 700;
            text-transform: uppercase;
            color: #34495e;
        }

        .earthquakes-legend img.img-legend {
            width: 150px;
        }

        img.leaflet-marker-icon-active {
            animation: flash_eq_icon 1s ease infinite;
            transform-origin: 50% 50%;
        }


        img.leaflet-marker-icon {
            border: 1px solid #ffffff;
            width: 50px !important;
            height: 50px !important;
        }



        .eq-title{
            font-size: 16px;
            font-weight: bold;
            padding: 0;
            margin: 0;
            white-space: nowrap;
        }

        .leaflet-control-layers{
            background: transparent;
            border: none !important;
        }
        .leaflet-control-layers-toggle{
            background-color: #34495e;
            border-radius: 50%;
            border: none;
        }

        .leaflet-control-layers-expanded{
            background: #34495e !important;
        }

        .leaflet-control-layers-base label span{
            text-transform: uppercase;
            font-weight: 700;
            margin-left: 2px;
            color: #fff;
        }
    </style>

</head>
<body>

<!-- header -->
<nav class="navbar navbar-fixed-top" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <div id="sidebar-toggle-button">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
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
                <li class="nav-item">
                    <a class="nav-link" href="/Earthquake"><i class="fa fa-dashboard fa-lg fa-fw"
                                                              aria-hidden="true"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item active">
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

<!-- sidebar -->
<div class="sidebar-toggle" id="sidebar">
    <div class="sidebar-top-header">
        <div class="ms-3 text-center pageheader-title-container">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png' ?>"
                     class="img-fluid rounded sidebar-logo">
            </a>
            <h4 class="header-title">INSTITUTO DO PETRÓLEO E GEOLOGIA</h4>
            <cite class="citation" style="font-size: 12px">To be a credible Geoscience
                Research Institution in the
                world</cite>
        </div>
        <div class="divider"></div>
        <div class="select-item-display-container">
            <div class="form-group">
                <label for="total_to_display">Total items to display</label>
                <select name="total_to_display" id="total_to_display" class="custom-select form-control">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="50" selected>50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                    <option value="">All</option>
                </select>
            </div>
            <div class="form-check mt-3">
                <input class="form-check-input" id="display_all" type="checkbox" checked>
                <label class="form-check-label" for="display_all">
                    <span class="fst-italic pl-1">Display only within radius  <?= number_format(get_earthquake_setting('earthquake_radius')); ?> km<sup>2</sup></span>
                </label>
            </div>
        </div>
    </div>

    <ul class="nav nav-sidebar">

        <li>

        </li>
        <li role="separator" class="divider"></li>
        <li>

        </li>
        <li role="separator" class="divider"></li>
        <li>
            <div class="most-recent-earthquake-list-container">
                <ol id="most-recent-earthquake-list" class="list-numbers mb-0"></ol>
            </div>
        </li>
        <li role="separator" class="divider"></li>

    </ul>
</div>
<!-- /sidebar -->

<!-- page-content-wrapper -->
<div class="page-content-toggle" id="page-content-wrapper">
    <div id="map-canvas">
        <div class="earthquake-logo-footer">
            <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png'; ?>" class="img-fluid"/>
        </div>
    </div>

</div>
<!-- /page-content-wrapper -->

<input type="hidden" id="earthquake_url" value="<?= get_earthquake_setting('earthquake_url'); ?>">
<input type="hidden" id="earthquake_radius" value="<?= get_earthquake_setting('earthquake_radius'); ?>">
<input type="hidden" id="earthquake_url_legend"
       value="<?php echo get_stylesheet_directory_uri() . '/images/map_legend.png'; ?>">
<input type="hidden" id="municipality_map"
       value="<?php echo get_stylesheet_directory_uri() . '/js/municipality.json' ?>">
<input type="hidden" value="<?php echo get_stylesheet_directory_uri() ?>" id="asset_url">

<!--
<div id="preloader">
    <h2 class="preloader-title">Instituto do Petróleo e Geologia</h2>
</div>
-->
<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/jquery/jquery.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/leaflet/leaflet.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/leaflet.markercluster.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/L.Icon.Pulse.js' ?>"></script>


<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/leaflet.contextmenu.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/earthquake.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/earthquake_map_viewer.js' ?>"></script>

<script>
    $(window).on('load', function () {
        if ($('#preloader').length) {
            $('#preloader').delay(100).fadeOut('slow', function () {
                $(this).remove();
            });

        }
    });

    $(document).ready(function () {

        $('#sidebar-toggle-button').on('click', function () {
            $('#sidebar').toggleClass('sidebar-toggle');
            $('#page-content-wrapper').toggleClass('page-content-toggle');

        });

        $('#sidebar-toggle-button-menu').on('click', function () {
            $(".navbar-header ul.navbar-nav").toggleClass('show-menu');
        })
    })

</script>

</body>
</html>

