<?php

add_action('admin_menu', 'theme_options_panel');
add_action('admin_init', 'ipg_settings_config');

function theme_options_panel() {

    add_menu_page('IPG Theme', 'IPG Theme', 'manage_options', 'ipg-theme-options', 'ipg_setting_options_page');
    add_submenu_page('ipg-theme-options', 'Slider setting', 'Slider setting', 'manage_options', 'slider-setting', 'slider_setting_page');
    add_submenu_page('ipg-theme-options', 'IPG Values setting', 'IPG Values setting', 'manage_options', 'ipg-value-setting', 'ipg_values_setting_page');
    add_submenu_page('ipg-theme-options', 'Earthquake setting', 'Earthquake setting', 'manage_options', 'earthquake-setting', 'earthquake_setting_page');
    //add_submenu_page('ipg-theme-options', 'Careers', 'Careers', 'manage_options', 'career-opportunity', 'career_setting_page');
//    add_submenu_page('ipg-theme-options', 'Studies and research', 'Studies and research', 'manage_options', 'studies-and-research', 'studies_and_research_setting_page');
    add_submenu_page(
            'ipg-theme-options', 'Procurement', 'Procurement', 'manage_options', 'procurement', 'procurement_setting_page'
    );
    add_submenu_page(
            'ipg-theme-options', 'IPG Staffs', 'IPG Staffs', 'manage_options', 'staffs', 'staff_setting_page'
    );
    /*
    add_submenu_page(
            'ipg-theme-options', 'Events', 'Events', 'manage_options', 'events', 'event_setting_page'
    );
    */
    add_submenu_page(
            'ipg-theme-options', 'Annual report', 'Annual report', 'manage_options', 'annual-report', 'annual_report_setting_page'
    );
    //add_submenu_page('ipg-theme-options', 'Other setting', 'Other setting', 'manage_options', 'other-setting', 'other_setting_page');


//    if (current_user_can('publish_posts') && !current_user_can('manage_options')) {
//        add_menu_page(
//                'Studies and research', 'Studies and research', 'publish_posts', 'studies-and-research', 'studies_and_research_setting_page'
//        );
//    }
//
}

// add_settings_field( $id, $title, $callback, $page, $section, $args )
function add_settings_field_to_section($id, $title, $callback, $page, $section) {
    add_settings_field($id, __($title, 'ipg-setting'), $callback, $page, $section);
}

//slider_ipg_theme_setting
function add_setting_fields_the_president() {
    //add_settings_field_to_section('ipg_setting_president_name', 'Email', 'ipg_setting_ipg_contact_email', 'the_president_ipg_theme_setting', 'ipg_setting_the_president_section');
}

function ipg_settings_config() {

    register_setting('general_ipg_theme_setting', 'ipg_setting_settings_general');

    add_settings_section(
            'ipg_setting_general_section', __('General information', 'ipg-setting'), 'empty_text_render', 'general_ipg_theme_setting'
    );
    add_setting_fields_general_info();

    /*
      +++++++++++++++++++++++++++++++++++++++++++
     */

    register_setting('slider_ipg_theme_setting', 'ipg_setting_settings_slider');
    add_settings_section(
            'ipg_setting_slider_section', __('Slider settings', 'ipg-setting'), 'empty_text_render', 'slider_ipg_theme_setting'
    );

    add_setting_fields_slider();

    /*
      +++++++++++++++++++++++++++++++++++++++++++
     */

    register_setting('ipg_values_ipg_theme_setting', 'ipg_setting_settings_ipg_values');
    add_settings_section(
            'ipg_setting_ipg_values_section', __('IPG Values settings', 'ipg-setting'), 'empty_text_render', 'ipg_values_ipg_theme_setting'
    );

    add_setting_fields_ipg_values();


    register_setting('earthquake_ipg_theme_setting', 'ipg_setting_settings_earthquake');
    add_settings_section(
            'ipg_setting_earthquake_section', __('Earthquake setting', 'ipg-setting'), 'empty_text_render', 'earthquake_ipg_theme_setting'
    );
    add_setting_fields_earthquake();

    register_setting('career_ipg_theme_setting', 'ipg_setting_career');
    add_settings_section(
            'ipg_setting_career_section', __('Career and opportunity settings', 'ipg-setting'), 'empty_text_render', 'career_ipg_theme_setting'
    );

    add_setting_fields_career();

    register_setting('studies_research_ipg_theme_setting', 'ipg_setting_settings_studies_research');
    add_settings_section(
            'ipg_setting_studies_research_section', __('Studies and research', 'ipg-setting'), 'empty_text_render', 'other_ipg_theme_setting'
    );

    add_setting_fields_studies_and_research();

    register_setting('other_ipg_theme_setting', 'ipg_setting_settings_other');
    add_settings_section(
            'ipg_setting_other_section', __('Others settings', 'ipg-setting'), 'empty_text_render', 'other_ipg_theme_setting'
    );
    add_setting_fields_other();

    //
}

function empty_text_render() {
//    $options = get_option('ipg_setting_settings_general');
//    var_dump(trim($options['ipg_setting_visao']));
}

function render_textarea($id, $name, $content) {
    $settings = array(
        'textarea_name' => $name,
        'media_buttons' => false,
        'textarea_rows'=>5,
        'editor_class'=>'form-control',
        'tinymce' => array(
            'theme_advanced_buttons1' => 'formatselect,|,bold,italic,underline,|,' .
            'bullist,blockquote,|,justifyleft,justifycenter' .
            ',justifyright,justifyfull,|,link,unlink,|' .
            ',spellchecker,wp_fullscreen,wp_adv'
        )
    );
    wp_editor($content, $id, $settings);
}

include_once 'ipg_setting_fragment_general.php';
include_once 'ipg_setting_fragment_slider.php';
include_once 'ipg_setting_fragment_earthquake.php';
include_once 'ipg_setting_fragment_other.php';
include_once 'ipg_setting_fragment_career.php';
include_once 'ipg_setting_fragment_studies_and_research.php';
include_once 'ipg_setting_fragment_staffs.php';
//include_once 'ipg_setting_fragment_events.php';
include_once 'ipg_setting_fragment_ipg_values.php';
include_once 'ipg_setting_fragment_procurement.php';
include_once 'ipg_setting_fragment_annual_report.php';
