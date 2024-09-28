<?php
    $title = "Connexion";

    ob_start();
?>

<section class="container-fluid p-3">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="card p-4 shadow" style="max-width: 400px; width: 100%;">
            <a href="index.php" class="btn btn-secondary mb-3 hover-bold w-50 mx-auto">Retour à l'accueil</a>
            <h1 class="text-center mb-4">S'identifier</h1>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    Pseudo ou mot de passe incorrect.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">
                    Vous êtes maintenant connecté.
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?page=connexion">
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

                <p class="mt-3 text-center">Pas encore inscrit ? <a class="text-black hover-bold" href="index.php?page=inscription">Inscrivez-vous</a>.</p>
        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();

    require('base.php');
?>