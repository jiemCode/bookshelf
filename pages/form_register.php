<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Bookshelf</title>
</head>
<body>
    <form action="../register.php" method="post">
        <label for="">Nom d'utilisateur</label>
        <input type="text" name="username" id="" value="<?php  echo $_GET['username']?>">
        <label for="">Email</label>
        <input type="email" name="email" id="" value="">
        <label for="">Mot de passe</label>
        <input type="password" name="password" id="">
        <input type="submit" value="Soumettre">
    </form>

    <span>Already have an account ? <a href="form_login.php">Sign in here</a></span>
    
</body>
</html>