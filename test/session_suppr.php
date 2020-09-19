<?php
SESSION_start();
?>

<!DOCTYPE html>
<html lang="fr" id="haut" style="margin-top: 85px">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        

        <title>Supprimer la session</title>
        
    </head>
    <?php

    unset($_SESSION['user']);

    if(isset($_SESSION['user'])) echo 'Votre session est'.' '.$_SESSION['user'];
    
    ?>
    
    <body">
        <h3>la session a bien été supprimée</h3>
        <a href="../index.php">retour</a>
</body>
</html>

