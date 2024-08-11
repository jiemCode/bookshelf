<?php

require "services.php";

session_start();


function addBook($titre, $author, $year, $genre, $collection_id) {
    insererLivre(titre: $titre, auteur: $author, annee: $year, genre: $genre, status: "disponible", collection_id: $collection_id);
}

if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["year"]) && isset($_POST["genre"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $genre = $_POST["genre"];
    $collection_id = $_SESSION["collection_id"];
    
    addBook($title, $author, $year, $genre, $collection_id);
    echo 'Collection Id: '.$collection_id;
    header("Location: pages/collection.php");
}
 