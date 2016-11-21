<?php
include '../inc/header.php';


if (isset($_GET['id']) and !empty($_GET))
{
    $x = htmlspecialchars($_GET['id']);
    $art = $db->prepare("SELECT * FROM articles WHERE id_article LIKE ? ");
    $art->execute(array($x));

    $art = $art->fetch();

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


<?php


/*if(isset($_GET['q']) AND !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    $art = $db->query('SELECT * FROM articles WHERE titre_article LIKE "%'.$q.'%" ORDER BY id_article DESC');

    if($art->rowCount() > 0){
        $a=$art->fetch();
        var_dump($a);
        */?><!--

        <li><a href="contenu/recette.php?id="<?php /*$a['id_article']*/?>><?/*= $a['titre_article'] */?></a></li>

        --><?php
/*    }
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
*/?>


<div class="container">

    <div class="row">
        <div class="col-md-12">
            <!-- Title -->
            <h1 style="text-align: center"><?= $titre?></h1>


            <!-- Date/Time -->
            <p style="text-align: center"><span class="glyphicon glyphicon-time"></span> Posté le <?=$date?></p>

            <hr>

        </div>
    </div>

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->


            <!-- Preview Image -->
            <img class="img-responsive" src="../contenu/broccoli_d.jpg" alt="">

            <hr>


            <p><?=$article?></p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Laissez un commentaire:</h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <form method="get">
                    <input type="text" class="form-control" name="q">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                        </form>
                </div>
                <!-- /.input-group -->
            </div>











            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Si vous avez encore faim...</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <?php
                            $categories = $db->query('SELECT * from categories');
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
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>Side Widget Well</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>

        </div>

    </div>
    <!-- /.row -->

    <hr>


</div>

<?php
include '../inc/footer.php';
?>
