<?php

function getHome() {
    require_once('src/connexion.php');

    // Traitement du formulaire de commentaire
    if (!empty($_POST['comment']) && !empty($_POST['article_id'])) {
        $comment = htmlspecialchars($_POST['comment']);
        $article_id = intval($_POST['article_id']); 

        $user_id = intval($_SESSION['user_id']);

        try {
            // Vérifier si l'ID de l'utilisateur existe dans la table `user`
            $stmt = $bdd->prepare('SELECT COUNT(*) FROM user WHERE id = ?');
            $stmt->execute([$user_id]);
            $userExists = $stmt->fetchColumn();

            if ($userExists) {
                // Insérer le commentaire dans la base de données
                $stmt = $bdd->prepare('INSERT INTO comments (article_id, user_id, content, date_publication) VALUES (?, ?, ?, NOW())');
                $stmt->execute([$article_id, $user_id, $comment]);

                header('Location: index.php?success=1');
                exit();
            } else {
                echo 'Utilisateur non valide.';
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Récupérer les articles pour blog et projets
    $blogArticlesQuery = $bdd->query('SELECT * FROM articles WHERE type = "blog" ORDER BY date_publication DESC');
    $projetArticlesQuery = $bdd->query('SELECT * FROM articles WHERE type = "projet" ORDER BY date_publication DESC');

    $blogArticles = $blogArticlesQuery->fetchAll();
    $projetArticles = $projetArticlesQuery->fetchAll();

    return [$blogArticles, $projetArticles, $bdd];
}