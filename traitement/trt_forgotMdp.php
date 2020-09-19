<?php 
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


$emailUser = htmlspecialchars(!empty($_POST['emailUser']) ? $_POST['emailUser'] : NULL, ENT_QUOTES);
echo $emailUser;
$search = $bdd->prepare("SELECT * FROM user WHERE emailUser = :emailUser");
$search-> execute(array(
    'emailUser' => $emailUser
));
$data_search = $search->fetch();
echo $data_search['ID_user'];
$id= $data_search['ID_user'];

$sujet = "Réinitailisation du mot de passe";

$corp = "Bonjour,
Veuillez trouver ci-joint un lien pour réinitailiser votre mot de passe :

http://localhost/cdh08/traitement/trt_reset_forgotMpd_form.php?id=$id ";

mail($emailUser, $sujet, $corp);

header('location:../index.php?success=3');
?>