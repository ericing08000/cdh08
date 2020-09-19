<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------------------------------*/
//Traitement - Membre de l'équipe
/*----------------------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$prenomEquipe = trim(htmlspecialchars(!empty($_POST['prenomEquipe']) ? $_POST['prenomEquipe'] : NULL, ENT_QUOTES));  
$nomEquipe = trim(htmlspecialchars(!empty($_POST['nomEquipe']) ? $_POST['nomEquipe'] : NULL, ENT_QUOTES));
$designationEquipe = htmlspecialchars(!empty($_POST['designationEquipe']) ? $_POST['designationEquipe'] : NULL, ENT_QUOTES);
$photoEquipe = htmlspecialchars(!empty($_FILES['downloadPhoto']['name']) ? $_FILES['downloadPhoto']['name'] : NULL, ENT_QUOTES);
$altPhotoEquipe = trim(htmlspecialchars(!empty($_POST['altPhotoEquipe']) ? $_POST['altPhotoEquipe'] : NULL, ENT_QUOTES));
$statusEquipe = htmlspecialchars(!empty($_POST['statusEquipe']) ? $_POST['statusEquipe'] : NULL, ENT_QUOTES);
$photoDefaut = 'imageDefaut.png';

// echo($prenomBureau);
// echo($nomBureau);
// echo($designationBureau);
// echo($statusBureau);
// echo($altPhoto);

if($_GET['method'] == 'insert'){
    //echo('Ajouter un membre de l'équipe');

    //Gestion de l'envoi et l'enregistrement de la photo
    if($_FILES['downloadPhoto']['error'] == 0)
    {
        //Dans le cas ou la photo est télécharger
        copy( $_FILES['downloadPhoto']['tmp_name'] , "../image/photo/".$_FILES['downloadPhoto']['name']);
    }
    if($_FILES['downloadPhoto']['error'] == 0){
        // S'il y a une photo : 
        $sql = $bdd->prepare ("INSERT INTO equipe (prenomEquipe, nomEquipe, designationEquipe, photoEquipe, altPhotoEquipe, statusEquipe )
        VALUES ( :prenomEquipe, :nomEquipe, :designationEquipe, :photoEquipe, :altPhotoEquipe, :statusEquipe)");
        // On éxecute la requête «$sql»:
        $sql->execute(array(
            'prenomEquipe' => $prenomEquipe,
            'nomEquipe' => $nomEquipe,
            'designationEquipe' => $designationEquipe,
            'photoEquipe' => $photoEquipe,
            'altPhotoEquipe' => $altPhotoEquipe,
            'statusEquipe' => $statusEquipe
        ));
    }else{
        // sinon pas de photo sélectionner mettre une photo par défaut : 
        $sql = $bdd->prepare ("INSERT INTO equipe (prenomEquipe, nomEquipe, designationEquipe, photoEquipe, altPhotoEquipe, statusEquipe )
        VALUES ( :prenomEquipe, :nomEquipe, :designationEquipe, :photoEquipe, :altEquipe, :statusEquipe)");
        // On éxecute la requête «$sql»:
        $sql->execute(array(
            'prenomEquipe' => $prenomEquipe,
            'nomEquipe' => $nomEquipe,
            'designationEquipe' => $designationEquipe,
            'photoEquipe' => $photoDefaut,
            'altPhotoEquipe' => 'image par défaut',
            'statusEquipe' => $statusEquipe
        ));
    }

    //On revient sur la page
    header('location:../dashboard#form_equipe');
        

}elseif($_GET['method'] == 'delete'){
    
    /*-------------------------------------------------*/
    //Traitement pour supprimer un membre de l'équipe
    /*-------------------------------------------------*/
    $bdd -> exec ("DELETE FROM equipe WHERE ID_Equipe = '".$_GET['id']."'");
    // On revient sur la page
    header('location:../dashboard#form_equipe');


}else{
    //echo('Éditer un membre');
    /*----------------------------------------------*/
    //Traitement pour éditer un membre de l'équipe
    /*----------------------------------------------*/
    if($_FILES['downloadPhoto']['error'] == 0){

        $req = $bdd->prepare ("UPDATE equipe SET prenomEquipe='$prenomEquipe', nomEquipe='$nomEquipe', designationEquipe='$designationEquipe', photoEquipe='$photoEquipe', altPhotoEquipe ='$altPhotoEquipe', statusEquipe='$statusEquipe' WHERE ID_Equipe ='".$_GET['id']."'");
    }else{
        $req = $bdd->prepare ("UPDATE equipe SET prenomEquipe='$prenomEquipe', nomEquipe='$nomEquipe', designationEquipe='$designationEquipe', altPhotoEquipe ='$altPhotoEquipe',  statusEquipe='$statusEquipe' WHERE ID_Equipe ='".$_GET['id']."'");
    }

    //Exécuter la requête
    $req -> execute();
    // On revient sur la page
    header('location:../dashboard#form_equipe');
}


?>