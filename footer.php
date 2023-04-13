<input type="hidden" id="earthquake_url" value="<?= get_earthquake_setting('earthquake_url'); ?>">
<input type="hidden" id="earthquake_radius" value="<?= get_earthquake_setting('earthquake_radius'); ?>">
<footer class="bg-footer">
    <div class="section-container">
        <div class="row">
            <div class="col-md-3">
                <div class="content">
                    <div class="bottominfo bottominfo-border-right">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png'; ?>"
                                     class="img-fluid footer-logo">
                                <br>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <p class="mb-1 text-dark"><?php echo get_general_setting('ipg_short_name'); ?></p>
                                <a href="https://www.google.no/maps/place/Institute+of+Petroleum+and+Geology/@-8.5606125,125.5403174,808m/data=!3m1!1e3!4m5!3m4!1s0x2d01dd0b05f712d5:0x1bcb1216ce65db33!8m2!3d-8.5605756!4d125.5415503?hl=en"
                                   target="_blank" class="mb-1 bottominfo-maplink"><i
                                            class="fas fa-map-marker-alt mr-3 fa-fw"></i><span
                                            class="text-small text-muted">
                                        <?php echo get_general_setting('ipg_address') ?>
                                    </span></a>
                                <p class="mb-1"><i class="fas fa-envelope mr-3 fa-fw"></i><span
                                            class="text-small text-muted">
                                        <?php echo get_general_setting('ipg_contact_email') ?>
                                    </span></p>
                                <p class="mb-1"><i class="fas fa-mobile mr-3 fa-fw"></i><span
                                            class="text-small text-muted">
                                        <?php echo get_general_setting('ipg_contact_phone') ?>
                                    </span></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="mt-3 mb-4 fw-normal">Quick links</h5>

                        <?php ipg_quick_links_menu(); ?>
                    </div>

                    <div class="col-md-3">
                        <h5 class="mt-3 mb-4 fw-normal">External Link</h5>

                        <?php ipg_external_links_menu(); ?>
                    </div>

                    <div class="col-md-3">
                        <h5 class="mt-3 mb-4 fw-normal">Legal</h5>
                        <?php ipg_legal_links_menu(); ?>
                    </div>
                    <!---->
                    <!---->
                    <!--                    <div class="col-md-12">-->
                    <!--                        --><?php //ipg_social_links_menu(); ?>
                    <!--                    </div>-->
                </div>
            </div>

        </div>
    </div>
    <div class=" py-4">
        <div class="container text-center">
            <hr>
            <p class="text-muted">
                <?= show_ipg_summary(); ?>
            </p>
            <p class="h6  text-muted">&copy <?php
                $copyYear = 2012; // Set your website start date
                $curYear = date('Y'); // Keeps the second year updated
                echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
                ?> Copyright. <a class="text-green ml-2" href="<?php bloginfo('url') ?>/privacy-and-statement"
                                 target="_blank">IPG-IP</a></p>
        </div>
    </div>
</footer>


<!--<div id="preloader">-->
<!--	<h2 class="preloader-title">Instituto do Petróleo e Geologia</h2> -->
<!--	<canvas id="tp__canvas"></canvas>-->
<!--</div>-->


<!-- Modal -->
<div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control"
                           id="search-post-keyword">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                </div>

                <div class="search-result">

                    <div class="search-post-result-list"></div>
                </div>

            </div>


        </div>
    </div>
</div>

<input type="hidden" value="<?php echo get_stylesheet_directory_uri()?>" id="asset_url">


<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/jquery/jquery.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/vendor/owl.carousel2/owl.carousel.min.js' ?>"></script>
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/infinite-scroll-pagination/css/scrollpagination.css' ?><!--"></script>-->
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/infinite-scroll-pagination/js/scrollpagination.js' ?><!--"></script>-->

