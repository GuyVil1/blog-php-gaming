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
    
        // Si l'article doit aller en mise en avant déclencher la fonction AlaUne
        if($star == true):
            //J'envoie en paramètre le titre de l'article pour récupérer l'articleId
            // qui vient d'être envoyé
            aLaUne($titre, $bdd);
        endif;
    }

    // Envoyer un article a la une
    function aLaUne($titre, $bdd){
        // Je selectionne l'article qui vient d'être envoyé
        $requete = $bdd->prepare("SELECT articleId FROM articles
                                WHERE titre = ?");
        $requete->execute(array($titre))or die(print_r($requete->errorInfo(), TRUE));;
        
        while($données = $requete->fetch()):
            // Je capture l'id de l'article en transformant le string recu en int
            $articleId = intval($données[0]);
        endwhile;
        // Requete pour envoyer l'id dans ma table star
        $sousRequete = $bdd->prepare("INSERT INTO stars(articleId)
                                        VALUES(?) ");
        $sousRequete->execute(array($articleId))or die(print_r($requete->errorInfo(), TRUE));
    }
?>