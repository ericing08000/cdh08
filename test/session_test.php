<?php
SESSION_start();

//Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="fr" id="haut" style="margin-top: 85px">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        

        <title>test de session</title>
        <h3>vous êtes bien connecté</h3>
    </head>
    
    
    
    <body">
        
</body>
</html>

