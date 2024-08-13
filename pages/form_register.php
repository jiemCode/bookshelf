<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription</title>
    <link rel="stylesheet" href="../static/css/forms.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <div class="login_form">
        <h1>Inscription</h1>
        </br>
        
        <!-- Options d'inscription -->
        <h3>S'inscrire avec</h3>

      <div class="login_option">
        <!-- Google button -->
        <div class="option">
          <a href="#">
            <img src="../static/image/googlelogo.jpg" alt="Google" />
            <span>Google</span>
          </a>
        </div>

        <!-- Apple button -->
        <div class="option">
          <a href="#">
            <img src="../static/image/applelogo.jpg" alt="Apple" />
            <span>Apple</span>
          </a>
        </div>
      </div>

      <p class="separator">
        <span>ou</span>
      </p>

        <!-- Formulaire d'inscription -->
        <form action="../register.php" method="post">
            <div class="input_box">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom">
            </div>
            <!-- <div class="input_box">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom">
            </div> -->
            <div class="input_box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre email">
            </div>
            <div class="input_box">
                <label for="motdepasse">Mot de passe</label>
                <input type="password" id="motdepasse" name="motdepasse" placeholder="Entrez votre mot de passe">
            </div>
            <div class="input_box">
                <label for="confirmation_motdepasse">Confirmez le mot de passe</label>
                <input type="password" id="confirmation_motdepasse" name="confirmation_motdepasse" placeholder="Confirmez votre mot de passe">
            </div>
            <button type="submit">S'inscrire</button>
            <p>Vous avez déjà un compte ? <a href="form_login.php">Connectez-vous!</a></p>
        </form>
    </div>
</body>
</html>

