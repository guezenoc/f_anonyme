<?php

require_once "class_singleton.php";
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");
require_once "class_message.php";

//declaration des variables 
$message= "";
if (isset($_GET["id"])) {
    $id=$_GET["id"];
    

// on lance une requete
$requete= "SELECT id, titre, contenu, date, ip_user FROM messages where id like ?";
$stmt=$lien_bdd->connexion->prepare($requete);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($id, $titre, $contenu,  $date, $ip_user);

$stmt->fetch();
    //$messages[]= array('id'=>$id, 'titre'=>$titre, 'date'=>$date, 'ip_user'=> $ip_user);
    $message= Message::construit_message($id,$titre,$contenu, $date, $ip_user);
    

    

//print_r($messages);
//on trransforme le tableau en json encode
//echo json_encode($messages);

$stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?= $message->date->date?></h2>
    <h3><?= $message->titre?></h3>
    <h4><?= $message->contenu?></h4>
    
        
</body>
</html>