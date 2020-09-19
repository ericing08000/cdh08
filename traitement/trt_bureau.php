<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();


/*----------------------------------------------*/
//Traitement - Membre du Bureau
/*----------------------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$prenomBureau = trim(htmlspecialchars(!empty($_POST['prenomBureau']) ? $_POST['prenomBureau'] : NULL, ENT_QUOTES));  
$nomBureau = trim(htmlspecialchars(!empty($_POST['nomBureau']) ? $_POST['nomBureau'] : NULL, ENT_QUOTES));
$designationBureau = htmlspecialchars(!empty($_POST['designationBureau']) ? $_POST['designationBureau'] : NULL, ENT_QUOTES);
$photoBureau = htmlspecialchars(!empty($_FILES['downloadPhoto']['name']) ? $_FILES['downloadPhoto']['name'] : NULL, ENT_QUOTES);
$altPhoto = trim(htmlspecialchars(!empty($_POST['altPhoto']) ? $_POST['altPhoto'] : NULL, ENT_QUOTES));
$statusBureau = htmlspecialchars(!empty($_POST['statusBureau']) ? $_POST['statusBureau'] : NULL, ENT_QUOTES);
$photoDefaut = 'imageDefaut.png';

// $mdpUser = !empty($_POST['mdpUser']) ? $_POST['mdpUser'] : NULL;
// echo($prenomBureau);
// echo($nomBureau);
//echo($designationBureau);
// echo($statusBureau);
// echo($altPhoto);

$classementBureau = '';
//Récupérer le dernier enregistrement pour affecter un classement auto-incrémenter
switch ($designationBureau){
    case $designationBureau == 'Le Président':
        $classementBureau = 1;
    break;
        case $designationBureau == 'Le Vice-Président':
            $classementBureau = 2;
        break;
            case $designationBureau == 'Le Vice-Président suppléant':
                $classementBureau = 3;
            break;
                case $designationBureau == 'Le Secrétaire Général':
                    $classementBureau = 4;
                break;
                    case $designationBureau == 'Le Trésorier':
                        $classementBureau = 5;
                    break;

}

if($_GET['method'] == 'insert'){
    //echo('Ajouter un membre');

    if(empty($_POST['prenomBureau'])){
        header('location:trt_bureau_form.php?error=1&prenom='.$prenomBureau.'&nom='.$nomBureau);
    }else{
        if(empty($_POST['nomBureau'])){
            header('location:trt_bureau_form.php?error=2&prenom='.$prenomBureau.'&nom='.$nomBureau);
        
        }else{
            //Vérifier qu'une photo a bien été sélectionner
            if($_FILES['downloadPhoto']['error'] == 4){
                header('location:trt_bureau_form.php?error=3&prenom='.$prenomBureau.'&nom='.$nomBureau);
            }else{
                //Gestion de l'envoi et l'enregistrement de la photo
                if($_FILES['downloadPhoto']['error'] == 0){

                    //Dans le cas ou la photo est télécharger
                    copy( $_FILES['downloadPhoto']['tmp_name'] , "../image/photo/".$_FILES['downloadPhoto']['name']);
                }
                if($_FILES['downloadPhoto']['error'] == 0){
                    // S'il y a une photo : 
                    $sql = $bdd->prepare ("INSERT INTO bureau (prenomBureau, nomBureau, classementBureau,  designationBureau, photoBureau, altPhoto, statusBureau )
                    VALUES ( :prenomBureau, :nomBureau, :classementBureau, :designationBureau, :photoBureau, :altPhoto, :statusBureau)");
                    // On éxecute la requête «$sql»:
                    $sql->execute(array(
                        'prenomBureau' => $prenomBureau,
                        'nomBureau' => $nomBureau,
                        'classementBureau' => $classementBureau,
                        'designationBureau' => $designationBureau,
                        'photoBureau' => $photoBureau,
                        'altPhoto' => $altPhoto,
                        'statusBureau' => $statusBureau
                    ));
                }else{
                    // sinon pas de photo sélectionner mettre une photo par défaut : 
                    $sql = $bdd->prepare ("INSERT INTO bureau (prenomBureau, nomBureau, classementBureau, designationBureau, photoBureau, altPhoto, statusBureau )
                    VALUES ( :prenomBureau, :nomBureau, :classementBureau, :designationBureau, :photoBureau, :altPhoto, :statusBureau)");
                    // On éxecute la requête «$sql»:
                    $sql->execute(array(
                        'prenomBureau' => $prenomBureau,
                        'nomBureau' => $nomBureau,
                        'classementBureau' => $classementBureau,
                        'designationBureau' => $designationBureau,
                        'photoBureau' => $photoDefaut,
                        'altPhoto' => 'image par défaut',
                        'statusBureau' => $statusBureau
                    ));
                    // //On revient sur la page
                    header('location:../dashboard#form_bureau');
                }
                //Vérifier s'il y a une légende pour la photo
                if(empty($_POST['altPhoto'])){

                    //On récupére le dernier enregistrement
                    $req = $bdd->prepare("SELECT MAX(ID_Bureau) As max FROM bureau");
                    $req-> execute();
                    $donnees = $req->fetch();
                    $max_ID_Bureau = $donnees['max'];

                    //On revient sur la page d'édition
                    header('location:../traitement/trt_bureau_form.php?error=4&id='.$max_ID_Bureau);
                }
            } 
        }
    }

}elseif($_GET['method'] == 'delete'){
    
    /*----------------------------------------------*/
    //Traitement pour supprimer un membre du Bureau
    /*----------------------------------------------*/
    $bdd -> exec ("DELETE FROM bureau WHERE ID_Bureau = '".$_GET['id']."'");
    // On revient sur la page
    header('location:../dashboard#form_bureau');


}else{
    
    /*----------------------------------------------*/
    //Traitement pour éditer un membre du Bureau
    /*----------------------------------------------*/
    
    //echo('Éditer un membre');
    
    if($_FILES['downloadPhoto']['error'] == 0){

        $req = $bdd->prepare ("UPDATE bureau SET prenomBureau='$prenomBureau', nomBureau='$nomBureau', designationBureau='$designationBureau', photoBureau='$photoBureau', altPhoto ='$altPhoto', statusBureau='$statusBureau' WHERE ID_Bureau ='".$_GET['id']."'");
    }else{
        $req = $bdd->prepare ("UPDATE bureau SET prenomBureau='$prenomBureau', nomBureau='$nomBureau', designationBureau='$designationBureau', altPhoto ='$altPhoto',  statusBureau='$statusBureau' WHERE ID_Bureau ='".$_GET['id']."'");
    }

    //Exécuter la requête
    $req -> execute();

    //On revient sur la page
    header('location:../dashboard#form_bureau');
}


?>