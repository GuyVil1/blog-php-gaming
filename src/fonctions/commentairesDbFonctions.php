<?php
    // Envoyer un commentaire
    function sendCommentary($articleId, $userId, $pseudo, $commentaire){
        
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("INSERT INTO commentaires(articleId, auteurId, pseudo, contenu)
                               VALUES(?, ?, ?, ?)");

        $requete->execute(array($articleId, $userId, $pseudo, $commentaire))or die(print_r($bdd->errorinfo()));
        $requete->closeCursor();
    }

    // Fonction pour récupérer l'avatar de l'utilisateur 
    function getAvatar($userId){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");

           // Récupérer l'avatar de l'utilisateur selon qu'il soit enregistré ou non
           if($userId == 0):
            $avatar = ["../../src/img/site/defaut_avatar.png"];
        else:
            $requete = $bdd->prepare("SELECT avatar FROM users WHERE userId = ?");
            $requete->execute(array($userId));
            while($données = $requete->fetch()){
            $avatar = [$données['avatar']];
            }
            $requete->closeCursor();
        endif;
        return $avatar;
    }


    // Récupérer les commentaire de l'article
    function getAllCommentary($articleId){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
                        
        $requete = $bdd->prepare("SELECT * FROM commentaires WHERE articleId = ?");
        $requete->execute(array($articleId))or die(print_r($bdd->errorinfo()));

        while($données = $requete->fetch()):
            // Injecter l'avatar de l'utilisateur grâce à la fonction précédente
            if(isset($données["auteurId"])):
                $avatar = getAvatar($données["auteurId"]);
                $listeCommentaires[] = [$données, $avatar];
            else:
            $listeCommentaires[] = $données;
            endif;
        endwhile;
        $requete->closeCursor();
        return $listeCommentaires;
    }

    // Fonction pour envoyer une réponse à un commentaire
    // function AddAnswerComment($commentaireId, $auteurId, $pseudo, $contenu){
    //     $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    //     $requete= $bdd->prepare("INSERT INTO reponse(commentaireID, auteurID, pseudo, contenu)
    //                             VALUES(?, ?, ?, ?)");
    //     $requete->execute(array($commentaireId, $auteurId, $pseudo, $contenu))or die(print_r($bdd->errorInfo()));
    //     $requete->closeCursor();
    // }

    // // FONCTION POUR ENVOYER UN REPONSE A UN COMMENTAIRE
    // function GetAllAnswerComment($id){
    //     $intId = intval($id);
    //     $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    //     $requete = $bdd->prepare("SELECT * FROM reponse WHERE commentaireId = ?");
    //     $requete->execute($intId)or die(print_r($bdd->errorInfo()));;

    //     while($données = $requete->fetch()){
    //         echo "coucou";
    //         $listeReponse = $données;
    //     }
    //     return $listeReponse;
    // }

?>

