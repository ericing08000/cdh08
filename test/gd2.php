<?php
    // on spécifie le type de document que l'on va créer (ici une image au format PNG
    header ("Content-type: image/png");

    // on dessine une image vide de 200 pixels sur 100
    $image = @ImageCreate (200, 100) or die ("Erreur lors de la création de l'image");

    // on applique à cette image une couleur de fond, les couleurs étant au format RVB, on aura donc ici une couleur rouge
    $couleur_fond = ImageColorAllocate ($image, 255, 255, 255);
    $couleur = ImageColorAllocate ($image,0, 0, 255);

    
    imageline($image,0,0,200,100,$couleur); 

    // on dessine notre image PNG
    ImagePng ($image);
?>
    
