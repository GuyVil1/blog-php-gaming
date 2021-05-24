<?php

// Function pour récupérer la liste des jeux
    function getListGame(){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT jeux.gameId, jeux.nom, jeux.developpeur, jeux.editeur, 
                                jeux.dateDeSortie, jeux.cover, hardware.console, gamecategory.genre 
                                FROM jeux
                                INNER JOIN hardware ON hardware.hardId = jeux.consoleId
                                INNER JOIN gamecategory ON gamecategory.gameCategoryId = jeux.gameCategoryId") 
                                or die(print_r($requete->errorInfo(), TRUE));

        $listCategorie = [];
        // Je distribue mes données dans une variable tableau
        while($données = $requete->fetch()){
            $listCategorie[] = array(
                "id"                => $données["gameId"],
                "nom"               => $données["nom"],
                "developpeur"       => $données["developpeur"],
                "editeur"           => $données["editeur"],
                "dateDeSortie"    => $données["dateDeSortie"],
                "cover"             => $données["cover"],
                "console"           => $données["console"],
                "genre"             => $données["genre"]
            );
        }
        $requete->closeCursor();

        // J'envoie les données dans mon appli
        return $listCategorie;
    }


// <!-- FONCTION POUR RECUPERER LA LISTE DES HARDWARE ET DES GENRE -->
function getHard(){
    $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    $requete = $bdd->query("SELECT * FROM hardware")or die(print_r($requete->errorInfo(), TRUE));
    $listHardware = array();

    while($données = $requete->fetch()){
        $listHardware[] = [$données["hardId"], $données["console"]];
    }
    return $listHardware;
}

function getGenre(){
    $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    $requete = $bdd->query("SELECT * FROM gamecategory")or die(print_r($requete->errorInfo(), TRUE));
    $listCategorie = array();

    while($données = $requete->fetch()){
        $listCategorie[] = [$données["gameCategoryId"], $données["genre"]];
    }
    return $listCategorie;
}

// Ajouter un jeu
function addGame($jeux, $console, $genre, $dev, $edit, $release, $cover){
    $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    $requete = $bdd->prepare("INSERT INTO jeux(nom, consoleId, gameCategoryId, developpeur, editeur, dateDeSortie, cover)
                            VALUES(?, ?, ?, ?, ?, ?, ?)")or die(print_r($requete->errorInfo(), TRUE));
    $requete->execute(array($jeux, $console, $genre, $dev, $edit, $release, $cover))or die(print_r($requete->errorInfo(), TRUE));

    $requete->closeCursor();
}

// DELETE UN JEU

function deleteGame($jeux){
    $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    $requete = $bdd->prepare("DELETE FROM jeux WHERE gameId = ?");
    $requete->execute(array($jeux))or die(print_r($requete->errorInfo(), TRUE));
    $requete->closeCursor();
}

// Récupérer tous les jeux
function getAllGame(){
    $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
    $requete = $bdd->query("SELECT * FROM jeux");

    $listeGame = array();
    while($données = $requete->fetch()){;
        $listeGame[] = $données;
    }

    return $listeGame;
}