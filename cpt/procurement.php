<?php


add_action('init', 'procurement_post_type');

// Studies and Research Custom Post Type
function procurement_post_type()
{

    register_post_type('procurement',
        // WordPress CPT Options Start
        array(
            'labels' => array(
                'name' => __('Procurements'),
                'singular_name' => __('Procurement'),
                'archives'              => 'Item Archives',
                'attributes'            => 'Item Attributes',
                'parent_item_colon'     => 'Parent Item:',
//                'all_items'             => 'All Procurement',
//                'add_new_item'          => 'Add New Procurement',
//                'add_new'               => 'Add New Procurement',
                'new_item'              => 'New Item',
//                'edit_item'             => 'Edit Procurement',
                'view_item'             => 'View Item',
                'view_items'            => 'View Items',
                'search_items'          => 'Search Item',
                'not_found'             => 'Not found',
                'not_found_in_trash'    => 'Not found in Trash',
            ),
            'has_archive' => true,
            'public' => true,
            'rewrite' => array('slug' => 'procurement'),
            'show_in_rest' => true,
            'supports' => array('title',
//                'editor',
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


add_action('cmb2_init', 'procurement_post_type_metaboxes');

function procurement_post_type_metaboxes()
{

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'procurement_';

    /* Team Settings ***************************************************************************/
    /* ************************************************************************************/
    $settings = new_cmb2_box(array(
        'id' => 'procurement_post_type_settings',
        'title' => 'Procurments settings',
        'object_types' => array('procurement'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,

    ));
//
//    $settings->add_field(array(
//        'name' => 'Author',
//        'id' => $prefix . 'author',
//        'type' => 'text',
//    ));

    $settings->add_field(array(
        'name' => 'Open Date',
        'id' => $prefix . 'open_date',
        'type' => 'text_date',
    ));
    $settings->add_field(array(
        'name' => 'Closing Date',
        'id' => $prefix . 'closing_date',
        'type' => 'text_date',
    ));
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
