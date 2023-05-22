<?php require_once '../assets/blobs/session.php' ?>
<?php

require_once '../utils/bddConnexion.php';

if(isset($_POST['form'])&&$_POST['form']==='connexion'){
    $identifiant =  isset($_POST['identifiant'])?htmlspecialchars($_POST['identifiant']):null;
    $motDePasse = isset($_POST['motDePasse'])?($_POST['motDePasse']):null;

    //var_dump($identifiant, $motDePasse, $motDePasseVerif, $courriel, $pseudonyme);

    if($identifiant == null || $motDePasse == null){
        $alert = 'E: Form not valid : Required informations not filled in.';
        //header('Location: inscription.php');
    } else {
        $query = 'SELECT * FROM utilisateurs WHERE identifiant = :identifiant;' ;
        $prep = $pdo->prepare($query);
        $prep->bindParam(':identifiant', $identifiant);
        $prep->execute();
        $arr = $prep->fetch();

        if ($arr != null && password_verify($motDePasse, $arr['motDePasse'])) {
            $alert = 'S: Form valid : connection completed !';
            $valid = true;
            $arr['pseudonyme'] = $arr['pseudonyme']?$arr['pseudonyme']:$arr['identifiant'];
            $_SESSION['user'] = $arr;      
        } else {
            $alert = 'E: Form invalid : username or password incorrect !';
        }
        
    }

    if(isset($alert)){
        $_SESSION['alert'] = $alert;
    }

    if(isset($valid)&&$valid===true){
        header('Location: index.php');
        exit();
    } else {
        header('Location: connexion.php');
        exit();
    }

}

?>
<?php require_once '../assets/blobs/headMetas.php' ?>
    <title>Todolist - Connexion</title>
    <meta name="description" content="Creez votre ToDoList avec ce merveilleux site internet.">
</head>
<body>
<?php require_once '../assets/blobs/header.php' ?>
<?php require_once '../utils/alert.php' ?>

    <main>
        <h1>Connexion</h1>
        <form action="#" method="post">
            <input name="form" type="hidden" value="connexion">
            <label for="identifiant">Identifiant de connexion</label>
            <input  id="identifiant" name="identifiant" type="text" required>

            <label for="motDePasse">Mot de passe (8 caractères minimum)</label>
            <input  id="motDePasse" name="motDePasse" type="password" required minlength="8" autocomplete="new-password">

            <button type="submit">Se connecter</button>
        </form>
    </main>

<?php require_once '../assets/blobs/footer.php' ?>
</body>
</html>