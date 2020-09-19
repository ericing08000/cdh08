<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------------------*/
//Traitement - Visiteur
/*----------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$nomContact = !empty($_POST['nomContact']) ? $_POST['nomContact'] : NULL;
$prenomContact = !empty($_POST['prenomContact']) ? $_POST['prenomContact'] : NULL;
$sujetContact = !empty($_POST['sujetContact']) ? $_POST['sujetContact'] : NULL;
$messageContact = !empty($_POST['messageContact']) ? $_POST['messageContact'] : NULL;

// echo $nomContact;
// echo $prenomContact;
// echo $sujetContact;
// echo $messageContact;

if (empty($nomContact)){
    header('location:../contact.php?error=1&nomContact='.$nomContact.'&prenomContact='.$prenomContact.'&sujetContact='.$sujetContact.'&messageContact='.$messageContact.'#error');
}else{
        if (empty($prenomContact)){
            header('location:../contact.php?error=2&nomContact='.$nomContact.'&prenomContact='.$prenomContact.'&sujetContact='.$sujetContact.'&messageContact='.$messageContact.'#error');
        }else{
            if (empty($sujetContact)){
                header('location:../contact.php?error=3&nomContact='.$nomContact.'&prenomContact='.$prenomContact.'&sujetContact='.$sujetContact.'&messageContact='.$messageContact.'#error');
            }else{
                if (empty($messageContact)){
                    header('location:../contact.php?error=4&nomContact='.$nomContact.'&prenomContact='.$prenomContact.'&sujetContact='.$sujetContact.'&messageContact='.$messageContact.'#error');
                }else{
                 
                //Envoyer le message par mail
                $mailTo = "aristo08000@gmail.com";
                $headers = "$nomContact $prenomContact";

                mail($mailTo, $sujetContact,  $messageContact, $headers );

                // On revient sur la page
                header('location:../contact.php?success=1#success');
                }
            }
        }
    }



?>