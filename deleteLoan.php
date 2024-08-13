

<?php

require "services.php";

session_start();


function deleteLoan($loan_id, $livre_id) {
    supprimerPret($loan_id, $livre_id);
}

if (isset($_GET["loan"])) {
    $loan_id = $_GET["loan"];
    $livre_id = $_GET["book"];
    deleteLoan($loan_id, $livre_id);
    if (isset($_GET["next"]) && $_GET["next"] === "here") {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header("Location: pages/collection.php");
    }
    
}