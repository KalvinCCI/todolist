<!-- HEADER start -->
    <header>
        <p>Ceci est le header</p>
        <ul>
            <li><a href="index.php">Accueil</a></li>
<?php if(isset($user)):?>
            <li><a href="compte.php">Compte : <b><?=$user['pseudonyme']?></b></a></li>
            <li><a href="toutes.php">Toutes vos tâches</a></li>
            <li><?php require '../assets/blobs/todoitem/ajouter.php' ?></li>
            <li><a href="deconnexion.php">Se déconnecter</a></li>
<?php else: ?>
            <li><a href="connexion.php">Se connecter</a></li>
            <li><a href="inscription.php">S'inscrire</a></li>
<?php endif ?>
        </ul>
    </header>
<!-- HEADER end -->
