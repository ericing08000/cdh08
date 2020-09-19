<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


/*-----------------------------------*/
//Traitement - Matériel Recyclerie
/*-----------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$photoMateriel = htmlspecialchars(!empty($_FILES['downloadPhotoMateriel']['name']) ? $_FILES['downloadPhotoMateriel']['name'] : NULL, ENT_QUOTES);
$altPhotoMateriel = trim(htmlspecialchars(!empty($_POST['altPhotoMateriel']) ? $_POST['altPhotoMateriel'] : NULL, ENT_QUOTES));
$nomMateriel = trim(htmlspecialchars(!empty($_POST['nomMateriel']) ? $_POST['nomMateriel'] : NULL, ENT_QUOTES));
$quantiteMateriel = trim(htmlspecialchars(!empty($_POST['quantiteMateriel']) ? $_POST['quantiteMateriel'] : 0, ENT_QUOTES));

// echo($quantiteMateriel);
// echo($altPhotoMateriel);
// echo($nomMateriel);
// echo($quantiteMateriel);

if($_GET['method'] == 'insert'){
   
    //Vérifier que le champ "Nom Materiel" ne soit pas vide
    if(empty($_POST['nomMateriel'])){
        header('location:trt_recyclerie_form.php?error=1');
    }
    else
    {
        //Permet de savoir si le matériel existe dans la base de données
        $req = $bdd->prepare("SELECT * FROM recyclerie WHERE nomMateriel = :nomMateriel");
        $req-> execute(array(
            'nomMateriel' => $nomMateriel
        ));
        //Compte le nombre de ligne dans la base de données
        $count = $req->rowcount();
        if($count>0){
            header('location:trt_recyclerie_form.php?error=3');
        }
        else
        {
            // if(empty($_POST['quantiteMateriel'])){
            //     header('location:trt_recyclerie_form.php?error=4&nomMateriel='.$nomMateriel);
            // }
            
            //Vérifier qu'une photo a bien été sélectionner et récupérer la valeur du champ "Nom Materiel"
            if($_FILES['downloadPhotoMateriel']['error'] == 4){
                header("location:trt_recyclerie_form.php?error=5&nomMateriel=".$nomMateriel);
            }
            else
            {
                //Gestion de l'envoi et l'enregistrement de la photo
                if($_FILES['downloadPhotoMateriel']['error'] == 0){
                    //Dans le cas ou la photo est télécharger
                    copy( $_FILES['downloadPhotoMateriel']['tmp_name'] , "../image/recyclerie/".$_FILES['downloadPhotoMateriel']['name']);
                }     
            
                if($_FILES['downloadPhotoMateriel']['error'] == 0){

                    //S'il y a une photo : 
                    $sql = $bdd->prepare ("INSERT INTO recyclerie (nomMateriel, quantiteMateriel, photoMateriel, altPhotoMateriel)
                    VALUES ( :nomMateriel, :quantiteMateriel, :photoMateriel, :altPhotoMateriel)");
                    // On éxecute la requête «$sql»:
                    $sql->execute(array(
                        'nomMateriel' => $nomMateriel,
                        'quantiteMateriel' => $quantiteMateriel,
                        'photoMateriel' => $photoMateriel,
                        'altPhotoMateriel' => $altPhotoMateriel 
                    ));
                        //On revient sur la page
                        header('location:../dashboard#form_recyclerie');
                }

                //Vérifier s'il y a une légende pour la photo
                if(empty($_POST['altPhotoMateriel'])){

                //On récupére le dernier enregistrement
                $req = $bdd->prepare("SELECT MAX(ID_Recyclerie) As max FROM recyclerie");
                $req-> execute();
                $donnees = $req->fetch();
                $max_ID_Recyclerie = $donnees['max'];
                
                //On revient sur la page d'édition
                header('location:../traitement/trt_recyclerie_form.php?error=2&id='.$max_ID_Recyclerie);
                }
            }
        }
    }

}elseif($_GET['method'] == 'delete'){

/*----------------------------------------------*/
//Traitement pour supprimer un Materiel
/*----------------------------------------------*/
$req = $bdd->prepare("SELECT * FROM recyclerie WHERE ID_Recyclerie = '".$_GET['id']."'");
$req->execute();
$donnees = $req->fetch();

$bdd -> exec ("DELETE FROM recyclerie WHERE ID_Recyclerie = '".$_GET['id']."'");

//On supprime image associée au Materiel
unlink("../image/recyclerie/".$donnees['photoMateriel']);

// On revient sur la page
header('location:../dashboard#form_recyclerie');
    

}
else
{
    /*----------------------------------------------*/
    //Traitement pour éditer un matériel
    /*----------------------------------------------*/
    $req = $bdd->prepare("SELECT * FROM recyclerie WHERE ID_Recyclerie = '".$_GET['id']."'");
    $req -> execute();
    $donnees = $req->fetch();
    $photoMaterielEdit = $donnees['photoMateriel'];

    //Gestion de l'envoi et l'enregistrement de la photo
    if($_FILES['downloadPhotoMateriel']['error'] == 0)
    {
            //Dans le cas ou la photo est télécharger
        copy( $_FILES['downloadPhotoMateriel']['tmp_name'] , "../image/Materiel/".$_FILES['downloadPhotoMateriel']['name']);
    }
        if($_FILES['downloadPhotoMateriel']['error'] == 0){
        
        $req = $bdd->prepare ("UPDATE recyclerie SET nomMateriel='$nomMateriel', quantiteMateriel='$quantiteMateriel', photoMateriel='$photoMateriel', altPhotoMateriel ='$altPhotoMateriel' WHERE ID_Recyclerie ='".$_GET['id']."'");
        }
        else
        {
            if($donnee['quantiteMateriel'] = ''){
                $quantiteMateriel = 0;
                $req = $bdd->prepare ("UPDATE recyclerie SET nomMateriel='$nomMateriel', quantiteMateriel='$quantiteMateriel', photoMateriel='$photoMaterielEdit', altPhotoMateriel ='$altPhotoMateriel' WHERE ID_Recyclerie ='".$_GET['id']."'");
            }
            else {
                $req = $bdd->prepare ("UPDATE recyclerie SET nomMateriel='$nomMateriel', quantiteMateriel='$quantiteMateriel', photoMateriel='$photoMaterielEdit', altPhotoMateriel ='$altPhotoMateriel' WHERE ID_Recyclerie ='".$_GET['id']."'");
            }
            
        }

            //Exécuter la requête
            $req -> execute();

            // On revient sur la page
            header('location:../dashboard#form_recyclerie');   
    }

?>