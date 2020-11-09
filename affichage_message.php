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
//print_r($messages);
//on trransforme le tableau en json encode
//echo json_encode($messages);

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>affichage des messages</h2>
    <table>
        <tr>
            <td>date</td>
            <td>titre</td>
            <td>contenu</td>
            <td></td>
        </tr>
        <?php
        
        for ($i=0; $i < count($messages) ; $i++) {  
        
        ?>
        <tr>
            <td><?=$messages[$i]->date->format("Y-m-d")?></td>
            <td><?=$messages[$i]->titre?></td>
            <td><?=nl2br($messages[$i]->contenu)?></td>
            <td><a href="affichage_message.php?id=<?=$messages[$i]->id?>">repondre au message</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
