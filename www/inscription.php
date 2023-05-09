<?php
if(session_status() === PHP_SESSION_NONE) session_start();

require_once '../utils/bddConnexion.php';

if(isset($_POST['form'])&&$_POST['form']==='inscription'){
    $identifiant =  isset($_POST['identifiant'])?htmlspecialchars($_POST['identifiant']):null;
    $motDePasse = isset($_POST['motDePasse'])?($_POST['motDePasse']):null;
    $motDePasseVerif = isset($_POST['motDePasseVerif'])?($_POST['motDePasseVerif']):null;
    $courriel = isset($_POST['courriel'])?htmlspecialchars($_POST['courriel']):null;
    $pseudonyme = isset($_POST['pseudonyme'])?htmlspecialchars($_POST['pseudonyme']):null;

    //var_dump($identifiant, $motDePasse, $motDePasseVerif, $courriel, $pseudonyme);

    if($identifiant == null || $motDePasse == null || $motDePasseVerif == null || $courriel == null){
        $alert = 'Form not valid : Required informations not filled in.';
        //header('Location: inscription.php');
    } elseif($motDePasse !== $motDePasseVerif){
        $alert = 'Form not valid : Passwords are not the same.';
    } else {
        $query = 'INSERT INTO utilisateurs (identifiant, motDePasse, courriel, pseudonyme) VALUES (:identifiant, :motDePasse, :courriel, :pseudonyme);' ;
        $motDePasse = password_hash($motDePasse, PASSWORD_ARGON2ID);
        $prep = $pdo->prepare($query);
        $prep->bindParam(':identifiant', $identifiant);
        $prep->bindParam(':motDePasse', $motDePasse);
        $prep->bindParam(':courriel', $courriel);
        $prep->bindParam(':pseudonyme', $pseudonyme);
        $prep->execute();
        $arrAll = $prep->fetchAll();

        $alert = 'Form valid : inscription completed !';
        $valid = true;
    }

    if(isset($alert)){
        $_SESSION['alert'] = $alert;
    }


    if(isset($valid)&&$valid===true){
        header('Location: connexion.php');
        exit();
    } else {
        header('Location: inscription.php');
        exit();
    }

}

?>
<?php require_once '../assets/blobs/headMetas.php' ?>
    <title>Todolist - Inscription</title>
    <meta name="description" content="Inscrivez vous dès maintenant !">
</head>
<body>
<?php require_once '../assets/blobs/header.php' ?>
<?php require_once '../utils/alert.php' ?>

    <main>
        <h1>Inscription</h1>
        <form action="#" method="post">
            <input name="form" type="hidden" value="inscription">
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