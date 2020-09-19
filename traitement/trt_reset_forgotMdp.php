<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

/*----------------------------------*/
//Traitement - Réinitialisation mdp
/*----------------------------------*/

$id = $_GET['id'];

//On vérifie que les «inputs» ne soient pas vides avant d’enregistrer dans la bdd :
$mdpUser = htmlspecialchars(!empty($_POST['mdpUser']) ? $_POST['mdpUser'] : NULL, ENT_QUOTES);
$confirmMdpUser = htmlspecialchars(!empty($_POST['confirmMdpUser']) ? $_POST['confirmMdpUser'] : NULL, ENT_QUOTES);

echo $mdpUser;
echo $confirmMdpUser;

//Rechercher l'utilisateur dans la base de données
$search = $bdd->prepare("SELECT * FROM user WHERE ID_user = '".$_GET['id']."' ");
$search-> execute();

$data_search = $search->fetch();

$pseudoUser = $data_search['pseudoUser'];
$prenomUser = $data_search['prenomUser'];
$nomUser =  $data_search['nomUser'];
$ID_typeCompte = $data_search['ID_typeCompte'];
$telUser = $data_search['telUser'];
$emailUser = $data_search['emailUser'];
//Mettre dans une variable les nombres de lignes d'enregistrements    
$count  = $search->rowcount();

if($confirmMdpUser !== $mdpUser){
     
    header('location:../traitement/trt_reset_forgotMpd_form.php?id='.$id.'&error=1');
    
}else{

    if($count > 0){

        echo $data_search['nomUser'];
        /*----------------------------------------------*/
        //Traitement pour éditer un l'utilisateur
        /*----------------------------------------------*/
        $password = password_hash($_POST['mdpUser'], PASSWORD_BCRYPT);
        $req = $bdd->prepare ("UPDATE user SET 
            pseudoUser='$pseudoUser',
            prenomUser='$prenomUser',
            nomUser='$nomUser',
            ID_typeCompte='$ID_typeCompte',
            telUser='$telUser',
            emailUser='$emailUser',
            mdpUser='$password' WHERE ID_user ='".$_GET['id']."'");

        //Exécuter la requête
        $req -> execute();
        
        // On revient sur la page
        header('location:../traitement/trt_reset_forgotMpd_form.php?id='.$id.'&success=1');
        
    }
}

?>