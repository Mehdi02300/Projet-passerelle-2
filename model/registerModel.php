<?php

function getRegister() {
    require_once('src/connexion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifiez si tous les champs sont remplis
        if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['pseudo'])) {
            header('location: index.php?page=inscription&error=1&message=Veuillez remplir tous les champs.');
            exit();
        }

        $email        = htmlspecialchars($_POST['email']);
        $password     = htmlspecialchars($_POST['password']);
        $passwordTwo  = htmlspecialchars($_POST['confirm_password']);
        $pseudo       = htmlspecialchars($_POST['pseudo']);
        
        // Vérifier si les mots de passe correspondent
        if ($password !== $passwordTwo) {
            header('location: index.php?page=inscription&error=1&message=Vos mots de passe ne sont pas identiques.');
            exit();
        }

        // Vérifier si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: index.php?page=inscription&error=1&message=Votre adresse email est invalide.');
            exit();
        }

        // Vérifier si l'email est déjà utilisé
        $req = $bdd->prepare('SELECT COUNT(*) AS numberEmail FROM user WHERE email = ?');
        $req->execute([$email]);
        $emailVerification = $req->fetch();
        if ($emailVerification['numberEmail'] != 0) {
            header('location: index.php?page=inscription&error=1&message=Adresse email déjà utilisée.');
            exit();
        }

        // Vérifier si le pseudo est déjà utilisé
        $req = $bdd->prepare('SELECT COUNT(*) AS numberPseudo FROM user WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $pseudoVerification = $req->fetch();
        if ($pseudoVerification['numberPseudo'] != 0) {
            header('location: index.php?page=inscription&error=1&message=Pseudo déjà utilisé.');
            exit();
        }

        // Ajout un nouvel utilisateur dans la BDD
        $req = $bdd->prepare('INSERT INTO user(email, password, pseudo, admin) VALUES(?, ?, ?, 0)');
        $req->execute([$email, $password, $pseudo]);

        // Récupérer l'ID de l'utilisateur pour la session
        $_SESSION['connect'] = true;
        $userId = $bdd->lastInsertId();
        $_SESSION['user_id'] = $userId;
        $_SESSION['pseudo'] = $pseudo; 

        // Redirection après l'inscription réussie
        header('location: index.php?page=accueil');
        exit();
    }
}