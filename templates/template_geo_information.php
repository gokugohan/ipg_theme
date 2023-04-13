<?php
/*
  Template Name: Geo-information and database page
 */
?>
<?php get_header();?>
<div class="container">
    <div class="page-header">
        <h1>Geo-Information and database <small>List of publications</small></h1>
    </div>
    <?php
        ipg_display_studies_and_research("Geo-Information");
    ?>
</div>
<?php
get_footer();
