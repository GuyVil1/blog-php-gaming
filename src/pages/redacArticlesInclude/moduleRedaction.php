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
    var_dump($listeTypeArticle);

?>
<!-- Formulaire de création d'article -->
<section class="articles">
    <form method="post" action="" enctype="multipart/form-data">
        <p>Titre de votre article</p>
        <input type="text" name="titre" >
        <p>Image de référence</p>
        <input type="file" name="fichier">
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
                    <select name="jeu">
                        <?php 
                            for($i=0; $i < count($listedeJeu); $i++):
                        ?>
                        <option value="<?= $listedeJeu[$i][1] ?>"><?= $listedeJeu[$i][1] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <select name="console">
                        <?php 
                            for($i=0; $i < count($listeHard); $i++):
                        ?>
                        <option value="<?= $listeHard[$i][1] ?>"><?= $listeHard[$i][1] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <select name="genre">
                        <?php 
                            for($i=0; $i < count($listeGenre); $i++):
                        ?>
                        <option value="<?= $listeGenre[$i] ?>"><?= $listeGenre[$i] ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <select name="typeArticle">
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
        <textarea name="contenu" id="contenu"> </textarea>
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