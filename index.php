<?php

    session_start();

    require('controller/controller.php');
    
    try {
        if(isset($_GET['page'])) {

            if($_GET['page'] == 'accueil') {
                home();
            }
            else if($_GET['page'] == 'connexion') {
                login();
            }
            else if($_GET['page'] == 'inscription') {
                register();
            }
            else if($_GET['page'] == 'créer un article') {
                create();
            }
            else {
                throw new Exception("Cette page n'existe pas ou a été supprimée.");
            }

        }
        else {
            home();
        }
    }
    catch(Exception $e) {
        $error = $e->getMessage();
        require('view/errorView.php');
    }