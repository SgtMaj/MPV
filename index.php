<?php
    // error_reporting(0);
    include '__dev/dev.func.php';

    include 'config.php';

    $page = 'home';

    if (isset($_GET)) {
        if (!empty($_GET['q'])) {
            $page = $_GET['q'];
        }
    }

    $aside = ($page == 'blog') ? 'blog' : 'page';
    $highlight = ($page =='blog') ? FALSE : TRUE;
?>

<?php include 'inc/header.inc.php'; ?>

    <?php include 'inc/highlight.inc.php'; ?>

    <section id="<?php echo $page; ?>" class="content clearfix">
        <?php
            if (file_exists('inc/' . $page . '.php')) {
                include 'inc/' . $page . '.php';
            }
        ?>

        <?php
            if (file_exists('inc/aside-' . $aside . '.inc.php')) {
                include 'inc/aside-' . $aside . '.inc.php';
            }
        ?>
    </section>

<?php include 'inc/footer.inc.php'; ?>