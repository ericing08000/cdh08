<?php
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

$fiche_pedagogique = $bdd->prepare("SELECT * FROM sport WHERE ID_Sport = '".$_GET['id']."'");
$fiche_pedagogique ->execute(array());
$data_fiche_pedagogique = $fiche_pedagogique->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche pédagogique</title>
</head>
<body style="margin:0">
    <?php if(isset($data_fiche_pedagogique['pdfSport'])){?>
    <iframe src="<?= $data_fiche_pedagogique['pdfSport'];?>?#zoom=78" type="application/pdf" style="width:100%; height:99vh"></iframe>
    
    <?php }else{?><p>Pas de fiche pédagogique pour ce sport</p><?php }?>
</body>
</html>