<?php 
    require_once '../assets/blobs/session.php';

    if( isset($_SESSION['user'])) {
        require_once '../utils/bddConnexion.php';
        $id_util = $_SESSION['user']['id'];
        
        // Ajout d'un todo
        if(isset($_POST['add']['intitule'])){
            $intitule = htmlspecialchars($_POST['add']['intitule']);

            $query = 'INSERT INTO liste_items (id_utilisateur, intitule) VALUES (:id_util, :intitule);';
            $prep = $pdo->prepare($query);
            $prep->bindParam(':id_util', $id_util);
            $prep->bindParam(':intitule', $intitule);
            $prep->execute();

            $_SESSION['alert'] = "S: ToDo added successfully !";
        } else

        // Modification d'un todo
        if(isset($_POST['update']['todoid'])) {
            $todoid = $_POST['update']['todoid'];

            $query = 'UPDATE liste_items SET etat_valide = NOT etat_valide WHERE id = :id_item AND id_utilisateur = :id_util;';
            $prep = $pdo->prepare($query);
            $prep->bindParam(':id_util', $id_util);
            $prep->bindParam(':id_item', $todoid);
            $prep->execute();

            $_SESSION['alert'] = "S: ToDo updated successfully !";

        } else

        // Suppression d'un todo
        if(isset($_POST['delete']['todoid'])) {
            $todoid = $_POST['delete']['todoid'];

            $query = 'DELETE FROM liste_items WHERE id = :id_item AND id_utilisateur = :id_util;';
            $prep = $pdo->prepare($query);
            $prep->bindParam(':id_util', $id_util);
            $prep->bindParam(':id_item', $todoid);
            $prep->execute();

            $_SESSION['alert'] = "S: ToDo deleted successfully !";
        }

    } else
    if( isset($_SESSION['user']) == false) {
        $_SESSION['alert'] = 'E: ToDo : user not connected';
    } else
    if( isset($_POST['intitule']) == false) {
        $_SESSION['alert'] = 'E: ToDo : intitule not filled';
    }

    if($_SESSION['page'] == 'toutes') {
        $_SESSION['page'] == null;
        header('Location: toutes.php');
        exit();
    } else {
        $_SESSION['page'] == null;
    }
    header('Location: index.php');
    exit();


?>