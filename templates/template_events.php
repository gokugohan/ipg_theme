<?php
/*
  Template Name: The Event page
 */
?>
<?php
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'nopaging' => false,
    'posts_per_page' => 10,
    'post_type' => 'event',
    'post_status' => 'published',
    'paged' => $paged,
    'meta_key' => 'event-start-date',
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
);

?>

    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary">Events</p>
                        <hr>
                        <br>
                    </div>
                </div>
            </header>
            <div class="row align-items-stretch">

                <div class="posts-listing col-lg-12">
                    <div class="container">

                        <ul class="recent-posts">
                            <?php
                            // the query
                            $posts = new WP_Query($args);
                            ?>

                            <?php if ($posts->have_posts()) : ?>
                                <?php while ($posts->have_posts()) : $posts->the_post(); ?>


                                    <li class="recent-posts-item bg-white rounded ml-3 p-2 shadow">

                                        <p class="recent-posts-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title();
                                                ?></a>
                                        </p>
                                        <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i>
                                        <?php the_time('j M Y'); ?> | <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                        </span>
                                        <?php

                                        $event_start_date = get_post_meta(get_the_ID(), 'event-start-date', true);
                                        $event_end_date = get_post_meta(get_the_ID(), 'event-end-date', true);
                                        $event_venue = get_post_meta(get_the_ID(), 'event-venue', true);

                                        $event = '<table class="table">';
                                        $event .= '<tr>';
                                        $event .= '<td><strong>' . __('Event Start Date:', 'upcoming-events') . '</strong><br>' . date_i18n(get_option('date_format'), $event_start_date) . '</td>';
                                        $event .= '<td><strong>' . __('Event End Date:', 'upcoming-events') . '</strong><br>' . date_i18n(get_option('date_format'), $event_end_date) . '</td>';
                                        $event .= '<td><strong>' . __('Event Venue:', 'upcoming-events') . '</strong><br>' . $event_venue . '</td>';
                                        $event .= '</tr>';
                                        $event .= '</table>';

                                        echo $event;
                                        ?>
                                    </li>
                                <?php endwhile; ?>

                                <?php wp_reset_postdata(); ?>

                            <?php else : ?>
                                <p><?php __('No Recent Posts'); ?></p>
                            <?php endif; ?>

                        </ul>

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
                    </div>
                </div>
            </div><!-- /row -->
        </div>

    </div>

<?php
get_footer();
