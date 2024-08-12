<?php

// require "services.php";

// session_start();


// function addBook($titre, $author, $year, $genre, $collection_id, $filename) {
//     insererLivre(titre: $titre, auteur: $author, annee: $year, genre: $genre, status: "disponible", collection_id: $collection_id, file: $filename);
// }

// if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["year"]) && isset($_POST["genre"]) && isset($_FILES["fileToUpload"])) {
//     $title = $_POST["title"];
//     $author = $_POST["author"];
//     $year = $_POST["year"];
//     $genre = $_POST["genre"];
//     $collection_id = $_SESSION["collection_id"];
//     $file = $_FILES["fileToUpload"];
    
//     addBook($title, $author, $year, $genre, $collection_id, $file);
//     echo 'File uploaded : '.$_FILES["fileToUpload"]["name"];
//     // header("Location: pages/collection.php");
// }