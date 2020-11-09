<?php
//connnexion bdd
require_once "class_singleton.php";
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");

// Import de la class reponse
require_once "class_reponse.php";

class Message {

  // Attributs de la class
  public $id;
  public $titre;
  public $contenu;
  public $date;
  public $ip_user;

  // Fonction __construct
  public function __construct($id, $titre, $contenu, $date, $ip_user)
  {
    $this->id = $id;
		$this->titre = $titre;
		$this->contenu = $contenu;
		$this->date = new dateTime();
		$this->ip_user = $ip_user;
  }

  // On modifie la fonction constructeur
  public static function construit_message($id, $titre, $contenu, $date, $ip_user) {
    // On fait appel au constructeur
    $message = new Message($id, $titre, $contenu, $date, $ip_user);
    $message->date = new dateTime($date);
    return $message;
  }

  // requete Envoie des messages


  /* RECUPERATION DES REPONSES */
  // Methode getReponses()
  public function getReponses() {
  
  // On déclare un tableau vide
  $reponses = array();

  //On récupère les réponses
  $requeteMessage = "SELECT message.id, titre, contenu, date, message.ip_user, message.ip_reponse FROM message WHERE message.ip_reponse = ?";
  // Preparation de la requete
  $stmt = $db->connexion->prepare($requeteMessage);
  // On bind le paramètre ID
  $stmt->bind_param("i", self::$id);
  // On éxécute la requête d'insertion
  $stmt->execute();
  // On bind les resulats
  $stmt->bind_result($id, $titre, $contenu, $date, $statut, $ip_user, $ip_reponse);
  // On fetch le résultat
  while($stmt->fetch()) {
    // On enregistre chaque réponse au message dans un nouvel objet réponse via la méthode construit_reponse
    $reponses[] = Reponse::construit_reponse($id, $titre, $contenu, $date, $statut, $ip_user, $id_reponse);
  }
  // On renvoie les résultats avec le json_encode
  echo json_encode($reponses);
  // On clos le statement
  $stmt->close();

  }

}
