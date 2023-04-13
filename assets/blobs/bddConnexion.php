<?php
 /* 
    This is a demo/exercice
    This file shouldn't be accessible on github on a true project.
    Password's weak
*/

define('USER', 'root');
define('PASSWRD', '');

try{
    //Chaine de connexion a la base de donnees
    $dsn = 'mysql:host=localhost;dbname=todolist;port=3306';
    
    // Options de connexion : encodage utf-8 pour mySQL
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
    
    // Création d'une instance de connexion à la BDD et ouverture de la connexion
    $pdo = new PDO($dsn, USER, PASSWRD, $options);
    
    // Choix de la méhode d'information en cas d'erreur - levé d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion effectuées avec le driver ' . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . '<br>';
} catch(PDOException $e) {
    $msg = 'ERREUR PDO dans ' .$e->getFile() . ' :<br>' . $e->getLine(). ' :<br> ' . $e->getMessage();
    die($msg);
}