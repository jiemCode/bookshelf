<?php

require "services.php";


function authentifier($login, $password) {
    if (!isValidUser($login)) {
        return ;
    }

    if (password_verify($password, getPassword($login))) {
        // 
        session_start();
        $_SESSION['username'] = $login;
        header('Location: pages/collection.php?username='.$login);
        
    } else {
        echo "<h1>You n'etes pa autorise ! &#128078 </h1>";
        // 
        echo "<h2><a href='pages/form_login.php?username=".$login."'>Retry</a></h2>";
    }
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    authentifier($username, $password);
    echo "Hi, ".$_SESSION["username"];
}
