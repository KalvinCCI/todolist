<?php
session_start();

if(isset($_SESSION['validation'])){
    $validation = $_SESSION['validation'];
    unset($_SESSION['validation']);
} else {
    header('Location: index.php');
}

require_once '../utils/bddConnexion.php';

if($validation === 'inscription'){
    if(isset($_POST)){
        $identifiant =  isset($_POST['identifiant'])?htmlspecialchars($_POST['identifiant']):null;
        $motDePasse = isset($_POST['motDePasse'])?htmlspecialchars($_POST['motDePasse']):null;
        $motDePasseVerif = isset($_POST['motDePasseVerif'])?htmlspecialchars($_POST['motDePasseVerif']):null;
        $courriel = isset($_POST['courriel'])?htmlspecialchars($_POST['courriel']):null;
        $pseudonyme = isset($_POST['pseudonyme'])?htmlspecialchars($_POST['pseudonyme']):null;

        var_dump($identifiant, $motDePasse, $motDePasseVerif, $courriel, $pseudonyme);

        if($identifiant == null || $motDePasse == null || $motDePasseVerif == null || $courriel == null){
            $alert = 'Form not valid : Required informations not filled in.';
            //header('Location: inscription.php');
        } elseif($motDePasse !== $motDePasseVerif){
            $alert = 'Form not valid : Passwords are not the same.';
        } else {
            $query = 'INSERT INTO utilisateurs (identifiant, motDePasse, courriel, pseudonyme) VALUES (:identifiant, :motDePasse, :courriel, :pseudonyme);' ;
            $prep = $pdo->prepare($query);
            $prep->bindParam(':identifiant', $identifiant);
            $prep->bindParam(':motDePasse', $motDePasse);
            $prep->bindParam(':courriel', $courriel);
            $prep->bindParam(':pseudonyme', $pseudonyme);
            $prep->execute();
            $arrAll = $prep->fetchAll();

            $alert = 'Form valid : inscription completed !';
        }

        if(isset($alert)){
            echo '<b>'.$alert.'</b>';
        }

        echo "<p>$identifiant | $motDePasse | $motDePasseVerif | $courriel | $pseudonyme</p>";

        

    }
}