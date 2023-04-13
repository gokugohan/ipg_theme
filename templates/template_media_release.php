<?php
/*
  Template Name: Media release page
 */
?>

<?php get_header(); ?>
    <div class="pt-0 py-5 bg-light">
    <div class="container-fluid">
        <div class="media-release">

            <div class="text-center">
                <p class="h2 text-uppercase text-primary"><?= the_title(); ?></p>
<!--                <h6 class="subtitle font-weight-normal"></h6>-->
                <hr>
            </div>

            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $args = array(
                'nopaging' => false,
                'posts_per_page' => 6,
                'post_type' => array('page', 'post'),
                'post_status' => 'published',
                'paged' => $paged,
                'category_name' => 'media-release'
            );

            $posts = new WP_Query($args);
            $total_post = $posts->post_count;
            $total_row = 2;
            $row_created = FALSE;
            ?>
            <!-- Row  -->
            <div class="row mt-4">
                <?php
                if ($posts->have_posts()) {
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        $post_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

                        if (has_post_thumbnail($post) && $post_image_feature != null) {
                            $post_image_feature_url = $post_image_feature;
                        } else {
                            $post_image_feature_url = get_template_directory_uri() . "/images/wave.png";
                        }
                        ?>

                        <!-- Column -->
                        <div class="col-md-3 on-hover">
                            <div class="card border-0 mb-4">
                                <div class="card-post-header"
                                     style="background-image: url('<?= $post_image_feature_url; ?>')"
                                >
                                    <!--                                <a href="#"><img class="card-img-top" src="-->
                                    <?//= $post_image_feature_url; ?><!--" alt="wrappixel kit"></a>-->
                                </div>

                                <div class="date-pos bg-info-gradiant p-2 d-inline-block text-center rounded text-white position-absolute">
                                    Oct<span class="d-block">23</span></div>
                                <h5 class="font-weight-medium mt-3 px-2">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none link">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <a href="<?php the_permalink(); ?>"
                                   class="text-decoration-none linking text-themecolor mt-2 px-2">Learn More</a>
                            </div>
                        </div>

                        <?php
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                    <?php
                } else {
                    ?>
                    <div class="news-item">
                        <h3 class="centered text-info">No media release found!</h3>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>


        <div class="Page navigation example">
            <?php
            $total_pages = $posts->max_num_pages;
            $pagination = paginate_links( array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => 'page/%#%',
                'type' => 'array', //instead of 'list'
                'total' => $total_pages,
                'current' => $paged,
                'aria_current'=>'Hello world'
            ));
            ?>

            <?php if (!empty($pagination)) : ?>
                <ul class="pagination justify-content-center mb-0">

                    <?php foreach ($pagination as $key => $page_link) : ?>
                        <li class="page-item mx-1<?php if (strpos($page_link, 'current') !== false) {
                            echo ' active';
                        } ?>"><?php echo $page_link ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

            <br>
            <br>
        </div>

    </div>
<?php
get_footer();
