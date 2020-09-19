<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------*/
//Traitement - Club
/*----------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$photoClub = htmlspecialchars(!empty($_FILES['downloadPhotoClub']['name']) ? $_FILES['downloadPhotoClub']['name'] : NULL, ENT_QUOTES);
$altPhotoClub = trim(htmlspecialchars(!empty($_POST['altPhotoClub']) ? $_POST['altPhotoClub'] : NULL, ENT_QUOTES));
$nomClub = trim(htmlspecialchars(!empty($_POST['nomClub']) ? $_POST['nomClub'] : NULL, ENT_QUOTES));
$nomPresidentClub = trim(htmlspecialchars(!empty($_POST['nomPresidentClub']) ? $_POST['nomPresidentClub'] : NULL, ENT_QUOTES));
$adresseClub = trim(htmlspecialchars(!empty($_POST['adresseClub']) ? $_POST['adresseClub'] : NULL, ENT_QUOTES));
$cpClub = trim(htmlspecialchars(!empty($_POST['cpClub']) ? $_POST['cpClub'] : NULL, ENT_QUOTES));
$villeClub = trim(htmlspecialchars(!empty($_POST['villeClub']) ? $_POST['villeClub'] : NULL, ENT_QUOTES));
$contactClub = trim(htmlspecialchars(!empty($_POST['contactClub']) ? $_POST['contactClub'] : NULL, ENT_QUOTES));
$telClub = trim(htmlspecialchars(!empty($_POST['telClub']) ? $_POST['telClub'] : NULL, ENT_QUOTES));
$emailClub = trim(htmlspecialchars(!empty($_POST['emailClub']) ? $_POST['emailClub'] : NULL, ENT_QUOTES));
$siteClub = trim(htmlspecialchars(!empty($_POST['siteClub']) ? $_POST['siteClub'] : NULL, ENT_QUOTES));
$googleMapsClub = trim(htmlspecialchars(!empty($_POST['googleMapsClub']) ? $_POST['googleMapsClub'] : NULL, ENT_QUOTES));

// echo $photoClub;
// echo $altPhotoClub;
// echo $nomClub;
// echo $nomPresidentClub;
// echo $adresseClub;
// echo $cpClub;
// echo $villeClub;
// echo $telClub;


if($_GET['method'] == 'insert'){

    //Vérifier que le champ "Nom Club" ne soit pas vide
    if(empty($_POST['nomClub'])){
        header('location:trt_club_form.php?error=1&nomClub='.$nomClub.'&adresseClub='.$adresseClub.'&cpClub='.$cpClub.'&villeClub='.$villeClub.'&telClub='.$telClub);
    }else{
        //Permet de savoir si le nom du club existe dans la base de données
        $req = $bdd->prepare("SELECT * FROM club WHERE nomClub = :nomClub");
        $req-> execute(array(
            'nomClub' => $nomClub
        ));
        //Compte le nombre de ligne dans la base de données
        $count = $req->rowcount();
        if($count>0){
            header('location:trt_club_form.php?error=2');
        }
    

    //Vérifier que le champ l'adresse du Club" ne soit pas vide
    if(empty($_POST['adresseClub'])){
        header('location:trt_club_form.php?error=3&nomClub='.$nomClub.'&adresseClub='.$adresseClub.'&cpClub='.$cpClub.'&villeClub='.$villeClub.'&telClub='.$telClub);
    }else{
        //Vérifier que le champ "Code Postal" ne soit pas vide
        if(empty($_POST['cpClub'])){
            header('location:trt_club_form.php?error=4&nomClub='.$nomClub.'&adresseClub='.$adresseClub.'&cpClub='.$cpClub.'&villeClub='.$villeClub.'&telClub='.$telClub);
        }else{
            //Vérifier que le champ "Ville Club" ne soit pas vide
            if(empty($_POST['villeClub'])){
                header('location:trt_club_form.php?error=5&nomClub='.$nomClub.'&adresseClub='.$adresseClub.'&cpClub='.$cpClub.'&villeClub='.$villeClub.'&telClub='.$telClub);
            }else{
                //Vérifier que le champ "Téléphone Club" ne soit pas vide
                if(empty($_POST['telClub'])){
                    header('location:trt_club_form.php?error=6&nomClub='.$nomClub.'&adresseClub='.$adresseClub.'&cpClub='.$cpClub.'&villeClub='.$villeClub);
                }else{
                    //Vérifier qu'une photo a bien été sélectionner et récupérer la valeur du champ "Nom sport"
                    if($_FILES['downloadPhotoClub']['error'] == 4){
                        header('location:trt_club_form.php?error=7&nomClub='.$nomClub.'&adresseClub='.$adresseClub.'&cpClub='.$cpClub.'&villeClub='.$villeClub.'&telClub='.$telClub);
                    }else{
                        if($_FILES['downloadPhotoClub']['error'] == 0){
                            //Dans le cas ou la photo est télécharger
                            copy( $_FILES['downloadPhotoClub']['tmp_name'] , "../image/club/".$_FILES['downloadPhotoClub']['name']);
                            //On prépare la requête
                            $sql = $bdd->prepare ("INSERT INTO club (photoClub, altPhotoClub, nomClub, nomPresidentClub, adresseClub, cpClub, villeClub, contactClub, telClub, emailClub, siteClub, googleMapsClub)
                            VALUES ( :photoClub, :altPhotoClub, :nomClub, :nomPresidentClub, :adresseClub, :cpClub, :villeClub, :contactClub, :telClub, :emailClub, :siteClub, :googleMapsClub)");

                                // On éxecute la requête «$sql»:
                                $sql->execute(array(
                                    'photoClub' => $photoClub,
                                    'altPhotoClub' => $altPhotoClub,
                                    'nomClub' => $nomClub,
                                    'nomPresidentClub' => $nomPresidentClub,
                                    'adresseClub' => $adresseClub,
                                    'cpClub' => $cpClub,
                                    'villeClub' => $villeClub,
                                    'contactClub' => $contactClub,
                                    'telClub' => $telClub,
                                    'emailClub' => $emailClub,
                                    'siteClub' => $siteClub,
                                    'googleMapsClub' => $googleMapsClub
                                ));
                                //On revient sur la page
                                header('location:../dashboard#form_club');
                            }

                            //Vérifier s'il y a une légende pour la photo
                            if(empty($_POST['altPhotoClub'])){

                                //On récupére le dernier enregistrement
                                $req = $bdd->prepare("SELECT MAX(ID_Club) As max FROM club");
                                $req-> execute();
                                $donnees = $req->fetch();
                                $max_ID_Club = $donnees['max'];

                                //On revient sur la page d'édition
                                header('location:../traitement/trt_club_form.php?error=8&id='.$max_ID_Club);
                            }
                        }
                    }
                }
            }
        }
    }
}elseif($_GET['method'] == 'delete'){

    /*---------------------------------------------------*/
    //Vérifier que le club ne soit pas affilié à des sport
    /*---------------------------------------------------*/
    $req = $bdd->prepare("SELECT * FROM sport_has_club  WHERE ID_Club = '".$_GET['id']."' ");
    $req->execute();
    $donnees = $req->fetch();
    
    //Compte le nombre de ligne dans la base de données
    $count = $req->rowcount();
    
        if($count>0){
            //echo $count;
            header("location:delete_club_form.php?error=1");
        
        }else{
            $req = $bdd->prepare("SELECT * FROM club_has_public  WHERE ID_Club = '".$_GET['id']."' ");
            $req->execute();
            $donnees = $req->fetch();
            
            //Compte le nombre de ligne dans la base de données
            $count = $req->rowcount();
            
                if($count>0){
                    //echo $count;
                    header("location:delete_club_form.php?error=1");
                }else{
                    /*----------------------------------*/
                    //Traitement pour supprimer un club
                    /*----------------------------------*/
                    $req = $bdd->prepare("SELECT * FROM club WHERE ID_Club = '".$_GET['id']."'");
                    $req->execute();
                    $donnees = $req->fetch();

                    $bdd -> exec ("DELETE FROM club WHERE ID_Club = '".$_GET['id']."'");

                    //On supprime image associée au sport
                    unlink("../image/club/".$donnees['photoClub']);

                    // On revient sur la page
                    header('location:../dashboard#form_club');
                }

            }

}else{

    /*----------------------------------------------*/
    //Traitement pour éditer un club
    /*----------------------------------------------*/
    $req = $bdd->prepare("SELECT * FROM club WHERE ID_Club = '".$_GET['id']."' ");
    $req -> execute();
    $donnees = $req->fetch();
    $photoClubEdit = $donnees['photoClub'];
    //var_dump($donnees);

    //Gestion de l'envoi et l'enregistrement de la photo
    if($_FILES['downloadPhotoClub']['error'] == 0)
    {
         //Dans le cas ou la photo est télécharger
        copy( $_FILES['downloadPhotoClub']['tmp_name'] , "../image/club/".$_FILES['downloadPhotoClub']['name']);
    }
        if($_FILES['downloadPhotoClub']['error'] == 0){

            $req = $bdd->prepare("UPDATE club SET photoClub='$photoClub', altPhotoClub='$altPhotoClub', nomClub='$nomClub', nomPresidentClub='$nomPresidentClub', adresseClub='$adresseClub',cpClub='$cpClub', villeClub='$villeClub', telClub='$telClub', emailClub='$emailClub', siteClub='$siteClub', googleMapsClub='$googleMapsClub' WHERE ID_Club ='".$_GET['id']."' ");
        }
        else
        {
            $req = $bdd->prepare("UPDATE club SET photoClub='$photoClubEdit', altPhotoClub='$altPhotoClub', nomClub='$nomClub', nomPresidentClub='$nomPresidentClub', adresseClub='$adresseClub',cpClub='$cpClub', villeClub='$villeClub', telClub='$telClub', emailClub='$emailClub', siteClub='$siteClub',googleMapsClub='$googleMapsClub' WHERE ID_Club ='".$_GET['id']."' ");

        }

    //Exécuter la requête
    $req -> execute();
    // On revient sur la page
    header('location:../dashboard#form_club');


}
?>