<?php 

require "services.php";

session_start();


function addLoan($user_id, $livre_id, $nom) {
    insererPret($user_id, $livre_id, $nom);
}

$user_id = $_SESSION["user_id"];
$livre_id = $_POST["livre_id"];

if (isset($_GET["action"]) && $_GET["action"] === "update") {
    $loan = getPretUtilisateur($user_id, $loan_id);
    $action = $_GET["action"];
} else {
    $name = $_POST["name"];
    echo $name;
}

addLoan($user_id, $livre_id, $name, $date);
header("Location: /pages/loans.php");
