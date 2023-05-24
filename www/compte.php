<?php require_once '../assets/blobs/session.php' ?>
<?php
    if(isset($user) == false) {
        $_SESSION['alert'] = 'E: Unautorised access : user not connected !';
        header('Location: index.php');
        exit();
    }
?>
<?php require_once '../assets/blobs/headMetas.php' ?>
    <title>Mon compte - Accueil</title>
    <meta name="description" content="Creez votre ToDoList avec ce merveilleux site internet.">
</head>
<body>
<?php require_once '../assets/blobs/header.php' ?>
<?php require_once '../utils/alert.php' ?>

    <main>
        <h1>Ceci est la page de compte</h1>
        <ul>
            <li>numero de compte : <?= $user['id'] ?></li>
            <li>identifiant de connexion : <?= $user['identifiant'] ?></li>
            <li>courriel : <?= $user['courriel'] ?></li>
            <li>pseudonyme : <?= $user['pseudonyme'] ?></li>
        </ul>
        <h2>Modification des informations du compte</h2>
        <ul>
            <li><button onclick="change_identifiant.showModal()">Modifier l'identifiant de connexion</button></li>
            <li><button onclick="change_password.showModal()">Modifier le mot de passe</button></li>
            <li><button onclick="change_courriel.showModal()">Modifier l'adresse de courriel</button></li>
            <li><button onclick="change_pseudonyme.showModal()">Modifier le pseudonyme</button></li>
        </ul>
        <dialog id="change_identifiant">
            <h1>Changer d'identifiant</h1>
            <form action="compteUpdate.php" method="POST">
                <label for="change_identifiant_input">Nouvel identifiant :</label>
                <input  id="change_identifiant_input" type="text" name="change_identifiant[new_identifiant]" required>
                <label for="change_identifiant_pswrd">Mot de passe :</label>
                <input  id="change_identifiant_pswrd" type="password" name="change_identifiant[pass]" required>
                <button type="submit">Confirmer</button>
            </form>
                <button>Annuler</button>
        </dialog>
        <dialog id="change_password">
            <h1>Changer de mot de passe</h1>
            <form action="compteUpdate.php" method="POST">
                <label for="change_password_input">Nouveau mot de passe :</label>
                <input  id="change_password_input" type="password" name="change_password[new_password]" required>
                <label for="change_password_inpu2">Nouveau mot de passe :</label>
                <input  id="change_password_inpu2" type="password" name="change_password[new_passwor2]" required>
                <label for="change_password_pswrd">Mot de passe :</label>
                <input  id="change_password_pswrd" type="password" name="change_password[pass]" required>
                <button type="submit">Confirmer</button>
            </form>
            <button>Annuler</button>
        </dialog>
        <dialog id="change_courriel">
            <h1>Changer d'adresse de courriel</h1>
            <form action="compteUpdate.php" method="POST">
                <label for="change_courriel_input">Nouvelle adresse courriel :</label>
                <input  id="change_courriel_input" type="text" name="change_courriel[new_courriel]" required>
                <label for="change_courriel_inpu2">Confirmer l'adresse courriel :</label>
                <input  id="change_courriel_inpu2" type="text" name="change_courriel[new_courrie2]" required>
                <label for="change_courriel_pswrd">Mot de passe :</label>
                <input  id="change_courriel_pswrd" type="password" name="change_courriel[pass]" required>
                <button type="submit">Confirmer</button>
            </form>
                <button>Annuler</button>
        </dialog>
        <dialog id="change_pseudonyme">
            <h1>Changer de pseudonyme</h1>
            <form action="compteUpdate.php" method="POST">
                <label for="change_pseudonyme_input">Nouveau pseudonyme :</label>
                <input  id="change_pseudonyme_input" type="text" name="change_pseudonyme[new_pseudonyme]">
                <button type="submit">Confirmer</button>
            </form>
                <button>Annuler</button>
        </dialog>
    </main>

<?php require_once '../assets/blobs/footer.php' ?>
</body>
</html>