<?php

require "services.php";


function addBook($titre, $author, $year, $genre) {
    insererLivre(titre: $titre, auteur: $author, annee: $year, genre: $genre, status: "disponible");
}

if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["year"]) && isset($_POST["genre"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];
    $genre = $_POST["genre"];
    echo $genre;
    
    // addBook($title, $author, $year, $genre);
    header("Location : pages/collection.php?genre=".$genre);
}
 