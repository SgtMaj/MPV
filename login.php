<?php
    include '__dev/dev.func.php';

    include 'config.php';
    include 'class/validation.class.php';

    $Session = new Session();

    if (!empty($_SESSION['auth'])) {
        $_SESSION['auth'] = array();
        unset($_SESSION['auth']);
    }

    if ($_POST) {
        if(!empty($_POST['login']) && !empty($_POST['pwd'])) {
            $post = Validation::sanitize($_POST);

            $isUser = Validation::checkUser($post);
        }
    }
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login | MPV | Un moteur de blog mais pas vraiment</title>
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo ROOT; ?>css/normalize.min.css">
        <link rel="stylesheet" href="<?php echo ROOT; ?>css/main.css">

        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>

    <body class="login">
        <?php $Session->getFlash(); ?>

        <section id="main-section" role="main">
            <header id="main-header" role="banner">
                <a href="<?php echo ROOT; ?>"><img src="img/logo.png" id="logo" alt="logo" /></a>
                <h1>MPV</h1>
            </header>

            <div id="form-login-wrapper">
                <form id="form-login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div id="form-input">
                        <input type="text" id="input-login" name="login" placeholder="Login..." value="" required />

                        <input type="password" id="input-pwd" name="pwd" placeholder="Password..." required />
                    </div>

                    <div id="form-submit">
                        <input type="submit" id="input-submit" value="go" />
                    </div>
                </form>
            </div>

            <footer id="form-login-links">
                <a href="<?php echo ROOT; ?>" class="right">Mot de passe oublié ? &rarr;</a>
                <a href="<?php echo ROOT; ?>" class="left">&larr; Retour à l'accueil</a>
            </footer>
        </section>

        <!--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>