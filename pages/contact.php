<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Contact</title>
    <link rel="stylesheet" href="../static/css/forms.css"> 
</head>
<body>
    <div id="btn-back">
        <a class="btn-back" href="collection.php">
            🢨
        </a>
    </div>
    <div class="login_form">
        <h3>Contactez-nous</h3>
        
        <!-- Formulaire de contact -->
        <form action="../processcontact.php" method="post">
            <div class="input_box">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom">
            </div>
            <div class="input_box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre email">
            </div>
            <div class="input_box">
                <label for="sujet">Sujet</label>
                <input type="text" id="objet" name="objet" placeholder="Entrez le sujet de votre message">
            </div>
            <div class="input_box">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Écrivez votre message"></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>
