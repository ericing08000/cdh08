<?php
session_start();

//Mettre le titre du bouton s'inscrire dans une variable
$btn_connect = '';

//Mettre la légende du bouton s'inscrire dans une variable
$alt_btn_connect = '';


if(isset($_SESSION['pseudoUser'])){
    

}else{
    //echo $_SESSION['pseudoUser'];
    // $btn_connect = $_SESSION['pseudoUser'];
    // $alt_btn_connect = $_SESSION['pseudoUser'];
}

?>

<!----------------------------------->
<!-- fichier css -->
<!----------------------------------->
<link rel="stylesheet" href="css/navbar.css">

<!----------------------------------->
<!-- Barre de navigation -->
<!----------------------------------->
<div class="navbar">
    <ul class="navbar-nav">
        <img title="Comité Départemental Handisport des Ardennes" class=navbar-img src="image/logo/cdh08.png" alt="logo Handisport">
        <li class="nav-item"><a href="index.php" id="btn_accueil" title="Retour à l'Accueil" class="nav-link">Accueil</a></li>
        <li class="nav-item"><a href="comite.php" id="btn_comite"title="Le Comité Handisport" class="nav-link">Le Comité Handisport</a></li>
        <li class="nav-item"><a href="club.php" id="btn_club"title="Nos clubs" class="nav-link">Nos clubs</a></li>
        <li class="nav-item"><a href="sport.php" id="btn_sport"title="Nos sports" class="nav-link">Nos sports</a></li>       
        <li class="nav-item"><a href="recyclerie.php" id="btn_recyclerie"title="Recyclerie" class="nav-link">Recyclerie</a></li>
        <li class="nav-item"><a href="evenement.php" id="btn_evenement"title="Les événements" class="nav-link">Les événements</a></li>
        <?php if(isset($_SESSION['type'])) {if($_SESSION['type'] == 1) {?><li class="nav-item"><a id="btn_dashboard" href="dashboard" class="nav-link">Tableau de bord</a></li><?php }} ?>
    </ul>

    <ul class="navbar-nav_2">
        <hr>

        <li class="nav-item"><a id="btn_contact" href="contact.php" title="Contactez-nous" class="nav-link_1">Contactez-nous</a></li>
        <li class="nav-item"><a id="btn_soutien" href="soutien.php" title="Faire un don" class="nav-link_2">Soutenez-nous</a></li>
        <hr>
        <!-- Si cette variable n'existe pas alors on affiche le bouton s'inscrire sinon on le cache  -->
        <?php if(!isset($_SESSION['pseudoUser'])){?>
        <li id="btn_sinscrire" class="nav-item"><a title="S'inscrire" class="nav-link_3">S'inscrire</a></li>
        <?php }else{?>
        <li style="display:none"></li>
        <?php }?>
        <!-- Si cette variable n'existe pas alors on affiche le bouton se connecter sinon on le cache -->
        <?php if(!isset($_SESSION['pseudoUser'])){?>
        <li id="btn_seconnecter_nav" class="nav-item"><a title="Se connecter" class="nav-link_4">Se connecter</a></li>
        <?php }else{?>
        <li style="display:none"></li>
        <?php }?>
        <!-- Si cette variable existe alors on affiche le bouton déconnexion et on reste sur la page -->
        <?php if(isset($_SESSION['pseudoUser'])) {?>
        <li id="btn_deconnecter_nav" class="nav-item"><a href="traitement/trt_deconnection.php?url=<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" title="Se déconnecter" class="nav-link_4">Déconnexion<br><?= ucfirst($_SESSION['prenomUser']);?></a></li>
        <?php }?>
    </ul>

    <div id="burger" >
        <a href="#" id="btn_dropmenu" title="Afficher le menu"><img src="image/icon/dropmenu1.png" alt="Afficher le menu"></a>
    </div>
    <!-- Fin de id="burger" -->
