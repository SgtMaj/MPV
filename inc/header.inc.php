<?php
    /*
     * @see http://demohtml.templatesquare.com/performs/
     */

    // error_reporting(0);
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MPV | Un blog mais pas vraiment</title>
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="main-section" role="main">
            <div id="page-top" class="clearfix">
                <header id="main-header" class="left" role="banner">
                    <a href=""><img src="img/logo.png" id="logo" alt="logo" /></a>
                    <h1>MPV</h1>
                    <h2>Un blog mais pas vraiment</h2>
                </header>

                <nav id="main-nav" class="" role="navigation">
                    <ul>
                        <li><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="current">home</a></li>
                        <li><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?q=blog">blog</a></li>
                        <li><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?q=about">about us</a></li>
                        <li><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?q=contact">contact</a></li>
                    </ul>
                </nav>
            </div>

            <div id="highlight">
                <div id="highlight-container">
                    <!-- <h3>Blog</h3> -->
            <!-- http://www.creativejuiz.fr/trytotry/juizy-slideshow-full-css3-html5/ -->
                    <div id="slideshow">
                        <div id="slider">
                            <figure id="slide-0" class="slide">
                                <img src="img/slide.jpg" alt="" />
                                <figcaption>
                                    <strong>Website Design</strong>
                                    Pellentesque habitant morbi tristique senectus et netus. Praesent in augue eleifend lacus dictum dapibus sit amet porttitor sem.
                                </figcaption>
                            </figure>

                            <figure id="slide-1" class="slide">
                                <img src="img/slide.jpg" alt="" />
                                <figcaption>
                                    <strong>Aliquam Dictum</strong>
                                    Praesent in augue eleifend lacus dictum dapibus sit amet porttitor sem. Pellentesque habitant morbi tristique senectus et netus.
                                </figcaption>
                            </figure>
                        </div>

                        <div id="slideshow-navigation">
                            <span class="bullet current"></span>
                            <span class="bullet"></span>
                            <span class="bullet"></span>
                            <span class="bullet"></span>
                            <span class="bullet"></span>
                        </div>
                    </div>
                </div>
            </div>

