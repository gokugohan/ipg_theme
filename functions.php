<?php
/*
 * Define a constant path to our single template folder
 */
define('SINGLE_PATH', TEMPLATEPATH . '/single');

define('SLIDER_KEY_LENGTH', 12);

// Register Custom Navigation Walker
require_once(dirname(__FILE__) . '/include/wp-bootstrap-navwalker.php');

require_once(dirname(__FILE__) . '/settings/ipg_setting.php');
require_once(dirname(__FILE__) . '/cpt/studies_and_research.php');
//require_once(dirname(__FILE__) . '/cpt/procurement.php');


//ipg_add_new_user_role();
// Add register new menu
function ipg_register_menu()
{
    register_nav_menus(
        array(
            'menu-principal' => __('Menu principal', 'ipg'),
            'quick-links' => __('Quick links', 'ipg'),
            'external-links' => __('External links', 'ipg'),
            'legal-links' => __('Legal links', 'ipg'),
            'social-links' => __('Social links', 'ipg')
        )
    );
}

add_action('init', 'ipg_register_menu');


add_post_type_support('page', 'excerpt');

/*
 * Multilevel bootstrap menu
 * http://www.jeffmould.com/2014/01/09/responsive-multi-level-bootstrap-menu/
 */

// bootstrap navigation menu register function for menu principal
function ipg_bootstrap_nav_menu()
{
    wp_nav_menu(array(
            'menu' => 'menu-principal',
            'theme_location' => 'menu-principal',
            'depth' => 3,
            'container' => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'navbar-menu',
            'menu_class' => 'nav navbar-nav navbar-left',
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new WP_Bootstrap_Navwalker(),
        )
    );
}

function include_menu_manual()
{
    require_once(dirname(__FILE__) . '/include/_menu.php');
}

// bootstrap navigation menu register function for footer menu
function ipg_quick_links_menu()
{
    wp_nav_menu(array('theme_location' => 'quick-links', 'menu_class' => 'list-unstyled quick-links'));
}

function ipg_external_links_menu()
{
    wp_nav_menu(array('theme_location' => 'external-links', 'menu_class' => 'list-unstyled quick-links'));
}

function ipg_legal_links_menu()
{
    wp_nav_menu(array('theme_location' => 'legal-links', 'menu_class' => 'list-unstyled quick-links'));
}

function ipg_social_links_menu()
{
    wp_nav_menu(array('theme_location' => 'social-links', 'menu_class' => 'list-unstyled list-inline social text-center'));
}

// handler for registering sidebar - Sidebar ipg
function ipg_register_sidebar()
{
    register_sidebar(array(
            'name' => __('Sidebar ipg'),
            'id' => 'sidebar-ipg',
            'before_widget' => '<div class="card">',
            'after_widget' => '</div>',
            'before_title' => '<div class="card-body"><h3 class="card-title">',
            'after_title' => '</h3></div>')
    );
//    register_sidebar(array(
//        'name' => __('Sidebar ipg for president'),
//        'id' => 'sidebar-ipg-president',
//        'before_widget' => '<div class="widget-sidebar panel panel-category">',
//        'after_widget' => '</div>',
//        'before_title' => '<div class="panel-heading"><h3 class="widget-sidebar-title panel-title">',
//        'after_title' => '</h3></div>')
//    );
}

add_action("init", "ipg_register_sidebar");

function ipg_restrict_admin_access()
{
    if (!current_user_can('administrator')) {
        wp_redirect(home_url());
        exit;
    }
}

//add_action('admin_init', 'ipg_restrict_admin_access');
//Only show admin bar to administrators
function ipg_hide_adminbar_for_other_user()
{
    if (!current_user_can('administrator')) {
        show_admin_bar(false);
    }
}

ipg_hide_adminbar_for_other_user();

function ipg_get_last_post_modified_date()
{
    echo the_modified_date();
}

//add_shortcode("get_modified_date", "ipg_get_last_post_modified_date");

function ipg_custom_theme_setup()
{
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'ipg_custom_theme_setup');

function ipg_add_image_class($class)
{
    $class .= ' img-fluid';
    return $class;
}

