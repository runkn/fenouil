<?php

include 'inc/header.php';

?>
<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-md-6">
            <h1>Bienvenue sur l'accueil !</h1><br>
            <p> Barre de recherche :</p>

            <!-- Barre de recherche en PHP -->
            <?php


            if(isset($_GET['q']) AND !empty($_GET['q'])) {
                $q = htmlspecialchars($_GET['q']);
                $art = $db->query('SELECT * FROM articles WHERE titre_article LIKE "%'.$q.'%" ORDER BY id_article DESC');

                if($art->rowCount() > 0){
                    $a=$art->fetch();
                    var_dump($a);
                    ?>

                    <li><a href="contenu/recette.php?id="<?php $a['id_article']?>><?= $a['titre_article'] ?></a></li>

                <?php
                }
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



            <!-- Barre de recherche en PHP -->
            <form method="get">

                <input type="search" name="q" placeholder="Recherche..."/>
                <input type="submit" value="valider"/>


            </form>


            <ul>








            </ul>

        </div>
    </div>
</div>
</body>




