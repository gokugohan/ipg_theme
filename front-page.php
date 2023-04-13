<?php
/*
  Template Name: The frontpage
 */
?>
<?php
get_header();
?>

    <div class="header-carousel-list">
        <?php include TEMPLATEPATH . '/include/ipg_slider.php'; ?>
    </div>

    <section class="py-5 bg-light">
        <div class="section-container">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary">Our Values</p>
                    </div>
                </div>
            </header>
            <div class="row align-items-center bg-our-values">
                <!-- <div class="col-lg-5 ml-auto mb-4 mb-lg-0 order-1 order-lg-1">
                    <div class="p-2 border"><img class="img-fluid" src="img/ipg/03.jpeg" alt=""></div>
                  </div> -->
                <div class="col-lg-12">
                    <ol class="list-numbers row px-3 mb-4">
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Integrity</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(1); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Professional</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(2); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Greatness</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(3); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Teamwork</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(4); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Intuitive</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(5); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Maturity</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(6); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Optimist</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(7); ?></p>
                        </li>
                        <li class="col-lg-4 mb-2 on-hover">
                            <h5>Respect</h5>
                            <p class="text-small text-muted"><?= show_ipg_values(8); ?></p>
                        </li>
                    </ol>

                </div>
            </div>
    </section>

    <div class="bg-white py-5">
        <div class="section-container">
            <div class="row">
                <div class="col-md-6 col-sm-12 recente-news-container">
                    <div class="maps-and-data">
                        <h2 class="maps-and-data-title">
                            <!-- <span class="fa fa-list  icon-circle"></span> -->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-newspaper  icon-circle"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                                <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                            </svg>
                            Recent News
                        </h2>
                        <ul class="recent-posts">
                            <?php
                            // the query
                            $the_query = new WP_Query(array(
                                'posts_per_page' => 5,
                            ));
                            ?>

                            <?php if ($the_query->have_posts()) : ?>
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                                    <li class="recent-posts-item bg-white rounded ml-3 p-2">
                                        <p class="recent-posts-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title();
                                                ?></a>
                                        </p>
                                        <span class="small text-gray"><i class="bi bi-clock mr-1"></i>
                                        <?php the_time('j M Y'); ?> | <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                        </span>
                                    </li>
                                <?php endwhile; ?>

                                <?php wp_reset_postdata(); ?>

                            <?php else : ?>
                                <p><?php __('No Recent Posts'); ?></p>
                            <?php endif; ?>

                        </ul>

                    </div>
                </div>

                <div class="col-md-6 col-sm-12 maps-and-data-container">
                    <div class="maps-and-data">
                        <h2 class="maps-and-data-title"><span class="fa fa-map-marker-alt  icon-circle"></span> Maps and
                            data</h2>

                        <ul class="maps-and-data-list">
                            <li>
                                <a href="#!"><span class="fa fa-map-marker"></span>
                                    <span class="text">Map viewers</span>
                                    <span class="float-right fa fa-angle-right maps-and-data-item-white"></span>
                                </a>
                            </li>
                            <li>
                                <a href="https://gis.ipg.tl/dbgis/"><span class="fa fa-map-marker"></span>
                                    <span class="text">Metadata and downloads</span>
                                    <span class="float-right fa fa-angle-right maps-and-data-item-white"></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php bloginfo('url'); ?>/Studies-And-Research"><span
                                            class="fa fa-map-marker"></span>
                                    <span class="text">Publications</span>
                                    <span class="float-right fa fa-angle-right maps-and-data-item-white maps-and-data-item-white"></span>
                                </a>
                            </li>
                        </ul>
                        <!--                        <p class="float-right mt-3">-->
                        <!--                            <a href="https://gis.ipg.tl/webgis/" class="merlenke">Go to our maps page <span-->
                        <!--                                        class="fa fa-angle-right maps-and-data-item-white-small"></span></a>-->
                        <!--                        </p>-->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Latest publications -->
    <div class="py-5 bg-light">
        <div class="section-container">

            <div class="row publications">
                <div class="col-md-3">
                    <div class="publications_header">
                        <p class="center">
                            <img style="width: 150px;"
                                 src="<?php echo get_stylesheet_directory_uri() . '/images/studies_and_research.png'; ?>"
                                 alt="Studies and Research">
                        </p>
                        <h2 class="maps-and-data-title center">Studies and Research</h2>
                    </div>
                </div>
                <div class="col-md-9 features">
                    <?php ipg_display_studies_and_research_frontpage(); ?>
                    <div class="col-md-12">
                        <p class="float-end mt-4">
                            <a href="<?php bloginfo('url'); ?>/Studies-And-Research" class="merlenke">Show all <span
                                        class=""></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earthquake Section -->
    <section class="pt-5 section-earthquake" id="section-earthquake">
        <div class="section-container">
            <h2 class="h2 mb-1 text-uppercase text-primary mb-3 text-center">
                <a href="<?php bloginfo('url'); ?>/Earthquake" target="_blank"
                   class="text-primary text-decoration-none"><span
                            class="fa fa-map-marker"></span>Earthquake</a>
            </h2>
            <input type="hidden" id="earthquake_front_page" value="1">
<!--            <input type="hidden" id="earthquake_url" value="--><?//= get_earthquake_setting('earthquake_url'); ?><!--">-->
<!--            <input type="hidden" id="earthquake_radius" value="--><?//= get_earthquake_setting('earthquake_radius'); ?><!--">-->
            <input type="hidden" id="municipality_map"
                   value="<?php echo get_stylesheet_directory_uri() . '/js/municipality.json' ?>">

            <input type="hidden" id="earthquake_url_legend"value="<?php echo get_stylesheet_directory_uri() . '/images/map_legend.png'; ?>">

            <div class="earthquake_container" id="earthquake_container">
                <div class="row">
                    <div class="col-md-3">
                        <ol id="frontpage-recent-earthquake-list" class="list-numbers mb-0 ml-2">

                        </ol>
                    </div>
                    <div class="col-md-9">
                        <div id="map-canvas"></div>
                    </div>
                </div>

            </div>

        </div>
    </section>

<?php
get_footer();
