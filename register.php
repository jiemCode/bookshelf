<?php

require "services.php";


function register($username, $email, $password) {
    if (isValidUser($username)) {
        echo "
            <script>
                alert('Ce compte existe deja ! Conectez-vous');
                window.location = '/pages/form_login.php?username=$username'
            </script>
        ";
    }

    insererUtilisateur($username, $email, password_hash($password, PASSWORD_DEFAULT));

    if (isValidUser($username)) {
        echo "
            <script>
                alert('Inscription reussi ! Conectez-vous');
                window.location = '/pages/form_login.php?username=$username'
            </script>
        ";
        return ;
    }

}

if (isset($_POST["nom"]) && isset($_POST["email"]) && isset($_POST["motdepasse"])) {
    $username = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["motdepasse"];
    
    register($username, $email, $password);
}