// Adicionar classe img-responsive para imagem
add_filter('get_image_tag_class', 'ipg_add_image_class');

//https://kinsta.com/knowledgebase/wordpress-disable-rss-feed/
function ipg_disable_feed()
{
    wp_redirect(home_url());
    exit();
}

add_action('do_feed', 'ipg_disable_feed', 1);
add_action('do_feed_rdf', 'ipg_disable_feed', 1);
add_action('do_feed_rss', 'ipg_disable_feed', 1);
add_action('do_feed_rss2', 'ipg_disable_feed', 1);
add_action('do_feed_atom', 'ipg_disable_feed', 1);
add_action('do_feed_rss2_comments', 'ipg_disable_feed', 1);
add_action('do_feed_atom_comments', 'ipg_disable_feed', 1);

/**
 * Remove the additional CSS section, introduced in 4.7, from the Customizer.
 * https://robincornett.com/additional-css-wordpress-customizer/
 * @param $wp_customize WP_Customize_Manager
 */
function prefix_remove_css_section($wp_customize)
{
    $wp_customize->remove_section('custom_css');
}

add_action('customize_register', 'prefix_remove_css_section', 15);

function excerpt($limit = 100)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt); // . ' <a href='.the_permalink().'>(...)</a>';
    } else {
        $excerpt = implode(" ", $excerpt);
    }

    return $excerpt;
}

function mostrar_poucos($limit = 500)
{
    $excerpt = explode(' ', get_the_content(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt);
    } else {
        $excerpt = implode(" ", $excerpt);
    }

    return $excerpt;
}

if (!function_exists('post_pagination')) :

    function post_pagination()
    {
        global $wp_query;
        $pager = 999999999;
        echo paginate_links(array(
            'base' => str_replace($pager, '%#%', esc_url(get_pagenum_link($pager))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => __('<span class="btn btn-default glyphicon glyphicon-backward"></span>'),
            'next_text' => __('<span class="btn btn-default glyphicon glyphicon-forward"></span>')
        ));
    }

endif;

function ipg_show_data_on_content_page()
{
    echo "Testing..";
}

//add_action('the_content', 'ipg_show_data_on_content_page');

function ipg_enqueue_script_admin()
{

    wp_enqueue_style('admin_css_bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', false, '1.0.0', 'all');
    wp_enqueue_style('admin_css_bootstrap_datepicker', get_template_directory_uri() . '/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css', false, '1.0.0', 'all');
    wp_enqueue_style('admin_css_datatable', get_template_directory_uri() . '/css/datatables.min.css', false, '1.0.0', 'all');
    wp_enqueue_style('admin_css_datatable', get_template_directory_uri() . '/vendor/datatables.min.css', false, '1.0.0', 'all');

    wp_enqueue_script('admin_jquery_bootstrap', get_template_directory_uri() . '/js/jquery.min.js', array('jquery'), '', true);
    wp_enqueue_script('admin_js_bootstrap', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('admin_js_bootstrap_datepicker', get_template_directory_uri() . '/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js', array('jquery'), '', true);
    wp_enqueue_script('admin_data_table', get_template_directory_uri() . '/js/datatables.min.js', array('jquery'), '', true);


    wp_enqueue_script('admin_table_script_bootstrap', get_template_directory_uri() . '/js/dash.js', array('jquery'), '', true);
}

add_action('admin_enqueue_scripts', 'ipg_enqueue_script_admin');

/*
 * INITIATE TABLE PROCUREMENT
 */

function ipg_create_table_procurement()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;

    $table_name = $wpdb->prefix . "procurement";
    $charset_collate = $wpdb->get_charset_collate();
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            Id INT(11) NOT NULL auto_increment,
            Title varchar(250) not null,
            Url varchar(250) not null,
            Post_date datetime not null,
            Open_date datetime,
            Close_date datetime,
            Updated_date datetime,
            User_who_post varchar(100) not null,
            User_Who_Update varchar(100),
            PRIMARY KEY (id))$charset_collate;";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);


        if (!isset($wpdb->procurement)) {
            $wpdb->procurement = $table_name;
            //add the shortcut so you can use $wpdb->stats
            $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
        }
    }

}

