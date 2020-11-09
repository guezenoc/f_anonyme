<?php

require_once "class_singleton.php";
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");

class Reponses {
//extends Messages 

    // Attributs de la class
    public $id;
    public $titre;
    public $message;
    public $date;
    public $id_reponse;
    private $ip_user;
  
    // Fonction __construct
    public function __construct($id, $titre, $message, $date, $IP_user, $ID_reponse)
    {
        $this->id_reponse=$id_reponse;
    }
  
    // On modifie la fonction constructeur
    public static function construit_reponse($id, $titre, $message, $date, $ip_user, $id_reponse) {
      // On fait appel au constructeur
      $reponse = new Reponse($id, $titre, $message, $date, $ip_user, $id_reponse);
      $reponse->date = new DateTime($date);
    }

    //On envoie les réponses
  //$requete_reponse = "SELECT message.id, titre, message, date, message.ip_user, message.ip_reponse FROM message WHERE message.ip_reponse = ?";
  }

