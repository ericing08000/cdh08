<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="downloadPhoto.php" enctype="multipart/form-data" method="post">
        <label for=""></label>
            <input type="file" name="downloadphoto" id="downloadphoto">

            <button type="submit" name="button" value="envoyer">Envoyer</button>
            
        </form>
    <?php 
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
    
    ?>
    
</body>
</html>