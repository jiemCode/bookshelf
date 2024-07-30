<?php

require "services.php";


function register($username, $email, $password) {
    if (isValidUser($username)) {
        echo "User already exists. Please ";
        echo "<h2><a href='pages/form_login.php?username=".$username."'>Sign In</a></h2>";
        return ;
    }

    insererUtilisateur($username, $email, password_hash($password, PASSWORD_DEFAULT));

    if (isValidUser($username)) {
        echo "Registration succesfull";
        return ;
    }

}

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    register($username, $email, $password);
}
