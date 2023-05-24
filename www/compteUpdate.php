<?php
    require_once '../assets/blobs/session.php';

    if(isset($user) == false) {
        $_SESSION['alert'] = 'E: Unautorised access : user not connected !';
        header('Location: index.php');
        exit();
    }

    require_once '../utils/bddConnexion.php';
    function refetchUserData($pdo, $user) {
        $query = 'SELECT * FROM utilisateurs WHERE id = :id;' ;
        $prep = $pdo->prepare($query);
        $prep->bindParam(':id', $user['id']);
        $prep->execute();
        $arr = $prep->fetch();

        $arr['pseudonyme'] = $arr['pseudonyme']?$arr['pseudonyme']:$arr['identifiant'];
        $_SESSION['user'] = $arr;  
    }

    // Changer l'identifiant
    if (isset($_POST['change_identifiant'])) {
        if ( isset($_POST['change_identifiant']['new_identifiant']) && isset($_POST['change_identifiant']['pass']) ) {
            if( password_verify($_POST['change_identifiant']['pass'], $user['motDePasse']) ){
                $query = 'UPDATE utilisateurs SET identifiant = :newIdentifiant WHERE id = :id_util;' ;
                $prep = $pdo->prepare($query);
                $prep->bindParam(':id_util', $user['id']);
                $prep->bindParam(':newIdentifiant', $_POST['change_identifiant']['new_identifiant']);
                $prep->execute();
                $_SESSION['alert'] = 'S: change_identifiant: success';

                refetchUserData($pdo, $user);
            } else {
                $_SESSION['alert'] = 'E: change_identifiant: password incorrect';
            }
        } else {
            $_SESSION['alert'] = 'E: change_identifiant: form incomplete';
        }

    // Changer le mot de passe
    } elseif (isset($_POST['change_password'])) {  
        if ( isset($_POST['change_password']['new_password']) && isset($_POST['change_password']['new_passwor2']) && isset($_POST['change_password']['pass']) ) {
            if( password_verify($_POST['change_password']['pass'], $user['motDePasse']) ){
                if ( $_POST['change_password']['new_password'] === $_POST['change_password']['new_passwor2']) {
                    if ( strlen($_POST['change_password']['new_password']) < 8 === false ) {
                        $password = password_hash($_POST['change_password']['new_password'], PASSWORD_ARGON2ID);
                        
                        $query = 'UPDATE utilisateurs SET motDePasse = :motDePasse WHERE id = :id_util;' ;
                        $prep = $pdo->prepare($query);
                        $prep->bindParam(':id_util', $user['id']);
                        $prep->bindParam(':motDePasse', $password);
                        $prep->execute();
                        $_SESSION['alert'] = 'S: change_password: success';
    
                        refetchUserData($pdo, $user);                
                    } else {
                        $_SESSION['alert'] = 'E: change_password: new password can\'t be shorter than 8 caracters';
                    }
                } else {
                    $_SESSION['alert'] = 'E: change_password: new passwords are not the same';
                }
            } else {
                $_SESSION['alert'] = 'E: change_password: password incorrect';
            }
        } else {
            $_SESSION['alert'] = 'E: change_password: form incomplete';
        }

    // Changer l'adresse courriel
    } elseif (isset($_POST['change_courriel'])) {
        if ( isset($_POST['change_courriel']['new_courriel']) && isset($_POST['change_courriel']['new_courrie2']) && isset($_POST['change_courriel']['pass']) ) {
            if( password_verify($_POST['change_courriel']['pass'], $user['motDePasse']) ){
                if ( $_POST['change_courriel']['new_courriel'] === $_POST['change_courriel']['new_courrie2']) {
                    $query = 'UPDATE utilisateurs SET courriel = :newCourriel WHERE id = :id_util;' ;
                    $prep = $pdo->prepare($query);
                    $prep->bindParam(':id_util', $user['id']);
                    $prep->bindParam(':newCourriel', $_POST['change_courriel']['new_courriel']);
                    $prep->execute();
                    $_SESSION['alert'] = 'S: change_courriel: success';

                    refetchUserData($pdo, $user);

                } else {
                    $_SESSION['alert'] = 'E: change_courriel: new courriels are not the same';
                }
            } else {
                $_SESSION['alert'] = 'E: change_identifiant: password incorrect';
            }
        } else {
            $_SESSION['alert'] = 'E: change_identifiant: form incomplete';
        }

    // Changer le mot du pseudonyme
    } elseif (isset($_POST['change_pseudonyme'])) {
        if ( isset($_POST['change_pseudonyme']['new_pseudonyme'])) {
            $query = 'UPDATE utilisateurs SET pseudonyme = :newPseudonyme WHERE id = :id_util;' ;
            $prep = $pdo->prepare($query);
            $prep->bindParam(':id_util', $user['id']);
            $prep->bindParam(':newPseudonyme', $_POST['change_pseudonyme']['new_pseudonyme']);
            $prep->execute();
            $_SESSION['alert'] = 'S: change_pseudonyme: success';

            refetchUserData($pdo, $user);
        } else {
            $_SESSION['alert'] = 'E: change_pseudonyme form incomplete';
        }
    
    // Suppression du compte
    } elseif (isset($_POST['delete_account'])) {
        if ( isset($_POST['delete_account']['identifiant']) && isset($_POST['delete_account']['pass']) ) {
            if ( $_POST['delete_account']['identifiant'] == $user['identifiant']) {
                if( password_verify($_POST['delete_account']['pass'], $user['motDePasse']) ) {

                    $query = 'DELETE FROM liste_items WHERE id_utilisateur = :id_util;' ;
                    $prep = $pdo->prepare($query);
                    $prep->bindParam(':id_util', $user['id']);
                    $prep->execute();
                    $query = 'DELETE FROM utilisateurs WHERE id = :id_util;' ;
                    $prep = $pdo->prepare($query);
                    $prep->bindParam(':id_util', $user['id']);
                    $prep->execute();
                    $_SESSION['alert'] = 'S: delete_account: success';

                    unset($_SESSION['user']);
                } else {
                    $_SESSION['alert'] = 'E: delete_account: password incorrect';
                }
            } else {
                $_SESSION['alert'] = 'E: delete_account: identifiant incorrect';
            }
        } else {
            $_SESSION['alert'] = 'E: delete_account: form incomplete';
        }
    } else {
        $_SESSION['alert'] = ' Es un gran bro momento...<br> No data sent to compteUpdate or accessed directly via the url';
    }
    

    header('Location: compte.php');