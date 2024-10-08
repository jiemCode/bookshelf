<?php

require "services.php";

session_start();


function addBook($titre, $author, $year, $genre, $collection_id, $filename) {
    insererLivre(titre: $titre, auteur: $author, annee: $year, genre: $genre, collection_id: $collection_id, filename: $filename);
}

function updateBook($livre_id, $titre, $author, $year, $genre, $filename) {
    modifierLivre(idLivre: $livre_id, nouveauTitre: $titre, nouvelAuteur: $author, nouvelleAnnee: $year, nouveauGenre: $genre, nouvelleLocation: $filename);
}

function processFile($target_dir, $target_file) {
    echo 'Myfiles-'.$_FILES["fileToUpload"]["name"];

    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create the directory with write permissions
    }
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    
    return $uploadOk;
}

function saveFile($target_file): bool {
    return move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

$collection_id = $_SESSION["collection_id"];
$timeString = date("YmdHis");

$target_dir = SITE_ROOT."/uploads/".$collection_id;
$target_file = $target_dir . '/' . $timeString . '_' . basename($_FILES["fileToUpload"]["name"]);



if (isset($_GET["action"]) && $_GET["action"] === "update") {
    $livre_id = $_GET["livre_id"];
    $action = $_GET["action"];
}

if (isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] !== '') {
    $filename = "/uploads/" . $collection_id . '/' . $timeString . '_' . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = processFile($target_dir, $target_file);
    if ($uploadOk == 1) {
        saveFile($target_file);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    $filename = $_GET["filename"];
}

$title = $_POST["title"];
$author = $_POST["author"];
$year = $_POST["year"];
$genre = $_POST["genre"];
$_FILES["fileToUpload"] = $_FILES["fileToUpload"];

echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

if ($action === "update") {
    updateBook(livre_id: $livre_id, titre: $title, author: $author, year: $year, genre: $genre, filename: $filename);
    header("Location: pages/collection.php");
} else {
    addBook(titre: $title, author: $author, year: $year, genre: $genre, collection_id: $collection_id, filename: $filename);
    header("Location: pages/collection.php?trigger=success&msg='".$title.'\' ajoute a la collection !');
}
