<?php
function earthquake_setting_page() {
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div> <h2>Earthquake setting</h2></div>';
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields('earthquake_ipg_theme_setting');
        do_settings_sections('earthquake_ipg_theme_setting');
        submit_button();
        ?>

    </form>
    <?php
}

function add_setting_fields_earthquake() {
    add_settings_field_to_section(
            'ipg_setting_url',
            'Earthquake url',
            'ipg_setting_earthquake_url',
            'earthquake_ipg_theme_setting',
            'ipg_setting_earthquake_section'
        );

  add_settings_field_to_section(
        'ipg_setting_radius',
        'Earthquake Radius (in Km)',
        'ipg_setting_earthquake_radius',
        'earthquake_ipg_theme_setting',
        'ipg_setting_earthquake_section'
    );
/*
    add_settings_field_to_section(
        'ipg_setting_access_token',
        'Map Access Token',
        'ipg_setting_earthquake_map_access_token',
        'earthquake_ipg_theme_setting',
        'ipg_setting_earthquake_section'
    );
  */
  /*
    add_settings_field_to_section('ipg_setting_interval_time', 'Refresh interval time (ms)', 'ipg_setting_interval_time', 'earthquake_ipg_theme_setting', 'ipg_setting_earthquake_section');
    add_settings_field_to_section('ipg_setting_zoom', 'Google map zoom', 'ipg_setting_zoom', 'earthquake_ipg_theme_setting', 'ipg_setting_earthquake_section');
    */
}

function ipg_setting_earthquake_url() {

    $options = get_option('ipg_setting_settings_earthquake');
    ?>
    <input type='text' name='ipg_setting_settings_earthquake[earthquake_url]'
           class="regular-text"
           value='<?php echo $options['earthquake_url']; ?>'>
    <?php
}


function ipg_setting_earthquake_radius() {

    $options = get_option('ipg_setting_settings_earthquake');
    ?>
    <input type='text' name='ipg_setting_settings_earthquake[earthquake_radius]'
           class="regular-text"
           value='<?php echo $options['earthquake_radius']; ?>'>
    <?php
}
/*
function ipg_setting_earthquake_map_access_token() {

    $options = get_option('ipg_setting_settings_earthquake');
    ?>
    <input type='text' name='ipg_setting_settings_earthquake[map_access_token]'
           class="regular-text"
           value='<?php echo $options['map_access_token']; ?>'>
    <?php
}
*/
/*
function ipg_setting_interval_time() {

    $options = get_option('ipg_setting_settings_earthquake');
    ?>
    <input type='text' name='ipg_setting_settings_earthquake[interval_time]'
           class="regular-text"
           value='<?php echo $options['interval_time']; ?>'>
    <?php
}

function ipg_setting_zoom() {

    $options = get_option('ipg_setting_settings_earthquake');
    ?>
    <input type='text' name='ipg_setting_settings_earthquake[zoom]'
           class="regular-text"
           value='<?php echo $options['zoom']; ?>'>
    <?php
}
*/

