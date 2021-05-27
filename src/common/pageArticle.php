<!-- PARTIE 7 -->
<link rel="stylesheet" href="../css/article.css">
<link rel="stylesheet"
        media="only screen and (max-width: 1266px)"
        href="../css/mobileArticle1266px.css"
    />
    <link rel="stylesheet"
        media="only screen and (max-width: 1266px)"
        href="../css/mobileArticle1100px.css"
    />
    
<?php
    // Variable titre qui viendra de la db
    $titre = "Belgium Video-Gaming";
    // injecter mes composants
    require "../../src/common/template.php";
    require "../fonctions/afficherArticleDbFonctions.php";
    
    // Je récupère l'id qui est fourni par l'url via mon GET
    if(isset($_GET["id"]) && !empty($_GET["id"])):
        // J'envoie l'entier de ma valeur dans une variable id
        $id = intval($_GET["id"]);
        // Requête pour récupérer le contenu de l'article
        $contenuArticle = getArticleContent($id);
        // var_dump($contenuArticle);
    endif;
?>

<!-- Compose le header de mon article -->
    <section class="headerArticle">
        <!-- une première partie avec mon image de cover -->
        <div><img src="<?=$contenuArticle[0]["cover"]?>" alt="cover jeux"></div>
        <!-- et les infos relative au jeu traité -->
        <div class="infoJeu">
            <h2><?=$contenuArticle[0]["nom"]?></h2>
            <p>genre: <?=$contenuArticle[0]["genre"]?> | éditeur: <?=$contenuArticle[0]["editeur"]?> 
            | développeur: <?=$contenuArticle[0]["developpeur"]?> | disponible: <?=$contenuArticle[0]["dateDeSortie"]?> | Auteur: <?=$_SESSION["user"]["prenom"]?> <?=$_SESSION["user"]["nom"]?> </p>
        </div>
    </section>

    <!-- Section du contenu de l'article qui sera flex -->
    <section class="monArticle">
        <!-- Intégralité de mon article ici sur lequel le flex principal sera appliqué -->
        <div class="article">
            <!-- Section qui contien l'image et le titre -->
            <div class="background" style="background: url(<?= $contenuArticle[0]["imgUrl"]?>) center center/cover; min-height: 50vh">
                <div class="titreArticle">
                    <h1><?=$contenuArticle[0]["titre"]?></h1>
                </div>
            </div>
            <!-- Le contenu de mon article -->
            <div class="contenuArticle">
                <?=$contenuArticle[0]["content"]?>
            </div>
            <!-- J'injecte les commentaires en dernier composents  -->
            <?php
                require "../../src/pages/articlesInclude/commentaires.php";
            ?> 
        </div>
        <div class="listArticle">
            <h2>Nos derniers articles</h2>
            <div>
                <img src="../../src/img/article/1621947158jpg.jpg"  style="width: 100%" alt="">
                <h2 style="color: white"><a href="#">titre de l'article</a></h2>
            </div>
            <div>
                <img src="../../src/img/article/1621947158jpg.jpg"  style="width: 100%" alt="">
                <h2 style="color: white"><a href="#">titre de l'article</a></h2>
            </div>
            <div>
                <img src="../../src/img/article/1621947158jpg.jpg"  style="width: 100%" alt="">
                <h2 style="color: white"><a href="#">titre de l'article</a></h2>
            </div>
            <div>
                <img src="../../src/img/article/1621947158jpg.jpg"  style="width: 100%" alt="">
                <h2 style="color: white"><a href="#">titre de l'article</a></h2>
            </div>
        </div>

    </section>

<?php
    require "../../src/common/footer.php";
?>