<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------------------*/
//Traitement - S'inscrire
/*----------------------------------*/
//On récupère l'url du formulaire : include\sinscrire.php
$url = $_GET['url'];

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$pseudoUser = htmlspecialchars(!empty($_POST['pseudoUser']) ? $_POST['pseudoUser'] : NULL, ENT_QUOTES);
$nomUser = htmlspecialchars(!empty($_POST['nomUser']) ? $_POST['nomUser'] : NULL, ENT_QUOTES);
$prenomUser = htmlspecialchars(!empty($_POST['prenomUser']) ? $_POST['prenomUser'] : NULL, ENT_QUOTES);
$telUser = htmlspecialchars(!empty($_POST['telUser']) ? $_POST['telUser'] : NULL, ENT_QUOTES);
$emailUser = htmlspecialchars(!empty($_POST['emailUser']) ? $_POST['emailUser'] : NULL, ENT_QUOTES);
$mdpUser = htmlspecialchars(!empty($_POST['mdpUser']) ? $_POST['mdpUser'] : NULL, ENT_QUOTES);
$confirme_mdpUser = htmlspecialchars(!empty($_POST['confirme_mdpUser']) ? $_POST['confirme_mdpUser'] : NULL, ENT_QUOTES);
//$ID_typeCompte = !empty($_POST['ID_typeCompte']) ? $_POST['ID_typeCompte'] : NULL;

// echo $url;
// echo $pseudoUser;
// echo $nomUser;
// echo $prenomUser;
// echo $telUser;
// echo $emailUser;
// echo $mdpUser;
// echo $confirme_mdpUser;

//On prépare la requête dans une variable «$sql»: 
$sql = $bdd->prepare ("INSERT INTO user (pseudoUser, prenomUser, nomUser, ID_typeCompte, telUser, emailUser, mdpUser )
VALUES ( :pseudoUser, :prenomUser, :nomUser, :ID_typeCompte, :telUser, :emailUser, :mdpUser)");

$password = password_hash($_POST['mdpUser'], PASSWORD_BCRYPT);

// On éxecute la requête «$sql»:
$sql->execute(array(
    'pseudoUser' => $pseudoUser,
    'prenomUser' => $prenomUser,
    'nomUser' => $nomUser,
    'ID_typeCompte' => 3,
    'telUser' => $telUser,
    'emailUser' => $emailUser,
    'mdpUser' => $password
));

// On revient sur la page
$success = '?success=1';
header("Location: http://$url$success");

