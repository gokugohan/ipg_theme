<?php

function ipg_values_setting_page() {
    ?>
    <div class="container">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">IPG VALUES</h3>
            </div>
            <div class="panel-body">
                <form action='options.php' method='post'>
                    <?php
                    settings_fields('ipg_values_ipg_theme_setting');
                    do_settings_sections('ipg_values_ipg_theme_setting');
                    submit_button();
                    ?>

                </form>  
            </div>
        </div>
    </div>
    <?php
}

function add_setting_fields_ipg_values() {
    add_settings_field_to_section('ipg_setting_value_1', '<h1>I<small>ntegrity</small></h1>', 'ipg_setting_ipg_value_1', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_2', '<h1>P<small>rofessional</small></h1>', 'ipg_setting_ipg_value_2', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_3', '<h1>G<small>reatness</small></h1>', 'ipg_setting_ipg_value_3', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_4', '<h1>T<small>eamwork</small></h1>', 'ipg_setting_ipg_value_4', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_5', '<h1>I<small>ntuitive</small></h1>', 'ipg_setting_ipg_value_5', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_6', '<h1>M<small>aturity</small></h1>', 'ipg_setting_ipg_value_6', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_7', '<h1>O<small>ptimist</small></h1>', 'ipg_setting_ipg_value_7', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
    add_settings_field_to_section('ipg_setting_value_8', '<h1>R<small>espect</small></h1>', 'ipg_setting_ipg_value_8', 'ipg_values_ipg_theme_setting', 'ipg_setting_ipg_values_section');
}

function ipg_setting_ipg_value_1() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>     
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_1]'><?php echo $options['ipg_values_description_1']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_2() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_2]'><?php echo $options['ipg_values_description_2']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_3() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_3]'><?php echo $options['ipg_values_description_3']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_4() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_4]'><?php echo $options['ipg_values_description_4']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_5() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_5]'><?php echo $options['ipg_values_description_5']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_6() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_6]'><?php echo $options['ipg_values_description_6']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_7() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_7]'><?php echo $options['ipg_values_description_7']; ?></textarea>          
    <?php
}

function ipg_setting_ipg_value_8() {

    $options = get_option('ipg_setting_settings_ipg_values');
    ?>       
    <label>Description</label>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Description" 
              name='ipg_setting_settings_ipg_values[ipg_values_description_8]'><?php echo $options['ipg_values_description_8']; ?></textarea>          
    <?php
}
