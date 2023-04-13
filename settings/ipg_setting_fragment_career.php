<?php

function career_setting_page() {
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div> <h2>IPG Theme</h2></div>';
    ?>
    <!--    <form action='options.php' method='post'>        
    <?php
    //settings_fields('career_ipg_theme_setting');
    //do_settings_sections('career_ipg_theme_setting');    
    ?>

    <?php
    //submit_button();
    ?>
        </form>-->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/bootstrap.min.css' ?>">
    <div class="container">
        <form method="post" class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label class="control-label">Title</label>
                <input type="text" class="form-control" id="career-titulo" name="career-titulo"/>
            </div>
            <div class="form-group">
                <label class="control-label">Summary</label>
                <textarea cols="20" rows="5"class="form-control"  id="career-summary" name="career-summary"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Link for vacancy post</label>
                <input type="text"class="form-control"  id="career-link" name="career-link"/>
            </div>
            <div class="form-group">
                <label class="control-label">Expire date</label>
                <input type="date"class="form-control"  id="career-date" name="career-date"/>
            </div>
            <div class="form-group">
                <input class="button button-primary" type="submit" value="submit"/>
            </div>
        </form>    
    </div>
    <?php
    $titulo = isset($_POST['career-titulo']) ? $_POST['career-titulo'] : FALSE;
    $summary = isset($_POST['career-summary']) ? $_POST['career-summary'] : FALSE;
    $link = isset($_POST['career-link']) ? $_POST['career-link'] : FALSE;
    $data_limite = isset($_POST['career-date']) ? $_POST['career-date'] : FALSE;

    if ($titulo && $summary && $link && $data_limite) {
        ipg_insert_new_job($titulo, $summary, $link, $data_limite);
    } else {
        echo "Upss.";
    }
    ipg_display_jobs();
}

function add_setting_fields_career() {
    add_settings_field_to_section(
            'ipg_setting_career', 'Add new vacancy', 'ipg_setting_career', 'career_ipg_theme_setting', 'ipg_setting_career_section'
    );
}

function ipg_setting_career() {

    $options = get_option('ipg_setting_career');
    ?>
    <label>Title</label>
    <br/>
    <input type='text' name='ipg_setting_career[ipg_career_title]' 
           class="regular-text"
           placeholder="Title"
           value='<?php echo $options['ipg_career_title']; ?>'>
    <br/>
    <label>Summary for the vacancy</label>
    <br/>
    <textarea cols='40' rows='5' class="regular-text" placeholder="Summary for the vacancy" 
              name='ipg_setting_career[ipg_career_summary]'><?php echo $options['ipg_career_summary']; ?></textarea>
    <br/>
    <label>Link for the vacancy</label><br/>
    <input type='text' name='ipg_setting_career[ipg_career_link]' 
           class="regular-text"
           placeholder="Url for vacancy content"
           value='<?php echo $options['ipg_career_link']; ?>'>

    <br/>
    <input type='date' 
           name='ipg_setting_career[ipg_setting_career_expire_date]'
           value="<?php echo $options['ipg_setting_career_expire_date']; ?>"
           />

    <h1>List of vacancies</h1>
    <table class="form-table" style="border: 1px solid #c3c3c3;">
        <thead>
            <tr>
                <th>Vancany Title</th>
                <th>Vacancy Summary</th>
                <th>Vacancy link</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Vacancy 1</td>
                <td>Lorem ipsum dollor sit amet.</td>
                <td>#!</td>
                <td><a href="#!" class="btn-vacancy-edit">Edit</a> | <a href="#!" class="btn-vacancy-delete">Delete</a></td>
            </tr>
            <tr>
                <td>Vacancy 2</td>
                <td>Lorem ipsum dollor sit amet.</td>
                <td>#!</td>
                <td><a href="#!" class="btn-vacancy-edit">Edit</a> | <a href="#!" class="btn-vacancy-delete">Delete</a></td>
            </tr>
        </tbody>
    </table>
    <script>
        window.onload = function () {
            var btnEdit = document.getElementsByClassName("btn-vacancy-edit");// .getElementByClassName("btn-vacancy-edit");
            console.log(btnEdit);
        }
    </script>
    <?php
}

//ipg_setting_career
