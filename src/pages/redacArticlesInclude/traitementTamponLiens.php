<style>
    .miniature{
        width: 50px;
        height: auto;
    }

    table tr td{
        padding: 0.5rem;
    }
</style>

<!-- VERIFIER SI LE USER VEUT RECUPERER LES LIENS DES PHOTOS QU'IL A UPLOADEE -->

<?php
        // converti en entier le string user / id
        $tamponUser =  intval($_SESSION["user"]["id"]);

    if(isset($_GET["liens"]) && $_GET["liens"] == "memoireTampon"){
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->query("SELECT * FROM imagetampon WHERE auteurId = $tamponUser");
?>
        <table border="1">
            <tr>
                <td>Lien de l'image</td>
                <td>miniature de l'image</td>
            </tr>
<?php
        while($données = $requete->fetch()){
?>
        <tr>
            <td><?= $données["liens"] ?></td>
            <td><img src="<?= $données["liens"] ?>" alt="<?= $données["liens"] ?>" class="miniature"></td>
        </tr>
<?php            
        }
?>
        </table>
        <h3>Une fois l'article publié, ne pas oublier de vider le tampon</h3>
        <h3 class="btnTampon"><a href="../../src/pages/articles.php?choix=redigerArticle&liens=memoireTampon&tampon=true">Vider tampon ?</a></h3>
<?php
    }   
?>


<!-- VERIFIER SI LE USER VEUT VIDER LE TAMPON-->

<?php
// Si le user veut effacer le tampon
    if(isset($_GET["tampon"]) && $_GET["tampon"] == true):
        $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
        $requete = $bdd->prepare("DELETE FROM imagetampon WHERE auteurID = ?");
        $requete->execute(array($tamponUser)) or die(print_r($requete->errorInfo(), TRUE));

        echo "<h2>Mémoire Tampon effacée, merci pour votre courtoisie</h2>";
        $requete->closeCursor();
    endif;
?>