<?php
session_start();

if(isset($_SESSION['validation'])){
    $validation = $_SESSION['validation'];
    unset($_SESSION['validation']);
} else {
    header('Location: index.php');
}


if($validation === 'inscription'){
    if(isset($_POST)){
        $identifiant =  htmlspecialchars(isset($_POST['identifiant'])?$_POST['identifiant']:null);
        $motDePasse = htmlspecialchars(isset($_POST['motDePasse'])?$_POST['motDePasse']:null);
        $motDePasseVerif = htmlspecialchars(isset($_POST['motDePasseVerif'])?$_POST['motDePasseVerif']:null);
        $courriel = htmlspecialchars(isset($_POST['courriel'])?$_POST['courriel']:null);
        $pseudonyme = htmlspecialchars(isset($_POST['pseudonyme'])?$_POST['pseudonyme']:null);

        if($identifiant === null || $motDePasse === null || $motDePasseVerif === null || $courriel === null){
            header('Location: inscription.php');
        }
    }
}