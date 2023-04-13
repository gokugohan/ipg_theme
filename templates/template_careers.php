<?php
/*
  Template Name: Career and opportunities page
 */
?>
<?php get_header(); ?>
    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary">Available Vacancies</p>
                        <hr>
                        <br>
                    </div>
                </div>
            </header>
            <div class="row align-items-stretch">
                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $args = array(
                    'nopaging' => false,
                    'posts_per_page' => 6,
                    'post_type' => array('page', 'post'),
                    'post_status' => 'published',
                    'paged' => $paged,
                    'category_name' => 'career-and-opportunities'
                );

                $posts = new WP_Query($args);
                $total_post = $posts->post_count;
                $total_row = 2;
                $row_created = FALSE;

                if ($posts->have_posts()) {
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        $postDate = strtotime($post->post_date);
                        $todaysDate = strtotime(date('Y-m-d'));
                        ?>
                        <div class="col-sm-12 col-md-6">
                            <div class="job-list">
                                <div class="job-list-carrer-item">
                                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                                        <span class="news-item-time">
                                    <?php the_time('j M Y'); ?> | <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                </span>
                                    </h6>
                                    <p>
                                        <br/>
                                        <span class="job-list-carrer-item-description">
                                        Summary : </span><?php echo(excerpt(20)); ?>
                                    </p>
                                    <ul class="job-list-carrer-item-links">
                                        <li><a href="mailto:tlebre@ipg.tl"><i
                                                        class="fa fa-envelope-o icon_1"> </i><span
                                                        class="icon_text"> Email this Vacancy</span></a></li>
                                        <li><a href="<?php the_permalink(); ?>"><i class="fa fa-eye icon_1"> </i>
                                                <span
                                                        class="icon_text">Vacancy full Vacancy Description</span></a>
                                        </li>
                                        <li>
                                            <?php
                                            $active = get_post_meta($post->ID, "active", TRUE);

                                            if ($active == 1) {
                                                ?>
                                                <!--                                            <i class="fa fa-check icon_1"> </i><span class="icon_text"> Currently open</span>-->
                                                <?php
                                            } else {
                                                ?>
                                                <!--                                            <i class="fa fa-ban icon_1"> </i><span class="icon_text"> Closed</span>-->
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            /*
                                                                                    if ($postDate > $todaysDate) {
                                                                                        ?>
                                                                                        <i class="fa fa-check icon_1"> </i><span class="icon_text"> Currently open</span>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <i class="fa fa-ban icon_1"> </i><span class="icon_text"> Closed</span>
                                                                                        <?php
                                                                                    }
                                            */
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                    <div class="Page navigation example">
                        <?php
                        $total_pages = $posts->max_num_pages;
                        $pagination = paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%',
                            'type' => 'array', //instead of 'list'
                            'total' => $total_pages,
                            'current' => $paged,
                            'aria_current' => 'Hello world'
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

                    </div>

                    <?php
                } else {
                    ?>
                    <div class="col-md-12">
                        <h3 class="centered text-info">No vancacies found!</h3>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

<?php
get_footer();
