<?php

// Enregister un nouvel user dans ma base de donnée
    function createUser($avatar, $login, $nom, $prenom, $email, $mdp, $roleId, $ban){
    
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("INSERT INTO users(avatar, login, nom, prenom, email, mdp, roleId, ban)
                                VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

        $requete->execute(array($avatar, $login, $nom, $prenom, $email, $mdp, $roleId, $ban)) or die(print_r($requete->errorInfo(), TRUE));
        $requete->closeCursor();
    }


    function login($user, $password){

        $bdd = new PDO("mysql:host=localhost;dbname=blog_php;charset=utf8", "root", "");
        $requete = $bdd->query('SELECT * FROM users ');

        while($result = $requete->fetch()){
            if($result["login"] == $user){
                $sel = md5($password) . $result["role_id"];
                if($result["password"] == $sel){
                    $_SESSION["connect"] = true;
                    $_SESSION["user"] = [
                        "id" => $result["id"],
                        "nom" => $result["nom"],
                        "prenom" => $result["prenom"],
                        "photo" => $result["photo_url"],
                        "login" => $result["login"],
                        "email" => $result["email"],
                        "role" => $result["role"]
                    ];
                    echo $_SESSION["user"]["prenom"];
                    header("location: ../../src/pages/account.php");
                    exit();
                }
                else{
                    header("location: ../../src/pages/login.php?erreur=Mot de passe incorrect");
                    exit();
                }
            }
        }
        // Si mon script arrive ici, il est sorti de ma boucle sans trouver de user
        header("location: ../../src/pages/login.php?erreur=Identifiant inconnu, veuillez recommencer!");
        exit();
    }