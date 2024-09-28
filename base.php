<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="design/defaut.css">
    </head>
    <body class="bg-primary vh-100 d-flex flex-column justify-content-between">

        <?= $content ?>

        <footer id='contact'>
            <?php require_once('src/footer.php'); ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>