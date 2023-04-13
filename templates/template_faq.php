<?php
/*
  Template Name: The FAQ page
 */
?>
<?php
get_header();
?>

<div class="container" id="about-ipg">
    <div class="row white">
        <br>
        <h1 class="centered">Frequently ask question</h1>
        <hr>
        <div class="col-sm-12">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    ?>
                    <div class="news-content">
                        <?php the_content(); ?>
                    </div>
                    <?php
                }
            } else {
                echo ('No content yet.');
            }
            ?>           
        </div>        
    </div><!-- row -->
</div><!-- container -->
<?php
get_footer();
