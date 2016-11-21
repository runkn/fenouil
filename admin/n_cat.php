<?php

include ('../inc/header.php');



if ($_SESSION['role'] != 1)
{
header('location: ../index.php?oh=oui');
}

if (isset($_POST['formc'])) {


    $ncat = htmlspecialchars($_POST['titrec']);
    $catp = htmlspecialchars($_POST['catp']);


    $reqc = $db->prepare("SELECT * FROM categories WHERE nom_categorie = ?");
    $reqc->execute(array($ncat));
    $catexist = $reqc->rowCount();

    if ($catexist == 0) {


        $insertcat = $db->prepare("INSERT INTO categories (nom_categorie, cat) VALUES(?, ?)");
        $insertcat->execute(array($ncat, $catp));

        echo "Votre catégorie a bien été ajoutée";

    } else {
        $erreur = "Cette catégorie existe déjà !";
    }

}

?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Creez une nouvelle catégorie</h1><br>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="well">


                <form method="POST" id="formc">
                    <div class="form-group">
                        <label for="titrec">Nom :</label>
                        <input type="text" class="form-control" name="titrec" id="titrec"/>
                    </div>
                    <div class="form-group">
                        <label for="catp">Categorie principale:</label>
                        <select id="catp" name="catp">
                            <option value="sucre">Sucré</option>
                            <option value="sale">Salé</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control" name="formc" value="Envoyer" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  if (isset($erreur)){
    echo $erreur;
}?>



<?php
 include ('../inc/footer.php');

?>