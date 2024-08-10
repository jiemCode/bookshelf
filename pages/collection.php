<?php

require '../services.php';

session_start();

$username = $_SESSION["username"];
echo 'User '.$username;
if (!isset($username)) {
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

        <!-- <div id="myPopup" class="popup">
            <div class="popup-content">
                <h2>Ajouter un livre</h2>
                <form action="../addBook.php" method="post">
                    <div class="">
                        <label for="">Titre</label>
                        <input type="text" name="title" id="" required>
                    </div>
                    <div class="">
                        <label for="">Auteur</label>
                        <input type="text" name="author" id="" required>
                    </div>
                    <div class="">
                        <label for="">Annee de publication</label>
                        <input type="number" min="0" minlength="4" maxlength="4" value="" name="year" id="" required>
                    </div>
                    <div class="">
                        
                        <label for="">Genre</label>
                        <select name="genre" id="" required>
                            <option value=""></option>
                            <option value="">Essai</option>
                            <option value="">Theatre</option>
                            <option value="">Roman</option>
                            <option value="">Poesie</option>
                        </select>
                        <label for="">Couverture</label>
                        <input type="file" name="" id="">
                    </div>

                    <div class="bottom-buttons">
                        <button id="closePopup">
                            Annuler
                        </button>
                        <button id="closePopup">
                            <input type="submit" value="Ajouter">
                        </button>
                    </div>
                </form>
            </div>
        </div> -->

        
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
                <div class="action-buttons-bar">
                    <!-- <a href="form_addBook.php"> -->
                    <a href="form_addBook.php">
                        <button id="myButtons"> <span class="action-buttons-icon"> 📝</span> <span class="action-buttons-text">Ajouter un livre </span></button>
                    </a>
                    <a href="search.php">
                        <button> <span class="action-buttons-icon"> 🔍</span> <span class="action-buttons-text">Rechercher un livre </span></button>
                    </a>
                    <a href="#">
                        <button> <span class="action-buttons-icon"> ↗️</span> <span class="action-buttons-text">Preter un livre </span></button>
                    </a>
                </div>
                <div class="page-title">
                    <h3>Ma collection </h3>
                    <small> - 27 oeuvres</small>
                </div>
            </div>
            
            

            <main id="content-void">
                <img src="../static/image/illustration.jpg" alt="bookshef-image">
                <h1>Votre collection est vide 🙄. Commencer par <span>ajouter un livre</span></h1>
            </main>
            <main id="content">

            <?php
            foreach (getLivresUtilisateur($_SESSION['user_id']) as $key => $item) {
            ?>

                <div class="item">
                    <div class="img-frame">
                        <img class="item-img" src="../static/image/illustration.jpg" alt="bookshef-image">
                    </div>
                    <div class="item-bottom">
                        <span class="item-title">
                            <?php echo $item["titre"] ?>
                        </span>
                        <span class="item-author">
                            <?php echo $item["auteur"] ?>
                        </span>
                    </div>
                </div>

            <?php
            }
            ?>
                

                <div class="item">
                    <div class="img-frame">
                        <img class="item-img" src="../static/image/illustration.jpg" alt="bookshef-image">
                    </div>
                    <div class="item-bottom">
                        <span class="item-title">
                            Les misérables
                        </span>
                        <span class="item-author">
                            Victor Hugo
                        </span>
                    </div>
                </div>
                
                
                <div class="item">
                    <div class="img-frame">
                        <img class="item-img" src="../static/image/illustration.jpg" alt="bookshef-image">
                    </div>
                    <div class="item-bottom">
                        <span class="item-title">
                            Les misérables
                        </span>
                        <span class="item-author">
                            Victor Hugo
                        </span>
                    </div>
                </div>


                <div class="item">
                    <div class="img-frame">
                        <img class="item-img" src="../static/image/illustration.jpg" alt="bookshef-image">
                    </div>
                    <div class="item-bottom">
                        <span class="item-title">
                            Les misérables
                        </span>
                        <span class="item-author">
                            Victor Hugo
                        </span>
                    </div>
                </div>

                <div class="item">
                    <!-- <img class="item-img" src="../static/image/illustration.jpg" alt="bookshef-image"> -->
                    <div class="img-frame">
                        <!-- <img alt="crypto" src="https://source.unsplash.com/random/?Cryptocurrency&1"> -->
                    </div>
                    <div class="item-bottom">
                        <span class="item-title">
                            Les misérables esd rtfgyuhijok
                        </span>
                        <span class="item-author">
                            Victor Hugo
                        </span>
                    </div>
                </div>


                <div class="item">
                    <div class="img-frame">
                        <img class="item-img" src="../static/image/illustration.jpg" alt="bookshef-image">
                    </div>
                    <div class="item-bottom">
                        <span class="item-title">
                            Les misérables
                        </span>
                        <span class="item-author">
                            Victor Hugo
                        </span>
                    </div>
                </div>


            </main>
        </div>

        <script src="/static/js/script.js" async defer></script>
    </body>
</html>