add_action('init', 'ipg_create_table_procurement');

function ipg_insert_new_procurement($title, $link, $open_date, $close_date)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "procurement";
    $today = date('Y-m-d H:i:s');
//    var_dump($today);
    $data = array(
        "Title" => strip_tags($title),
        "Url" => $link,
        "Open_date" => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $open_date))),
        "Close_date" => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $close_date))),
        "Post_date" => $today,
        "User_who_post" => $current_user->user_login
    );

    $wpdb->insert($table_name, $data);
}

function ipg_update_procurement($id, $title, $url, $open_date, $close_date)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();
    $table_name = $wpdb->prefix . "procurement";
    $today = date('Y-m-d H:i:s');
    $data = array(
        "Title" => strip_tags($title),
        "Url" => $url,
        "Open_date" => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $open_date))),
        "Close_date" => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $close_date))),
        "Updated_date" => $today,
        "User_Who_Update" => $current_user->user_login
    );

    $wpdb->update($table_name, $data, array("Id" => $id));
}

function ipg_delete_procurement($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "procurement";
    $wpdb->delete($table_name, array("Id" => $id));
}

function ipg_display_procurement($is_admin = FALSE)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "procurement";
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY Id DESC");
    $date_format = "d-M-Y";
    $class_active = "";
    ?>
    <table id="tbl-procurement" class="table table-striped display">
        <thead>
        <tr>
            <th>Nº</th>
            <th>Title</th>
            <th>Open Date</th>
            <th>Close Date</th>
            <th>Attachment</th>
            <?php if ($is_admin) {
                ?>
                <th></th>
                <?php
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results as $value) {
            ?>
            <?php
            if (strtotime($value->Close_date) > strtotime('now')) {
                $class_active = "still-open";
            }
            ?>
            <tr class="<?= $class_active ?>">
                <td><?= $value->Id; ?></td>
                <td><?= $value->Title; ?></td>
                <td>
                    <?php echo date($date_format, strtotime(($value->Open_date) ? $value->Open_date : $value->Open_date)); ?>
                </td>
                <td>
                    <?php echo date($date_format, strtotime(($value->Close_date) ? $value->Close_date : $value->Close_date)); ?>

                </td>
                <td><a href="<?= $value->Url; ?>" class="btn btn-sm btn-outline-success" target="_blank"><i class="bi bi-download"></i></a></td>
                </td>
                <?php
                if ($is_admin) {
                    ?>
                    <td>
                        <a class="btn-edit-procurement" href="#!"
                           data-id="<?= $value->Id; ?>"
                           data-title="<?= $value->Title; ?>"
                           data-open-date="<?= $value->Open_date; ?>"
                           data-close-date="<?= $value->Close_date; ?>"
                           data-url="<?= $value->Url; ?>"
                        >Edit</a> <a
                                href="#!"
                                data-id="<?= $value->Id; ?>"
                                data-title="<?= $value->Title; ?>"
                                class="btn-delete-procurement">Delete</a>
                    </td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <?php
}

/*
 * END TABLE PROCUREMENT
 */

/*
 * INITIATE TABLE EVENT CALENDAR
 */

function ipg_create_table_event_calendar()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;

    $table_name = $wpdb->prefix . "event_calendar";
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            Id INT(11) NOT NULL auto_increment,
            Title varchar(250) not null,
            Url varchar(300) not null,
            Class varchar(50) not null,
            Start datetime not null,
            End datetime not null,            
            PRIMARY KEY (id))$charset_collate;";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);


        if (!isset($wpdb->event_calendar)) {
            $wpdb->event_calendar = $table_name;
            //add the shortcut so you can use $wpdb->stats
            $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
        }

    }

}

add_action('init', 'ipg_create_table_event_calendar');

/*
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */

function ipg_display_events()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "event_calendar";
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    return $results;
}

function ipg_insert_new_event($title, $url, $css_class, $start, $end)
{
    global $wpdb;
    //global $current_user;
    //wp_get_current_user();

    $table_name = $wpdb->prefix . "event_calendar";

    $data = array(
        "Title" => strip_tags($title),
        "Url" => $url,
        "Class" => $css_class,
        "Start" => $start,
        "End" => $end
    );

    $wpdb->insert($table_name, $data);
    echo $wpdb->last_error;
    echo "------------------";
    echo $wpdb->last_query;
    return $wpdb->insert_id;
}

