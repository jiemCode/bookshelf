<?php

session_start();
session_unset();
session_destroy();

echo "Logout user ".$_SESSION["username"];
header("Location: /");