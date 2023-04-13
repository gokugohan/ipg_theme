<?php
/*
  Template Name: Geo-investigation page
 */
?>
<?php get_header();?>
<div class="container">
    <div class="page-header">
        <h1>Geo-investigation <small>List of publications</small></h1>
    </div>
    <?php
        ipg_display_studies_and_research("Geo-Investigation");
    ?>
</div>
<?php
get_footer();
