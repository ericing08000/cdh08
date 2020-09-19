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
$designationEquipe = trim(htmlspecialchars(!empty($_POST['designationEquipe']) ? $_POST['designationEquipe'] : NULL, ENT_QUOTES));
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
    if(empty($_POST['prenomEquipe'])){
        header('location:trt_Equipe_form.php?error=1&prenom='.$prenomEquipe.'&nom='.$nomEquipe.'&designation='.$designationEquipe);
    }else{
        if(empty($_POST['nomEquipe'])){
            header('location:trt_Equipe_form.php?error=2&prenom='.$prenomEquipe.'&nom='.$nomEquipe.'&designation='.$designationEquipe);
        
        }else{
            if(empty($_POST['designationEquipe'])){
                header('location:trt_Equipe_form.php?error=3&prenom='.$prenomEquipe.'&nom='.$nomEquipe.'&designation='.$designationEquipe);
            
            }else{
                //Vérifier qu'une photo a bien été sélectionner
                if($_FILES['downloadPhoto']['error'] == 4){
                    header('location:trt_Equipe_form.php?error=4&prenom='.$prenomEquipe.'&nom='.$nomEquipe.'&designation='.$designationEquipe);
                }else{
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
                        // //On revient sur la page
                        header('location:../dashboard#form_equipe');
                    }
                    //Vérifier s'il y a une légende pour la photo
                    if(empty($_POST['altPhotoEquipe'])){

                        //On récupére le dernier enregistrement
                        $req = $bdd->prepare("SELECT MAX(ID_Equipe) As max FROM equipe");
                        $req-> execute();
                        $donnees = $req->fetch();
                        $max_ID_Equipe = $donnees['max'];

                        //On revient sur la page d'édition
                        header('location:../traitement/trt_equipe_form.php?error=5&id='.$max_ID_Equipe);
                    }
                }
            }
        }
    }

    

   
        

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