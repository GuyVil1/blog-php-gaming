<?php
    require "traitementTamponLiens.php";
    // J'encapsule la liste des jeux dans une variable
    $listedeJeu = getAllGame();
    // J'encapsule les console
    $listeHard = getHard();
    // J'encapule les catégorie d'article
    $listeGenre = getGameCategorie();
    // J'encapsule type d'article
    $listeTypeArticle = getCategorie();


    // Traitement du formulaire de redaction quand celui-ci est envoyé
    if(isset($_POST["titre"]) && isset($_FILES["fichier"]) && isset($_POST["jeu"]) 
        && isset($_POST["console"]) && isset($_POST["genre"]) && isset($_POST["typeArticle"]) && isset($_POST["contenu"])):

        $star = false; //Par défaut pour être sur d'envoyer une données
        $titre = $_POST["titre"];
        $imgUrl = $_FILES["fichier"];//traitement à effectuer dans la requete envoyerArticle
        $content = $_POST["contenu"];//tel quel
        $date = date('Y-m-d H:i:s');//Recuperer date du jour avec heure de l'envoi
        $categorieId = $_POST["typeArticle"];//Récupérer gameCategorieId du jeux
        $gameCategoryId = $_POST["genre"];//Récupérer categorie du jeu
        $auteurID = intval($_SESSION["user"]["id"]);//Récupère l'id de l'auteur
        $gameId = $_POST["jeu"];// Récupérér le gameId du jeu
        $hardId = $_POST["console"];//récupérer le hardId du jeux

        //Vérifier si l'article doit aller dans les mis en avant. Cette donnée ne sera plus traitée dans la fonction
        if(isset($_POST["star"]) && $_POST["star"] == true):
            $star = true;
        endif;

        envoyerArticle($titre, $imgUrl, $content, $date, $categorieId, $gameCategoryId, $auteurID, $gameId, $hardId, $star);
    endif;
?>

<!-- Formulaire de création d'article -->
<section class="articles">
    <form method="post" action="" enctype="multipart/form-data">
        <p>Titre de votre article</p>
        <input type="text" name="titre" required>
        <p>Image de référence</p>
        <input type="file" name="fichier" required>
        <!-- Traitement pour récupérer liste des jeux -->
        <table>
            <tr>
                <td>Jeu concerné</td>
                <td>console</td>
                <td>Genre</td>
                <td>Type d'article</td>
                <td>A la une?</td>
            </tr>
            <tr>
                <td>
                <!-- Boucle pour générer un select dynamique avec liste des jeux -->
                    <select name="jeu" required>
                        <?php 
                            for($i=0; $i < count($listedeJeu); $i++):
                        ?>
                        <option value="<?= $listedeJeu[$i][1] ?>"><?= $listedeJeu[$i][1] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                <!-- Boucle pour générer un select dynamique avec liste des consoles -->
                    <select name="console" required>
                        <?php 
                            for($i=0; $i < count($listeHard); $i++):
                        ?>
                        <option value="<?= $listeHard[$i][1] ?>"><?= $listeHard[$i][1] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                <!-- Boucle pour générer un select dynamique avec liste des genre -->
                    <select name="genre" required>
                        <?php 
                            for($i=0; $i < count($listeGenre); $i++):
                        ?>
                        <option value="<?= $listeGenre[$i] ?>"><?= $listeGenre[$i] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                <!-- Boucle pour générer un select dynamique avec liste d'articles -->
                    <select name="typeArticle" required>
                        <?php 
                            for($i=0; $i < count($listeTypeArticle); $i++):
                        ?>
                        <option value="<?= $listeTypeArticle[$i] ?>"><?= $listeTypeArticle[$i] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <input type="checkbox" name="star">
                </td>
            </tr>
        </table>

        <p>Composez votre article</p>
        <textarea name="contenu" id="contenu" required> </textarea>
        <input class="btnTampon" type="submit" value="Envoyez votre article">
    </form>
</section>

<!-- Ajout du script tinymce et activer options -->
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist image imagetools media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
</script>