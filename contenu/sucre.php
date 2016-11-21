<?php
include '../inc/header.php';


$recettes = $db->query('SELECT * from categories WHERE cat ="sucre"');

$qsd = $db->query('SELECT * from categories INNER JOIN articles on categories.id_categorie = articles.id_categorie_article WHERE cat = "sucre"');
$rowt=$qsd->fetch();




?>
<div id="wrap">



<div class="container">
    <div class="row">

        <div class="page-header">
            <h1 style="text-align: center;;">Nos catégories sucrées <span class="glyphicon glyphicon-shopping-cart"></span></h1><br>
        </div>
    </div>


    <div class="row">

        <div class="col-md-8">


            <?php while ($row=$recettes->fetch()) { ?>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="thumbnail">
                        <a href = "/contenu/cont.php?cat=<?=$row['id_categorie']?>">
                            <img class="" src="http://lorempixel.com/350/251" alt="...">
                        </a>
                        <div class="caption">
                            <h3><?=ucfirst($row['nom_categorie'])?></h3>
                            <a href="/contenu/cont.php?cat=<?=$row['id_categorie']?>" class="btn btn-info" role="button">Ok </a>                        </div>
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

        </div>
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

<?php
include ('../inc/footer.php');

?>