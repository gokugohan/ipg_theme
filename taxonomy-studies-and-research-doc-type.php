<?php
/*
  Template Name: Studies and Research Page
 */

get_header();

$division_args = array(
    'taxonomy' => 'studies-and-research-division',
    'orderby' => 'name',
    'order' => 'ASC',
    "hide_empty" => 0,
);

$study_research_divisions = get_categories($division_args);

$doc_type_args = array(
    'taxonomy' => 'studies-and-research-doc-type',
    'orderby' => 'name',
    'order' => 'ASC',
    "hide_empty" => 0,
);


$study_research_document_types = get_categories($doc_type_args);


$term = get_queried_object();
$term_id = get_queried_object_id();

$args = array(
    'post_type' => 'studies-and-research',
    'post_status' => 'publish',
    'nopaging' => true,
    'tax_query' => array(
        array(
            'taxonomy' => 'studies-and-research-doc-type',
            'field' => 'slug',
            'terms' => array($term->slug),
            'operator' => 'IN'
        ),
    ),
);
?>


    <!-- Latest publications -->
    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">

            <header class="mb-2 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary">Studies and research repository  | <?=$term->name?></p>
                        <br>
                        <hr>
                    </div>
                </div>
            </header>


            <div class="row align-items-stretch">
                <div class="posts-listing col-lg-12">
                    <div class="mx-auto" style="width: 50%">
                        <div class="input-group mb-3">

                            <input type="text" class="form-control"
                                   id="input-search-publication"
                                   placeholder="Search Here" aria-label="Username"
                                   aria-describedby="basic-addon1">
                        </div>

                        <div class="search-result-list"></div>

                    </div>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="publications-type-container">
                                    <!-- List of publications TOPIC: Geochemestry, Geophysic, Geohazard etc -->
                                    <div class="publications">
                                        <h2 class="publications-title">PUBLICATION TOPIC</h2>
                                        <div class="publications-item-list-container">

                                            <ul class="m-0 p-0">
                                                <?php
                                                $active_class="";
                                                foreach ($study_research_divisions as $div) {
                                                    if ($div->term_id == $term_id) {
                                                        $active_class="active";
                                                    }else{
                                                        $active_class="";
                                                    }
                                                    ?>
                                                    <li class="<?=$active_class?>">
                                                        <a href="<?php echo esc_url(get_term_link($div->term_id)) ?>"
                                                           class="nav-link text-dark px-4 hoverable">
                                                            <i class="fa fa-folder-open mr-2"></i>
                                                            <span class="d-inline"><?php echo esc_html($div->cat_name) ?></span>
                                                            <span class="badge bg-secondary d-inline float-end"><?php echo esc_html($div->count) ?></span>

                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <br><br>
                                        <h2 class="publications-title">PUBLICATION TYPE</h2>
                                        <div class="publications-item-list-container">

                                            <ul class="m-0 p-0">
                                                <?php

                                                foreach ($study_research_document_types as $doc) {
                                                    if ($doc->term_id == $term_id) {
                                                        $active_class="active";
                                                    }else{
                                                        $active_class="";
                                                    }
                                                    ?>

                                                    <li class="<?=$active_class?>">
                                                        <a href="<?php echo esc_url(get_term_link($doc->term_id)) ?>"
                                                           class="nav-link text-dark px-4 hoverable">
                                                            <i class="fa fa-folder-open mr-2"></i>
                                                            <span class="d-inline"><?php echo esc_html($doc->cat_name) ?></span>
                                                            <span class="badge bg-secondary d-inline float-end"><?php echo esc_html($doc->count) ?></span>

                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="publications-content-container">
                                    <div class="publications-content-container">

                                        <div class="row list-of-publications">

                                            <?php

                                            $posts = new WP_Query($args);

                                            $file_icon_class_name = '';
                                            if ($posts->have_posts()) {
                                                while ($posts->have_posts()) {
                                                    $posts->the_post();

                                                    $author = get_post_meta($post->ID, 'sr_author', true);
                                                    $date = get_post_meta($post->ID, 'sr_date', true);
                                                    $attachment = get_post_meta($post->ID, 'sr_file', true);

                                                    ?>
                                                    <!-- Grid item -->
                                                    <div class="col-xl-6 col-md-12 mb-3">
                                                        <div class="icon-box">
                                                            <div class="icon"><i class="bi bi-filetype-pdf"
                                                                                 style="color: #c2dd79;"></i></div>
                                                            <h4 class="title">
                                                                <a href="#publication-<?= $post->ID ?>"
                                                                   data-bs-toggle="collapse"
                                                                   class="collapsed question"><?= the_title() ?></a>
                                                            </h4>
                                                            <div class="text-dark py-2 px-0 publication-post-meta">
                                                                <div class="publication-post-meta-author">
                                                                    <?php

                                                                    $doc_types = get_the_terms($post->ID, 'studies-and-research-doc-type');
                                                                    if ($doc_types && !is_wp_error($doc_types)) {
                                                                        foreach ($doc_types as $term) {
                                                                            echo '<span class="badge badge-success me-1">' . $term->name . '</span>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    |
                                                                    <?php
                                                                    $divisions = get_the_terms($post->ID, 'studies-and-research-division');
                                                                    if ($divisions && !is_wp_error($divisions)) {
                                                                        foreach ($divisions as $term) {
                                                                            echo '<span class="badge badge-info me-1">' . $term->name . '</span>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    |
                                                                    <span class="badge badge-success"><i
                                                                                class="fa fa-users"></i> <?= $author ?></span>
                                                                </div>
                                                                |
                                                                <i style="color: #c2dd79;"
                                                                   class="fa fa-calendar"></i> <?php the_time('M/d/Y');
                                                                echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>

                                                            </div>
                                                            <div class="description collapse" data-bs-parent=".icon-box"
                                                                 id="publication-<?= $post->ID ?>"><?= the_content(); ?></div>
                                                            <a href="<?= $attachment ?>"
                                                               class="float-end btn btn-sm btn-outline-success"><i
                                                                        class="bi bi-download"></i></a>
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
                                                    <h3 class="centered text-info">No studies and research found!</h3>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>

                                    </div>

                                    <div class="Page navigation mt-5">
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

                                        <br>
                                        <br>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


<?php
get_footer();