function ipg_update_event($id, $title, $url, $css_class, $start, $end)
{
    global $wpdb;

    $table_name = $wpdb->prefix . "event_calendar";

    $data = array(
        "Title" => strip_tags($title),
        "Url" => $url,
        "Class" => $css_class,
        "Start" => $start,
        "End" => $end
    );

//    if ($is_update) {
    $wpdb->update($table_name, $data, array("Id" => $id));
//    }
}

function ipg_delete_event($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "event_calendar";
    $wpdb->delete($table_name, array("Id" => $id));
}

/*
 * END TABLE EVENT CALENDAR
 */


/*
 * INITIATE TABLE STUDY AND RESEARCH
 */


function ipg_create_table_studies_and_research()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;

    $table_name = $wpdb->prefix . "studies_and_reasearch";
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            Id INT(11) NOT NULL auto_increment,
            Date datetime not null,
            Title varchar(1000) not null,
            Summary text,
            Url varchar(500) not null,
            Author varchar(500) not null,
            Division varchar(150) not null,
            Document_Type varchar(50) not null,
            User_who_post varchar(100) not null,
            PRIMARY KEY (id))$charset_collate;";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);


        if (!isset($wpdb->studies_and_reasearch)) {
            $wpdb->studies_and_reasearch = $table_name;
            //add the shortcut so you can use $wpdb->stats
            $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
        }
    }

}

add_action('init', 'ipg_create_table_studies_and_research');


/*
 ==================
 Ajax Search
======================
*/
// add the ajax fetch js
//add_action('wp_footer', 'ajax_search');
function ajax_search()
{
    ?>
    <script type="text/javascript">
        function search_publications() {


            let keyword = jQuery('#input-search-publication').val();
            if (keyword.length > 2) {
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {action: 'publication_search_result_fetch', keyword: keyword},
                    success: function (data) {
                        jQuery('.search-result-list').html(data);
                    }
                });
            }


        }

        function search_news() {
            let keyword = jQuery('#news-search-keyword').val();

            // if (keyword.length > 2) {
            jQuery.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: {action: 'fetch_news_list', keyword: keyword},
                success: function (data) {
                    jQuery('.search-result-list').html(data);
                }
            });
            // }
        }
    </script>

    <?php
}

add_action('wp_ajax_fetch_news_list', 'fetch_news_list');
add_action('wp_ajax_nopriv_fetch_news_list', 'fetch_news_list');

function fetch_news_list()
{
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $the_query = new WP_Query(array(
            'post_type' => array('page', 'post'),
            'post_status' => 'published',
            'category_name' => 'news',
            's' => esc_attr($_POST['keyword']),
        )
    );
    if ($the_query->have_posts()) :
        echo '<div class="list-group">';
        while ($the_query->have_posts()): $the_query->the_post(); ?>

            <a class="list-group-item list-group-item-action"
               href="<?php echo esc_url(post_permalink()); ?>"><?php the_title(); ?>
                <br>
                <small><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></small>
            </a>

        <?php endwhile;
        echo '</div>';
        wp_reset_postdata();
    else:
        echo '<li class="list-group-item">' . $_POST['keyword'] . ' not found!</li>';
    endif;

    die();
}


add_action('wp_ajax_fetch_post_list', 'fetch_post_list');
add_action('wp_ajax_nopriv_fetch_post_list', 'fetch_post_list');
function fetch_post_list()
{
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $the_query = new WP_Query(array(
            'post_type' => array('post'),
            'post_status' => 'published',
            's' => esc_attr($_POST['keyword']),
        )
    );
    if ($the_query->have_posts()) :
        echo '<p class="search-total-counter">' . $the_query->post_count . ' Results found</p>';
        echo '<div class="row media-release">';

        while ($the_query->have_posts()):
            $the_query->the_post();
            $post_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

            if (has_post_thumbnail($post) && $post_image_feature != null) {
                $post_image_feature_url = $post_image_feature;
            } else {
                $post_image_feature_url = get_template_directory_uri() . "/images/wave.png";
            }
            ?>

            <div class="post col-xl-4 on-hover">
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
            <!-- <a class="list-group-item list-group-item-action"  href="<?php /*echo esc_url(post_permalink()); */ ?>"><?php /*the_title(); */ ?>
                <br>
                <small><?php /*echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; */ ?></small>
            </a>-->

        <?php endwhile;
        echo '</div>';
        wp_reset_postdata();
    else:
        echo '<h3 class="text-warning">' . $_POST['keyword'] . ' not found!</h3>';
    endif;

    die();
}

