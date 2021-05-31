<?php
$titre = "BELGIUM VIDEO-GAMING";
    // injecter mes composants
    require "./src/common/template.php";
    require "./src/pages/indexIncludes/news.php";
?>
    <section id="moreNews">
        <div>
            <h2>Plus de news...</h2>
            <?php
            require "./src/pages/indexIncludes/moreNews.php";
            ?>
        </div>
        <div class="listArticle">
        <?php
            require './src/pages/indexIncludes/articlesOnTop.php';
        ?>  
        </div>
    </section>
<?php
    require "./src/common/footer.php";
?>