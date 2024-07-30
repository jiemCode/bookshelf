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

        <?php
        require 'services.php';
        ?>

        <div class="container">
            <div class="nav">
                <nav>
                    <button class="btn-nav active-page">Acceuil</button>
                    ·
                    <button class="btn-nav">Contact</button>
                </nav>
                <div class="buttons">
                    <a href="pages/form_login.php"><button class="btn-login">Se connecter</button></a>
                    ↔
                    <a href="pages/form_register.php"><button class="btn-register">S'inscrire</button></a>
                </div>
            </div>
            <div class="header">
                <span id="logo">BookShelf</span>
                <div class="action-buttons-bar">
                    <a href="pages/collection.html">
                        <button> <div> +</div>Créer une collection</button>
                    </a>
                </div>
            </div>
            <main>
                <img src="static/image/illustration.jpg" alt="bookshef-image">
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