// the ajax function
add_action('wp_ajax_publication_search_result_fetch', 'publication_search_result_fetch');
add_action('wp_ajax_nopriv_publication_search_result_fetch', 'publication_search_result_fetch');

function publication_search_result_fetch()
{
    $posts = new WP_Query(array(
            'post_type' => array('studies-and-research'),
            'post_status' => 'publish',
            's' => esc_attr($_POST['keyword']),
        )
    );
    if ($posts->have_posts()) :
        echo '<p class="search-total-counter">' . $posts->post_count . ' Results found</p>';
        echo '<div class=""> <button type="button" class="close-me" ><span aria-hidden="true">&times;</span></button>';

        while ($posts->have_posts()):
            $posts->the_post();
            $author = get_post_meta(get_the_ID(), 'sr_author', true);
            $date = get_post_meta(get_the_ID(), 'sr_date', true);
            $attachment = get_post_meta(get_the_ID(), 'sr_file', true);

            ?>


        <div class="list-of-publications list-search-publication-result">

            <div class="icon-box">
                <div class="icon"><i class="bi bi-filetype-pdf"></i></div>
                <h4 class="title">
                    <a href="#search-publication-result-<?=get_the_id()?>" data-bs-toggle="collapse" class="collapsed question"><?= the_title() ?></a>
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
                    <i  style="color: #c2dd79;" class="fa fa-calendar"></i> <?php the_time('M/d/Y');
                    echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>

                </div>
                <div class="description collapse" data-bs-parent=".icon-box" id="search-publication-result-<?=get_the_id()?>"><?= the_content(); ?></div>
                <a href="<?= $attachment ?>" class="float-end btn btn-sm btn-outline-success"><i class="bi bi-download"></i></a>
            </div>

        </div>

        <?php endwhile;
        echo '</div>';
        wp_reset_postdata();
    else:
        echo '<h3 class="text-warning">' . $_POST['keyword'] . ' not found!</h3>';
    endif;

    die();
}

function ipg_display_studies_and_research_frontpage()
{
    $posts = new WP_Query(array(
            'post_type' => array('studies-and-research'),
            'post_status' => 'publish',
            'nopaging' => false,
            'posts_per_page' => 10,

        )
    );

    if ($posts->have_posts()) {

        while ($posts->have_posts()) {
            $posts->the_post();
            $author = get_post_meta(get_the_ID(), 'sr_author', true);
            $date = get_post_meta(get_the_ID(), 'sr_date', true);
            $attachment = get_post_meta(get_the_ID(), 'sr_file', true);
            ?>

            <div class="publication-item">
                <div class="field-content">
                    <?php
                    $doc_types = get_the_terms(get_the_ID(), 'studies-and-research-doc-type');
                    if ($doc_types && !is_wp_error($doc_types)) {
                        foreach ($doc_types as $term) {
                            echo '<span class="badge badge-primary mr-1">' . $term->name . '</span>';
                        }
                    }
                    ?>
                                                                |
                                                                <?php
                                                                $divisions = get_the_terms(get_the_ID(), 'studies-and-research-division');
                                                                if ($divisions && !is_wp_error($divisions)) {
                                                                    foreach ($divisions as $term) {
                                                                        echo '<span class="badge badge-primary me-1 mb-1">' . $term->name . '</span>';
                                                                    }
                                                                }
                                                                ?>

                |
                <span class="badge badge-primary"><i
                            class="bi bi-people"></i> <?= $author ?></span>
                |
                <span class="badge badge-primary"><i
                            class="bi bi-clock"></i> <?php the_time('j M Y'); ?> | <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>


                </div>
                <h3><a href="<?= $attachment; ?>"
                       target="_blank"><?php the_title(); ?></a></h3>
            </div>
        <?php }
        wp_reset_postdata();
    } else {
        echo '<span>No publications</span>';
    }

}

