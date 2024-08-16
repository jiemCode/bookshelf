<?php

require "services.php";


function register($username, $email, $password) {
    if (isValidUser($username)) {
        header('Location: pages/form_login.php?trigger=error&msg='.'Ce compte existe deja ! Conectez-vous !');
        return;
    }

    insererUtilisateur($username, $email, password_hash($password, PASSWORD_DEFAULT));

    if (isValidUser($username)) {
        header('Location: pages/form_login.php?trigger=success&msg='.'Inscription reussi ! Connectez-vous!');
    }

}

if (isset($_POST["nom"]) && isset($_POST["email"]) && isset($_POST["motdepasse"])) {
    $username = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["motdepasse"];
    
    register($username, $email, $password);
}
