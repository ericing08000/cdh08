<!--------------------------------->
<!-- Connexion au server local  --->
<!--------------------------------->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php

$user = 'ericing';
$pass = 'Eric@ing%08000';

try{

    
    $bdd = new PDO('mysql:host=localhost:3308; dbname=test' , $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    //set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}catch(PDOException $e)
{
    print "Erreur :" . $e->getMessage() . "<br*>";
    die;
}



$req = $bdd->prepare('SELECT * FROM users');
$req->execute();

$donnees = $req->fetch();

echo"<pre>";
print_r($donnees);
echo"</pre>";

?>