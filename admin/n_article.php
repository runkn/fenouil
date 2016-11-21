

<?php
include '../inc/header.php';

if ($_SESSION['role'] != 1)
{
    header('location: ../index.php?oh=oui');
}



$brouillonn = 0 ;

if (isset($_POST['form'])) {
    if (!empty($_POST['titren']) AND !empty($_POST['texten']) AND !empty($_POST['daten']) AND !empty($_POST['selectcat'])) {

        if (isset($_POST['brouillon'])) {
            $brouillonn = 1;
        }

        else
        {
            $brouillonn = 0;
        }





        $titren = htmlspecialchars($_POST['titren']);
        $texten = htmlspecialchars($_POST['texten']);
        $catp = $_POST['catp'];
        $daten = $_POST['daten'];
        $categorien = $_POST['selectcat'];
        $auteur = $_SESSION['id'];


        $categ = intval($categorien);
        $narticle = $db->prepare('INSERT INTO articles (id_categorie_article, titre_article, txt_article, date_article, brouillon_article, id_utilisateur_article, catp_article) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $narticle->execute(array($categ, $titren, $texten, $daten, $brouillonn, $auteur, $catp));

    } else {
        echo 'veuillez remplir tous les champs.';
    }
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-6">
            <h1>Bienvenue sur la page créer un nouvel article !</h1><br>
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-6">
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
                        <select name="selectcat" id="selectcat">
                            <?php

                            $reqcattn = $db->query("SELECT * from categories");


                            while ($row = $reqcattn->fetch())
                            {

                                ?>
                                <option value="<?=$row['id_categorie']?>" name="categorie" id="categorie"><?=ucfirst($row['nom_categorie']) ?></option>

                                <?php

                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="catp">Categorie principale:</label>
                        <select id="catp" name="catp">
                            <option value="sucre">Sucré</option>
                            <option value="sale">Salé</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brouillon">Brouillon</label>
                        <input type="checkbox" id="brouillon" name="brouillon" value="">
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
