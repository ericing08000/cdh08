<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


/*-----------------------------------*/
//Traitement - Sport
/*-----------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$nomSport = trim(htmlspecialchars(!empty($_POST['nomSport']) ? $_POST['nomSport'] : NULL, ENT_QUOTES));
$photoSport = htmlspecialchars(!empty($_FILES['downloadPhoto']['name']) ? $_FILES['downloadPhoto']['name'] : NULL, ENT_QUOTES);
$altPhotoSport = trim(htmlspecialchars(!empty($_POST['altPhotoSport']) ? $_POST['altPhotoSport'] : NULL, ENT_QUOTES));
$capaciteSport = trim(htmlspecialchars(!empty($_POST['capaciteSport']) ? $_POST['capaciteSport'] : NULL, ENT_QUOTES));
$descriptionSport = trim(htmlspecialchars(!empty($_POST['descriptionSport']) ? $_POST['descriptionSport'] : NULL, ENT_QUOTES));
$pratiqueSport = trim(htmlspecialchars(!empty($_POST['pratiqueSport']) ? $_POST['pratiqueSport'] : NULL, ENT_QUOTES));
$reglementSport = trim(htmlspecialchars(!empty($_POST['reglementSport']) ? $_POST['reglementSport'] : NULL, ENT_QUOTES));

// $altPhotoDefaut = 'image par défaut';

// echo($nomSport);
// echo($photoSport);
// echo($altPhotoSport);

if($_GET['method'] == 'insert'){
   
    //Vérifier que le champ "Nom sport" ne soit pas vide
    if(empty($_POST['nomSport'])){
        header('location:trt_sport_form.php?error=1');
    }
    else
    {
        //Permet de savoir si le sport existe dans la base de données
        $req = $bdd->prepare("SELECT * FROM sport WHERE nomSport = :nomSport");
        $req-> execute(array(
            'nomSport' => $nomSport
        ));
        //Compte le nombre de ligne dans la base de données
        $count = $req->rowcount();
        if($count>0){
            header('location:trt_sport_form.php?error=3');
        }
        else
        {
            //Vérifier qu'une photo a bien été sélectionner et récupérer la valeur du champ "Nom sport"
            if($_FILES['downloadPhoto']['error'] == 4){
                header("location:trt_sport_form.php?error=5&nomSport=".$nomSport);
            }
            else
            {
                //Gestion de l'envoi et l'enregistrement de la photo
                if($_FILES['downloadPhoto']['error'] == 0){
                    //Dans le cas ou la photo est télécharger
                    copy( $_FILES['downloadPhoto']['tmp_name'] , "../image/sport/".$_FILES['downloadPhoto']['name']);
                }     
            
                if($_FILES['downloadPhoto']['error'] == 0){

                    //S'il y a une photo : 
                    $sql = $bdd->prepare ("INSERT INTO sport (nomSport, photoSport, altPhotoSport, capaciteSport, descriptionSport, pratiqueSport, reglementSport)
                    VALUES ( :nomSport, :photoSport, :altPhotoSport, :capaciteSport, :descriptionSport, :pratiqueSport, :reglementSport)");
                    // On éxecute la requête «$sql»:
                    $sql->execute(array(
                        'nomSport' => $nomSport,
                        'photoSport' => $photoSport,
                        'altPhotoSport' => $altPhotoSport,
                        'capaciteSport' => $capaciteSport,
                        'descriptionSport' => $descriptionSport,
                        'pratiqueSport' => $pratiqueSport,
                        'reglementSport' => $reglementSport

                    ));
                        //On revient sur la page
                        header('location:../dashboard#form_sport');
                }

                //Vérifier s'il y a une légende pour la photo
                if(empty($_POST['altPhotoSport'])){

                //On récupére le dernier enregistrement
                $req = $bdd->prepare("SELECT MAX(ID_Sport) As max FROM sport");
                $req-> execute();
                $donnees = $req->fetch();
                $max_ID_Sport = $donnees['max'];
                
                //On revient sur la page d'édition
                header('location:../traitement/trt_sport_form.php?error=2&id='.$max_ID_Sport);
                }
            }
        }
    }  
}elseif($_GET['method'] == 'delete'){
    /*----------------------------------------------*/
    //Vérifier que le sport ne soit pas déjà utilisé
    /*----------------------------------------------*/
    $req = $bdd->prepare("SELECT * FROM sport_has_club  WHERE ID_Sport = '".$_GET['id']."'");
    $req->execute();
    $donnees = $req->fetch();
    
    //Compte le nombre de ligne dans la base de données
    $count = $req->rowcount();
    
        if($count>0){
            //echo $count;
            header("location:delete_sport_form.php?error=4");
        
        }else{
        /*----------------------------------------------*/
        //Traitement pour supprimer un sport
        /*----------------------------------------------*/
        $req = $bdd->prepare("SELECT * FROM sport WHERE ID_Sport = '".$_GET['id']."'");
        $req->execute();
        $donnees = $req->fetch();
        
        $bdd -> exec ("DELETE FROM sport WHERE ID_Sport = '".$_GET['id']."'");
        
        //On supprime image associée au sport
        unlink("../image/sport/".$donnees['photoSport']);

        // On revient sur la page
        header('location:../dashboard#form_sport');
        }   
    
    }
    else
    {
        /*----------------------------------------------*/
        //Traitement pour éditer un sport
        /*----------------------------------------------*/
        $req = $bdd->prepare("SELECT * FROM sport WHERE ID_Sport = '".$_GET['id']."'");
        $req -> execute();
        $donnees = $req->fetch();
        $photoSportEdit = $donnees['photoSport'];

        //Gestion de l'envoi et l'enregistrement de la photo
        if($_FILES['downloadPhoto']['error'] == 0)
        {
             //Dans le cas ou la photo est télécharger
            copy( $_FILES['downloadPhoto']['tmp_name'] , "../image/sport/".$_FILES['downloadPhoto']['name']);
        }
            if($_FILES['downloadPhoto']['error'] == 0){
           
            $req = $bdd->prepare ("UPDATE sport SET nomSport='$nomSport', photoSport='$photoSport', altPhotoSport ='$altPhotoSport', capaciteSport = '$capaciteSport', descriptionSport ='$descriptionSport', pratiqueSport='$pratiqueSport' reglementSport ='$reglementSport' WHERE ID_Sport ='".$_GET['id']."'");
        }
        else
        {
            $req = $bdd->prepare ("UPDATE sport SET nomSport='$nomSport', photoSport='$photoSportEdit', altPhotoSport ='$altPhotoSport', capaciteSport = '$capaciteSport', descriptionSport ='$descriptionSport', pratiqueSport='$pratiqueSport', reglementSport ='$reglementSport' WHERE ID_Sport ='".$_GET['id']."'");
        }

            //Exécuter la requête
            $req -> execute();

            // On revient sur la page
            header('location:../dashboard#form_sport');   
    }

?>