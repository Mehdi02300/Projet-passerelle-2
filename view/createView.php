<?php
    $title = "Créer un article";

    ob_start();
?>

<section class="container">
        
    <div class='d-flex justify-content-between align-items-center mt-5'>
            <!-- Bouton Retour à l'accueil -->
            <a href="index.php" class="btn btn-secondary mb-3 hover-bold">Retour</a>
            <h1 class="mb-4">Ajouter un article</h1>
        </div>
        <form action="index.php?page=créer un article" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm my-5">
            <div class="mb-3">
                <label for="tittle" class="form-label">Titre :</label>
                <input type="text" id="tittle" name="tittle" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu :</label>
                <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type :</label>
                <select id="type" name="type" class="form-select">
                    <option value="blog">Blog</option>
                    <option value="projet">Projet</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image :</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>

</section>

<?php
    $content = ob_get_clean();

    require('base.php');
?>