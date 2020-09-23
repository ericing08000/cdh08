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
$nomEvenement = trim(htmlspecialchars(!empty($_POST['nomEvenement']) ? $_POST['nomEvenement'] : NULL, ENT_QUOTES));
$lieuEvenement = trim(htmlspecialchars(!empty($_POST['lieuEvenement']) ? $_POST['lieuEvenement'] : NULL, ENT_QUOTES));
$dateDebutEvenement = htmlspecialchars(!empty($_POST['dateDebutEvenement']) ? $_POST['dateDebutEvenement'] : NULL, ENT_QUOTES);
$dateFinEvenement = htmlspecialchars(!empty($_POST['dateFinEvenement']) ? $_POST['dateFinEvenement'] : '0000-00-00' , ENT_QUOTES);
$txtEvenement = trim(htmlspecialchars(!empty($_POST['txtEvenement']) ? $_POST['txtEvenement'] : NULL, ENT_QUOTES));
$activiteEvenement = trim(htmlspecialchars(!empty($_POST['activiteEvenement']) ? $_POST['activiteEvenement'] : NULL, ENT_QUOTES));
$participantEvenement = trim(htmlspecialchars(!empty($_POST['participantEvenement']) ? $_POST['participantEvenement'] : NULL, ENT_QUOTES));

// echo($lieuEvenement);
// echo($dateDebutEvenement);
// echo($dateFinEvenement);
// echo($txtEvenement);
// echo($activiteEvenement);
// echo($participantEvenement);


if($_GET['method'] == 'insert'){
   
    //Vérifier que le champ "Nom événement" ne soit pas vide
    if(empty($_POST['nomEvenement'])){
         header('location:trt_evenement_form.php?error=1&nom='.$nomEvenement.'&lieu='.$lieuEvenement.'&dateDebut='.$dateDebutEvenement.'&txt='.$txtEvenement);
    }else{
        if(empty($_POST['lieuEvenement'])){
            header('location:trt_evenement_form.php?error=2&nom='.$nomEvenement.'&lieu='.$lieuEvenement.'&dateDebut='.$dateDebutEvenement.'&txt='.$txtEvenement);
        }else{
            if(empty($_POST['dateDebutEvenement'])){
                header('location:trt_evenement_form.php?error=3&nom='.$nomEvenement.'&lieu='.$lieuEvenement.'&dateDebut='.$dateDebutEvenement.'&txt='.$txtEvenement);
                        
            }else{
                if($_POST['dateDebutEvenement'] < date('Y-m-d')){
                    header('location:trt_evenement_form.php?error=5&nom='.$nomEvenement.'&lieu='.$lieuEvenement.'&dateDebut='.$dateDebutEvenement.'&txt='.$txtEvenement);
                            
                }else{
                    if(empty($_POST['txtEvenement'])){
                        header('location:trt_evenement_form.php?error=4&nom='.$nomEvenement.'&lieu='.$lieuEvenement.'&dateDebut='.$dateDebutEvenement.'&txt='.$txtEvenement);
                                
                    }else{
                        //Préparation de requête pour l'insertion
                        $sql = $bdd->prepare ("INSERT INTO evenement (nomEvenement, lieuEvenement, dateDebutEvenement, dateFinEvenement, txtEvenement, activiteEvenement, participantEvenement)
                        VALUES (:nomEvenement, :lieuEvenement, :dateDebutEvenement, :dateFinEvenement, :txtEvenement, :activiteEvenement, :participantEvenement)");
                        //On éxecute la requête «$sql»:
                        $sql->execute(array(
                            'nomEvenement' => $nomEvenement,
                            'lieuEvenement' => $lieuEvenement,
                            'dateDebutEvenement' => $dateDebutEvenement,
                            'dateFinEvenement' => $dateFinEvenement,
                            'txtEvenement' => $txtEvenement,
                            'activiteEvenement' => $activiteEvenement,
                            'participantEvenement' => $participantEvenement

                        ));
                        
                        //On revient sur la page
                        header('location:../dashboard#form_evenement');
                    }
                }
            }
        }
    }            
    
}elseif($_GET['method'] == 'delete'){
    
        /*----------------------------------------------*/
        //Traitement pour supprimer un sport
        /*----------------------------------------------*/        
        $bdd -> exec ("DELETE FROM evenement WHERE ID_Evenement = '".$_GET['id']."'");
        
       
        // On revient sur la page
        header('location:../dashboard#form_evenement');
        
    }
    else
    {
        /*----------------------------------------------*/
        //Traitement pour éditer un événement
        /*----------------------------------------------*/
        $req = $bdd->prepare("SELECT * FROM evenement WHERE ID_Evenement = '".$_GET['id']."'");
        $req -> execute();
        $donnees = $req->fetch();
    
        $req = $bdd->prepare ("UPDATE evenement SET nomEvenement='$nomEvenement', lieuEvenement = '$lieuEvenement', dateDebutEvenement ='$dateDebutEvenement', dateFinEvenement='$dateFinEvenement', txtEvenement ='$txtEvenement', activiteEvenement='$activiteEvenement', participantEvenement='$participantEvenement' WHERE ID_Evenement ='".$_GET['id']."'"); 
    }
        //Exécuter la requête
        $req -> execute();

        // On revient sur la page
        header('location:../dashboard#form_evenement');   

        
        
        
        
        
        
        
?>