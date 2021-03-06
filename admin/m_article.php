<?php
include "../inc/header.php";


if ($_SESSION['role'] != 1)
{
    header('location: ../index.php?oh=oui');
}


if (isset($_POST['marticle']) AND isset($_FILES['image']) AND !empty($_POST['marticle'])) {


    $id2 = $_GET['id'];
    $titre = htmlspecialchars($_POST['titre']);
    $texte = htmlspecialchars($_POST['texte']);
    $date = $_POST['date'];
    $idcat = $_POST['categorie'];



        $update = $db->prepare('UPDATE articles SET id_categorie_article = ?, titre_article = ?, txt_article = ?, date_article = ? WHERE id_article = ?');

        $update->execute(array($idcat, $titre, $texte, $date, $id2));
        var_dump($update);

}


    if (isset($_GET['id']) and !empty($_GET['id'])) {


        $requetearticle = $db->prepare('SELECT * from articles where id_article = ?');
        $idarticle = htmlspecialchars($_GET['id']);
        $requetearticle->execute(array($idarticle));

        while($row = $requetearticle->fetch()){
            $titre2=$row['titre_article'];
            $contenu2=$row['txt_article'];
            $date2=$row['date_article'];

        }
    }

if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['image']['size'] <= $tailleMax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides)) {


            $img = $_FILES['image']['name'];

            $chemin = "../admin/images/$img";

            $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$chemin);

            if(isset($resultat))

            {
                $idart = $_GET['id'];
                $img = $_FILES['image']['name'];
                $updateavatar = $db->prepare('UPDATE articles SET img_article = ? WHERE id_article = ?');
                $updateavatar->execute(array($img, $idart));

            }

            else {
                $msg = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}

    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Modifier un article:</h2><hr><br>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="well">


                    <form action="" enctype="multipart/form-data" method="post" name="marticle">
                        <div class="form-group">
                            <label for="titre">Titre:</label>
                            <input type="text" class="form-control" name="titre" id="titre" value="<?= $titre2?>"/>
                        </div>
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" name="date" id="date" value="<?= $date2?>"/>
                        </div>
                        <div class="form-group">
                            <label for="texte">Texte:</label>
                            <textarea rows="4" cols="50" class="form-control" name="texte" id="texte"><?=$contenu2?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categorie">Categorie:</label>
                            <select name="categorie" id="categorie">
                                <?php
                                $reqcatt = $db->query("SELECT * from categories");

                                while ($row = $reqcatt->fetch())
                                {

                                    $nom= $row['nom_categorie'];
                                    $id=$row['id_categorie'];

                                    ?>
                                    <option value="<?=$id?>"><?=$nom ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" id="image" name="image" value="">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control" name="marticle" value="Enregistrer les modifications" />
                        </div>
                    </form>
                </div>

            </div>




        </div>
    </div>



    <?php








    ?>