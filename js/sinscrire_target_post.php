<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


$pseudoUser = htmlspecialchars($_POST['pseudoUser'], ENT_QUOTES);  
$emailUser = htmlspecialchars($_POST['emailUser'], ENT_QUOTES);  
$mdpUser = htmlspecialchars($_POST['mdpUser'], ENT_QUOTES);
$mdpUser_confirme = htmlspecialchars($_POST['mdpUser_confirme'], ENT_QUOTES);

//sleep(1);

//Permet de savoir si pseudo existe dans la base de données
$search = $bdd->prepare("SELECT * FROM user WHERE pseudoUser = :pseudoUser");
$search-> execute(array(
    'pseudoUser' => $pseudoUser  
));
//Compte le nombre de ligne dans la base de données
$count = $search->rowcount();

$connect = $search->fetch();

if($count>0){
    echo'pseudo_existe';

}else{
    //Permet de savoir si pseudo existe dans la base de données
    $search_email = $bdd->prepare("SELECT * FROM user WHERE emailUser = :emailUser");
    $search_email-> execute(array(
        'emailUser' => $emailUser
        
    ));
    //Compte le nombre de ligne dans la base de données
    $count_email = $search_email->rowcount();

    if($count_email>0){
        echo'email_existe';
    
    }else{
        if($mdpUser != $mdpUser_confirme){
        echo'mdp false';
        
        }else{
            echo'ok';
            session_start();
            $_SESSION['pseudo'] = $connect['pseudo'];
            
        }
    }    
    

}
?>