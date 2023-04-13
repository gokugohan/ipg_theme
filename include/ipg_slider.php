
<?php
$sliders = get_option('ipg_setting_settings_slider');
if ($sliders != NULL) {
    $slide_counter = 0;
    ?>

        <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel-bg carousel carousel-fade" data-bs-ride="carousel">
                <?php
                foreach ($sliders as $chave => $valor) {
                    $slide = $sliders[$chave];
                    if ((strlen($chave) === SLIDER_KEY_LENGTH)) {

                        $title = $sliders[$chave . '_title'];
                        $summary = $sliders[$chave . '_summary'];
                        $readmore = $sliders[$chave . '_read_more'];

                        if ($slide_counter == 0) {
                            $active = "active";
                        } else {
                            $active = '';
                        }
                        ?>
                        <div class="carousel-item  <?= $active ?>"
                            style="background-image: url(<?=$slide?>); background-size: cover; background-position: center; background-repeat: no-repeat; transition: .5s ease-in-out;">
                            <div class="carousel-container">
                                <div class="container">
                                    <h2 class="animate__animated animate__fadeInDown"><?= $title; ?></h2>
                                    <p class="animate__animated fanimate__adeInUp"><?= $summary; ?></p>
                                    <a href="<?= $readmore; ?>" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                                </div>
                            </div>
                        </div>

                        <?php
                        $slide_counter++;
                    }
                }
                ?>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                </a>

            </div>

            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
                </g>
            </svg>
        </section>

    <?php
}
