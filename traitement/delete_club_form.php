<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/trt_delete_club_form.css">
    <title>Traitement - Supprimer un club</title>
</head>
<body>
    <div id="trt_delete_club_form">
            <!------------------------->
            <!-- Gestion des erreurs -->
            <!------------------------->
            <?php
    
            if($_GET['error'] == 1) {?>
                <div class="error">
                    <h3>Le club ne peut-être supprimé car il est affilié à des sports et au public accueilli. Veuillez tout d'abord en mode édition décocher les sports du club et le public accueilli pour supprimer le club définitivement.</h3>
                </div>
            <?php } ?>

            <div  class="trt_delete_club_form">
                <div class="button">
                    <a href="../dashboard#form_club"><button>Quitter</button></a>
                </div>
            </div>
        
    </div>
    <!-- fin de id="trt_bureau_form" -->
</body>
</html>