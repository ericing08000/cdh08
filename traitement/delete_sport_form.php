<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/trt_delete_sport_form.css">
    <title>Traitement - Supprimer un sport</title>
</head>
<body>
    <div id="trt_delete_sport_form">
            <!------------------------->
            <!-- Gestion des erreurs -->
            <!------------------------->
            <?php
    
            if($_GET['error'] == 4) {?>
                <div class="error">
                    <h3>Le sport ne peut-être supprimé car il est affilié à des club. Veuillez tout d'abord en mode édition décocher le sport des club pour supprimer le sport définitivement.</h3>
                </div>
            <?php } ?>
            
            <div  class="trt_delete_sport_form">
                <div class="button">
                    <a href="../dashboard#form_sport"><button>Quitter</button></a>
                </div>
            </div>
        
    </div>
    <!-- fin de id="trt_bureau_form" -->
</body>
</html>