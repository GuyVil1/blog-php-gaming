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
                                WHERE s.articleId = a.articleId
                                ORDER BY `starId` DESC LIMIT 3");

        while($données = $requete->fetch()):
            $listeOnTop[] = $données;
        endwhile;

        return $listeOnTop;
}

    // PARTIE 9
        // Récupérer les X derniers articles de la base de données
        function getXArticle($number){
            $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    
            $requete = $bdd->query("SELECT * 
                                    FROM articles
                                    ORDER BY articleID DESC LIMIT $number");

            while($données = $requete->fetch()):
                $listArticle[] = $données;
            endwhile;

            return $listArticle;
        }

    // Récupére les articles à la une
    function getTop($number){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT a.articleId, a.titre, a.imgUrl
                                    FROM articles a 
                                    INNER JOIN stars s ON s.articleId = a.articleId
                                    ORDER BY starId DESC LIMIT $number");

        while($données = $requete->fetch()){
            $listeTop[] = $données;
        }
        return $listeTop;
    }
?>