/*
 * END TABLE STUDY AND RESEARCH
 */

/*
 * INITIATE TABLE IPG STAFF
 */

function ipg_create_ipg_staff()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;

    $table_name = $wpdb->prefix . "ipg_staff";
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            Id INT(11) NOT NULL auto_increment,
            Image varchar(1000) not null,
            Name varchar(200) not null,
            Email varchar(50) not null,
            Position varchar(100) not null,
            Degree varchar(200) not null,
            User_who_Add varchar(100) not null,
            User_Who_Update varchar(100),
            PRIMARY KEY (id))$charset_collate;";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);


        if (!isset($wpdb->ipg_staff)) {
            $wpdb->ipg_staff = $table_name;
            //add the shortcut so you can use $wpdb->stats
            $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
        }
    }

}

add_action('init', 'ipg_create_ipg_staff');

function ipg_insert_new_ipg_staff($name, $email, $image, $position, $degree)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "ipg_staff";

    $data = array(
        "Image" => $image,
        "Name" => strip_tags($name),
        "Email" => $email,
        "Degree" => $degree,
        "Position" => strip_tags($position),
        "User_who_Add" => $current_user->user_login
    );
    $wpdb->insert($table_name, $data);
    echo $wpdb->last_error;
    echo "------------------";
    echo $wpdb->last_query;
    return $wpdb->insert_id;
}

function ipg_update_ipg_staff($id, $name, $email, $image, $position, $degree)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "ipg_staff";

    $data = array(
        "Name" => strip_tags($name),
        "Image" => $image,
        "Email" => $email,
        "Degree" => $degree,
        "Position" => $position,
        "User_Who_Update" => $current_user->user_login
    );
//    var_dump($data);
    $wpdb->update($table_name, $data, array("ID" => $id));
    echo $wpdb->last_error;
    echo "------------------";
    echo $wpdb->last_query;
}

function ipg_delete_ipg_staff($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ipg_staff";
    $wpdb->delete($table_name, array("Id" => $id));
}

//add_shortcode('ipg_display_ipg_staff', 'ipg_display_ipg_staff');

function ipg_display_ipg_staff($is_admin = FALSE)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ipg_staff";
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY NAME ASC");

    if ($results) {
        echo '<div class="row text-center ipg-teams">';    // Container open

        foreach ($results as $value) {

            ?>
            <div class="col-xl-2 col-sm-4 mb-5">
                <?php

                $default_image = get_stylesheet_directory_uri() . "/images/staff.jpg";
                $lngth = mb_strlen($value->Image, 'utf8');
                $filetype = wp_check_filetype($default_image, ['jpg', 'png'])['ext'];
                if (wp_http_validate_url($value->Image)) {
                    if ($lngth > 10 && $filetype == 'jpg' || $filetype = 'png') {
                        $default_image = $value->Image;
                    }
                }
                ?>

                <div class="bg-white rounded shadow-sm py-2 px-3">
                    <img src="<?php echo $default_image; ?>" alt="<?= $value->Name; ?>(<?= $value->Degree; ?>)"
                         class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" height="120px" width="120px">
                    <h5 class="mb-0"><?= $value->Name; ?>
                        <br><small><?= $value->Degree; ?></small></h5>
                    <span class="small text-uppercase text-muted"><?= $value->Position; ?></span>
                </div>
                <br/>
                <?php
                if ($is_admin) {
                    ?>
                    <a href="#!" class="edit-staff-detail btn btn-info"
                       data-id="<?= $value->Id; ?>"
                       data-name="<?= $value->Name; ?>"
                       data-img="<?= $value->Image; ?>"
                       data-position="<?= $value->Position; ?>"
                    //data-email="<?= $value->Email; ?>"
                    data-degree="<?= $value->Degree; ?>"
                    ><span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a href="#!" class="btn-delete-staff btn btn-info"
                       data-id="<?= $value->Id; ?>"
                       data-name="<?= $value->Name; ?>"
                    ><span class="glyphicon glyphicon-remove"></span>Delete</a>
                    <?php
                }
                ?>
            </div>
            <?php
        }

        echo '</div>';  // Close the container
    }
}

