<?php

require('model/homeModel.php');
require('model/loginModel.php');
require('model/registerModel.php');
require('model/createModel.php');

function home() {
    list($blogArticles, $projetArticles, $bdd) = getHome();

    require('view/homeView.php'); // Passer les articles à la vue
}

function login() {
    $requete = getLogin();

    require('view/loginView.php');
}

function register() {
    $requete = getRegister();

    require('view/registerView.php');
}

function create() {
    $requete = getCreate();

    require('view/createView.php');
}