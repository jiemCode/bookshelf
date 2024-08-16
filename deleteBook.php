

<?php

require "services.php";

session_start();


function deleteBook($livre_id, $filename) {
    supprimerLivre($livre_id);
    if (file_exists($filename)) {
        echo "This file exist";
        unlink($filename);
    }
}

if (isset($_GET["book"])) {
    $livre_id = $_GET["book"];
    $filename = $_GET["filename"];
    deleteBook($livre_id, $filename);
    if (isset($_GET["next"]) && $_GET["next"] === "here") {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: pages/collection.php?trigger=error&msg= Livre supprime !");
    }
    
}