/*
 * END TABLE IPG STAFF
 */


/*
 * INITIATE TABLE ANNUAL REPORTS
 */

function ipg_create_table_annual_report()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;

    $table_name = $wpdb->prefix . "annual_report";
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            Id INT(11) NOT NULL auto_increment,            
            Title varchar(1000) not null,
            Url varchar(500) not null,
            User_who_post varchar(100) not null,
            User_who_update varchar(100),
            PRIMARY KEY (id))$charset_collate;";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);


        if (!isset($wpdb->annual_report)) {
            $wpdb->annual_report = $table_name;
            //add the shortcut so you can use $wpdb->stats
            $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
        }
    }

}

add_action('init', 'ipg_create_table_annual_report');

function ipg_display_annual_report($is_admin = FALSE)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "annual_report";

    $query = ("SELECT * FROM $table_name ORDER BY Id DESC");


    $results = $wpdb->get_results($query);

    if ($results) {
        ?>
        <table id="tbl-annual-report" class="table table-striped display">
            <thead>
            <tr>
                <th>Annual report</th>
                <th>Attachment</th>
                <?php
                if ($is_admin) {
                    ?>
                    <th></th>
                    <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($results as $value) {
                ?>
                <tr>
                    <td><?= $value->Title; ?></td>
                    <td><a href="<?= $value->Url; ?>" class="btn btn-sm btn-outline-success" target="_blank"><i class="bi bi-download"></i></a></td>
                    <?php
                    if ($is_admin) {
                        ?>
                        <td>
                            <a class="btn-edit-annual-report" href="#!"
                               data-id="<?= $value->Id; ?>"
                               data-title="<?= $value->Title; ?>"
                               data-url="<?= $value->Url; ?>"
                            ><span class="glyphicon glyphicon-edit"></span></a><a
                                    href="#!"
                                    data-id="<?= $value->Id; ?>"
                                    data-title="<?= $value->Title; ?>"
                                    class="btn-delete-annual-report"><span
                                        class="glyphicon glyphicon-remove"></span></a>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
}


function ipg_insert_new_annual_report($title, $url)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "annual_report";

    $data = array(
        "Title" => $title,
        "Url" => $url,
        "User_who_post" => $current_user->user_login
    );
    $wpdb->insert($table_name, $data);
    echo $wpdb->last_error;
    echo "------------------";
    echo $wpdb->last_query;
    return $wpdb->insert_id;
}

function ipg_update_annual_report($id, $title, $url)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "annual_report";

    $data = array(
        "Title" => $title,
        "Url" => $url,
        "User_who_update" => $current_user->user_login
    );

    $wpdb->update($table_name, $data, array("ID" => $id));
    echo $wpdb->last_error;
    echo "------------------";
    echo $wpdb->last_query;
}

function ipg_delete_annual_report($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "annual_report";
    $wpdb->delete($table_name, array("Id" => $id));
    echo $wpdb->last_error;
    echo "------------------";
    echo $wpdb->last_query;
}

/*
 * END TABLE ANNUAL REPORTS
 */

function show_ipg_summary()
{
    return get_option('ipg_setting_settings_general')['ipg_summary'];
}

function show_ipg_description_name()
{
    return get_option('ipg_setting_settings_general')['ipg_description_name'];
}

function show_ipg_values($index)
{
    $options = get_option('ipg_setting_settings_ipg_values');
    return $options["ipg_values_description_$index"];
}

function sub_title_procurement()
{
    $options = get_option('ipg_setting_settings_other');
    if (isset($options['ipg_new_procurement'])) {
        $sub_title_category = "New procurement process available";
    } else {
        $sub_title_category = "List of previous procurement process";
    }
    echo $sub_title_category;
}

function sub_title_carrer_opportunities()
{
    $options = get_option('ipg_setting_settings_other');
    if (isset($options['ipg_new_vacancy'])) {
        $sub_title_category = "New job vacancies available";
    } else {
        $sub_title_category = "List of previous job vacancies";
    }

    echo $sub_title_category;
}

function sub_title_legislation()
{
    $options = get_option('ipg_setting_settings_other');
    if (isset($options['ipg_new_legislation'])) {
        $sub_title_category = "New legislation available";
    } else {
        $sub_title_category = "List of legislation";
    }
    echo $sub_title_category;
}

function sub_title_annual_reports()
{
    $options = get_option('ipg_setting_settings_other');
    if (isset($options['ipg_new_annual_report'])) {
        $sub_title_category = "New annual report process available";
    } else {
        $sub_title_category = "List of previous annual reports process";
    }
    echo $sub_title_category;
}

// replace WordPress Howdy in WordPress 3.3
function replace_howdy($wp_admin_bar)
{
    $my_account = $wp_admin_bar->get_node('my-account');
    $newtitle = str_replace('Howdy,', 'Logged in as', $my_account->title);
    $wp_admin_bar->add_node(array(
        'id' => 'my-account',
        'title' => $newtitle,
    ));
}

add_filter('admin_bar_menu', 'replace_howdy', 25);

// Change Login Logo URL
add_filter('login_headerurl', 'my_custom_login_url');

function my_custom_login_url($url)
{
    return home_url();
}

// Change Login logo
function custom_login_style()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-styles.css" />';
}

