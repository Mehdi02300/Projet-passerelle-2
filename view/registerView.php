<?php
    $title = "Inscription";

    ob_start();
?>

<section class="container">
        
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div id="login-body" class="card p-4 shadow" style="width: 400px;">
            <a href="index.php" class="btn btn-secondary mb-3 hover-bold w-50 mx-auto">Retour à l'accueil</a>
            <h1 class="text-center mb-4">S'inscrire</h1>

            <?php
            if (isset($_GET['error'])) {
                $message = htmlspecialchars($_GET['message']);
                echo "<div class='alert alert-danger' role='alert'>$message</div>";
            }
            
            if (isset($_GET['success'])) {
                echo "<div class='alert alert-success' role='alert'>Inscription réussie ! Vous pouvez vous connecter.</div>";
            }
            ?>

            <form method="post" action="index.php?page=inscription">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmez le mot de passe</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>


            <p class="text-center mt-3">Déjà inscrit ? <a class="text-black hover-bold" href="index.php?page=connexion">Connectez-vous</a></p>
        </div>
    </div>

</section>

<?php
    $content = ob_get_clean();

    require('base.php');
?>