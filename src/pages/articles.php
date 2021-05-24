<?php 
    // variable pour activer le liens vers l'éditeur de texte présent sur le template
    $tinymce = true;
    $titre = "Rédiger un article";
    require "../../src/common/template.php";
    require "../../src/fonctions/dbFonction.php";
    require '../../src/fonctions/mesFonctions.php';
    require "../../src/fonctions/gameDbFonctions.php";
    require "../../src/fonctions/categorieDbFonctions.php";
    // Gérer la variable du contenu dynamique
    $choixMenu = "redigerArticle";
?>


<section class="gestionAdmin mb-5 p-3">
    <div class="template p-2">
        <div class="menu mt-5">
            <a href="../../src/pages/articles.php?choix=redigerArticle">Rediger un article</a>
            <a href="../../src/pages/articles.php?choix=uploaderPhoto">Uploader photo</a> 
            <a href="../../src/pages/articles.php?choix=redigerArticle&liens=memoireTampon">Afficher tampon</a> 
        </div>
        <div class="<?=$choixMenu?>">
            <?php
                // Quand l'admin selectionne les catégories
                // REDIGER ARTICLE
                if(isset($_GET["choix"]) && $_GET["choix"] == "redigerArticle"):
                    require "../../src/pages/redacArticlesInclude/moduleRedaction.php";
                endif;
                // UPLOADER PHOTO
                if(isset($_GET["choix"]) && $_GET["choix"] == "uploaderPhoto"):
                    require "../../src/pages/redacArticlesInclude/moduleUploadFichier.php";
                endif;
            ?>

        </div>
    </div>
</section>