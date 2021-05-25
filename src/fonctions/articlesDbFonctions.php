<?php

// <!-- ENVOYER ARTICLE DANS LA DB -->

    function envoyerArticle($titre, $imgUrl, $content, $date, $categorieId, $gameCategoryId, $auteurID, $gameId, $hardId, $star){
        // je traite l'image de l'article et l'envoie dans le dossier article
        $traiterImage = sendImg($imgUrl, "article");
        
        // après avoir codé ma fonction dans categorieDbFonction.php, je peux 
        // récupérer l'id de ma catégorie d'article en lançant ma fonction:
        $arrayCategorieId = getTypeArticleByName($categorieId);
        
        // Je récupère l'index à envoyer:
        $categorieId = $arrayCategorieId[0];
        
        // Je récupére l'id Catégoeir de jeu
        $arrayGameCategoryId =  getGameCategorieByName($gameCategoryId);
        $gameCategoryId = $arrayGameCategoryId[0];

        // Je récupère l'id du jeu
        $arrayGamename = getGameByName($gameId);
        $gameId = $arrayGamename[0];

        // Je récupère l'id de la machine
        $arrayHardware = getHardByName($hardId);
        $hardId = $arrayHardware[0];

        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("INSERT INTO articles(titre, imgUrl, content, date, categorieId, gameCategoryId, auteurId, gameId, hardId, star)
                                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $requete->execute(array($titre, $traiterImage, $content, $date, $categorieId, $gameCategoryId, $auteurID, $gameId, $hardId, $star))or die(print_r($requete->errorInfo(), TRUE));
    }
?>