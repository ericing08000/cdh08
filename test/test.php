<!------------------------------------>
<!-- page test -->
<!------------------------------------>

<?php

require_once('../class/Database.php');

$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

$req = $bdd->prepare('SELECT * FROM bureau');
$req->execute();

$donnees = $req->fetch();

echo"<pre>";
print_r($donnees);
echo"</pre>";


?>

