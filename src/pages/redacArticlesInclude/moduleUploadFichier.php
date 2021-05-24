<style>

    /* Section upload */
    .recapUpload{
        width: 40%;
        margin: 1rem auto;
        /* border: 1px solid black; */
        padding: 1rem;
    }

    .recapUpload > img{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        border: 1px green solid;
        padding: 0.3rem;
    }

    /* formulaire */
    .formulaire{
        border: 1px solid black;
        margin-left: 2rem;
        margin-top: 2rem;
        padding: 1rem;
        width: 30%;
        box-shadow: 0px 10px 13px -7px black, 1px 2px 3px 3px rgba(0,0,0,0);
    }

    /* Section liste images */
    .liste{
        background: rgb(0,0,0);
        background: linear-gradient(117deg, rgba(0,0,0,1) 10%, rgba(255,247,0,1) 44%, rgba(255,10,10,1) 95%);
        border-top: 2px solid blue;
        margin-top: 2rem;
        padding-top: 2rem;
        text-align: center;
        color: white;
        box-shadow: 0px 10px 13px -7px black, 1px 2px 3px 3px rgba(0,0,0,0);

    }
    .miseEnPage{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .image{
        width: 10rem;
        margin: 1rem;
        padding: 0.5rem;
        border: solid 1px black;
        background-color: white;
    }
    .image > a > img{
        width: 100%;
        height: 10rem;
        box-shadow: 0px 10px 13px -7px #000000, -6px -3px 4px 5px rgba(0,0,0,0);
        margin-bottom: 1rem;
        border: solid 3px green;

    }

    .image > a > p{
        text-align: center;
        color: black;
    }
</style>

<!-- TRAITEMENT DU FORMULAIRE  -->
<?php 

    if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] == 0){

    // Vérifier la taille du fichier recu (1M = 1000000o)
        if($_FILES["fichier"]["size"] <= 10000000)
        {
            // Extension autorisée pour l'upload:
            $extensionArray = ["png", "PNG", "gif", "GIF", "jpg", "JPG", "JPEG", "jfif", "JFIF", "jpeg"];
            // récupérer toutes les infos du fichier envoyé
            $infoFichier = pathinfo($_FILES["fichier"]["name"]);
            // Je récupére l'extension du fichier qui a été envoyé
            $extensionImage = $infoFichier["extension"];

            // Extension autorisée ? 
            if(in_array($extensionImage, $extensionArray)){
                // préparation chemin repertoire + renommer le fichier
                $destination = "../../src/img/article/" . time() . basename($_FILES["fichier"]["name"]);
                // envoi fichier
                move_uploaded_file($_FILES["fichier"]["tmp_name"], $destination);
                // J'informe que tout s'est bien passé
                echo "<div class='recapUpload'>
                    <h4 style='color: green'>Envoi du fichier " . $_FILES["fichier"]["name"] . " réussi !!!</h4>
                    <img src='".$destination."' class='nouvelUpload' />
                </div>";
                // Si user veut envoyer les liens dans un tampon pour la rédaction de son article
                if($_POST["tampon"] == "oui"){
                    $bdd = new PDO("mysql:host=localhost;dbname=game_from_belgium;charset=utf8", "root", "");
                    $requete = $bdd->prepare("INSERT INTO imagetampon(liens, auteurId) VALUES(?, ?)");
                    
                    $requete->execute(array($destination, $_SESSION["user"]["id"]))or die(print_r($requete->errorInfo(), TRUE));;

                    $requete->closeCursor();
                }
            }
        } else {
        echo '<h4 style="color: red">Attention la taille du fichier dépasse la taille maximale autorisée (10Mo)</h4>';

        }
    }

?>

<div class="formulaire">
    <form method="post" action="" enctype="multipart/form-data">
        <h4>Uploader un fichier...</h4>
        <table>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <tr>
                <td><input type="file" name="fichier"></td>
            </tr>
            <tr>
                <td>
                    <select name="tampon">
                        <option value="oui">OUI</option>
                        <option value="nom">NON</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" /></td>
            </tr>
        </table>
    </form>
</div>

<?php
    // J'encapsule le chemin de mon dossier dans une variable
    $dir = "../../src/img/article/";

    // dans la variable $fichiers, j'effectue le scan de mon dossier upload
    $fichiers = scandir($dir);
    // Si je regarde le contenu de ce que j'ai récupéré, je remarque les deux entrées parasites
    // que je vais devoir éliminer lors de mon affichage
?>

<div class="liste">
    <h2>Liste des images disponibles</h2>
    <div class="miseEnPage">
    <?php 
        // Je parcours ma variable $fichiers et affiche chaque fichier présent
        foreach($fichiers as $values){
            if($values != "." && $values != ".." && $values != "index.php"){
                // je retire les 10 première lettre du nom du fichier qui ont été générée
                // aléatoirement par ma fonction time()
                $name = $values;
                // J'affiche le contenu lié à l'itération de la boucle
                echo '
                    <div class="image">
                        <a href="' .$dir . $values . '">
                        <img src="' .$dir . $values . '" alt="' . $values . '" />
                        <p>' . $name . ' </p></a>
                    </div>';
            }
        }
    ?>
    </div>
</div>