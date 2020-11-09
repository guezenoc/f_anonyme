<?php

require_once "class_singleton.php";
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");
require_once "class_message.php";
//declaration des variables 
$messages= array();

// on lance une requete
$requete= "SELECT id, titre, contenu, date, ip_user FROM messages";
$stmt=$lien_bdd->connexion->prepare($requete);
$stmt->execute();
$stmt->bind_result($id, $titre, $contenu,  $date, $ip_user);

while ($stmt->fetch()) {
    //$messages[]= array('id'=>$id, 'titre'=>$titre, 'date'=>$date, 'ip_user'=> $ip_user);
    $messages[]= Message::construit_message($id,$titre,$contenu, $date, $ip_user);
}
print_r($messages);
//on trransforme le tableau en json encode
echo json_encode($messages);

$stmt->close();
