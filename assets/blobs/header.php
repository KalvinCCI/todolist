<?php
    if(session_status() === PHP_SESSION_NONE) session_start();

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }
?>
<!-- HEADER start -->
    <header>
        <p>Ceci est le header</p>
<?php if(isset($user)):?>
        <p><?=$user['pseudonyme']?$user['pseudonyme']:$user['identifiant']?></p>
        <p><a href="deconnexion.php">Se déconnecter</a></p>
<?php else: ?>
        <p><a href="connexion.php">Se connecter</a><p>
        <p><a href="inscription.php">S'inscrire</a><p>
<?php endif ?>
    </header>
<!-- HEADER end -->
