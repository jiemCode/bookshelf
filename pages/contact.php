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
        require '../services.php';
        ?>

        <div class="container">
            <div class="nav">
                <nav>
                    <button class="btn-nav">
                        <a href="../index.php">Acceuil</a>
                    </button>
                    ·
                    <button class="btn-nav active-page">
                        <a href="#">Contact</a>
                    </button>
                </nav>
                <div class="buttons">
                    <a href="form_login.php"><button class="btn-login">Se connecter</button></a>
                    ↔
                    <a href="form_register.php"><button class="btn-register">S'inscrire</button></a>
                </div>
            </div>
            <div class="header">
                <span id="logo">
                    <a href="#">BookShelf</a>
                </span>
                <div class="action-buttons-bar">
                    <a href="collection.php">
                        <button>Créer une collection</button>
                    </a>
                </div>
            </div>
            <main>
                <h1>Support client disponible <span>24H/24</span></h1>
            </main>
            <div class="description">
                
                <div>
                    <ul>
                        <li><small><span class="icon-check">📬</span> support@bookshelf.sn</small></li>
                        <li><small><span class="icon-check">📱</span> +33 827 45 45</small></li>
                        <li><small><span class="icon-check">🏢</span> Diamniadio BP 24404</small></li>
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

