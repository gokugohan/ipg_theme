<?php
/*
  Template Name: The Procurements page
 */
?>
<?php get_header(); ?>
    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary"><?= the_title(); ?></p>
                        <hr>
                        <br>
                    </div>
                </div>
            </header>
            <div class="row align-items-stretch">


                <div class="col-sm-12">
                    <?php the_content();?>
                    <?php
//                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
//                    $args = array(
//                        'post_type' => array('procurement'),
//                        'post_status' => 'publish',
//                        'orderby' => 'title',
//                        'order' => 'DESC',
//                        'paged' => $paged,
//                    );
//                    $procurement_query = new WP_Query($args);

                    ipg_display_procurement();
?>


<!--                    <div class="table-responsive">-->
<!--                        <table class="table table-hover" id="table-procurement">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Title</th>-->
<!--                                <th>Opening Date</th>-->
<!--                                <th>Closing Date</th>-->
<!--                                <th>Attachment</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php
//                            if ($procurement_query->have_posts()) {
//                                while ($procurement_query->have_posts()) {
//                                    $procurement_query->the_post();
//                                    $open_date = get_post_meta($post->ID, 'procurement_open_date', true);
//                                    $closing_date = get_post_meta($post->ID, 'procurement_closing_date', true);
//                                    $file = get_post_meta($post->ID, 'procurement_file', true);
//                                    ?>
<!--                                    <tr>-->
<!--                                        <td>--><?php //the_title(); ?><!--</td>-->
<!--                                        <td>--><?//=$open_date ?><!--</td>-->
<!--                                        <td>--><?//=$closing_date ?><!--</td>-->
<!--                                        <td><a href="--><?//=$file ?><!--" class="btn btn-sm btn-outline-success" target="_blank"><i class="bi bi-download"></i></a></td>-->
<!--                                    </tr>-->
<!--                                    --><?php
//                                }
//                                /* Restore original Post Data */
//                                wp_reset_postdata();
//                                ?>
<!--                                --><?php
//                            }else{
//                                ?>
<!--                                <tr>-->
<!--                                    <td colspan="3"><span class="text-info">No procument info</span></td>-->
<!--                                </tr>-->
<!--                                    --><?php
//                            }
//                            ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->

                </div>
            </div><!-- /row -->
        </div>

    </div>
<?php
get_footer();
