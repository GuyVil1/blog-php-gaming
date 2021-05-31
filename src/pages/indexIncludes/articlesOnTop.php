<!-- .listArticle -->
<h2>Les articles mis en avant</h2>
<!-- Récupérer les 15 premiers articles -->
    <?php
    // récupèrer les 20 derniers article qui ont été on top
        $listeAlaUne = getTop(20);
        for($i = 0; $i < count($listeAlaUne); $i++):
            // Je limite le nombre de caractère des tire à 49
            $titreRaccourci = substr($listeAlaUne[$i]['titre'], 0, 49).'...';
    ?>
        <a href="../../src/common/pageArticle.php?id=<?= $listeAlaUne[$i]['articleId'] ?>">
            <div>
                <img src="<?= $listeAlaUne[$i]['imgUrl']?>" alt="">
                <h2><?=$titreRaccourci?></h2>
            </div>
        </a>
    <?php    
        endfor;//ligne 8
    ?>