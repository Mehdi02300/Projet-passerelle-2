<?php

    function getLogin() {


        require_once('src/connexion.php');

        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
            // Variables
            $pseudo     = htmlspecialchars($_POST['pseudo']);
            $password   = htmlspecialchars($_POST['password']);
    
            // Vérifier si le pseudo existe
            $req = $bdd->prepare('SELECT * FROM user WHERE pseudo = ?');
            $req->execute([$pseudo]);
            $user = $req->fetch();
    
            // Vérifier si l'utilisateur existe et vérifier le mot de passe
            if ($user && $password === $user['password']) {
                // Mot de passe correct, stocker les informations de l'utilisateur dans la session
                $_SESSION['connect'] = 1;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email']   = $user['email'];
                $_SESSION['pseudo']  = $user['pseudo'];
                $_SESSION['admin']   = $user['admin'] ?? false;
    
                // Redirection après connexion réussie
                header('Location: index.php?page=accueil&success=1');
                exit();
            } else {
                // Pseudo ou mot de passe invalide
                header('Location: index.php?page=connexion&error=1');
                exit();
            }
        }

    }