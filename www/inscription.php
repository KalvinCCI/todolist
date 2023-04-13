<?php
    session_start();

    $_SESSION['validation']='inscription';
?>
<?php require_once '../assets/blobs/headMetas.php' ?>
    <title>Todolist - Inscription</title>
    <meta name="description" content="Inscrivez vous dès maintenant !">
</head>
<body>
<?php require_once '../assets/blobs/header.php' ?>

    <main>
        <h1>Inscription</h1>
        <form action="validation.php" method="post">
            <label for="identifiant">Identifiant de connexion</label>
            <input  id="identifiant" name="identifiant" type="text" required>

            <label for="motDePasse">Mot de passe (8 caractères minimum)</label>
            <input  id="motDePasse" name="motDePasse" type="password" required minlength="8" autocomplete="new-password">

            <label for="motDePasseVerif">Validez votre mot de passe</label>
            <input  id="motDePasseVerif" name="motDePasseVerif" type="password" required minlength="8" autocomplete="new-password">

            <label for="courriel">Adresse mail de contact</label>
            <input  id="courriel" name="courriel" type="email" required>

            <label for="pseudonyme">Pseudonyme (Optionnel)</label>
            <input  id="pseudonyme" name="pseudonyme" type="text">

            <button type="submit">S'inscrire</button>
        </form>
    </main>

<?php require_once '../assets/blobs/footer.php' ?>
</body>
</html>