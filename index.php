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
        <link rel="stylesheet" href="static/css/popup.css" />
    </head>
    <body>

        <?php
        require 'services.php';

        session_start();


        $username = $_SESSION["username"];

        ?>

        <div class="container">
            <div class="nav">
                <nav>
                    <button class="btn-nav active-page">
                        <a href="">Acceuil</a>
                    </button>
                    ·
                    <button class="btn-nav">
                        <a href="pages/contact.php">Contact</a>
                    </button>
                </nav>
                <div class="buttons">
                <?php
                if (isset($_SESSION["username"])) {
                ?>
                    <!-- <a href="logout.php"><button class="btn-register">Deconnexion</button></a> -->
                    <div class="user-container">
                        <div class="username"><?php echo $username; ?></div>
                        <a href="logout.php" class="logout-btn">Déconnexion</a>
                    </div>
                <?php
                } else {
                ?>
                    <a href="pages/form_login.php"><button class="btn-login">Se connecter</button></a>
                    ↔
                    <a href="pages/form_register.php"><button class="btn-register">S'inscrire</button></a>
                <?php
                } 
                ?>
                </div>
            </div>

            <!-- <div id="header-block"> -->
                <div class="header" id="header">
                    <span id="logo">
                        <a href="#">BookShelf</a>
                    </span>
                    <div class="action-buttons-bar">
                        <a href="pages/collection.php">
                            <button>
                            <?php
                            if (isset($_SESSION["username"])) {
                            ?>
                                Voir ma collection
                            <?php
                            } else {
                            ?>
                                Créer une collection
                            <?php
                            } 
                            ?>
                            </button>
                        </a>
                    </div>
                </div>
            <!-- </div> -->

            <main>
                <img src="static/image/illustration.png" alt="bookshef-image">
                <h1>Chaque livre a une histoire, collectionnez-les toutes sur <span>BookShelf</span></h1>
            </main>
            <div class="description">
                <div class="why">
                    <h2 class="title">Pourquoi BookShelf ?</h2>
                </div>
                <div>
                    <ul>
                        <li><small><span class="icon-check">🔎</span> Gardez une Trace de Votre Collection de Livres</small></li>
                        <li><small><span class="icon-check">🤞</span> Votre Bibliothèque Personnelle à Portée de Main</small></li>
                        <li><small><span class="icon-check">💯</span> Découvrez une experience unique de la bibliophilie</small></li>
                    </ul>
                </div>
            </div>
        </div>

        <footer>
            &copy 2024 - Tous droits réservés
        </footer>

                
        <script src="/static/js/script.js" async defer></script>
    </body>
</html>

