<?php

session_start();
//echo $_SESSION['type'];

if(!isset($_SESSION['type'])){
    header('location:index.php');
}else{

    if($_SESSION['type'] != 1){
        header('location:index.php');
    }
}
    

//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();
?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Tableau de bord</title>
</head>

<body>
    <div id="dashboard_container">
        
        <!--==============================-->
        <!-- Barre de navigation -->
        <!--==============================-->
        <div id="dashboard_navbar">
            <!-- Container User -->
            <div class="user">
                <img src="image/Icon/user01.png" alt="">
                <p><?= $_SESSION['prenomUser'];?></p>
            </div>
            <hr>
            <div class="user">
                <img src="image/Icon/dashboard.png" alt="">
                <p>Tableau de bord</p>
            </div>
            <hr>
            <ul id="dashboard_link">
                <li title="Le comité" ><a id="btn_form_comite" href="#form_bureau">Le Bureau</a></li>
                <li title="Le comité" ><a id="btn_form_comite" href="#form_equipe">L'équipe</a></li>
                <li title="Les clubs" ><a id="btn_form_club" href="#form_club">Les clubs</a></li>
                <li title="Les sports" ><a id="btn_form_sport" href="#form_sport">Les sports</a></li>
                <li title="La recyclerie" ><a id="btn_form_recyclerie"  href="#form_recyclerie">La recyclerie</a></li>
                <li title="les événement" ><a id="btn_form_evenement" href="#form_evenement">Les événements</a></li>
                <!-- <li title="La galerie" ><a id="btn_form_galerie" href="#form_galerie">La galerie</a></li> -->
                <li title="Les partenaires" ><a id="btn_form_partenaire" href="#form_partenaire">Les partenaires</a></li>
                <li title="Les utilisateurs" ><a id="btn_form_user" href="#form_user">Les utilisateurs</a></li>
                <li title="retour" ><a href="index.php">Retour</a></li>
            </ul>

        </div>
        <!-- fin de id="dashboard_navbar" -->

        <!-- Container Main -->
        <div id="dashboard_main">

            <!-- header -->
            <div class="header">
                <hr>
            </div>
            
            <div id="dashboard_content"> 
                <!--==============================-->  
                <!-- formulaire - Évènement -->
                <!--==============================-->
                <div id="form_evenement">
                    <div id="table">  
                        <?php
                            $req = $bdd->prepare("SELECT * FROM evenement");
                            $req -> execute();
                            $countEvenement = $req->rowcount();
                        ?>
                        <h3 style="text-align:center">- GESTION DES ÉVÈNEMENTS - Nombre d'évènement(s) : <?= $countEvenement ?></h3> 
                    
                        <div class="table">
                            <table>
                                <tr>
                                    <th id="large">Nom</th>
                                    <th id="petit">Date début</th>
                                    <th id="petit">Date fin</th>
                                    <th id="large">Lieu</th>
                                    <th id="large">Activité(s) proposée(s)</th>
                                    <th id="petit">Éditer</th>
                                    <th id="petit">Supprimer</th>
                                </tr>
                            
                                <?php
                                //--------------------------------------------
                                //-- Préparer le requête pour les évènements 
                                //--------------------------------------------
                                $req = $bdd->prepare("SELECT * FROM evenement");
                                $req -> execute();
                                while($donnees = $req->fetch()){
                                    //Afficher le résultat de la requête
                                    //var_dump($donnees);    
                                    ?>
                                    <tr>
                                        <td><?= $donnees['nomEvenement'];?></td>
                                        <!----------------------->
                                        <!-- Gestion des dates -->
                                        <!----------------------->
                                        <?php
                                            setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                                            $dateDebut = strtotime($donnees['dateDebutEvenement']);
                                            $dateFin = strtotime($donnees['dateFinEvenement']);
                                        ?>
                                        <td><?= strftime("%d/%m/%Y", $dateDebut);?></td>
                                        <td><?php if($donnees['dateFinEvenement'] != '0000-00-00'){ echo strftime("%d/%m/%Y", $dateFin);}?></td>
                                        
                                        <td><?= $donnees['lieuEvenement'];?></td>
                                        <td><?= $donnees['activiteEvenement'];?></td>
                                        <td><a title="Éditer : <?= $donnees['nomEvenement'];?>" href="traitement/trt_evenement_form.php?id=<?= $donnees['ID_Evenement'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                        <td><a title="Supprimer : <?= $donnees['nomEvenement'];?>" href="traitement/trt_evenement_form.php?id=<?= $donnees['ID_Evenement'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                    </tr>

                                <?php   }   ?>
                            </table>
                        </div>
                        <!-- Fin de class="table_body" -->
                        <a title="Ajouter un évènement" href="traitement/trt_evenement_form.php"><button>Ajouter un événement</button></a>
                    </div>     
                </div>

                <!--==============================-->
                <!-- formulaire - Le bureau -->
                <!--==============================-->
                <div id="form_bureau">
                    <div id="table">
                    <h3 style="text-align:center">- GESTION DU BUREAU -</h3>
                        <div class="table">
                            <table>
                                <tr>
                                    <th id="large">Prénom</th>
                                    <th id="large">Nom</th>
                                    <th id="large">Désignation</th>
                                    <th id="large">Photo</th>
                                    <th id="petit">Status</th>
                                    <th id="petit">Éditer</th>
                                    <th id="petit">Supprimer</th>
                                </tr>
                            
                                <?php
                                //--------------------------------------------
                                //-- Préparer le requête pour le Bureau 
                                //--------------------------------------------
                                $req = $bdd->prepare("SELECT * FROM bureau");
                                $req -> execute();
                                while($donnees = $req->fetch()){
                                    //Afficher le résultat de la requête
                                    //var_dump($donnees);    
                                    ?>
                                    <tr>
                                        <td><?= $donnees['prenomBureau']; ?></td>
                                        <td><?= $donnees['nomBureau']; ?></td>
                                        <td><?= $donnees['designationBureau'];?></td>
                                        <td><img class="photo" title="<?= $donnees['altPhoto'];?>" src="image/photo/<?= $donnees['photoBureau'];?>" alt=""></td>
                                        <td><?php if($donnees['statusBureau'] == 1){ echo 'Actif';}else{echo'Inactif';};?></td>
                                        <td><a title="Éditer : <?= $donnees['prenomBureau']." ".$donnees['nomBureau'];?>" href="traitement/trt_bureau_form.php?id=<?= $donnees['ID_Bureau'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                        <td><a title="Supprimer : <?= $donnees['prenomBureau']." ".$donnees['nomBureau'];?>" href="traitement/trt_bureau_form.php?id=<?= $donnees['ID_Bureau'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                    </tr>

                                <?php   }   ?>
                            </table>
                        </div>
                        <!-- Fin de class="table_body" -->
                        <a title="Ajouter un membre" href="traitement/trt_bureau_form.php"><button>Ajouter un membre</button></a>
                    </div>
                </div>
                
                <!--==============================-->
                <!-- formulaire - L'équipe' -->
                <!--==============================-->
                <div id="form_equipe">
                    <div id="table">
                        <h3 style="text-align:center">- GESTION DE L'ÉQUIPE -</h3>
                        <div class="table">
                            <table>
                                
                                <tr>
                                    <th id="large" >Prénom</th>
                                    <th id="large" >Nom</th>
                                    <th id="large" >Désignation</th>
                                    <th id="large" >Photo</th>
                                    <th id="petit" >Status</th>
                                    <th id="petit" >Éditer</th>
                                    <th id="petit" >Supprimer</th>
                                </tr>
                            
                                <?php
                                //-------------------------------------------
                                //-- Préparer le requête pour l'Equipe
                                //-------------------------------------------
                                $req = $bdd->prepare("SELECT * FROM equipe");
                                $req -> execute();
                                while($donnees = $req->fetch()){
                                    //Afficher le résultat de la requête
                                    //var_dump($donnees);    
                                    ?>
                                    <tr>
                                        <td><?= $donnees['prenomEquipe']; ?></td>
                                        <td><?= $donnees['nomEquipe']; ?></td>
                                        <td><?= $donnees['designationEquipe'];?></td>
                                        <td><img class="photo" title="<?= $donnees['altPhotoEquipe'];?>" src="image/photo/<?= $donnees['photoEquipe'];?>" alt=""></td>
                                        <td><?php if($donnees['statusEquipe'] == 1){ echo 'Actif';}else{echo'Inactif';};?></td>
                                        <td><a title="Éditer : <?= $donnees['prenomEquipe']." ".$donnees['nomEquipe'];?>" href="traitement/trt_equipe_form.php?id=<?= $donnees['ID_Equipe'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                        <td><a title="Supprimer : <?= $donnees['prenomEquipe']." ".$donnees['nomEquipe'];?>" href="traitement/trt_equipe_form.php?id=<?= $donnees['ID_Equipe'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                    </tr>
                                <?php   }   ?>
                            </table>    
                        </div>
                        <a title="Ajouter un membre d'équipe" href="traitement/trt_equipe_form.php"><button>Ajouter un membre d'équipe</button></a>  
                    </div>    
                    </div>

                <!--==============================-->                    
                <!-- formulaire - Les clubs-->
                <!--==============================-->
                <div id="form_club">
                    <div id="table">
                        <?php
                            $req = $bdd->prepare("SELECT * FROM club");
                            $req -> execute();
                            $countClub = $req->rowcount();
                        ?>
                        <h3 style="text-align:center">- GESTION DES CLUBS - Nombre de Club(s) : <?= $countClub ?></h3>

                        <div class="table">
                            <table>
                                <tr>
                                    <th id="large">Nom du club</th>
                                    <th id="large">Adresse</th>
                                    <th id="petit">Code Postal</th>
                                    <th id="large">Ville</th>
                                    <th>Téléphone</th>
                                    <th id="large">Email</th>
                                    <th id="petit">Éditer</th>
                                    <th id="petit">Supprimer</th>

                                </tr>
                                <?php
                                //-------------------------------------------
                                //-- Préparer le requête pour les Clubs
                                //-------------------------------------------
                                $req = $bdd->prepare("SELECT * FROM club ORDER BY nomClub");
                                $req -> execute();
                                while($donnees = $req->fetch()){
                                    //Afficher le résultat de la requête
                                    //var_dump($donnees);    
                                ?>    
                                    <tr>
                                        <td><?= $donnees['nomClub'];?></td>
                                        <td><?= $donnees['adresseClub']; ?></td>
                                        <td><?= $donnees['cpClub']; ?></td>
                                        <td><?= $donnees['villeClub']; ?></td>
                                        <td><?= $donnees['telClub']; ?></td>
                                        <td><?= $donnees['emailClub']; ?></td>
                                        <td><a title="Éditer : <?= $donnees['nomClub'];?>" href="traitement/trt_club_form.php?id=<?= $donnees['ID_Club'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                        <td><a title="Supprimer : <?= $donnees['nomClub'];?>" href="traitement/trt_club_form.php?id=<?= $donnees['ID_Club'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                    </tr>
                                    <?php   }   ?>
                            </table>
                        </div>
                        <a title="Ajouter un club" href="traitement/trt_club_form.php"><button>Ajouter un club</button></a>
                    </div>
                </div>

                <!--==============================-->
                <!-- formulaire - Les sports-->
                <!--==============================-->
                <div id="form_sport">
                <div id="table">
                        <?php
                            // Requête pour totaliser les sports
                            $req = $bdd->prepare("SELECT * FROM sport");
                            $req -> execute();
                            $countSport = $req->rowcount();
                        ?>
                        
                        <h3 style="text-align:center">- GESTION DES SPORTS - Nombre de Sport(s) : <?= $countSport ?></h3>
                        
                        <div class="table">
                            <table>
                                    <tr>
                                        <th >Nom du sport</th>
                                        <th >Photo / Pictogramme</th>
                                        <th id="petit" >Éditer</th>
                                        <th id="petit" >Supprimer</th>
                                    </tr>
                                    <?php
                                    //-------------------------------------------
                                    //-- Préparer le requête pour les Sports
                                    //-------------------------------------------
                                    $req = $bdd->prepare("SELECT * FROM sport ORDER BY nomSport");
                                    $req -> execute();
                                    while($donnees = $req->fetch()){
                                        //Afficher le résultat de la requête
                                        //var_dump($donnees);    
                                        ?>
                                        <tr>
                                            <td><?= $donnees['nomSport']; ?></td>
                                            <td><img class="photo" title="<?= $donnees['altPhotoSport'];?>" src="image/sport/<?= $donnees['photoSport'];?>" alt=""></td>
                                            <td><a title="Éditer : <?= $donnees['nomSport'];?>" href="traitement/trt_sport_form.php?id=<?= $donnees['ID_Sport'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                            <td><a title="Supprimer : <?= $donnees['nomSport'];?>" href="traitement/trt_sport_form.php?id=<?= $donnees['ID_Sport'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                        </tr>
                                    <?php   }   ?>
                            </table>
                        </div>
                        <a title="Ajouter un sport" href="traitement/trt_sport_form.php"><button>Ajouter un sport</button></a>
                    </div>          
                </div>

                <!--==============================-->
                <!-- formulaire - La recyclerie-->
                <!--==============================-->
                <div id="form_recyclerie">
                    <div id="table">
                        <?php
                            $req = $bdd->prepare("SELECT * FROM recyclerie");
                            $req -> execute();
                            $countMateriel = $req->rowcount();
                        ?>
                        <h3 style="text-align:center">- GESTION DE LA RECYCLERIE - Nombre de matériel(s) : <?= $countMateriel ?></h3>
                        <div class="table">
                            <table>
                                <tr>
                                    <th>Nom du matériel</th>
                                    <th>Photo</th>
                                    <th id="petit" >Quantité</th>
                                    <th id="petit" >Éditer</th>
                                    <th id="petit" >Supprimer</th>
                                </tr>
                                <?php
                                    //-------------------------------------------
                                    //-- Préparer le requête pour la recyclerie
                                    //-------------------------------------------
                                    $req = $bdd->prepare("SELECT * FROM recyclerie ORDER BY nomMateriel");
                                    $req -> execute();
                                    while($donnees = $req->fetch()){
                                        //Afficher le résultat de la requête
                                        //var_dump($donnees);    
                                        ?>
                                        <tr>
                                            <td><?= $donnees['nomMateriel']; ?></td>
                                            <td><img class="photo" title="<?= $donnees['altPhotoMateriel'];?>" src="image/recyclerie/<?= $donnees['photoMateriel'];?>" alt=""></td>
                                            <td><?= $donnees['quantiteMateriel']; ?></td>
                                            <td><a title="Éditer : <?= $donnees['nomMateriel'];?>" href="traitement/trt_recyclerie_form.php?id=<?= $donnees['ID_Recyclerie'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                            <td><a title="Supprimer : <?= $donnees['nomMateriel'];?>" href="traitement/trt_recyclerie_form.php?id=<?= $donnees['ID_Recyclerie'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                        </tr>
                                    <?php   }   ?>
                                <tr>
                            </table>
                        </div>
                        <a title="Ajouter un matériel" href="traitement/trt_recyclerie_form.php"><button>Ajouter un matériel</button></a>
                    </div>
                </div>

                <!--==============================-->
                <!-- formulaire - La galerie-->
                <!--==============================-->
                <div id="form_galerie">
                        <h2>Formulaire - La galerie</h2>
                </div>


                <!--==============================-->
                <!-- formulaire - Les partenaires-->
                <!--==============================-->
                <div id="form_partenaire">
                <div id="table">
                        <?php
                            // Requête pour totaliser les sports
                            $req = $bdd->prepare("SELECT * FROM partenaire");
                            $req -> execute();
                            $countPartenaire = $req->rowcount();
                        ?>
                        <h3 style="text-align:center">- GESTION DES PARTENAIRES - Nombre de Partenaire(s) : <?= $countPartenaire ?></h3>
                        
                        <div class="table">
                            <table>
                                    <tr>
                                        <th >Nom du partenaire</th>
                                        <th >Photo</th>
                                        <th id="petit" >Éditer</th>
                                        <th id="petit" >Supprimer</th>
                                    </tr>
                                    <?php
                                    //-------------------------------------------
                                    //-- Préparer le requête pour les Sports
                                    //-------------------------------------------
                                    $req = $bdd->prepare("SELECT * FROM partenaire ORDER BY nomPartenaire");
                                    $req -> execute();
                                    while($donnees = $req->fetch()){
                                        //Afficher le résultat de la requête
                                        //var_dump($donnees);    
                                        ?>
                                        <tr>
                                            <td><?= $donnees['nomPartenaire']; ?></td>
                                            <td><img class="photo" title="<?= $donnees['altPhotoPartenaire'];?>" src="image/partenaire/<?= $donnees['photoPartenaire'];?>" alt=""></td>
                                            <td><a title="Éditer : <?= $donnees['nomPartenaire'];?>" href="traitement/trt_partenaire_form.php?id=<?= $donnees['ID_Partenaire'];?>"><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                            <td><a title="Supprimer : <?= $donnees['nomPartenaire'];?>" href="traitement/trt_partenaire_form.php?id=<?= $donnees['ID_Partenaire'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                        </tr>
                                    <?php   }   ?>
                            </table>
                        </div>
                        <a title="Ajouter un partenaire" href="traitement/trt_partenaire_form.php"><button>Ajouter un partenaire</button></a>
                    </div>          
                </div>

                <!--==============================-->                           
                <!-- formulaire - Les utilisateurs-->
                <!--==============================-->
                <div id="form_user">
                    <div id="table">
                        <?php
                            $req = $bdd->prepare("SELECT * FROM user");
                            $req -> execute();
                            $countUser = $req->rowcount();
                        ?>
                        <h3 style="text-align:center">- GESTION DES UTILISATEURS - Nombre d'utilisateur(s) : <?= $countUser ?></h3>
                        <div class="table">
                            <table>
                                <tr>
                                    <th id="large">Pseudo</th>
                                    <th id="large">Prénom</th>
                                    <th id="large">Nom</th>                                    
                                    <th id="petit">Type de compte</th>
                                    <th id="petit">Téléphone</th>
                                    <th id="large">Email</th>
                                    <!-- <th id="large">Mot de passe</th> -->
                                    <th id="petit" >Éditer</th>
                                    <th id="petit" >Supprimer</th>
                                </tr>

                            <?php
                                //----------------------------------
                                //------ Préparer le requête
                                //----------------------------------
                                $req = $bdd->prepare("SELECT u.ID_user, u.pseudoUser, u.prenomUser, u.nomUser, tp.nomTypeCompte,u.telUser, u.emailUser, u.mdpUser, tp.ID_typeCompte FROM user AS u, type_compte AS tp WHERE u.ID_typeCompte=tp.ID_typeCompte ORDER BY u.pseudoUser");
                                $req -> execute();
                                //------------------------------
                                // Boucle pour remplir la table 
                                //------------------------------
                                while($donnees = $req->fetch()){
                                //Afficher le résultat de la requête
                                //var_dump($donnees);    
                                ?>
                                
                                <tr>
                                    <td><?= $donnees['pseudoUser']; ?></td>
                                    <td><?= $donnees['prenomUser']; ?></td>
                                    <td><?= $donnees['nomUser']; ?></td>
                                    <td><?= $donnees['nomTypeCompte']; ?></td>
                                    <td><?= $donnees['telUser']; ?></td>
                                    <td><?= $donnees['emailUser']; ?></td>
                                    <!-- <td><?= $donnees['mdpUser']; ?></td> -->
                                    <td><a title="Éditer : <?= $donnees['pseudoUser'];?>" href="traitement/trt_user_form.php?id=<?= $donnees['ID_user'];?>&ID_typeCompte=<?php echo $donnees['ID_typeCompte'];?>" ><img src="image/Icon/edit.png" alt="Éditer"></a></td>
                                    <td><a title="Supprimer : <?= $donnees['pseudoUser'];?>" href="traitement/trt_user_form.php?id=<?= $donnees['ID_user'];?>&suppr=ok"><img src="image/Icon/delete.png" alt="Supprimer"></a></td>
                                </tr>
                            <?php   }   ?>
                            
                            </table>
                        </div>
                        <a title="Ajouter un utilisateur" href="traitement/trt_user_form.php"><button>Ajouter un utilisateur</button></a>
                    </div>    
                </div>
                <!-- fin de id="form_user" -->

            </div>
            <!-- fin de id="dashboard_content"-->

            <!-- Footer -->
            <div class="footer">
            <h4>&copy Comité Départemental Handisport Des Ardennes</h4>
            </div>
        </div>
        <!-- fin de id="dashboard_main"-->

    </div>
    <!-- fin de id="dashboard_container" -->
</body>

<script src="js/jquery.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/ajax_search_sport.js"></script>

</html>
