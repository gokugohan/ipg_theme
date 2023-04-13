<?php

function ipg_setting_options_page() {
    ?>
    <div class="container">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">IPG THEME</h3>
            </div>
            <div class="panel-body">
                <form action='options.php' method='post'>
                    <?php
                    settings_fields('general_ipg_theme_setting');
                    do_settings_sections('general_ipg_theme_setting');
                    submit_button();
                    ?>

                </form>
            </div>
        </div>
    </div>

    <?php
}

function add_setting_fields_general_info() {
    add_settings_field_to_section('ipg_setting_president_name', "President's name", 'ipg_setting_president_name', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_president_url_photo', "President's profile picture", 'ipg_setting_president_profile_picture', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_short_name', 'IPG short name', 'ipg_setting_ipg_short_name', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_description_name', 'IPG description name', 'ipg_setting_ipg_description_name', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_summary', 'IPG Summary', 'ipg_setting_ipg_summary', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_address', 'Address', 'ipg_setting_ipg_address', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_address_lat', 'Latitude', 'ipg_setting_ipg_address_lat', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_address_long', 'Longitude', 'ipg_setting_ipg_address_long', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_contact_email', 'Email', 'ipg_setting_ipg_contact_email', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_contact_phone', 'Phone', 'ipg_setting_ipg_contact_phone', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_contact_website', 'Website', 'ipg_setting_ipg_contact_website', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_visao', 'Visão', 'ipg_setting_ipg_visao', 'general_ipg_theme_setting', 'ipg_setting_general_section');
    add_settings_field_to_section('ipg_setting_missao', 'Missão', 'ipg_setting_ipg_missao', 'general_ipg_theme_setting', 'ipg_setting_general_section');
}

function ipg_setting_president_name() {

    $options = get_option('ipg_setting_settings_general');
    ?>

    <input type='text' name='ipg_setting_settings_general[ipg_president_name]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_president_name']; ?>'>
    <hr/>
    <label>Logo IPG</label>
    <input type='text' name='ipg_setting_settings_general[ipg_contact_logo]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_contact_logo']; ?>'>
    <label>Logo RDTL</label>
    <input type='text' name='ipg_setting_settings_general[ipg_contact_logo_rdtl]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_contact_logo_rdtl']; ?>'>
    <br/>
    <?php
}

function ipg_setting_president_profile_picture() {

    $options = get_option('ipg_setting_settings_general');
    ?>
    <input type='text' name='ipg_setting_settings_general[ipg_setting_president_url_photo]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_setting_president_url_photo']; ?>'>
           <?php
       }

       function ipg_setting_ipg_short_name() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_short_name]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_short_name']; ?>'>
           <?php
       }

       function ipg_setting_ipg_description_name() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_description_name]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_description_name']; ?>'>
    <hr/>
    <?php
}

function ipg_setting_ipg_summary() {
    $options = get_option('ipg_setting_settings_general');
    ?>
    <textarea cols='40' rows='5' class="regular-text form-control" placeholder="Summary" 
              name='ipg_setting_settings_general[ipg_summary]'><?php echo $options['ipg_summary']; ?></textarea>          
              <?php
          }

          function ipg_setting_ipg_address() {

              $options = get_option('ipg_setting_settings_general');
              ?>
    <input type='text' name='ipg_setting_settings_general[ipg_address]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_address']; ?>'>
           <?php
       }

       function ipg_setting_ipg_address_lat() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_address_lat]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_address_lat']; ?>'>
           <?php
       }

       function ipg_setting_ipg_address_long() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_address_long]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_address_long']; ?>'>
           <?php
       }

       function ipg_setting_ipg_contact_email() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_contact_email]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_contact_email']; ?>'>
           <?php
       }

       function ipg_setting_ipg_contact_phone() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_contact_phone]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_contact_phone']; ?>'>
           <?php
       }

       function ipg_setting_ipg_contact_website() {

           $options = get_option('ipg_setting_settings_general');
           ?>
    <input type='text' name='ipg_setting_settings_general[ipg_contact_website]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_contact_website']; ?>'>
    <hr/>

    <?php
}
?>
<?php

function ipg_setting_ipg_visao() {

    $options = get_option('ipg_setting_settings_general');

    render_textarea(
            'ipg_setting_visao', 'ipg_setting_settings_general[ipg_setting_visao]', $options['ipg_setting_visao']);
}

function ipg_setting_ipg_missao() {

    $options = get_option('ipg_setting_settings_general');
    render_textarea(
            'ipg_setting_missao', 'ipg_setting_settings_general[ipg_setting_missao]', $options['ipg_setting_missao']);
}
