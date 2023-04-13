<?php
/*
  Template Name: Geo-hazard page
 */
?>
<?php get_header();?>
<div class="container">
    <div class="page-header">
        <h1>Geo-Hazard <small>List of publications</small></h1>
    </div>
    <?php
        ipg_display_studies_and_research("Geo-Hazard");
    ?>
</div>
<?php
get_footer();
