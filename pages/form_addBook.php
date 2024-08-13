<?php

require '../services.php';

session_start();

$username = $_SESSION["username"];
if (isset($username)) {
    // 
} else {
    header("Location: form_login.php");
}

if (isset($_GET["book"])) {
    $livre_id = $_GET["book"];
    $livre = getLivreUtilisateur($_SESSION["user_id"], $livre_id);
    $action = "update";
} else {
    $action = "insert";
}

// echo $livre;
// echo $action;
// echo $livre_id;

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
        <link rel="stylesheet" href="/static/css/user_log.css">
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
                <div class="user-container">
                    <div class="username"><?php echo $username; ?></div>
                    <a href="../logout.php" class="logout-btn">Déconnexion</a>
                </div>
            </div>
            <div class="header">
                <span id="logo">
                    <a href="collection.php">BookShelf</a>
                </span>

                <div class="page-title">
                    <a class="btn-back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                        🢨
                    </a>
                    <h3>Ajouter un livre</h3>
                </div>
            </div>
            
            <main id="content">
                
                <form action="../upload_file.php?action=<?php echo $action; ?>&livre_id=<?php echo $livre_id; ?>&filename=<?php echo $livre["location"]; ?>" method="post" class="add-book" enctype="multipart/form-data">
                    <div class="form-add-book">

                        <div class="book-img">
                            
                            <div id="displayImg">
                                <img id="image-output" src="
                                <?php echo isset($livre['location']) ? $livre['location'] : '/static/image/no_cover.png';?>
                                " alt="" srcset="">
                            </div>
                            <input type="file" name="fileToUpload" id="fileToUpload" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" value="Add" style="display: none;">
                            <label for="fileToUpload"> + Ajouter une image</label>
                        </div>
                        <div class="book-labels">
                            <div class="input-block">
                                <label for="">Titre</label>
                                <input type="text" name="title" id="" required value="<?php echo isset($livre['titre']) ? $livre['titre'] : ""; ?>">
                            </div>                        
                            <div class="input-block">
                                <label for="">Auteur</label>
                                <input type="text" name="author" id="" required value="<?php echo isset($livre['auteur']) ? $livre['auteur'] : ""; ?>">
                            </div>
                            <div class="input-block">
                                <label for="">Année</label>
                                <input type="number" min="1200" name="year" id="" required value="<?php echo isset($livre['annee']) ? $livre['annee'] : ""; ?>">
                            </div>
                            <div class="input-block">
                                <label for="">Genre</label>
                                <select name="genre" id="" required>
                                    <?php $default_genre = isset($livre['genre']) ? $livre['genre'] : "Autres"; ?>
                                    <option selected value="<?php echo $default_genre; ?>"><?php echo $default_genre; ?></option>
                                    <option value="Roman">Roman</option>
                                    <option value="Essai">Essai</option>
                                    <option value="Theatre">Theatre</option>
                                    <option value="SF">SF</option>
                                    <option value="Autres">Autres</option>
                                </select>
                            </div>
                            <!-- <div class="input-block">
                                <label for="">Statut</label>
                                <select name="status" id="" required 
                                <?php
                                if ($action === "update") {
                                    ?>
                                     disabled
                                 <?php
                                }
                                 ?>
                                >
                                    <?php $default_status = isset($livre['status']) ? $livre['status'] : "Disponible"; ?>
                                    <option selected value="<?php echo $default_status; ?>"><?php echo $default_status; ?></option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Prêté">Prêté</option>
                                </select>
                            </div> -->
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