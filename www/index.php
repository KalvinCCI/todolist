<?php require_once '../assets/blobs/session.php' ?>
<?php require_once '../assets/blobs/headMetas.php' ?>
    <title>Todolist - Accueil</title>
    <meta name="description" content="Creez votre ToDoList avec ce merveilleux site internet.">
</head>
<body>
<?php require_once '../assets/blobs/header.php' ?>
<?php require_once '../utils/alert.php' ?>

    <main>
        <h1>Bonjour, ceci est la page d'accueil</h1>
<?php
    if (isset($user)):
        ////////Si un utilisateur est connecté////////
?>
        <p>Bonjour <?=$user['pseudonyme']?>, voici vos 5 dernière tâches saisies :</p>

<?php
        require_once '../utils/bddConnexion.php';

        $query = 'SELECT id, intitule, etat_valide, date_creation FROM liste_items WHERE id_utilisateur = :id_util ORDER BY date_creation DESC LIMIT 5;' ;
        $prep = $pdo->prepare($query);
        $prep->bindParam(':id_util', $user['id']);
        $prep->execute();
        $arr = $prep->fetchAll();
        unset($pdo);

        
        if ( sizeof($arr) > 0):
?>
        <ul>
<?php       
            foreach ($arr as $todoitem):
                require '../assets/blobs/todoitem/affichage.php';            
            endforeach;
?>
        </ul>
<?php 
        endif;
?>
        <?php require '../assets/blobs/todoitem/ajouter.php' ?>
<?php
    else:
        ////////Si l'utilisateur n'est pas connecté////////
?>
        <p>Veuillez vous inscrire ou vous connecter !</p>

<?php
    endif;
        ////////////////////////////////////////////////////
?>
    </main>

<?php require_once '../assets/blobs/footer.php' ?>
</body>
</html>