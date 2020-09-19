<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

$thisclub = $_GET['id'];

/*----------------------------------*/
//Traitement - club_has_public
/*----------------------------------*/

//On fait une boucle dans le tableau pour récupérer les ID_Club et ID_Public
foreach($_POST['handi_public'] as $ID_Public => $value) {

    $searchPublic = $bdd->prepare('SELECT * FROM club_has_public WHERE ID_Club = :ID_Club AND ID_Public = :ID_Public');
    $searchPublic -> execute(array(
        'ID_Club' => $thisclub,
        'ID_Public' => $ID_Public
    ));

    //Vérifier que le public ne soit pas déjà dans la liste
    $count = $searchPublic ->rowcount();

    //Si il est déjà dans la liste alors on fait une rediection avec un erreur
    if($count>0){

        header('location:trt_club_form.php?id='.$thisclub);

    }else{
        //préparer la requête pout l'insertion
        $req = $bdd->prepare("INSERT INTO club_has_public (ID_Club, ID_Public) VALUES(:ID_Club, :ID_Public) ");
        $req -> execute(array(
        'ID_Club'=> $thisclub,
        'ID_Public' => $ID_Public
        ));
    
    //Fermer la requête $req
    $req -> closeCursor();

    //Rediection vers le formulaire du club
    header('location:trt_club_form.php?id='.$thisclub);
    }

}

?>