
<?php

include 'inc/header.php';


$reqarticle = $db->query('SELECT * from articles WHERE brouillon_article = 0');




?>


<?php

if (isset($_GET['oh'])) {?>

    <script type="text/javascript" xmlns="http://www.w3.org/1999/html">

        alert('Vous avez été redirigé! Chenapan!');


    </script>


<?php }

?>


    <div class="jumbotron">
        <div class="container">

            <h1>Bienvenue sur l'accueil !</h1>
            <p>Ici vous pouvez tout faire c'est top.</p>
            <!-- <p><a class="btn btn-primary btn-lg">Sign Up</a></p> -->
        </div>
    </div><br>
<div id="wrap">


    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-8 col-sm-12">

                <div class="page-header">
                    <h1>Nos derniers articles en ligne  <span class="glyphicon glyphicon-grain"></span></h1><br>
                </div>

                <?php
                        while ($row=$reqarticle->fetch()) { ?>




                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="thumbnail">
                                    <a href = "contenu/recette.php?id=<?=$row['id_article']?>">
                                        <img class="" src="contenu/broccoli_d.jpg" alt="...">
                                    </a>
                                    <div class="caption">
                                        <p class="limit"><?=$row['titre_article'] ?></p>
                                        <p class="limit"><?=$row['date_article']?></p>
                                        <p class="limit"><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                    </div>
                                </div>
                            </div>



                        <?php } ?>




            </div>


            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
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

                     <li><a href="contenu/recette.php?id=<?=$a['id_article']?>"><?= ucfirst( $a['titre_article']) ?></a></li>

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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="text-center">Les catégories</h4>
                    </div>
                    <div class="panel-body text-center" style="display: none">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-unstyled">
                                    <?php
                                    $categories = $db->query('SELECT * from categories');
                                    while  ($categorie = $categories->fetch())
                                    {
                                        $nomcat= $categorie['nom_categorie'];
                                        ?>
                                        <li><a href="contenu/cont.php?cat=<?=$categorie['id_categorie']?>"><?= ucfirst($nomcat)?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
            <button align="center">Clique, c'est magique !</button>

        </div>
    </div>



</div>

<script>
    $(document).ready(function(){
        $("button").click(function(){
            var div = $("h4");
            div.animate({left: '20px'}, "slow");
            div.animate({fontSize: '3em'}, "slow");
        });
    });
    $(document).ready(function(){
        $(".panel-heading").click(function(){
            $(".panel-body").animate({
                height: 'toggle'
            });
        });
    });
</script>
</div>
<?php
include 'inc/footer.php';
?>