<script>
    $(document).ready(function () {

        $("body").on("click",".close-me",function (){
            $(".search-result-list").hide();
            alert(1)
        });

        $("#input-search-publication").on("keyup", function () {
            $(".search-result-list").show();
            let keyword = $(this).val();

            if (keyword.length > 1) {
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {action: 'publication_search_result_fetch', keyword: keyword},
                    success: function (data) {

                        $('.search-result-list').html(data);
                    }
                });
            }else{
                $('.search-result-list').html('');
                // $('.search-result-list').html('<p class="text-warning m-0 p-1"> ' + keyword + ' not found!</p>');
            }
        });
        $("#news-search-keyword").on("keyup", function () {
            let keyword = $(this).val();
            console.log(keyword);
            if (keyword.length > 2) {
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {action: 'fetch_news_list', keyword: keyword},
                    success: function (data) {
                        $('.search-result-list').html(data);
                    }
                });
            }else{
                $('.search-result-list').html('<p class="text-warning"> ' + keyword + ' not found!</p>');
            }
        });

		$("#search-post-keyword").on("keyup", function () {
            let keyword = $(this).val();

            if (keyword.length > 2) {
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {action: 'fetch_post_list', keyword: keyword},
                    success: function (data) {
                        $('.search-post-result-list').html(data);
                    }
                });
            }else{
                $('.search-post-result-list').html('<p class="text-warning"> ' + keyword + ' not found!</p>');
            }
        });

		$('#table-procurement').DataTable({"ordering": false});

		$(".menu-item").addClass('ri-check-double-line');
    });
</script>

<?php if (is_page("Events")) {
    ?>
    <!--    <script src="<?php echo get_stylesheet_directory_uri() . '/js/calendar.min.js' ?>"></script>
        <script src="<?php echo get_stylesheet_directory_uri() . '/js/jstz.min.js' ?>"></script>
        <script src="<?php echo get_stylesheet_directory_uri() . '/js/init_calendar.js' ?>"></script>-->

    <?php
}
?>

<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<?php
if (is_front_page()) {
    ?>
    <script src="<?php echo get_stylesheet_directory_uri() . '/vendor/leaflet/leaflet.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/vendor/leaflet/leaflet.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/js/leaflet.markercluster.js' ?>"></script>

    <script src="<?php echo get_stylesheet_directory_uri() . '/js/L.Icon.Pulse.js' ?>"></script>

    <script src="<?php echo get_stylesheet_directory_uri() . '/js/earthquake.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/js/earthquake_map_viewer.js' ?>"></script>

    <script>

        window.addEventListener('scroll', function () {
            // console.log(window.scrollY);
            // if (window.scrollY > 150) {
            //     document.getElementById('header-logo-menu-container').classList.add('fixed-top');
            //     navbar_height = document.querySelector('.navbar').offsetHeight;
            //     document.body.style.paddingTop = navbar_height + 'px';
            // } else {
            //     document.getElementById('header-logo-menu-container').classList.remove('fixed-top');
            //     document.body.style.paddingTop = '0';
            // }
        });
    </script>
    <?php
}else{
    ?>

    <script>
        $(document).ready(function(){
            loadSlideMarqueeRecent();
            function loadSlideMarqueeRecent(){
                let self = this;
                let url = this.earthquakeLink + '5/' + this.preferedRadius;
                $.ajax({
                    url: $("#earthquake_url").val()+'5/'+$("#earthquake_radius").val(),
                    method: "get",
                    dataType: "json",
                    crossDomain: true,
                    success: function (response) {
                        // get only items in defined radius
                        var lista = response.events;
                        let marqueeEqList = $("#slide-recent-earthquake");
                        let marqueeText = "";
                        for (let i = 0; i < lista.length; i++) {
                            let item = lista[i];
                            var event_datetime = moment(item.event_datetime).add(9, "hours").format("ddd DD MMMM YYYY, HH:mm:ss");

                            marqueeText += item.region + " - " + item.magnitude + " <span class='text-sm'>(" + event_datetime + " OTL)</span> | ";

                            marqueeEqList.html("<a href='#section-earthquake'>" + marqueeText + "</a>");
                        }


                    },
                    error: function (error) {
                        $("#slide-recent-earthquake").html("<span class='text-danger'>Error getting earthquake data</span>");
                    }
                });
            }//loadSlideMarqueeRecent

        })
    </script>
<?php
}
?>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/datatables.min.js' ?>" type="text/javascript"></script>
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/js/text-particles.min.js' ?><!--"></script>-->
<script src="<?php echo get_stylesheet_directory_uri() . '/js/script.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/main.js' ?>"></script>


<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


<?php wp_footer(); ?>
</body>
</html>
