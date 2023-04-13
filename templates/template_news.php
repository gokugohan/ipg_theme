<?php

/*
  Template Name: News page
 */

get_header();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'nopaging' => false,
    'posts_per_page' => 10,
    'post_type' => array('page', 'post'),
    'post_status' => 'published',
    'paged' => $paged,
    'category_name' => 'news'
);
?>
    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary">News</p>
                        <hr>
                        <div class="widget search mx-auto" style="width: 75%">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       id="news-search-keyword"
                                       placeholder="Search Here" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="search-result-list"></div>
                        </div>
                        <br>
                    </div>
                </div>
            </header>

            <div class="row align-items-stretch">
                <div class="posts-listing col-lg-12">
                    <div class="container-fluid">

                        <div class="news-list">
                            <div class="row media-release">
                                <?php
                                $posts = new WP_Query($args);
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
                                        <!-- post -->
                                        <div class="post col-xl-3 col-md-6 on-hover">
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <div class="card-post-header"
                                                         style="background-image: url('<?= $post_image_feature_url; ?>'); height: 250px;"
                                                    >
                                                    </div>

                                                </a>
                                                <div class="post-details">
                                                    <div class="post-meta d-flex justify-content-between">
                                                        <div class="date meta-last"><?php the_time('j M Y'); ?></div>
                                                    </div>
                                                    <h5 class="font-weight-medium mt-3 px-2">
                                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none link">
                                                            <?php the_title(); ?>
                                                        </a></h5>

                                                    <p class="text-muted"><?php echo(excerpt()); ?></p>
                                                    <footer class="post-footer d-flex align-items-center">

                                                        <div class="date">
                                                            <i class="icon-clock"></i> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                        </div>
                                                    </footer>
                                                </div>
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
                                        <h3 class="centered text-info">No news</h3>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="Page navigation news-pagination">
                                <?php
                                $total_pages = $posts->max_num_pages;
                                $pagination = paginate_links(array(
                                    'base' => get_pagenum_link(1) . '%_%',
                                    'format' => 'page/%#%',
                                    'type' => 'array', //instead of 'list'
                                    'total' => $total_pages,
                                    'current' => $paged,
                                    'aria_current' => 'Song goku'
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
                </div>
            </div>
        </div>
    </div>

    <div id="scrollpagination">
        <ul id="content"></ul>
    </div>
    <div class="loading" id="loading"></div>
<?php
get_footer();
