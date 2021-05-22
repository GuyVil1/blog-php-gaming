<?php
    $titre = "enregistrez-vous";
    require "../../src/common/template.php";
    $mdpNok = false;
    require "../../src/fonctions/dbFonction.php";
    require '../../src/fonctions/mesFonctions.php';
    $titre = "Connectez-vous";

    // Si mon user est déjà connecté, le renvoyer sur index
    if(isset($_SESSION["connecté"]) && $_SESSION["connecté"] == true):
        header("location: ../../index.php");
    endif;

    // Si le formulaire est envoyé, je lance la fonction login pour connecter mon user
    if(isset($_POST["login"]) && isset($_POST["password"])):
        $login = htmlspecialchars($_POST["login"]);
        $password = htmlspecialchars($_POST["password"]);

        login($login, $password);
     
    else:
?>

<section>
    <form action="" method="post" class="login">
        <div>
            <?php
            if(isset($_GET["erreur"])):
            ?>
            <h2><?= $_GET["erreur"] ?></h2>
            <?php endif; ?>
            <label>login:</label>
            <input type="text" name="login" required placeholder="Entrez votre login">
            <label>Mot de passe:</label>
            <input type="password" name="password" required placeholder="Entrez votre mot de passe">
            <input type="submit" value="Se connecter">
        </div>
    </form>
</section>

<?php 
    endif; 
    ?>