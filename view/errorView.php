<?php
    $title = "Erreur";

    ob_start();
?>

<section class="container">
        <a href="index.php" class="btn btn-secondary my-5 hover-bold">Retour à l'accueil</a>
        <h1 class='my-5'>OUPS !</h1>
        <p class='mb-5'><?= $error ?></p>
    </div>

</section>

<?php
    $content = ob_get_clean();

    require('base.php');
?>