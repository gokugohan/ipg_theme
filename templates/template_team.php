<?php
/*
  Template Name: The Team page
 */
?>

<?php get_header(); ?>

    <style>

    </style>
    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
            <header class="mb-5 text-center">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <p class="h2 text-uppercase text-primary"><?= the_title(); ?></p>
                        <hr>
                        <br>
                    </div>
                </div>
            </header>
            <div class="row align-items-stretch">


                <div class="col-md-3">
                    <div class="single-team-member hvr-underline-reveal">
                        <div class="img-holder">
                            <img src="images/team/1.jpg" alt="Awesome Image">

                        </div>
                        <div class="text-holder">
                            <h3>Felicity BNovak</h3>
                            <span>Designer</span>
                            <div class="text">
                                <p>Occasionally circumstances occur in which toil and pain can procure.</p>
                            </div>
                            <ul class="contact-info">
                                <li>Phone: +123-456-7890</li>
                                <li>Email: <b>Felicity@Solutions.com</b></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            ?>
                            <div>

                                <?php
                                //the_content();
                                $is_not_empty = !empty(get_the_content());
                                if ($is_not_empty) {
                                    the_content();
                                } else {
                                    ipg_display_ipg_staff();
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div><!-- /row -->
        </div>

    </div>


<?php
get_footer();
