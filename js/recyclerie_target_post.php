<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


$dateDebut = htmlspecialchars($_POST['dateDebut'], ENT_QUOTES);  
$dateFin = htmlspecialchars($_POST['dateFin'], ENT_QUOTES);

// echo $dateDebut;
// echo $dateFin;
//sleep(1);

// Permet de savoir si date est valide
if($dateDebut < date('Y-m-d')){

    echo 'dateDebut_inf';   

}else{

    if($dateFin < $dateDebut){
        echo 'dateFin_inf';

    }else{
        echo 'ok';
    }
    

}

?>