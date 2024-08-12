<?php

require '../services.php';

session_start();

$username = $_SESSION["username"];
echo 'User '.$username;
if (isset($username)) {
    // 
} else {
    header("Location: form_login.php");
}

if (isset($_GET["book"])) {
    $livre_id = $_GET["book"];
    $livre = getLivreUtilisateur($_SESSION["user_id"], $livre_id);
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
                    <button class="btn-nav">
                        <a href="../index.php">Acceuil</a>
                    </button>
                    ·
                    <button class="btn-nav">
                        <a href="contact.php">Contact</a>
                    </button>
                </nav>
                <div class="buttons">
                    <!-- <button class="btn-login">Se connecter</button>
                    ↔ -->
                    <a href="../logout.php"><button class="btn-register"> 
                        Deconnexion</button></a>
                </div>
            </div>
            <div class="header">
                <span id="logo">
                    <a href="collection.php">BookShelf</a>
                </span>
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
                    <a class="btn-back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                        🢨
                    </a>
                    <h3>Details du livre</h3>
                </div>
            </div>
            
            <main id="content">
                
                <form action="../upload_file.php" method="post" class="add-book" enctype="multipart/form-data">
                    <div class="form-add-book">

                        <div class="book-img">
                            <img id="image-output" src="
                            <?php echo isset($livre['location']) ? $livre['location'] : '/static/image/no_cover.png';?>"
                            alt="" srcset="">
                        </div>
                        <div class="book-labels">
                            <div class="input-block">
                                <h2 class="label-hint">
                                    <?php
                                    echo $livre["titre"];
                                    ?>
                                </h2>
                            </div>                        
                            <div class="input-block">
                                <small>De </small>
                                <h4 class="label-hint">
                                <?php
                                    echo $livre["auteur"];
                                    ?>
                                </h4>
                            </div>
                            <div class="input-block">
                                <Small>Annee de publication</Small>
                                <h4 class="label-hint">
                                <?php
                                    echo $livre["annee"];
                                    ?>
                                </h4>
                            </div>
                            <div class="input-block">
                                <small>Genre</small>
                                <h4 class="label-hint">
                                <?php
                                    echo $livre["genre"];
                                    ?>
                                </h4>
                            </div>
                            <div class="input-block">
                                <small>Statut</small>
                                <h4 class="label-hint">
                                <?php
                                    echo $livre["status"];
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="add-book-btn">
                        <button class="btn"><a href="../deleteBook.php?book=<?php echo $livre_id; ?>&filename=<?php echo $livre['location']; ?>">Supprimer</a></button>
                        <button class="btn"><a href="form_addBook.php?action=update&book=<?php echo $livre_id; ?>">Modifier</a></button>
                    </div>
                    
                </form>

            </main>
        </div>

        <script src="/static/js/script.js" async defer></script>
    </body>
</html>