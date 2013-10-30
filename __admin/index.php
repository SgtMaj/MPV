<?php
    include '../__dev/dev.func.php';

    include '../config.php';
    include '../class/session.class.php';
?>
<?php
    $Session = new Session();

    if ($Session->isLogged()) {
        $pseudo = $_SESSION['auth']['pseudo'];
    }
    else {
        header('Location: ../login.php');
    }
?>
<?php
    $page = 'home';

    if (!empty($_GET['q'])) {
        $page = $_GET['q'];
    }
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Administration | MPV | Un moteur de blog mais pas vraiment</title>
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo ROOT; ?>css/normalize.min.css">
        <link rel="stylesheet" href="<?php echo ADMIN; ?>css/main.css">

        <!--[if lt IE 9]>
            <script src="../js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>

    <body class="admin">
        <header id="admin-bar" class="clearfix">
            <div id="admin-user" class="right">
                Hello <?php echo $pseudo; ?> ! |
                <a href="<?php echo ROOT; ?>login.php">Se déconnecter</a>
            </div>

            <div id="admin-links">
                <ul>
                    <li>
                        <a href="<?php echo ROOT; ?>" id="admin-go-site" target="_blank">&larr; Aller sur le site</a>
                    </li>
                    <li><a href="<?php echo ADMIN; ?>?q=add">Ajouter du contenu</a></li>
                </ul>
            </div>
        </header>

        <section id="main-section" role="main">
            <nav id="main-nav" class="" role="navigation">
                <ul>
                    <li><a href="<?php echo ADMIN; ?>" id="nav-home" class="current">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN; ?>?q=carrousel" id="nav-carrousel">Carrousel</a></li>
                </ul>
            </nav>

            <section id="main-content">
            <?php
                if (file_exists('inc/' . $page . '.php')) {
                    include 'inc/' . $page . '.php';
                }
            ?>
            </section>

        </section>

        <!--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>-->
        <script>
            window.jQuery || document.write('<script src="../js/vendor/jquery-1.10.2.min.js"><\/script>')
        </script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>