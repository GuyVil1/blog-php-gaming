<?php
if(isset($_POST["reponse"]) && !empty($_POST["reponse"])):
    // sanitize le commentaire et le pseudo
    if(isset($_POST["pseudo"])):
        $options = array(
            'pseudo' 	=> FILTER_SANITIZE_STRING,
            'reponse' 	=> FILTER_SANITIZE_STRING
        );
    else:
        $options = array(
            'reponse' 	=> FILTER_SANITIZE_STRING
        );
    endif;

    $result = filter_input_array(INPUT_POST, $options);  
                // si le user est connecté, j'ai déjà son id et son login
                // j'ai ausi l'idArticle récupéré plus haut
                // Je peux traiter les données pour les envoyer dans la DB
                if(isset($_POST["pseudo"])):
                    $pseudoToSend = $result["pseudo"];
                    $userId = 0;
                else:
                    $pseudoToSend = $_SESSION["user"]["login"];
                    $userId = intval($_SESSION["user"]["id"]);
                endif;
                $commentaire = $result["reponse"];
                $commentaireId = intval($_GET["reponseId"]);
                AddAnswerComment($commentaireId, $userId, $pseudoToSend, $commentaire);
endif;

