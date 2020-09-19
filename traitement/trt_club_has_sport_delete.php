<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

//Récupérer l'ID_Club par la méthode GET et la mettre dans une variable
$thisclub = $_GET['id'];
//Récupérer l'ID_Sport par la méthode GET et la mettre dans une variable
$thissport = $_GET['sport'];

/*-------------------------------------*/
//Traitement - Supprimer club_has_sport
/*-------------------------------------*/

//Préparer la requête pour la suppression 
$bdd -> exec ("DELETE FROM sport_has_club WHERE ID_Club = '$thisclub' AND ID_Sport = '$thissport'");

//redirection vers le formulaire du club
header('location:trt_club_form.php?id='.$thisclub.'#table_sport');



?>