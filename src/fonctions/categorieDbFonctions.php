<?php

// Function pour récupérer les catégorie de console
    function getHardCategorie(){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT * FROM hardware") or die(print_r($requete->errorInfo(), TRUE));

        $listCategorie = [];
        // Je distribue mes données dans une variable tableau
        while($données = $requete->fetch()){
            $listCategorie[] = $données["console"];
        }
        $requete->closeCursor();

        // J'envoie les données dans mon appli
        return $listCategorie;
    }

    // DELETE HARD CATEGORIE
    function deleteHardCategorie($console){
        var_dump($console);
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("DELETE FROM hardware WHERE console = ?");
        $requete->execute(array($console));
        $requete->closeCursor();

    }

    // AJOUTER UNE CONSOLE
    function addHardCategorie($console){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("INSERT INTO hardware(console) VALUES(?)");
        $requete->execute(array($console));
        $requete->closeCursor();

    }

    // CATEGORIE ARTICLE
    function getCategorie(){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT * FROM categorie") or die(print_r($requete->errorInfo(), TRUE));

        $listCategorie = [];
        // Je distribue mes données dans une variable tableau
        while($données = $requete->fetch()){
            $listCategorie[] = $données["nomCategorie"];
        }
        $requete->closeCursor();

        // J'envoie les données dans mon appli
        return $listCategorie;
    }

        // DELETE CATEGORIE D'ARTICLE
        function deleteTypeCategorie($type){
            var_dump($type);
            $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
            $requete = $bdd->prepare("DELETE FROM categorie WHERE nomCategorie = ?");
            $requete->execute(array($type));
            $requete->closeCursor();
    
        }
    
        // AJOUTER UNE CATEGORIE D'ARTICLE
        function addTypeCategorie($type){
            $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
            $requete = $bdd->prepare("INSERT INTO categorie(nomCategorie) VALUES(?)");
            $requete->execute(array($type));
            $requete->closeCursor();
    
        }

        // CATEGORIE GAME
    function getGameCategorie(){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT * FROM gameCategory") or die(print_r($requete->errorInfo(), TRUE));

        $listCategorie = [];
        // Je distribue mes données dans une variable tableau
        while($données = $requete->fetch()){
            $listCategorie[] = $données["genre"];
        }
        $requete->closeCursor();

        // J'envoie les données dans mon appli
        return $listCategorie;
    }

    // DELETE TYPE CATEGORIE
    function deleteGameCategorie($genre){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("DELETE FROM gameCategory WHERE genre = ?");
        $requete->execute(array($genre));
        $requete->closeCursor();

    }

    // AJOUTER UNE CONSOLE
    function addGameCategorie($genre){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("INSERT INTO gameCategory(genre) VALUES(?)");
        $requete->execute(array($genre));
        $requete->closeCursor();
    }

    ?>