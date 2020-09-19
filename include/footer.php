<!----------------------------------->
<!-- fichier css -->
<!----------------------------------->
<link rel="stylesheet" href="css/footer.css">

<!----------------------------------->
<!-- Footer -->
<!----------------------------------->

<div id="footer" class="footer">

    <!-------------------------->
    <!-- section partie 1 -->
    <!-------------------------->
    <section class="footer1">
        <a href="index.php" class="lien-image"><img title="Comité Départemental Handisport des Ardennes" class=navbar-img src="image/logo/cdh08.png" alt="logo Handisport"></a>
        <ul class="nav">
            <li class="item">
                <a title="Le Comité Handipsort" href="comite" class="link">Le Comité Handipsort</a>
            </li>
            <li class="item">
                <a title="Nos clubs" href="sport.php#club" class="link">Nos clubs</a>
            </li>
            <li class="item">
                <a title="Nos sports" href="sport.php" class="link">Nos sports</a>
            </li>
            <li class="item">
                <a title="Recyclerie" href="recyclerie" class="link">Recyclerie</a>
            </li>
        </ul>
        <hr>
    </section>
    
    <!-------------------------->
    <!-- section partie 2 -->
    <!-------------------------->
    <section class="footer2">
        <ul class="nav">
            <li class="item">
                <a title="Contactez-nous" href="contact" class="link">Contactez-nous</a>
            </li>
            <li class="item">
                <a title="Faire un don" href="soutien" class="link">Soutenez-nous</a>
            </li>
        </ul>
        <hr>
    </section>

    <!-------------------------->
    <!-- section partie 3 -->
    <!-------------------------->
    <section class="footer3">
        <ul class="nav">
            <li title="Horaires d’ouverture au public" class="item" style="font-style:italic;">Horaires d’ouverture au public :</li>
            <li title="Du Lundi au vendredi : 08h30 - 12h00 et 13h30 - 17h:00" class="item">Du Lundi au vendredi : 08h30 - 12h00 et 13h30 - 17h00</li>
            <li title="Téléphone : 03.24.36.61.37" class="item">Téléphone : 03.24.36.61.37</li>
        </ul>
        <hr>
    </section>

    <!-------------------------->
    <!-- section partie 4 -->
    <!-------------------------->
    <section class="footer4">
        <ul class="nav">
            <li class="item" style="font-style:italic;">Communauté :</li>
            <li class="item">
                <a title="Suivez-nous sur Facebook" href="https://fr-fr.facebook.com/comite.handisportardennes/" target="_blank"><img class="facebook" src="image/logo/facebook.png" alt="Facebook"></a>
                <a title="Suivez-nous sur Instagram" href="https://www.instagram.com/handisport_ardennes/?hl=fr" target="_blank" ><img class="instagram" src="image/logo/instagram.png" alt="Instagram"></a>
            </li>
        </ul>

    </section>
    
    <!-------------------------->
    <!-- footer partie 5 -->
    <!-------------------------->
    <footer class="footer5">
        <h4>&copy Comité Départemental Handisport Des Ardennes</h4>
        <div>
        <a id="top" href="#" title="Retour en haut de la page"><img class="back" src="image/icon/retourHaut.png" alt="retour en haut de la page"></a>
    </div>
    </footer>
</div>

<!-- //Remonter en haut de page  -->
<script>
    $(function (){ 
        $('#top').click(function ()  
        { 
            $('html, body').animate({ 
                scrollTop: '0px' 
            }, 
            1500); 
            return false; 
        }); 
    });
</script>