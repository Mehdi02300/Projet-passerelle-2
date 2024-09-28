<?php
    $title = "Accueil";

    ob_start();
?>

<section class="container">

    <header class="py-4 mb-5 sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Mehdi Rhallab</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end gap-5" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#projet">Projets</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                
                <!-- Partie Connexion / Déconnexion -->
                <div class="d-flex flex-column-reverse align-items-start flex-lg-row gap-2">
                    <?php
                    // Vérifiez si l'utilisateur est connecté
                    if (isset($_SESSION['connect']) && $_SESSION['connect']) {
                        echo '<a href="src/logout.php" class="btn btn-secondary">Déconnexion</a>';
                        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                            echo '<a href="index.php?page=créer un article" class="btn btn-outline-secondary">Ajouter un Article</a>';
                        }
                    } else {
                        echo '<a href="index.php?page=connexion" class="btn btn-outline-secondary">Connexion</a>';
                        echo '<a href="index.php?page=inscription" class="btn btn-secondary">S\'inscrire</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <section class="d-flex flex-column align-items-center text-center" id="accueil">
        <div class="card w-100 d-lg-w-75 my-5">
            <img src="images/dev.png" class="card-img-top img-fluid" alt="Image de développeur">
            <div class="card-body text-white">
            <h5 class="card-title fs-3">Portfolio</h5>
            <p class="card-text fs-5 fw-bold">
                Développeur Web maîtrisant parfaitement les aspects de la création d'un site internet efficace, simple et intuitif. Bienvenue sur mon portfolio.
            </p>
            </div>
        </div>
    </section>

    <main class="d-flex flex-column gap-3 mt-5 flex-lg-row">
        <!-- Blog Section -->
        <section id='blog'>
            <h3 class='my-5'>Blog</h3>
            <?php if (count($blogArticles) > 0) { ?>
                <div id="CarrouselBlog" class="carousel slide">
                    <div class="carousel-inner">
                        <?php foreach ($blogArticles as $index => $article) { ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="card mb-5">
                                    <?php if (!empty($article['image'])) { ?>
                                        <img src="<?php echo htmlspecialchars($article['image']); ?>" class="card-img-top img-height" alt="<?php echo htmlspecialchars($article['tittle']); ?>">
                                    <?php } ?>
                                    <div class="card-body-main p-3">
                                        <h5 class="card-title fs-4 mt-3"><?php echo htmlspecialchars($article['tittle']); ?></h5>
                                        <div class="d-flex justify-content-center align-items-start gap-5">
                                            <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#enSavoirPlusBlog<?php echo $article['id']; ?>">
                                                En savoir plus
                                            </button>

                                            <div class="modal fade" id="enSavoirPlusBlog<?php echo $article['id']; ?>" data-bs-backdrop="static">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content bg-primary text-black">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo htmlspecialchars($article['tittle']); ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body d-flex flex-column justify-content-center align-items-center p-5">
                                                            <?php if (!empty($article['image'])) { ?>
                                                                <img src="<?php echo htmlspecialchars($article['image']); ?>" class="card-img-mod" alt="<?php echo htmlspecialchars($article['tittle']); ?>">
                                                            <?php } ?>
                                                            <p><?php echo htmlspecialchars($article['content']); ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBlog<?php echo $article['id']; ?>" aria-expanded="false" aria-controls="collapseBlog<?php echo $article['id']; ?>">
                                                Commentaires
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="collapse" id="collapseBlog<?php echo $article['id']; ?>">
                                                <!-- Formulaire de commentaire -->
                                                <?php if (isset($_SESSION['connect']) && $_SESSION['connect']) { ?>
                                                <form method="post" action="index.php" class="mb-3">
                                                    
                                                    <!-- Champ caché pour l'ID de l'article -->
                                                    <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>" />
                                                
                                                    <div class="mb-3">
                                                        <label for="comment" class="form-label">Votre commentaire</label>
                                                        <textarea name="comment" class="form-control" rows="4" placeholder="Écrivez votre commentaire ici" required></textarea>
                                                    </div>
                                                    
                                                    <div class='d-flex justify-content-center'>
                                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                                    </div>
                                                </form>

                                            <?php } else { ?>
                                                <!-- Message pour inviter l'utilisateur à se connecter -->
                                                <p>Veuillez vous <a href="index.php?page=connexion" class="text-primary hover-bold">connecter</a> pour ajouter un commentaire.</p>
                                            <?php } ?>


                                            <!-- Afficher les commentaires -->
                                            <h3>Commentaires :</h3>
                                            <div class="comments-section">
                                            <?php
                                            $reqComments = $bdd->prepare('SELECT comments.id, comments.content, comments.date_publication, user.pseudo
                                                                            FROM comments
                                                                            INNER JOIN user ON comments.user_id = user.id
                                                                            WHERE comments.article_id = ?
                                                                            ORDER BY comments.date_publication DESC');
                                            $reqComments->execute([$article['id']]);
                                            $comments = $reqComments->fetchAll();

                                            if (count($comments) > 0) {
                                                foreach ($comments as $comment) {
                                                    ?>
                                                    <div class="comment">
                                                        <p><strong><?php echo htmlspecialchars($comment['pseudo']); ?> :</strong></p>
                                                        <p><?php echo htmlspecialchars($comment['content']); ?></p>
                                                        <p><small><?php echo htmlspecialchars($comment['date_publication']); ?></small></p>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "<p>Aucun commentaire pour cet article.</p>";
                                            }
                                            ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#CarrouselBlog" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#CarrouselBlog" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            <?php } else { ?>
                <div class="alert alert-info" role="alert">
                    Aucun article disponible dans la section Blog pour le moment.
                </div>
            <?php } ?>
        </section>

        <!-- Projects Section -->
        <section id='projet'>
            <h3 class='my-5'>Projets</h3>
            <?php if (count($projetArticles) > 0) { ?>
                <div id="CarrouselProjet" class="carousel slide">
                    <div class="carousel-inner">
                        <?php foreach ($projetArticles as $index => $article) { ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="card mb-5">
                                    <?php if (!empty($article['image'])) { ?>
                                        <img src="<?php echo htmlspecialchars($article['image']); ?>" class="card-img-top img-height" alt="<?php echo htmlspecialchars($article['tittle']); ?>">
                                    <?php } ?>
                                    <div class="card-body-main p-3">
                                        <h5 class="card-title fs-4 mt-3"><?php echo htmlspecialchars($article['tittle']); ?></h5>
                                        <div class="d-flex justify-content-center align-items-start gap-5">
                                            <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#enSavoirPlusProjet<?php echo $article['id']; ?>">
                                                En savoir plus
                                            </button>

                                            <div class="modal fade" id="enSavoirPlusProjet<?php echo $article['id']; ?>" data-bs-backdrop="static">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content bg-primary text-black">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo htmlspecialchars($article['tittle']); ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body d-flex flex-column justify-content-center align-items-center p-5">
                                                            <?php if (!empty($article['image'])) { ?>
                                                                <img src="<?php echo htmlspecialchars($article['image']); ?>" class="card-img-mod" alt="<?php echo htmlspecialchars($article['tittle']); ?>">
                                                            <?php } ?>
                                                            <p><?php echo htmlspecialchars($article['content']); ?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProjet<?php echo $article['id']; ?>" aria-expanded="false" aria-controls="collapseProjet<?php echo $article['id']; ?>">
                                                Commentaires
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="collapse" id="collapseProjet<?php echo $article['id']; ?>">
                                                <!-- Formulaire de commentaire -->
                                                <?php if (isset($_SESSION['connect']) && $_SESSION['connect']) { ?>
                                                <form method="post" action="index.php" class="mb-3">
                                                    <!-- Champ caché pour l'ID de l'article -->
                                                    <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>" />
                                                    
                                                    <div class="mb-3">
                                                        <label for="comment" class="form-label">Votre commentaire</label>
                                                        <textarea name="comment" class="form-control" rows="4" placeholder="Écrivez votre commentaire ici" required></textarea>
                                                    </div>

                                                    <div class='d-flex justify-content-center'>
                                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                                    </div>
                                                </form>

                                            <?php } else { ?>
                                                <!-- Message pour inviter l'utilisateur à se connecter -->
                                                <p>Veuillez vous <a href="index.php?page=connexion" class="text-primary hover-bold">connecter</a> pour ajouter un commentaire.</p>
                                            <?php } ?>


                                            <!-- Afficher les commentaires -->
                                            <h3>Commentaires :</h3>
                                            <div class="comments-section">
                                            <?php
                                            $reqComments = $bdd->prepare('SELECT comments.id, comments.content, comments.date_publication, user.pseudo
                                                                            FROM comments
                                                                            INNER JOIN user ON comments.user_id = user.id
                                                                            WHERE comments.article_id = ?
                                                                            ORDER BY comments.date_publication DESC');
                                            $reqComments->execute([$article['id']]);
                                            $comments = $reqComments->fetchAll();

                                            if (count($comments) > 0) {
                                                foreach ($comments as $comment) {
                                                    ?>
                                                    <div class="comment">
                                                        <p><strong><?php echo htmlspecialchars($comment['pseudo']); ?> :</strong></p>
                                                        <p><?php echo htmlspecialchars($comment['content']); ?></p>
                                                        <p><small><?php echo htmlspecialchars($comment['date_publication']); ?></small></p>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "<p>Aucun commentaire pour cet article.</p>";
                                            }
                                            ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#CarrouselProjet" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#CarrouselProjet" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            <?php } else { ?>
                <div class="alert alert-info" role="alert">
                    Aucun article disponible dans la section Projet pour le moment.
                </div>
            <?php } ?>
        </section>
    </main>

</section>

<?php
    $content = ob_get_clean();

    require('base.php');
?>