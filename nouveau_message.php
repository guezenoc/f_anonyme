<?php

session_start();

require_once "class_singleton.php";
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");

// declaration des variables
$contenu ="";
$titre="";
$ip_user = $_SERVER['REMOTE_ADDR'];

if (!empty($_POST)) {
    if (isset($_POST['titre'])) {
        $titre = htmlspecialchars(trim(addslashes($_POST['titre'])));
    }
    if (isset($_POST['contenu'])) {
        $contenu = htmlspecialchars(trim(addslashes($_POST['contenu'])));
    }
}

//insert le message dans la base de données
$requete ="INSERT INTO messages (titre, contenu, ip_user) VALUES ('$titre', '$contenu', '$ip_user')";
$stmt= $lien_bdd->connexion->prepare($requete);
$stmt->execute();
$stmt->close();
//fin de l'insertion 





  