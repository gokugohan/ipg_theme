<?php


add_action('init', 'studies_and_research_post_type');
add_action( 'init', 'register_taxonomy_division' );
add_action( 'init', 'register_taxonomy_document' );

// Studies and Research Custom Post Type
function studies_and_research_post_type()
{
    register_post_type('studies-and-research',
        // WordPress CPT Options Start
        array(
            'labels' => array(
                'name' => __('Studies and Research'),
                'singular_name' => __('Studies and Research'),
                'archives'              => 'Item Archives',
                'attributes'            => 'Item Attributes',
                'parent_item_colon'     => 'Parent Item:',
                'all_items'             => 'All Studies and Research',
                'add_new_item'          => 'Add New Studies and Research',
                'add_new'               => 'Add New Studies and Research',
                'new_item'              => 'New Item',
                'edit_item'             => 'Edit Studies and Research',
                'view_item'             => 'View Item',
                'view_items'            => 'View Items',
                'search_items'          => 'Search Item',
                'not_found'             => 'Not found',
                'not_found_in_trash'    => 'Not found in Trash',
            ),
            'has_archive' => true,
            'public' => true,
            'rewrite' => array('slug' => 'studies-and-research'),
            'show_in_rest' => true,
            'supports' => array('title',
                'editor',
//                'excerpt',
                'author',
//                'thumbnail',
//                'custom-fields',
//                'comments',
//                'revisions',
                ),
//            'menu_icon' => 'dashicons-calendar',
// This is where we add taxonomies to our CPT
//            'taxonomies' => array('category'),
        )
    );
}

function register_taxonomy_division(){

    $labels = array(
        'name'                       => 'Division',
        'singular_name'              => 'Division',
        'menu_name'                  => 'Division',
        'all_items'                  => 'All Division',
        'parent_item'                => 'Parent Item',
        'parent_item_colon'          => 'Parent Item:',
        'new_item_name'              => 'New Item Name',
        'add_new_item'               => 'Add New Division',
        'add_new'                    => 'Add New Division',
        'edit_item'                  => 'Edit Division',
        'view_item'                  => 'View Item',
        'separate_items_with_commas' => 'Separate items with commas',
        'add_or_remove_items'        => 'Add or remove items',
        'choose_from_most_used'      => 'Choose from the most used',
        'popular_items'              => 'Popular Items',
        'search_items'               => 'Search Items',
        'not_found'                  => 'Not Found',
        'no_terms'                   => 'No items',
        'items_list'                 => 'Items list',
        'items_list_navigation'      => 'Items list navigation',

    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'publicly_queryable' => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
        'rewrite'            => array(
            'slug'       => 'studies-and-research-division',
            'with_front' => false,
            'feeds'      => true,
        ),
    );
    register_taxonomy( 'studies-and-research-division', array( 'studies-and-research' ), $args );
}

function register_taxonomy_document(){

    $labels = array(
        'name'                       => 'Document type',
        'singular_name'              => 'Document type',
        'menu_name'                  => 'Document type',
        'all_items'                  => 'All Document type',
        'parent_item'                => 'Parent Item',
        'parent_item_colon'          => 'Parent Item:',
        'new_item_name'              => 'New Item Name',
        'add_new_item'               => 'Add New Document type',
        'add_new'                    => 'Add New Document type',
        'edit_item'                  => 'Edit Document type',
        'view_item'                  => 'View Item',
        'separate_items_with_commas' => 'Separate items with commas',
        'add_or_remove_items'        => 'Add or remove items',
        'choose_from_most_used'      => 'Choose from the most used',
        'popular_items'              => 'Popular Items',
        'search_items'               => 'Search Items',
        'not_found'                  => 'Not Found',
        'no_terms'                   => 'No items',
        'items_list'                 => 'Items list',
        'items_list_navigation'      => 'Items list navigation',

    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'publicly_queryable' => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
        'rewrite'            => array(
            'slug'       => 'studies-and-research-doc-type',
            'with_front' => false,
            'feeds'      => true,
        ),
    );
    register_taxonomy( 'studies-and-research-doc-type', array( 'studies-and-research' ), $args );
}



add_action('cmb2_init', 'studies_and_research_post_type_metaboxes');

function studies_and_research_post_type_metaboxes()
{

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'sr_';

    /* Team Settings ***************************************************************************/
    /* ************************************************************************************/
    $settings = new_cmb2_box(array(
        'id' => 'studies_and_research_post_type_settings',
        'title' => 'Studies and Research settings',
        'object_types' => array('studies-and-research'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,

    ));

    $settings->add_field(array(
        'name' => 'Author',
        'id' => $prefix . 'author',
        'type' => 'text',
    ));

//    $settings->add_field(array(
//        'name' => 'Date',
//        'id' => $prefix . 'date',
//        'type' => 'text_date',
//    ));
    $settings->add_field( array(
        'name'    => 'Attachment',
        'desc'    => 'Upload a file or enter an URL.',
        'id'      => $prefix . 'file',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => 'application/pdf', // Make library only display PDFs.
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );


}
