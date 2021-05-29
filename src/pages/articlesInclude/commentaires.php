            <!-- PARTIE 08 -->
            <!-- RECUPERE LES COMMENTAIRES, AFFICHER LES EXISTANTS -->
<?php            
            // PS: l'id article est déjà connu et encapsulé plus haut dans la page
            // dans $articleId
            if(isset($_POST["commentaire"])):
                // sanitize le commentaire et le pseudo
                if(isset($_POST["pseudo"])):
                    $options = array(
                        'pseudo' 	=> FILTER_SANITIZE_STRING,
                        'commentaire' 	=> FILTER_SANITIZE_STRING
                    );
                else:
                    $options = array(
                        'commentaire' 	=> FILTER_SANITIZE_STRING
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
                $commentaire = $result["commentaire"];
                sendCommentary($articleId, $userId, $pseudoToSend, $commentaire);
            
            endif;
?>            
            <!-- Puis inclure un form-->
            <div class="commentaires" id="commentaire">

                <form action="../../src/common/pageArticle.php?id=<?=$articleId?>#commentaire" method="POST">
                    <table>
                        <tbody>
                            <tr>
                                <td>Commentez cet article</td>
                            </tr>
                            <tr>
                            <?php
                                // PARTIE 8
                                // Si le user est connecté on inscrit son nom à la place de l'input
                                if(isset($_SESSION["user"])):
                                ?>
                                    <td name="pseudo"><img src="<?= $_SESSION["user"]["photo"]?> " alt=""><?= $_SESSION["user"]["login"] ?></td>
                                <?php
                                    else:
                                ?>
                                    <td><img src="../../src/img/site/defaut_avatar.png" ><input type="text" name="pseudo" placeholder="pseudo"></td>
                                <?php
                                endif;
                            ?>
                            </tr>
                            <tr>
                                <td><textarea name="commentaire" id="" cols="30" rows="10" placeholder="Entrez votre commentaire..." required></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Envoyez votre commentaire"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    <!-- Liste des commentaire et de ses réponses -->
    <?php
        
        // récupérer les commentaires
        $listeCommentaire = getAllCommentary($articleId);
        // Faire un var_dump pour montrer la structure
        // var_dump($listeCommentaire);
        // Redistribuer les données dans des variables lisibles:
        // $commentaireId[] = $listeCommentaire[$i][0][0];
    ?>
        <div class="listCommentaire">
            <?php
        for($i = 0; $i < count($listeCommentaire); $i++):
            ?>
            <!-- Je recois un tableau multidimensionnel avec deux taleaux 
            que je vais devoir traiter -->
            <div class="commentaireContainer" id="<?=$listeCommentaire[$i][0][0]?>">
                <div class="infosUser">
                    <div>
                        <img src="<?=$listeCommentaire[$i][1][0]?>" alt="">
                    </div>
                    <div>
                        <p><?= $listeCommentaire[$i][0][3]?></p>
                        <p><?= $listeCommentaire[$i][0][4]?></p>
                    </div>
                </div>
                <div class="contenuCommentaire">
                    <p><?= $listeCommentaire[$i][0][5]?></p>
                </div>
                <!-- Je redirige manuellement vers un hypperlien GET avec l'id de l'article, et l'id de la réponse a laquell le 
                user veut répondre-->
                    <!-- <a href="http://localhost/src/common/pageArticle.php?id=<?= $articleId?>&reponse=true&reponseId=<?= $listeCommentaire[$i][0][0]?>&end=true/#<?= $listeCommentaire[$i][0][0]?>"><p class="repondre">Répondre</p></a> -->
                <!-- A CODER EN DERNIER QUAND L'ENVOI DES REPONSES AUX COMMENTAIRES A ETE CODE -->
                <?php
                    // Je récupère les reponses aux com
                    // $listeReponse = GetAllAnswerComment($listeCommentaire[$i][0][0]);
                ?>
                <?php
                // REPONSE AUX COMMENTAIRES
                // Je vérifie si les get pour répondre aux articles à été cliqué
                // if(isset($_GET["reponse"]) && $_GET["reponse"] == true):
                //     // durant la boucle, j'identifie grâce aux id le commentaire sur lequel le user veut répondre
                //     if(isset($_GET["reponseId"]) && $_GET["reponseId"] == $listeCommentaire[$i][0][0]):
                //         // quand le commentaire est trouvé, je construit un formulaire
                ?>

                <!-- J'INJECTE LE TRAITEMENT DU FORMULAIRE DE REPONSE -->
                <?php
                    // require "traitementReponse.php";
                ?>
                <!-- <div class="commentaires" id="reponse">
                    <form action="" method="post"> -->
                        <!-- Je reprends le 1er formulaire et je l'adapte -->
                        <!-- <table>
                            <tbody> -->
                                <?php
                                // if(isset($_SESSION["user"])):
                                ?>
                                    <!-- <td name="pseudo"><img src="<?= $_SESSION["user"]["photo"]?> " alt="">
                                    <?= $_SESSION["user"]["login"] ?></td> -->
                                <?php
                                    // else:
                                ?>
                                    <!-- <td><img src="../../src/img/site/defaut_avatar.png" >
                                    <input type="text" name="pseudo" placeholder="pseudo"></td> -->
                                <?php
                                // endif;
                                ?>
                                <!-- </tr>
                                <tr>
                                    <td><textarea name="reponse" id="" cols="30" rows="10" placeholder="Entrez votre commentaire..." required></textarea></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Envoyez votre commentaire"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div> -->
                <?php
                //     endif;//Ligne105
                // endif;//Ligne 107
                ?>
            </div>
            <?php
        endfor;
    ?>
            </div>                    
        </div>