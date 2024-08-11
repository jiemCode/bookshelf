<?php
// require '../services.php';

session_start();

$username = $_SESSION["username"];
echo 'User '.$username;
if (isset($username)) {
    // 
} else {
    header("Location: form_login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/static/css/style.css">
    </head>
    <body>

        <div class="container">
            <div class="nav">
                <nav>
                    <button class="btn-nav active-page">Acceuil</button>
                    ·
                    <button class="btn-nav">Contact</button>
                </nav>
                <div class="buttons">
                    <!-- <button class="btn-login">Se connecter</button>
                    ↔ -->
                    <a href="../logout.php"><button class="btn-register"> 
                        Deconnexion</button></a>
                </div>
            </div>
            <div class="header">
                <span id="logo">BookShelf</span>
                <!-- <div class="action-buttons-bar">
                    <a href="form_addBook.php">
                        <button> <span class="action-buttons-icon"> 📝</span> <span class="action-buttons-text">Ajouter un livre </span></button>
                    </a>
                    <a href="#">
                        <button> <span class="action-buttons-icon"> 🔍</span> <span class="action-buttons-text">Rechercher un livre </span></button>
                    </a>
                    <a href="#">
                        <button> <span class="action-buttons-icon"> ↗️</span> <span class="action-buttons-text">Preter un livre </span></button>
                    </a>
                </div> -->
                <div class="page-title">
                    <h3>Informations du livre</h3>
                    <!-- <small> - </small> -->
                </div>
            </div>
            
            <main id="content">
                
                <form action="../addBook.php" method="post" class="add-book">
                    <div class="form-add-book">

                        <div class="book-img">
                            
                            <div id="displayImg">
                                <img id="image-output" src="/static/image/no_cover.png" alt="" srcset="">
                            </div>
                            <input type="file" name="" id="cover-img" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" value="Add" style="display: none;">
                            <label for="cover-img"> + Ajouter une image</label>
                        </div>
                        <div class="book-labels">
                            <div class="input-block">
                                <label for="">Titre</label>
                                <input type="text" name="title" id="" required>
                            </div>                        
                            <div class="input-block">
                                <label for="">Auteur</label>
                                <input type="text" name="author" id="" required>
                            </div>
                            <div class="input-block">
                                <label for="">Annee</label>
                                <input type="number" min="1200" name="year" id="" required>
                            </div>
                            <div class="input-block">
                                <label for="">Genre</label>
                                <select name="genre" id="" required>
                                    <option value="">Autres</option>
                                    <option value="">Roman</option>
                                    <option value="">Essai</option>
                                    <option value="">Theatre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="add-book-btn">
                        <input type="reset" value="Reset">
                        <input type="submit" value="Enregistrer">
                    </div>
                </form>

            </main>
        </div>

        <script src="/static/js/script.js" async defer></script>
    </body>
</html>