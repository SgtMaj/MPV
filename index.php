<?php
    include 'class/dev.func.php';

    $page = 'home';

    if (isset($_GET)) {
        if (!empty($_GET['q'])) {
            $page = $_GET['q'];
        }
    }

?>

<?php include 'inc/header.inc.php'; ?>

    <?php include 'inc/' . $page . '.php'; ?>

<?php include 'inc/footer.inc.php'; ?>