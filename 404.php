<?php //get_header(); ?>
<?php //include('include/ipg_slider.php'); ?>
<!--<div class="container">	        	    -->
<!--    <h1 class="centered">Page requested was not found!</h1>-->
<!--</div>-->
<?php
//get_footer();
?>

<!doctype html>
<html lang="en">

<head>
    <title><?= get_bloginfo('name'); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            margin: 0;
        }

        header,
        nav,
        section {
            display: block;
        }

        figcaption,
        main {
            display: block;
        }

        a {
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }

        strong {
            font-weight: inherit;
        }

        strong {
            font-weight: bolder;
        }

        code {
            font-family: monospace, monospace;
            font-size: 1em;
        }

        dfn {
            font-style: italic;
        }

        svg:not(:root) {
            overflow: hidden;
        }

        button,
        input {
            font-family: sans-serif;
            font-size: 100%;
            line-height: 1.15;
            margin: 0;
        }

        html {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        *,
        *::before,
        *::after {
            -webkit-box-sizing: inherit;
            box-sizing: inherit;
        }

        p {
            margin: 0;
        }

        button {
            background: transparent;
            padding: 0;
        }

        button:focus {
            outline: 1px dotted;
            outline: 5px auto -webkit-focus-ring-color;
        }

        *,
        *::before,
        *::after {
            border-width: 0;
            border-style: solid;
            border-color: #dae1e7;
        }

        button,
        [type="button"],
        [type="reset"],
        [type="submit"] {
            border-radius: 0;
        }

        button,
        input {
            font-family: inherit;
        }

        input::-webkit-input-placeholder {
            color: inherit;
            opacity: .5;
        }

        input:-ms-input-placeholder {
            color: inherit;
            opacity: .5;
        }

        input::-ms-input-placeholder {
            color: inherit;
            opacity: .5;
        }

        input::placeholder {
            color: inherit;
            opacity: .5;
        }

        button,
        [role=button] {
            cursor: pointer;
        }

        .color-atlantis {
            background-color: #9EC92B;
        }

        .bg-no-repeat {
            background-repeat: no-repeat;
        }

        .bg-cover {
            background-size: cover;
        }

        .border-grey-light {
            border-color: #dae1e7;
        }

        .hover\:border-grey:hover {
            border-color: #b8c2cc;
        }

        .rounded-lg {
            border-radius: .5rem;
        }

        .border-2 {
            border-width: 2px;
        }

        .hidden {
            display: none;
        }

        .flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .items-center {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .justify-center {
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .font-sans {
            font-family: Nunito, sans-serif;
        }

        .font-light {
            font-weight: 300;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-black {
            font-weight: 900;
        }

        .h-1 {
            height: .25rem;
        }

        .leading-normal {
            line-height: 1.5;
        }

        .m-8 {
            margin: 2rem;
        }

        .my-3 {
            margin-top: .75rem;
            margin-bottom: .75rem;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .max-w-sm {
            max-width: 30rem;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .py-3 {
            padding-top: .75rem;
            padding-bottom: .75rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .pb-full {
            padding-bottom: 100%;
        }

        .absolute {
            position: absolute;
        }

        .relative {
            position: relative;
        }

        .pin {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .text-white {
            color: #ffffff;
        }

        .text-2xl {
            font-size: 1.5rem;
        }

        .text-5xl {
            font-size: 3rem;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .tracking-wide {
            letter-spacing: .05em;
        }

        .w-16 {
            width: 4rem;
        }

        .w-full {
            width: 100%;
            background: #b5d65d;
            background-image: url(<?php echo get_stylesheet_directory_uri() . '/images/wave.png' ?>);
            background-repeat: no-repeat;
            background-position: top;
            background-size: cover;
            position: relative;
        }

        @media (min-width: 768px) {
            .md\:bg-left {
                background-position: left;
            }

            .md\:bg-right {
                background-position: right;
            }

            .md\:flex {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }

            .md\:my-6 {
                margin-top: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .md\:min-h-screen {
                min-height: 100vh;
            }

            .md\:pb-0 {
                padding-bottom: 0;
            }

            .md\:text-3xl {
                font-size: 1.875rem;
            }

            .md\:text-15xl {
                font-size: 9rem;
            }

            .md\:w-1\/2 {
                width: 50%;
            }
        }

        @media (min-width: 992px) {
            .lg\:bg-center {
                background-position: center;
            }
        }
    </style>
</head>

<body class="antialiased font-sans">
<div class="md:flex min-h-screen">
    <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
        <div class="max-w-sm m-8">
            <div class="text-black text-5xl md:text-15xl font-black">
                <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.png' ?>"
                     alt="<?= bloginfo('title') ?>">
            </div>

            <div class="w-16 h-1 color-atlantis my-3 md:my-6"></div>

            <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                Page requested not found! </p>

            <a href="<?php bloginfo('url'); ?>">
                <button
                        class="color-atlantis text-white font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                    Go Home
                </button>
            </a>
        </div>
    </div>

    <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
        <div style="background-image: url('<?php echo get_stylesheet_directory_uri() . '/images/login-background.jpg' ?>');"
             class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
        </div>
    </div>
</div>
</body>

</html>
