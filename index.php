<?php
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

<?php get_header(); ?>
    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">

                        <p class="h2 text-uppercase text-primary"><?=the_title();?></p>
                        <small><i><?php the_time('j F Y'); ?></i></small>
                        <hr>
                        <br>
                    </div>
                </div>
            </header>
            <div class="row align-items-stretch">

                <div class="col-sm-12">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            ?>
                            <div class="news-content">

                                <?php the_content(); ?>
                            </div>
                            <?php
                        }
                    } else {
                        echo('No content yet.');
                    }
                    ?>
                </div>
            </div><!-- /row -->
        </div>

    </div>
<?php
get_footer();
