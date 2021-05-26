<?php
// PARTIE 7
    // Récupérer les articles à la une
    function getArticleOnTop(){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT a.articleId, a.titre, a.imgUrl, a.content, a.date, c.nomCategorie, gc.genre, u.nom, u.prenom
                                FROM articles a
                                INNER JOIN categorie c ON c.categorieId = a.categorieId
                                INNER JOIN gamecategory gc ON gc.gameCategoryId = a.gameCategoryId
                                INNER JOIN users u ON u.userId = a.auteurId
                                INNER JOIN jeux j ON j.gameId = a.gameId
                                INNER JOIN hardware h ON h.hardId = a.hardId
                                INNER JOIN stars s ON s.articleId = a.articleId
                                WHERE s.articleId = a.articleId");

        while($données = $requete->fetch()):
            $listeOnTop[] = $données;
        endwhile;

        return $listeOnTop;
}
?>