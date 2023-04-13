<?php
/*
  Template Name: The Contact page
 */
?>
<?php get_header(); ?>
<!--contact-section-starts-->
<div class="container">            
    <div class="row">
        <div class="col-md-8">
            <h3>Find Us Here</h3>
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
            <div style='overflow:hidden;height:440px;'>
                <div id='gmap_canvas' style='height:440px;width:100%;'></div>                   
                <style>
                    #gmap_canvas img{max-width:none!important;background:none!important}
                </style>
            </div>
            <?php
            $lat = get_general_setting('ipg_address_lat');
            $lon = get_general_setting('ipg_address_long');
            ?>
            <script type='text/javascript'>
                function init_map() {
                    var myOptions = {
                        zoom: 18,
                        center: new google.maps.LatLng(<?= $lat; ?>,<?= $lon; ?>),
                        mapTypeId: google.maps.MapTypeId.HYBRID,
                        disableDefaultUI: true
                    };

                    map = new google.maps.Map(
                            document.getElementById('gmap_canvas'),
                            myOptions
                            );
                    marker = new google.maps.Marker(
                            {
                                map: map,
                                position: new google.maps.LatLng(<?= $lat; ?>,<?= $lon; ?>)
                            });
                    var content = "<strong><?php echo get_general_setting('ipg_short_name') ?></strong>";

                    infowindow = new google.maps.InfoWindow(
                            {
                                content: content});
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
                }
                google.maps.event.addDomListener(window, 'load', init_map);
            </script>
        </div>
        <div class="col-md-4">
            <h3>Contact info</h3>
            <p>
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    }
                }
                ?>
            </p>
            <address>
                <strong><?php echo get_general_setting('ipg_short_name'); ?></strong><br>
                <i class="fa fa-map-marker"> </i> <?php echo get_general_setting('ipg_address') ?><br /><br />
                <p>
                    <i class="fa fa-phone"> </i> <?php echo get_general_setting('ipg_contact_phone') ?><br>
                    <i class="fa fa-envelope"> </i> <?php echo get_general_setting('ipg_contact_email') ?> <br>
                </p>
            </address>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php
get_footer();
