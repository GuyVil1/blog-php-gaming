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
    // Gérer la variable du contenu dynamique
    $choixMenu = "adminContenu";
?>

<section class="gestionAdmin mb-5 p-3">
    <div class="template p-2">
        <div class="menu mt-5">
            <a href="../../src/pages/admin.php?choix=listeCategorie">Gérer les catégories</a>
            <a href="../../src/pages/admin.php?choix=listeuser">Gérer les users</a>
            <a href="../../src/pages/admin.php?choix=listecommentaire">Gérer les commentaires</a>
            <a href="../../src/pages/admin.php?choix=listearticle">Gérer les articles</a>  
        </div>
        <div class="<?=$choixMenu?>">
            <?php
                // Quand l'admin selectionne les catégories
                if(isset($_GET["choix"]) && $_GET["choix"] == "listeCategorie"):
                    require "../../src/pages/adminInclude/categorie/ListCategorie.php";
                endif;
            ?>

        </div>
    </div>
</section>

<?php
require '../../src/common/footer.php';
?>