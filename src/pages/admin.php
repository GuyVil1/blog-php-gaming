<?php 
    // variable pour activer le liens vers l'éditeur de texte présent sur le template
    $titre = "Espace d'administration";
    require "../../src/common/template.php";
    require "../../src/fonctions/dbFonction.php";
    require '../../src/fonctions/mesFonctions.php';

    // Refuser l'accès à la page à qui n'est pas admin
    if($_SESSION["user"]["role"] != "admin"):
        header("location: ../../index.php");
    endif;
?>

<section class="categorieArticle">
    <h2 class="ta-c mt-5">Listes des catégories existantes</h2>
    <div class="gestionCategorie">
        <?php
            require "../../src/pages/adminInclude/hardCategorie.php";
        ?>
    </div>
</section>