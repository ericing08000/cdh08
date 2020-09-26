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

// Permet de savoir si date de début est inférieur à la date du jour
if($dateDebut < date('Y-m-d')){
    //Retourner un message dans la console
    echo 'dateDebut_inf';   

}else{
    // Permet de savoir si date de fin est inférieur à la date de début
    if($dateFin < $dateDebut){
        //Retourner un message dans la console
        echo 'dateFin_inf';

    }else{
        //sinon retourner un message dans la console
        echo 'ok';
    }
    
}?>
