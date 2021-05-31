<h2>Nos derniers articles</h2>
<!-- Récupérer les 15 premiers articles -->
    <?php
        $listeNews = getXArticle(20);
        for($i = 0; $i < count($listeNews); $i++):
            // Je limite le nombre de caractère des tire à 49
            $titreRaccourci = substr($listeNews[$i]['titre'], 0, 49).'...';
    ?>
        <a href="../../src/common/pageArticle.php?id=<?= $listeNews[$i]['articleId'] ?>">
            <div>
                <img src="<?= $listeNews[$i]['imgUrl']?>" alt="">
                <h2><?=$titreRaccourci?></h2>
            </div>
        </a>
    <?php    
        endfor;//ligne 8
    ?>