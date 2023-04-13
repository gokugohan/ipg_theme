<?php

function slider_setting_page() {
    ?>
    <div class="container">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">IPG THEME</h3>
            </div>
            <div class="panel-body">
                <form action='options.php' method='post'>
                    <?php
                    settings_fields('slider_ipg_theme_setting');
                    do_settings_sections('slider_ipg_theme_setting');
                    submit_button();
                    ?>

                </form>  
            </div>
        </div>
    </div>
    <?php
}

function add_setting_fields_slider() {    
    add_settings_field_to_section('ipg_setting_slider_1', 'Slider 1', 'ipg_setting_ipg_slider_1', 'slider_ipg_theme_setting', 'ipg_setting_slider_section');
    add_settings_field_to_section('ipg_setting_slider_2', 'Slider 2', 'ipg_setting_ipg_slider_2', 'slider_ipg_theme_setting', 'ipg_setting_slider_section');
    add_settings_field_to_section('ipg_setting_slider_3', 'Slider 3', 'ipg_setting_ipg_slider_3', 'slider_ipg_theme_setting', 'ipg_setting_slider_section');
    add_settings_field_to_section('ipg_setting_slider_4', 'Slider 4', 'ipg_setting_ipg_slider_4', 'slider_ipg_theme_setting', 'ipg_setting_slider_section');
    add_settings_field_to_section('ipg_setting_slider_5', 'Slider 5', 'ipg_setting_ipg_slider_5', 'slider_ipg_theme_setting', 'ipg_setting_slider_section');
}

function ipg_setting_ipg_slider_1() {

    $options = get_option('ipg_setting_settings_slider');
    ?>
    <label>Image link</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_1]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_slider_1']; ?>'>
    <br/>
    <label>Title for slider</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_1_title]' 
           class="regular-text form-control"
           value='<?php echo $options['ipg_slider_1_title']; ?>'>
    <br/>
    <label>Summary for slider</label>
    <textarea cols='40' rows='3' class="regular-text form-control" placeholder="Caption for slider" 
              name='ipg_setting_settings_slider[ipg_slider_1_summary]'><?php echo $options['ipg_slider_1_summary']; ?></textarea>
    <br/>
    <label>Link for summary content</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_1_read_more]' 
           class="regular-text form-control"
           placeholder="Url for read more slider content"
           value='<?php echo $options['ipg_slider_1_read_more']; ?>'>    
           <?php
       }

       function ipg_setting_ipg_slider_2() {

           $options = get_option('ipg_setting_settings_slider');
           ?>
    <label>Image link</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_2]' 
           class="regular-text form-control"
           placeholder="Image url for slider"
           value='<?php echo $options['ipg_slider_2']; ?>'>
    <br/>
    <label>Title for slider</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_2_title]' 
           class="regular-text form-control"
           placeholder="Title for slider"
           value='<?php echo $options['ipg_slider_2_title']; ?>'>
    <br/>
    <label>Summary for slider</label>
    <textarea cols='40' rows='5' 
              class="regular-text form-control" 
              placeholder="Caption for slider"
              name='ipg_setting_settings_slider[ipg_slider_2_summary]'><?php echo $options['ipg_slider_2_summary']; ?></textarea>
    <br/>
    <label>Link for summary content</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_2_read_more]' 
           class="regular-text form-control"
           placeholder="Url for read more slider content"
           value='<?php echo $options['ipg_slider_2_read_more']; ?>'> 
           <?php
       }

       function ipg_setting_ipg_slider_3() {

           $options = get_option('ipg_setting_settings_slider');
           ?>
    <label>Image link</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_3]' 
           class="regular-text form-control"
           placeholder="Image url for slider"           
           value='<?php echo $options['ipg_slider_3']; ?>'>
    <br/>
    <label>Title for slider</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_3_title]' 
           class="regular-text form-control"
           placeholder="Title for slider"
           value='<?php echo $options['ipg_slider_3_title']; ?>'>
    <br/>
    <label>Summary for slider</label>
    <textarea 
        cols='40' rows='3' class="regular-text form-control" 
        placeholder="Caption for slider"
        name='ipg_setting_settings_slider[ipg_slider_3_summary]'><?php echo $options['ipg_slider_3_summary']; ?></textarea>
    <br/>
    <label>Link for summary content</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_3_read_more]' 
           class="regular-text form-control"
           placeholder="Url for read more slider content"
           value='<?php echo $options['ipg_slider_3_read_more']; ?>'> 
           <?php
       }

       function ipg_setting_ipg_slider_4() {

           $options = get_option('ipg_setting_settings_slider');
           ?>
    <label>Image link</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_4]' 
           class="regular-text form-control"
           placeholder="Image url for slider"
           value='<?php echo $options['ipg_slider_4']; ?>'>
    <br/>
    <label>Title for slider</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_4_title]' 
           class="regular-text form-control"
           placeholder="Title for slider"
           value='<?php echo $options['ipg_slider_4_title']; ?>'>
    <br/>
    <label>Summary for slider</label>
    <textarea cols='40' rows='5' class="regular-text form-control" 
              placeholder="Caption for slider"
              name='ipg_setting_settings_slider[ipg_slider_4_summary]'><?php echo $options['ipg_slider_4_summary']; ?></textarea>
    <br/>
    <label>Link for summary content</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_4_read_more]' 
           class="regular-text form-control"
           placeholder="Url for read more slider content"
           value='<?php echo $options['ipg_slider_4_read_more']; ?>'> 
           <?php
       }

       function ipg_setting_ipg_slider_5() {

           $options = get_option('ipg_setting_settings_slider');
           ?>
    <label>Image link</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_5]' 
           class="regular-text form-control"
           placeholder="Image url for slider"
           value='<?php echo $options['ipg_slider_5']; ?>'>
    <br/>
    <label>Title for slider</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_5_title]' 
           class="regular-text form-control"
           placeholder="Title for slider"
           value='<?php echo $options['ipg_slider_5_title']; ?>'>
    <br/>
    <label>Summary for slider</label>
    <textarea cols='40' rows='5' 
              class="regular-text form-control" 
              placeholder="Caption for slider"
              name='ipg_setting_settings_slider[ipg_slider_5_summary]'><?php echo $options['ipg_slider_5_summary']; ?></textarea>
    <br/>
    <label>Link for summary content</label>
    <input type='text' name='ipg_setting_settings_slider[ipg_slider_5_read_more]' 
           class="regular-text form-control"
           placeholder="Url for read more slider content"
           value='<?php echo $options['ipg_slider_5_read_more']; ?>'> 
    <?php
}
