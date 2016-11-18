<?php
include "../inc/header.php";



if ($_SESSION['role'] != 1)
{
    header('location: ../index.php?oh=oui');
}


if (isset($_POST['marticle']) AND !empty($_POST['marticle'])){

    $id2 = htmlspecialchars($_GET['id']);
    $titre = htmlspecialchars($_POST['titre']);
    $texte = htmlspecialchars($_POST['texte']);
    $date = $_POST['date'];

    $update = $db->prepare('UPDATE articles SET titre_article = ?, txt_article = ?, date_article = ? WHERE id_article = ?');

    

    $update->execute(array($titre, $texte, $date, $id2));

    header('location:admin.php');
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


                    <form action="" enctype="multipart/form-data" method="post">
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

                        </div>
                        <div class="form-group">
                            <select>
                                <?php
                                $reqcatt = $db->query("SELECT * from categories");

                                while ($row = $reqcatt->fetch())
                                {

                                    $nom= $row['nom_categorie'];
                                    $id=$row['id_categorie'];

                                    ?>
                                    <option value="<?$id?>"><?=$nom ?></option>

                                    <?php
                                }
                                ?>
                            </select>

                        </div>


                        <div class="form-group">
                            <input type="file">
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