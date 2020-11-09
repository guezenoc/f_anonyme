<?php

require_once "class_singleton.php";
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");
require_once "class_message.php";
require_once "class_reponse.php";

//declaration des variables 
$message= "";
$reponse="";
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
 
$reqrep= "SELECT $id, $titre, $contenu, $date, $ip_user, $id_reponse FROM messages WHERE id=?";
$stmt=$lien_bdd->connexion->prepare($reqrep);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($id, $titre, $contenu, $date, $ip_user, $id_reponse);
while ($stmt->fetch()) {
    $reponse= Reponse::construit_reponse($id, $titre, $contenu, $date, $ip_user, $id_reponse);
}
    
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        $(function(){
            //ENVOI les données sur le serveur sur la bdd
            $("#envoie").click(function()
            {
                console.log($("#votre_reponse").val());
                $.ajax({
                    url: "nouveau_message.php",
                    data: {
                        titre: $("#titre_message").val(),
                        contenu: $("#message").val()
                    },
                    method: "POST"
                })
                .done(function(){
                    console.log("c'est envoyé !");
                });
                $("#titre_message").val("");
                $("#message").val("");
            });
        })
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?= $message->date->date?></h2>
    <h3><?= $message->titre?></h3>
    <h4><?= $message->contenu?></h4>

    <ul>
        <li></li>
    </ul>

    <form action="POST">
        <textarea name="votre_reponse" id="votre_reponse" cols="30" rows="10"></textarea>
        <input type="submit" id="envoie" value="envoie">
    </form>
    
        
</body>
</html>