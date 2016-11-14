<?php

include 'inc/header.php';

?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bienvenue sur l'accueil !</h1><br>
                <h4> Articles à mettre !</h4>
                <p> Barre de recherche :</p>

                <!-- Barre de recherche en PHP -->
                <?php

                $art = $db->query('SELECT titre_article FROM articles ORDER BY id_article DESC');

                if(isset($_GET['q']) AND !empty($_GET['q'])) {
                    $q = htmlspecialchars($_GET['q']);
                    $art = $db->query('SELECT * FROM articles WHERE titre_article LIKE "%'.$q.'%" ORDER BY id_article DESC');


                }

                ?>

                <!-- Barre de recherche en PHP -->
                <form method="get">

                    <input type="search" name="q" placeholder="Recherche..."/>
                    <input type="submit" value="valider"/>


                </form>

                <?php if($art->rowCount() > 0) { ?>

                <ul>
                    <?php while($a = $art->fetch()) { ?>
                        <li><?= $a['titre_article'] ?></li>
                    <?php } ?>
                    <?php } else { ?>
                        <h3> Aucun résultat pour "<?= $q ?>"</h3>
                    <?php } ?>

                    <?php

                    while($a = $art->fetch()) { ?>

                        <li><?= $a['titre_article'] ?></li>

                    <?php } ?>

                </ul>

            </div>
        </div>
    </div>
    </body>




