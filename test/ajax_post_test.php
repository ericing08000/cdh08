<!DOCTYPE html>
<html lang="fr" id="haut" style="margin-top: 85px">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Envoyer les données par POST </title>
        
    </head>
    
    <body">
        
     <div class="container">
            <h1>Ajax - Envoyer des données par POST</h1>
    <p>
        Login : <input type="text" id="login" name="login"><br><br>
        Mot de passe : <input type="password" id="mdp" name="mdp">
    </p>
            <button class="ajax_get" id="ajax_get">Hello World</button>
            <button class="ajax_post" id="ajax_post">$.post</button>

            <div id="resultat"></div>
     </div>
    
    </body>
<script src="../js/jquery.js"></script>
<script src="../js/ajax_get.js"></script>
</html>