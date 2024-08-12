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
    $action = "update";
} else {
    $action = "insert";
}

echo $livre;
echo $action;
echo $livre_id;

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
                    <button class="btn-nav active-page">
                        <a href="../index.php">Acceuil</a>
                    </button>
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
                <span id="logo">
                    <a href="collection.php">BookShelf</a>
                </span>
                
                <div class="page-title">
                    <a class="btn-back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                        🢨
                    </a>
                    <h3>Enregistrer un prêt</h3>
                </div>
            </div>
            
            <main id="content">
                <?php
                $user_collection = getPretUtilisateur($_SESSION['user_id']);
                $_count = count($user_collection);
                ?>
                
                <form action="../upload_file.php?action=<?php echo $action; ?>&livre_id=<?php echo $livre_id; ?>" method="post" class="add-book" enctype="multipart/form-data">
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
                                <label for="">Personne</label>
                                <input type="text" name="hostname" id="" required value="<?php echo isset($livre['auteur']) ? $livre['auteur'] : ""; ?>">
                            </div>
                            
                            <div class="input-block">
                                <label for="">Livre</label>
                                <select name="livre_id" id="" required>
                                
                                    <option value="" selected ><?php echo isset($livre['genre']) ? $livre['genre'] : ""; ?></option>
                                    
                                    <?php
                                    foreach ($user_collection as $key => $item) {
                                    ?>
                                    <option value="">
                                        <?php echo $item["titre"] ;?>
                                    </option>
                                    <?php }?>
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