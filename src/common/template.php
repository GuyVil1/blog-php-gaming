<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre?></title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src//css/generique.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../../src/img/site/logo-150px.png">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;600;700&family=Poppins:wght@100;200;300;500;700&display=swap" rel="stylesheet">    
    <script src="https://kit.fontawesome.com/83f4286022.js" crossorigin="anonymous"></script>
    <?php
    if(isset($tinymce) && $tinymce == true):
        ?>
    <!-- faire le lien avec tinymce -->
    <script src="https://cdn.tiny.cloud/1/3cbmy463x00x3y5ipepe1ci2yn586bgoizf588705i8zcma1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>    
    <?php endif; ?>

</head>
<body class="bgWhite"> 
    <?php   
    require ("nav.php");
    // Je gère les message d'erreur à cet endroit, juste après le menu
    if(isset($_GET["error"]) && $_GET["error"] == true):
        echo "coucou";
    ?>
        <h2><?= $_GET["message"] ?></h2>
    <?php
        endif;
    ?>
</body>
</html>
