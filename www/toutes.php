<?php require_once '../assets/blobs/session.php' ?>
<?php
    if(isset($user) == false) {
        $_SESSION['alert'] = 'E : Unautorised access : user not connected !';
        header('Location: index.php');
        exit();
    }

    $_SESSION['page'] = 'toutes';
?>
<?php require_once '../assets/blobs/headMetas.php' ?>
    <title>Todolist - Toutes vos tâches</title>
    <meta name="description" content="Creez votre ToDoList avec ce merveilleux site internet.">
</head>
<body>
<?php require_once '../assets/blobs/header.php' ?>
<?php require_once '../utils/alert.php' ?>

    <main>
        <h1>Bonjour, ceci est la page qui affiche toutes les tâches</h1>
        <p>Voici toutes vos tâches enregistrées :</p>
<?php
        require_once '../utils/bddConnexion.php';

        $query = 'SELECT id, intitule, etat_valide, date_creation FROM liste_items WHERE id_utilisateur = :id_util ORDER BY date_creation DESC;' ;
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
<?php   endif;?>

<?php require '../assets/blobs/todoitem/ajouter.php' ?>
    </main>
    
<?php require_once '../assets/blobs/footer.php' ?>
</body>
</html>