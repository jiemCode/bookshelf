<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../static/css/forms.css" />
</head>
<body>
  <div class="login_form">
    <!-- Login form container -->
    <form action="../login.php" method="post">
      <h3>Se connecter avec</h3>

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

      <!-- Login option separator -->
      <p class="separator">
        <span>ou</span>
      </p>

      <!-- Email input box -->
      <div class="input_box">
        <label for="nom">Nom d'utilisateur</label>
        <input type="text" name="nom" id="">
      </div>

      <!-- Paswwrod input box -->
      <div class="input_box">
        <div class="password_title">
          <label for="">Mot de passe</label>
          <a href="#">Mot de passe oublié?</a>
        </div>

        <input type="password" id="password" name="motdepasse" placeholder="Entrez votre mot de passe" required />
      </div>

       <!-- Login button -->
      <button type="submit">Log In</button>

      <p class="sign_up">Vous n'avez pas de compte? <a href="form_register.php">Inscrivez-vous!</a></p>
    </form>
  </div>
</body>
</html>