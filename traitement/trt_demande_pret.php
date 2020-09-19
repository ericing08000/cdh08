<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------------------*/
//Traitement - Demande de prêt
/*----------------------------------*/
$id = $_GET['id'];
$url = $_GET['url'];
$req_recyclerie = $bdd->prepare("SELECT * FROM user WHERE ID_User = '$id' ");
$req_recyclerie -> execute();
$data_recyclerie = $req_recyclerie ->fetch();

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$designation_materiel = htmlspecialchars(!empty($_POST['designation_materiel']) ? $_POST['designation_materiel'] : NULL, ENT_QUOTES);


$dateDebut = htmlspecialchars(!empty($_POST['dateDebut']) ? $_POST['dateDebut'] : NULL, ENT_QUOTES);
$dateFin = htmlspecialchars(!empty($_POST['dateFin']) ? $_POST['dateFin'] : NULL, ENT_QUOTES);

setlocale (LC_TIME, 'fr_FR.utf8','fra');
$dateDebut = strtotime($_POST['dateDebut']);
$date_Debut = strftime("%d/%m/%Y", $dateDebut);
$dateFin = strtotime($_POST['dateFin']);
$date_Fin = strftime("%d/%m/%Y", $dateFin);

// echo 'Désignation du matériel : '.$designation_materiel;
// echo '<br>';
// echo 'Date de début : '.$date_Debut;
// echo '<br>';
// echo 'Date de fin : '.$date_Fin;
// echo '<br>';
// echo 'Identifiant N°'.$id;
// echo '<br>';
// echo 'Pseudo : '.$data_recyclerie['pseudoUser'];
// echo '<br>';
// echo 'Nom et prénom : '.$data_recyclerie['nomUser'].' '.$data_recyclerie['prenomUser'];
// echo '<br>';
// echo 'email : '.$data_recyclerie['emailUser'];
// echo '<br>';
// echo $_GET['url'];
// echo '<br>';

$pseudo = $data_recyclerie['pseudoUser'];
$nomComplet = $data_recyclerie['nomUser'].' '.$data_recyclerie['prenomUser'];
$tel = $data_recyclerie['telUser'];
$email = $data_recyclerie['emailUser'];


$dateDebut = strtotime($dateDebut);
strtotime($dateFin);
//Envoyer le message par mail
$mailTo = "aristo08000@gmail.com";
$sujetContact = 'Demande de prêt';
$messageContact = "Bonjour,
Veuillez trouver ci-dessous ma demande pour :

Désignation du matériel : $designation_materiel 
Date de début : $date_Debut
Date de fin : $date_Fin
Pseudo : $pseudo
Nom et prénom : $nomComplet
Tel : $tel
email : $email

Merci d'avance";

mail($mailTo, $sujetContact,  $messageContact);

// On revient sur la page
$success= '?success=2';
header("Location: http://$url$success");



?>