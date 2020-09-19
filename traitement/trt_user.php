<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------------------*/
//Traitement - Utilisateur
/*----------------------------------*/

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$pseudoUser = trim(htmlspecialchars(!empty($_POST['pseudoUser']) ? $_POST['pseudoUser'] : NULL, ENT_QUOTES));
$prenomUser = trim(htmlspecialchars(!empty($_POST['prenomUser']) ? $_POST['prenomUser'] : NULL, ENT_QUOTES));
$nomUser = trim(htmlspecialchars(!empty($_POST['nomUser']) ? $_POST['nomUser'] : NULL, ENT_QUOTES));
$ID_typeCompte = htmlspecialchars(!empty($_POST['ID_typeCompte']) ? $_POST['ID_typeCompte'] : NULL, ENT_QUOTES);
$telUser = htmlspecialchars(!empty($_POST['telUser']) ? $_POST['telUser'] : NULL, ENT_QUOTES);
$emailUser = trim(htmlspecialchars(!empty($_POST['emailUser']) ? $_POST['emailUser'] : NULL, ENT_QUOTES));
$mdpUser = trim(htmlspecialchars(!empty($_POST['mdpUser']) ? $_POST['mdpUser'] : NULL, ENT_QUOTES));

if($_GET['method'] == 'insert'){

    //Permet de savoir si le pseudo existe dans la base de données
    $req = $bdd->prepare("SELECT * FROM user WHERE pseudoUser = :pseudoUser");
    $req-> execute(array(
        'pseudoUser' => $pseudoUser
    ));
    
    //Compte le nombre de ligne dans la base de données
    $count = $req->rowcount();
    
    if($count>0){
        header('location:trt_user_form.php?error=1');
        
        
    }else{
        //Permet de savoir si le email existe dans la base de données
        $req = $bdd->prepare('SELECT * FROM user WHERE emailUser = :emailUser');
        $req-> execute(array(
            'emailUser' => $emailUser
        ));

        //Compte le nombre de ligne dans la base de données
        $count = $req->rowcount();
        if($count>0){
            header('location:trt_user_form.php?error=2');
        
        }else{
        // On prépare la requête dans une variable «$sql»: 
        $sql = $bdd->prepare ("INSERT INTO user (pseudoUser, prenomUser, nomUser, ID_typeCompte, telUser, emailUser, mdpUser )
        VALUES ( :pseudoUser, :prenomUser, :nomUser, :ID_typeCompte, :telUser, :emailUser, :mdpUser)");

        $password = password_hash($_POST['mdpUser'], PASSWORD_BCRYPT);

        // // On éxecute la requête «$sql»:
        $sql->execute(array(
            'pseudoUser' => $pseudoUser,
            'prenomUser' => $prenomUser,
            'nomUser' => $nomUser,
            'ID_typeCompte' => $ID_typeCompte,
            'telUser' => $telUser,
            'emailUser' => $emailUser,
            'mdpUser' => $password
        ));

        // On revient sur la page
        header('location:../dashboard#form_user');
        
        }
    
    }

}elseif($_GET['method'] == 'delete'){

    /*----------------------------------------------*/
    //Traitement pour supprimer un l'utilisateur
    /*----------------------------------------------*/
    $bdd -> exec ("DELETE FROM user WHERE ID_user = '".$_GET['id']."'");
    // On revient sur la page
    header('location:../dashboard#form_user');


}else{
    
    /*----------------------------------------------*/
    //Traitement pour éditer un l'utilisateur
    /*----------------------------------------------*/
    $password = password_hash($_POST['mdpUser'], PASSWORD_BCRYPT);
    $req = $bdd->prepare ("UPDATE user SET pseudoUser='$pseudoUser', prenomUser='$prenomUser', nomUser='$nomUser', ID_typeCompte='$ID_typeCompte', telUser='$telUser', emailUser='$emailUser',mdpUser='$password' WHERE ID_user ='".$_GET['id']."'");

    //Exécuter la requête
    $req -> execute();
    // On revient sur la page
    header('location:../dashboard#form_user');
}

?>