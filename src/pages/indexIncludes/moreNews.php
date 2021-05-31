<!-- #moreNews -->

<?php
    $listeMoreArticle = getXArticle(12);
    
    // Générer la partie more news
    for($i = 0; $i < count($listeMoreArticle); $i++){
?>
    <a href="./src/common/pageArticle.php?id=<?=$listeMoreArticle[$i]["articleId"]?>">
        <div class="moreNews">
            <img src="<?=$listeMoreArticle[$i]["imgUrl"] ?>" alt="image article">
            <div>
                <h2><?= $listeMoreArticle[$i]["titre"] ?></h2>
            </div>
        </div>
    </a>
<?php
    }
?>


