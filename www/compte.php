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
            <li>id : <?= $user['id'] ?></li>
            <li>identifiant de connexion : <?= $user['identifiant'] ?></li>
            <li>courriel : <?= $user['courriel'] ?></li>
            <li>pseudonyme : <?= $user['pseudonyme'] ?></li>
        </ul>
    </main>

<?php require_once '../assets/blobs/footer.php' ?>
</body>
</html>