</div>
<!-- Fin de class="navbar" -->
<div id="modal_dropmenu" style="display:none">
    <div id="dropmenu" >
        <ul class="nav">
            <li class="nav-item"><a title="Retour à l'accueil" href="index.php" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a title="Le comité Handisport" href="comite.php" class="nav-link">Le comité Handisport</a></li>
            <li class="nav-item"><a title="Nos clubs" href="club.php" class="nav-link">Nos clubs</a></li>
            <li class="nav-item"><a title="Nos sports" href="sport.php" class="nav-link">Nos sports</a></li>
            <li class="nav-item"><a title="Recyclerie" href="recyclerie.php" class="nav-link">Recyclerie</a></li>
            <li class="nav-item"><a title="Les événements" href="evenement.php" id="btn_evenement" class="nav-link">Les événements</a></li>
        </ul>
        <hr>
        <ul class="nav">
            <li class="nav-item"><a title="Contactez-nous" href="contact.php" class="nav-link">Contactez-nous</a></li>
            <li class="nav-item"><a title="Soutenez-nous" href="soutien.php" class="nav-link">Soutenez-nous</a></li>
        </ul>
        <hr>
        <ul class="nav">
            <!-- Si cette variable n'existe pas alors on affiche le bouton s'inscrire sinon on le cache  -->
            <?php if(!isset($_SESSION['pseudoUser'])){?>
                <li id="btn_sinscrire_dropmenu" class="nav-item"><a title="S'inscrire" class="nav-link">S'inscrire</a></li>
            <?php }else{?>
            <li style="display:none"></li>
            <?php }?>
            <!-- Si cette variable n'existe pas alors on affiche le bouton se connecter sinon on le cache -->
            <?php if(!isset($_SESSION['pseudoUser'])){?>
                <li id="btn_seconnecter_dropmenu" class="nav-item"><a title="Se connecter" class="nav-link">Se connecter</a></li>
            <?php }else{?>
            <li style="display:none"></li>
            <?php }?>
            <!-- Si cette variable existe alors on affiche le bouton déconnexion et on reste sur la page -->
            <?php if(isset($_SESSION['pseudoUser'])) {?>
            <li id="btn_deconnecter_dropmenu" class="nav-item"><a href="traitement/trt_deconnection.php?url=<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" title="Se déconnecter" class="nav-link">Déconnexion - <?= ucfirst($_SESSION['prenomUser']);?></a></li>
            <?php }?>
            
        </ul>
    </div>
    <!-- Fin de id="dropmenu" -->
</div>
<!-- Fin de id="modal_dropmenu" -->


<!----------------------------->
<!-- Gestion des erreurs -->
<!----------------------------->   
<?php
//Vérifier s'il y a une variable error
    if(isset($_GET['success'])){
        if($_GET['success']==1){?>
            <div id="success_nav" class="success">
                <h3>Votre inscription a bien été enregistrée, vous pouvez vous connecter.</h3>    
            </div>    
        <?php }
            if($_GET['success']==2){?>
                <div id="success_nav" class="success">
                    <h3>Votre demande de prêt a bien été pris en compte.</h3>    
                </div>    
            <?php }
                if($_GET['success']==3){?>
                    <div id="success_nav" class="success">
                        <h3>Un email vous a été envoyé , vous pouvez réinitialiser votre mot de passe en cliquant sur le lien.</h3>    
                        </div>    
                        <?php }
                    
    }   
?>

<?php include ('include/sinscrire.php');?>
<?php include ('include/seconnecter.php');?>
<?php include ('include/forgotMdp.php');?>


<script src="js/jquery.js"></script>
<script src="js/dropmenu.js"></script>
<script src="js/modal_sinscrire.js"></script>       
<script src="js/modal_seconnecter.js"></script>
<script src="js/modal_forgotMdp.js"></script>
<script src="js/modal_seconnecter_nav.js"></script>
