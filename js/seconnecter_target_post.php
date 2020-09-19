<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


$pseudo_signup = htmlspecialchars($_POST['pseudo_signup'], ENT_QUOTES);  
$mdp_signup = htmlspecialchars($_POST['mdp_signup'], ENT_QUOTES);
// echo $pseudo_signup;
// echo $mdp_signup;
//sleep(1);

// Permet de savoir si pseudo existe dans la base de données
$search = $bdd->prepare("SELECT * FROM user WHERE pseudoUser = :pseudoUser");
$search-> execute(array(
    'pseudoUser' => $pseudo_signup
    
));


//Compte le nombre de ligne dans la base de données
$count = $search->rowcount();

$testmdp = $search->fetch();
//echo($testmdp['mdpUser']);

$thismdp = password_verify($mdp_signup, $testmdp['mdpUser']);
// echo '<br>';
// echo $count;
// echo '<br>';
// echo $thismdp;
if($count>0 && $thismdp == 1){
    echo 'ok'; 
    session_start();
    $_SESSION['id'] = $testmdp['ID_user'];
    $_SESSION['pseudoUser'] = $testmdp['pseudoUser'];
    $_SESSION['type'] = $testmdp['ID_typeCompte'];
    $_SESSION['prenomUser'] = $testmdp['prenomUser'];

}else{
    
    echo 'false';

}

?>