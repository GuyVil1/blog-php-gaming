<?php
    // PARTIE 7
    // rechercher contenu Article a afficher
    function getArticleContent($id){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("SELECT a.titre, a.imgUrl, a.content, a.date, c.nomCategorie, gc.genre, 
                                        u.nom AS auteurNom, u.prenom AS auteurPrenom, j.nom, j.developpeur, j.editeur, j.dateDeSortie, j.cover, h.console 
                                    FROM articles a
                                    INNER JOIN categorie c ON c.categorieId = a.categorieID
                                    INNER JOIN gamecategory gc ON gc.gameCategoryId = a.gameCategoryId
                                    INNER JOIN users u ON u.userId = a.auteurId
                                    INNER JOIN jeux j ON j.gameId = a.gameId
                                    INNER JOIN hardware h ON h.hardId = a.hardId
                                    WHERE a.articleId = ?");
        $requete->execute(array($id))or die(print_r($requete->errorInfo(), TRUE));

        while($données = $requete->fetch()):
            $contenuArticle[] = $données;
        endwhile;
        // Si l'id envoyé par le user existe, je retourne les données recues par la requête
        if($contenuArticle):
            return $contenuArticle;
        else:
            // si ce n'est pas le cas, je renvoie sur la page d'index et active un message
            header("location: ../../index.php?error=true&message=Le lien suivi n'existe pas, retour à la case départ :)");
        endif;
    }
?>