<?php
/*
  Template Name: The president
 */
?>
<?php get_header(); ?>
<div class="col-sm-12 col-md-8 col-lg-9 remove-padding-left">
    <?php include('/ipg_slider.php'); ?>

    <div class="the-president-section">                    
        <h3 class="the-president-title"><?php the_title(); ?></h3>        
        <div class="the-president-content">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="thumbnail the-president-photo">
                        <img src="<?= get_general_setting('ipg_setting_president_url_photo'); ?>" 
                             alt="<?php //echo get_value_setting('name_degree');  ?>">                        
                        <div class="caption">
                            <h3 class="the-president-name">
                                President and BOD of IPG                                
                                <br/>
                                <?= get_general_setting('ipg_president_name'); ?>
                            </h3>                             
                        </div>
                    </div>

                </div>
                <div class="col-md-9 col-sm-12">
                    <p class="artext">
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                the_content();
                            }
                        } else {
                            echo ('No content yet.');
                        }
                        ?>
                    </p>  
                </div>
            </div>            
            <div class="clearfix"></div>                        
        </div>
    </div>        
</div>
<div class="col-sm-12 col-md-4 col-lg-3 remove-padding-right">
    <?php get_sidebar(); ?>
</div>
<div class="clearfix"></div>
<?php
get_footer();
