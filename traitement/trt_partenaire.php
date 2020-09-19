<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


/*-----------------------------------*/
//Traitement - Partenaire
/*-----------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$nomPartenaire = trim(htmlspecialchars(!empty($_POST['nomPartenaire']) ? $_POST['nomPartenaire'] : NULL, ENT_QUOTES));
$photoPartenaire = htmlspecialchars(!empty($_FILES['downloadPhotoPartenaire']['name']) ? $_FILES['downloadPhotoPartenaire']['name'] : NULL, ENT_QUOTES);
$altPhotoPartenaire = trim(htmlspecialchars(!empty($_POST['altPhotoPartenaire']) ? $_POST['altPhotoPartenaire'] : NULL, ENT_QUOTES));

//Récupérer le dernier enregistrement pour affecter un classement auto-incrémenter
$req = $bdd->prepare("SELECT MAX(classementPartenaire) AS max FROM partenaire");
$req -> execute();
$donnees = $req->fetch();
$max_classement = $donnees['max'] + 1;
$classementPartenaire = $max_classement;

// echo($nomPartenaire);
// echo($photoPartenaire);
// echo($altPhotoPartenaire);

if($_GET['method'] == 'insert'){
   
    //Vérifier que le champ "Nom Partenaire" ne soit pas vide
    if(empty($_POST['nomPartenaire'])){
        header('location:trt_partenaire_form.php?error=1');
    }
    else
    {
        //Permet de savoir si le sport existe dans la base de données
        $req = $bdd->prepare("SELECT * FROM partenaire WHERE nomPartenaire = :nomPartenaire");
        $req-> execute(array(
            'nomPartenaire' => $nomPartenaire
        ));
        //Compte le nombre de ligne dans la base de données
        $count = $req->rowcount();
        if($count>0){
            header('location:trt_partenaire_form.php?error=3');
        }
        else
        {
            //Vérifier qu'une photo a bien été sélectionner et récupérer la valeur du champ "Nom sport"
            if($_FILES['downloadPhotoPartenaire']['error'] == 4){
                header("location:trt_partenaire_form.php?error=4&nomPartenaire=".$nomPartenaire);
            }
            else
            {
                //Gestion de l'envoi et l'enregistrement de la photo
                if($_FILES['downloadPhotoPartenaire']['error'] == 0){
                    //Dans le cas ou la photo est télécharger
                    copy( $_FILES['downloadPhotoPartenaire']['tmp_name'] , "../image/partenaire/".$_FILES['downloadPhotoPartenaire']['name']);
                }     
            
                if($_FILES['downloadPhotoPartenaire']['error'] == 0){

                    //S'il y a une photo : 
                    $sql = $bdd->prepare ("INSERT INTO partenaire (nomPartenaire,classementPartenaire, photoPartenaire, altPhotoPartenaire)
                    VALUES ( :nomPartenaire, :classementPartenaire, :photoPartenaire, :altPhotoPartenaire)");
                    // On éxecute la requête «$sql»:
                    $sql->execute(array(
                        'nomPartenaire' => $nomPartenaire,
                        'classementPartenaire' => $classementPartenaire,
                        'photoPartenaire' => $photoPartenaire,
                        'altPhotoPartenaire' => $altPhotoPartenaire 
                    ));
                        //On revient sur la page
                        header('location:../dashboard#form_partenaire');
                }

                //Vérifier s'il y a une légende pour la photo
                if(empty($_POST['altPhotoPartenaire'])){

                    //On récupére le dernier enregistrement
                    $req = $bdd->prepare("SELECT MAX(ID_Partenaire) As max FROM partenaire");
                    $req-> execute();
                    $donnees = $req->fetch();
                    $max_ID_Partenaire = $donnees['max'];
                    
                    //On revient sur la page d'édition
                    header('location:../traitement/trt_partenaire_form.php?error=2&id='.$max_ID_Partenaire);
                }
            }
        }
    }  
}elseif($_GET['method'] == 'delete'){
    
        /*----------------------------------------------*/
        //Traitement pour supprimer un Partenaire
        /*----------------------------------------------*/
        $bdd -> exec ("DELETE FROM partenaire WHERE ID_Partenaire = '".$_GET['id']."'");
        
        //On supprime l'image associée au Partenaire
        $req = $bdd->prepare("SELECT * FROM partenaire WHERE ID_Partenaire = '".$_GET['id']."'");
        $req->execute();
        $donnees = $req->fetch();

        unlink("../image/sport/".$donnees['photoPartenaire']);

        // On revient sur la page
        header('location:../dashboard#form_partenaire');
    }   
    else
    {
        /*----------------------------------------------*/
        //Traitement pour éditer un Partenaire
        /*----------------------------------------------*/
        $req = $bdd->prepare("SELECT * FROM partenaire WHERE ID_Partenaire = '".$_GET['id']."'");
        $req -> execute();
        $donnees = $req->fetch();
        $photoPartenaireEdit = $donnees['photoPartenaire'];

        //Gestion de l'envoi et l'enregistrement de la photo
        if($_FILES['downloadPhotoPartenaire']['error'] == 0)
        {
             //Dans le cas ou la photo est télécharger
            copy( $_FILES['downloadPhotoPartenaire']['tmp_name'] , "../image/partenaire/".$_FILES['downloadPhotoPartenaire']['name']);
        }
            if($_FILES['downloadPhotoPartenaire']['error'] == 0){
           
            $req = $bdd->prepare ("UPDATE partenaire SET nomPartenaire='$nomPartenaire', photoPartenaire='$photoPartenaire', altPhotoPartenaire ='$altPhotoPartenaire' WHERE ID_Partenaire ='".$_GET['id']."'");
        }
        else
        {
            $req = $bdd->prepare ("UPDATE partenaire SET nomPartenaire='$nomPartenaire', photoPartenaire='$photoPartenaireEdit', altPhotoPartenaire ='$altPhotoPartenaire' WHERE ID_Partenaire ='".$_GET['id']."'");
        }

            //Exécuter la requête
            $req -> execute();

            // On revient sur la page
            header('location:../dashboard#form_partenaire');   
    }

?>