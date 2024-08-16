<?php

require "services.php";


function authentifier($login, $password) {
    if (!isValidUser($login)) {
        header('Location: pages/form_login.php?trigger=error&msg='.'Vous n\'etes pas autorise !');
        return ;
    }

    if (password_verify($password, getPassword($login))) {
        // 
        session_start();
        $_SESSION['username'] = $login;
        $_SESSION['user_id'] = getUserId($login);
        $_SESSION['collection_id'] = getCollectionId($_SESSION['user_id']);
        header('Location: pages/collection.php?username='.$login.'&trigger=success&msg='.'Bienvenue '.$login.' !');
        
    } else {
        header('Location: pages/form_login.php?trigger=error&msg='.'Login ou mot de passe incorrects !');
    }
}

if (isset($_POST["nom"]) && isset($_POST["motdepasse"])) {
    $username = $_POST["nom"];
    $password = $_POST["motdepasse"];
    
    authentifier($username, $password);
}
