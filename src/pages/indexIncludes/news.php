<!-- PARTIE 7 -->
<!-- appeler ma fonction pour récupérer les news à la une -->
<?php 
    // Mes fonctions DB
    require "./src/fonctions/newsDbFonctions.php";
    $listeOnTop = getArticleOnTop();
    // J'envoie mes données utiles dans des variables dynamiques

    for($i =0; $i < 3; $i++):
        $vId[$i] = intval($listeOnTop[$i]["articleId"]);
        $vTitre[$i] = $listeOnTop[$i]["titre"];
        $vUlr[$i] = $listeOnTop[$i]["imgUrl"];
        $VcategorieArticle[$i] = $listeOnTop[$i]["nomCategorie"];
    endfor;
?>

<section id="news">
    <h2 class="mb-2 ml-9">dernières news...</h2>
    <div class="contenuNews">
        <div class="vignette v1" style="background: url(<?=$vUlr[0]?>) center center/cover">
            <a href="../../src/common/pageArticle.php?id=<?= $vId[0] ?>">
            <p class="newsCategorie ml-2"><?=$VcategorieArticle[0]?></p>
            <h2 class="ml-2 mb-2 newsTitre"><?=$vTitre[0]?></h2>
        </a>
        </div>
        <div class="miniVignette">
            <div class="vignette v2" style="background: url(<?=$vUlr[1]?>) center center/cover">
                <a href="../../src/common/pageArticle.php?id=<?= $vId[1] ?>">
                <p class="newsCategorie ml-2"><?=$VcategorieArticle[1]?></p>
                <h2 class="ml-2 mb-2 newsTitre"><?=$vTitre[1]?></h2>
                </a>
            </div>
            <div class="vignette v3" style="background: url(<?=$vUlr[2]?>) center center/cover">
               <a href="../../src/common/pageArticle.php?id=<?= $vId[2] ?>">   
                <p class="newsCategorie ml-2"><?=$VcategorieArticle[2]?></p>
                <h2 class="ml-2 mb-2 newsTitre"><?=$vTitre[2]?></h2>
               </a>
            </div>
        </div>
    </div>
</section>