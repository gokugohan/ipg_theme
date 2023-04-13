<?php
function other_setting_page() {
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div> <h2>Other setting</h2></div>';
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields('other_ipg_theme_setting');
        do_settings_sections('other_ipg_theme_setting');
        submit_button();
        ?>

    </form>
    <?php
}

function add_setting_fields_other() {
    add_settings_field_to_section(
            'ipg_setting_check_career_opportunities', 
            'Check for available new vacancy', 
            'ipg_setting_ipg_career_opportunity', 
            'other_ipg_theme_setting', 
            'ipg_setting_other_section');
    
    add_settings_field_to_section('ipg_setting_check_procurement', 'Check for available new procurement', 'ipg_setting_ipg_procurement', 'other_ipg_theme_setting', 'ipg_setting_other_section');
    add_settings_field_to_section('ipg_setting_check_annual_report', 'Check for available new annual report', 'ipg_setting_ipg_annual_report', 'other_ipg_theme_setting', 'ipg_setting_other_section');
    add_settings_field_to_section('ipg_setting_check_legislation', 'Check for available new legislation', 'ipg_setting_ipg_legislation', 'other_ipg_theme_setting', 'ipg_setting_other_section');
}

function ipg_setting_ipg_career_opportunity() {

    $options = get_option('ipg_setting_settings_other');
    $value = NULL;
    if (is_array($options)) {
        //$key_exist = array_key_exists('ipg_new_vacancy', $options);
        $value = $options['ipg_new_vacancy'];
    }
    ?>
    <input type='checkbox' 
           name='ipg_setting_settings_other[ipg_new_vacancy]' <?php checked($value, 1); ?> value='1'>

    <?php
}

function ipg_setting_ipg_procurement() {

    $options = get_option('ipg_setting_settings_other');
    $value = NULL;
    if (is_array($options)) {
        //$key_exist = array_key_exists('ipg_new_vacancy', $options);
        $value = $options['ipg_new_procurement'];
    }
    ?>
    <input type='checkbox' 
           name='ipg_setting_settings_other[ipg_new_procurement]' <?php checked($value, 1); ?> value='1'>

    <?php
}

function ipg_setting_ipg_annual_report() {

    $options = get_option('ipg_setting_settings_other');
    $value = NULL;
    if (is_array($options)) {
        //$key_exist = array_key_exists('ipg_new_vacancy', $options);
        $value = $options['ipg_new_annual_report'];
    }
    ?>
    <input type='checkbox' 
           name='ipg_setting_settings_other[ipg_new_annual_report]' <?php checked($value, 1); ?> value='1'>

    <?php
}

function ipg_setting_ipg_legislation() {

    $options = get_option('ipg_setting_settings_other');
    $value = NULL;
    if (is_array($options)) {
        //$key_exist = array_key_exists('ipg_new_vacancy', $options);
        $value = $options['ipg_new_legislation'];
    }
    ?>
    <input type='checkbox' 
           name='ipg_setting_settings_other[ipg_new_legislation]' <?php checked($value, 1); ?> value='1'>

    <?php
}