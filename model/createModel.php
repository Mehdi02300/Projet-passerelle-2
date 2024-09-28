<?php

    function getCreate() {
        
        require_once('src/connexion.php');

        // Vérifie si l'utilisateur est admin
        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Récupère les données du formulaire
                $tittle = htmlspecialchars($_POST['tittle']); // Utilisation de 'tittle'
                $content = htmlspecialchars($_POST['content']);
                $type = htmlspecialchars($_POST['type']);
                $date_publication = date('Y-m-d');
                $image = '';

                // Gestion de l'upload de l'image
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image = 'images/' . basename($_FILES['image']['name']);
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $image) === false) {
                        echo 'Erreur lors de l\'upload de l\'image.';
                        exit();
                    }
                }

                // Prépare et exécute la requête d'insertion
                $stmt = $bdd->prepare("INSERT INTO articles (tittle, content, date_publication, image, type) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$tittle, $content, $date_publication, $image, $type]);

                // Redirection après l'ajout
                header('Location: index.php?success=1');
                exit();
            }
        } else {
            // Redirection si l'utilisateur n'est pas admin
            header('Location: index.php?error=1');
            exit();
        }
    }