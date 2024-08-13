<?php

require "services.php";


function authentifier($login, $password) {
    if (!isValidUser($login)) {
        echo "
            <script>
                alert('Vous n'etes pas autorise !');
                window.location = '/pages/form_login.php'
            </script>
        ";
        return ;
    }

    if (password_verify($password, getPassword($login))) {
        // 
        session_start();
        $_SESSION['username'] = $login;
        $_SESSION['user_id'] = getUserId($login);
        $_SESSION['collection_id'] = getCollectionId($_SESSION['user_id']);
        header('Location: pages/collection.php?username='.$login);
        echo "
            <script>
                alert('Vous n'etes pas autorise !');
                window.location = '/pages/form_login.php?username=$login'
            </script>
        ";
        
    } else {
        echo "
            <script>
                alert('Login ou mot de passe incorrects !');
                window.location = '/pages/form_login.php?username=$login'
            </script>
        ";
    }
}

if (isset($_POST["nom"]) && isset($_POST["motdepasse"])) {
    $username = $_POST["nom"];
    $password = $_POST["motdepasse"];
    
    authentifier($username, $password);
}
