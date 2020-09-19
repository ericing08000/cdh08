<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/forgotMdp.css">
        <title>Mot de passe oublié</title>
    </head>

    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->    
        <?php include ('include/navbar.php');?>

        <!----------------------------------->
        <!-- Mot de passe oublié -->
        <!----------------------------------->
        <div class="forgotMdp_container">
            <div class="forgotMdp">
                    <div class="logo">
                        <img title="Handisport Comité Départemental des Ardennes" src="image/Logo/cdh08.png" alt="Logo Handisport des Ardennes">
                    </div>
                <hr>
                <div class="input"> 
                    <h3>Mot de passe oublié ?</h3>   
                        <form  method="post" action="">
                        <p>Entrez simplement votre adresse e-mail ci-dessous et nous vous enverrons un lien pour réinitialiser votre mot de passe !</p>
                            <input title="Renseigner votre email" placeholder="Email*" type="email" name="email" id="">
                            
                            <button title="Réinitialiser le mot de passe" type="submit">Réinitialiser le mot de passe</button>
                        </form>
                    <hr>
                        <div class="button">
                            <a href="sinscrire.php" title="Créer un compte !" id="btn_sinscrire_mdp">Créer un compte !</a>
                            <a href="seconnecter.php" title="Vous avez déjà un compte ? Se connecter !" id="btn_seconnecter_mdp">Vous avez déjà un compte ? Se connecter !</a>
                        </div>
                </div>  
            </div>
            <!-- Fin de class="forgotMdp" -->
        </div>
        <!-- Fin de class="fotgotMdp_container" -->

        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>
        
    </body>


</html>
