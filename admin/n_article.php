<?php
include '../inc/header.php';

if (isset($_POST['form'])) {
    if (!empty($_POST['titren']) AND !empty($_POST['texten']) AND !empty($_POST['daten']) AND !empty($_POST['selectcat'])) {

        $titren = htmlspecialchars($_POST['titren']);
        $texten = htmlspecialchars($_POST['texten']);
        $daten = $_POST['daten'];
        $categorien = $_POST['selectcat'];

        $categ = intval($categorien);
        $narticle = $db->prepare('INSERT INTO articles (id_categorie_article, titre_article, txt_article, date_article) VALUES (?, ?, ?, ?)');
        $narticle->execute(array($categ, $titren, $texten, $daten));

    } else {
        echo 'veuillez remplir tous les champs.';
    }
}

?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bienvenue sur la page créer un nouvel article !</h1><br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="well">


                    <form method="POST" id="form">
                        <div class="form-group">
                            <label for="titren">Titre:</label>
                            <input type="text" class="form-control" name="titren" id="titren"/>
                        </div>
                        <div class="form-group">
                            <label for="daten">Date:</label>
                            <input type="date" class="form-control" name="daten" id="daten"/>
                        </div>
                        <div class="form-group">
                            <label for="texten">Texte:</label>
                            <textarea rows="4" cols="50" class="form-control" name="texten"id="texten"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categorien">Categorie:</label>

                        </div>
                        <div class="form-group">
                            <select name="selectcat" id="selectcat">
                                <?php

                                $reqcattn = $db->query("SELECT * from categories");


                                while ($row = $reqcattn->fetch())
                                {

                                    ?>
                                    <option value="<?=$row['id_categorie']?>" name="categorie" id="categorie"><?=$row['nom_categorie'] ?></option>

                                    <?php

                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="brouillon">Brouillon</label>
                            <input type="checkbox" id="brouillon" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control" name="form" value="Envoyer" />
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php


?>
<?php include '../inc/footer.php'; ?>



/*  ancien traitement qui marche pas
if (isset($_POST['titren']) AND isset($_POST['texten']) AND isset($_POST['daten']) AND isset($_POST['categorie'])) {

$titren = htmlspecialchars($_POST['titren']);
$texten = htmlspecialchars($_POST['texten']);
$daten = htmlspecialchars($_POST['daten']);
$cat = intval($_POST['categorie']);

var_dump($cat);

$narticle = $db->prepare('INSERT INTO articles (id_categorie_article, titre_article, txt_article, date_article) VALUES (?, ?, ?, ?)');
$narticle->execute(array($cat, $titren, $texten, $daten));

}
*/
