<?php
/*
  Template Name: Login form
 */

get_header();
?>

<div class="login-form-container">
    <?php
    //include('ipg_slider.php');

    if (!is_user_logged_in()) {
        ?>
        <div class="text-center">
            <header>
                <a href="<?php bloginfo('url') ?>">
                    <img class="img-responsive img-login" 
                         src="<?= get_stylesheet_directory_uri() ?>/images/logo.png" 
                         style="display: inline;"
                         />
                </a>
            </header>
        </div>

        <div class="col-md-12">
            <br/>
            <form method="post" action="<?php echo wp_login_url(); ?>">                        
                <fieldset>
                    <legend>
                        <h3 class="text-center">
                            <a href="#!">Member login area</a>                    
                        </h3>
                    </legend>
                    <div class="form-group">
                        <label for="user_login"><?php _e('Username', 'personalize-login'); ?></label>
                        <input type="text" class="form-control" name="log" id="user_login">
                    </div>
                    <div class="form-group">
                        <label for="user_pass"><?php _e('Password', 'personalize-login'); ?></label>
                        <input type="password" name="pwd" class="form-control" id="user_pass">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default" value="<?php _e('Sign In', 'personalize-login'); ?>">
                        <input type="hidden" name="redirect_to" value="<?= $_SERVER['HTTP_REFERER'] ?>">
                    </div>
                </fieldset>                        
            </form>
        </div>
        <?php
    } else {
        wp_redirect(get_site_url());        
        exit;
    }
    ?>
</div>
<!--</div>-->
<!--<div class="col-sm-12 col-md-4 col-lg-3 remove-padding-right">
<?php //get_sidebar(); ?>
</div>-->

<div class="clearfix"></div>
<?php
get_footer();
