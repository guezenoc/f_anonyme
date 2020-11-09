<?php

session_start();

//connexion bdd
require_once "class_singleton.php"
$lien_bdd = db_connect::construit("localhost","root","","f_anonyme");

