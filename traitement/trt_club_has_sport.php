<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

$thisClub = $_GET['id'];

/*----------------------------------*/
//Traitement - club_has_public
/*----------------------------------*/

//On fait une boucle dans le tableau pour récupérer les ID_Club et ID_Public
foreach($_POST['handi_sport'] as $ID_Sport => $value) {

    $searchSport = $bdd->prepare('SELECT * FROM sport_has_club WHERE ID_Sport = :ID_Sport AND ID_Club = :ID_Club');
    $searchSport -> execute(array(
        'ID_Sport' => $ID_Sport,
        'ID_Club' => $thisClub
    ));

    //Vérifier que le public ne soit pas déjà dans la liste
    $count = $searchSport ->rowcount();

    //S'il est déjà dans la liste alors on fait une redirection
    if($count>0){

        header('location:trt_club_form.php?id='.$thisClub);

    }else{
        //préparer la requête pout l'insertion
        $req = $bdd->prepare("INSERT INTO sport_has_club (ID_Sport, ID_Club) VALUES(:ID_Sport, :ID_Club) ");
        $req -> execute(array(
        'ID_Sport'=> $ID_Sport,
        'ID_Club' => $thisClub
        ));
    
    //Fermer la requête $req
    $req -> closeCursor();

    //Rediection vers le formulaire du club
    header('location:trt_club_form.php?id='.$thisClub);
    }

}

?>