<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


$emailUser = htmlspecialchars(!empty($_POST['emailUser']) ? $_POST['emailUser'] : NULL, ENT_QUOTES); 
//sleep(1);

//Permet de savoir si l'email existe dans la base de données
$search = $bdd->prepare("SELECT * FROM user WHERE emailUser = :emailUser");
$search-> execute(array(
    'emailUser' => $emailUser
));
//Compte le nombre de ligne dans la base de données
$count = $search->rowcount();

$connect = $search->fetch();

if($count>0){
    echo'ok';  
    
}
else{
    
    echo'false';
}
?>