add_action('login_head', 'custom_login_style');

function admin_login_redirect($redirect_to, $request, $user)
{
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array("administrator", $user->roles) || in_array("author", $user->roles)) {
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter("login_redirect", "admin_login_redirect", 10, 3);

function get_slider_setting($key)
{
    $options = get_option('ipg_setting_settings_slider');
    return $options[$key];
}

function get_general_setting($key)
{
    $options = get_option('ipg_setting_settings_general');
    return $options[$key];
}

function get_earthquake_setting($key)
{
    $options = get_option('ipg_setting_settings_earthquake');
    return $options[$key];
}

function render_category($total, $title, $slug, $page, $index = FALSE)
{
    if (!$index) {
        $total_item = $total;
        $category_title = $title;
        $para_category = $slug;
    }

    include('include/' . $page . '.php');
}

function render_about_page_fragment($title, $slugpage, $page)
{
    $page_title = $title;
    $slug = $slugpage;
    include("include/" . $page . ".php");
}

/**
 * Removes actions and filters to clean up the head
 */
function rational_head_clean()
{
// https://scotch.io/tutorials/removing-wordpress-header-junk
    remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
    remove_action('wp_head', 'wp_generator'); //removes meta name generator.
    remove_action('wp_head', 'feed_links', 2);  //removes feed links.
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); /* Removes prev and next links */
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); //removes shortlink.
// http://wordpress.stackexchange.com/a/185578/26817
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('emoji_svg_url', '__return_false');
//add_filter('tiny_mce_plugins', 'rational_tiny_mce_plugins_clean');
// http://wordpress.stackexchange.com/a/211469/26817
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}

add_action('init', 'rational_head_clean');

/**
 * http://www.wpbeginner.com/wp-themes/create-custom-single-post-templates-for-specific-posts-or-sections-in-wordpress/
 * Filter the single_template with our custom function
 */
add_filter('single_template', 'ipg_single_template');

/**
 * Single template function which will choose our template
 */
function ipg_single_template($single)
{
    global $wp_query, $post;

    /**
     * Checks for single template by category
     * Check by category slug and ID
     */
    foreach ((array)get_the_category() as $cat) :

        if (file_exists(SINGLE_PATH . '/single-' . $cat->slug . '.php'))
            return SINGLE_PATH . '/single-' . $cat->slug . '.php';

        elseif (file_exists(SINGLE_PATH . '/single-' . $cat->term_id . '.php'))
            return SINGLE_PATH . '/single-' . $cat->term_id . '.php';

    endforeach;
}

//add_filter('rest_authentication_errors', 'disable_wp_json_request');

function disable_wp_json_request($access)
{

    return new WP_Error('access_denied', '@Goku has disabled it with Kamehameha Power', array(
        'status' => 403
    ));
}

