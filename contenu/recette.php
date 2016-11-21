<?php
include '../inc/header.php';



    if (isset($_GET['id']) and !empty($_GET)) {
        $x = htmlspecialchars($_GET['id']);
        $art = $db->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur_article = utilisateurs.id_utilisateur WHERE id_article LIKE ? ");
        $art->execute(array($x));

        $art = $art->fetch();
        $auteur = $art['pseudo_utilisateur'];
        $titre = $art['titre_article'];
        $article = $art['txt_article'];
        $date = $art['date_article'];

        $categorie = $db->query("SELECT * FROM categories INNER JOIN articles ON categories.id_categorie = articles.id_categorie_article WHERE id_article LIKE '$x'");
        $row = $categorie->fetch();

        $categorie = $row['nom_categorie'];




    } else {
        header('location:../index.php');
    }



?>


    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1 style="text-align: center"><?= ucfirst($titre)?><span class="glyphicon glyphicon-grain"></span></h1>
                    <p style="text-align: center"><span class="glyphicon glyphicon-time"></span> Posté le <?=$date?></p>
                    <p style="text-align: center"><span class="glyphicon glyphicon-apple"></span> Posté par <?= ucfirst($auteur)?></p>

                </div>


            </div>
        </div>

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->


                <!-- Preview Image -->
<!--                <img class="img-responsive" value="<?/*= $x */?>" src="../admin/images/<?/*= $img */?>">
-->
                <img class="img-responsive" src="http://lorempixel.com/500/500/food" style="margin: 0 auto"><br>

                <p style="text-align: justify; font-size: 18px"><?=$article?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->

                <?php

                if (isset($_SESSION['id'])) { ?>
                    <div class="well">
                        <h4>Laissez un commentaire:</h4>
                        <form action="" role="form" method="POST" name="form_commentaire">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="commentaire" id="commentaire"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="form_commentaire">Envoyer</button>

                            </form>
                        </div>
        <?php } ?>


                <?php if (isset($_POST['form_commentaire'])){

                    $iduser= $_SESSION['id'];
                    $idarticle = $_GET['id'];
                    $texte = $_POST['commentaire'];

                    $reqcom = $db->prepare ("INSERT INTO commentaires (id_utilisateur_commentaire, id_article_commentaire, txt_commentaire, date_commentaire) VALUES(?, ?, ?, NOW())");

                    $reqcom->execute(array($iduser, $idarticle, $texte));




                }?>


                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->


                <?php



                $affichercom = $db ->prepare('SELECT * FROM commentaires INNER JOIN utilisateurs on commentaires.id_utilisateur_commentaire = utilisateurs.id_utilisateur WHERE id_article_commentaire LIKE "%'.$x.'%" ORDER BY id_commentaire DESC LIMIT 5');
                $affichercom->execute(array($x));

                while ($row = $affichercom->fetch()) { 
                    
                    
                    $pseudouser = $row['pseudo_utilisateur'];
                    
                    
                    ?>


                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="profil_p.php?id=<?=$row['id_utilisateur']?>"><?=ucfirst($pseudouser)?></a>
                                <small><?=$row['date_commentaire']?></small>
                            </h4>
                           <?=$row['txt_commentaire']?>
                        </div>
                    </div>
               <?php } ?>








                <!-- Comment -->

            </div>

            <div class="col-md-4">

                <div class="well">
                    <h4>Rechercher</h4>
                    <form method="get" id="z" name="z">
                        <div class="input-group">
                            <input type="search" class="form-control" id="z" name="z">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Go!</button>
                                      </span>
                        </div>
                    </form>

                    <?php
                    if(isset($_GET['z']) AND !empty($_GET['z'])) {
                        $q = htmlspecialchars($_GET['z']);

                        $art = $db->query('SELECT * FROM articles WHERE titre_article LIKE "%'.$q.'%" and brouillon_article = 0 ORDER BY id_article DESC LIMIT 5');

                        if($art->rowCount() > 0){

                            while ($a=$art->fetch()){
                                ?>

                                <li><a href="recette.php?id=<?=$a['id_article']?>"><?= ucfirst( $a['titre_article']) ?></a></li>

                                <?php
                            }}
                        else

                        {
                            if (isset($q))
                            {
                                $erreur = "Aucun résultat pour ".$q;

                            }
                            if (isset($erreur))
                            {
                                echo $erreur;
                            }

                        }

                    }
                    ?>
                </div>
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Si vous avez encore faim...</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                                $categories = $db->query('SELECT * from categories LIMIT 5');
                                while  ($categorie = $categories->fetch())

                                {
                                    $nomcat= $categorie['nom_categorie'];

                                    ?>
                                    <li><a href="<?= $nomcat?>.php"><?= ucfirst($nomcat)?></a>
                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include '../inc/footer.php';
?>

