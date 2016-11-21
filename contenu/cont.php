<?php
include "../inc/header.php";


$catid = $_GET['cat'];

$reqa = $db->prepare('SELECT * from articles INNER JOIN categories on articles.id_categorie_article = categories.id_categorie WHERE id_categorie = ?');
$reqa->execute(array($catid));

$row=$reqa->fetch();



?>




<div id="wrap">



    <div class="container">
        <div class="row">

            <div class="page-header">
                <h1 style="text-align: center;">Nos <?= $row['nom_categorie'] ?> <span class="glyphicon glyphicon-shopping-cart"></span></h1><br>
            </div>
        </div>


        <div class="row">

            <div class="col-md-8">


                <?php while ($row=$reqa->fetch()) { ?>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="thumbnail">
                            <a href = "#">
                                <img class="" src="http://lorempixel.com/350/251" alt="...">
                            </a>
                            <div class="caption">
                                <h3><?=ucfirst($row['titre_article'])?></h3>
                                <p>Contenu </p>
                                <a href="/contenu/recette.php?id=<?=$row['id_article']?>">ICI !</a>                        </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="col-md-4 col-lg-4">

                <div class="well">
                    <h4>Rechercher</h4>
                    <form method="get">
                        <div class="input-group">
                            <input type="search" class="form-control" id="q" name="q">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Go!</button>
                                      </span>
                        </div>
                    </form>

                    <?php
                    if(isset($_GET['q']) AND !empty($_GET['q'])) {
                        $q = htmlspecialchars($_GET['q']);

                        $art = $db->query('SELECT * FROM articles WHERE titre_article LIKE "%'.$q.'%" and brouillon_article = 0 ORDER BY id_article DESC LIMIT 5');

                        if($art->rowCount() > 0){

                            while ($a=$art->fetch()){
                                ?>

                                <li><a href="/vipere/contenu/recette.php?id=<?=$a['id_article']?>"><?= ucfirst( $a['titre_article']) ?></a></li>

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

                <div class="well">
                    <header>
                        <h3>A propos de nous...<span class="glyphicon glyphicon-heart"></span></h3><br>
                    </header>
                    <img class="thumbnail" src="http://lorempixel.com/350/251" width="300px"/>
                    <p class="news-content">Mauris viverra et lacus id scelerisque. Vivamus fermentum porta maximus. Curabitur mattis vehicula fermentum. Sed sed sodales purus.</p>
                </div>

                <div class="well">
                    <h4>Les catégories: </h4>
                    <div class="row">
                        <div class="col-lg-6">

                            <ul class="list-group">
                                <?php
                                $categories = $db->query('SELECT * from categories');
                                while  ($categorie = $categories->fetch())

                                {
                                    $nomcat= $categorie['nom_categorie'];

                                    ?>
                                    <li class="list-group-item"><a href="<?= $nomcat?>.php"><?= ucfirst($nomcat)?></a>
                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>

            </div>
        </div>
    </div>
</div>