<?php
session_start();
include 'inc/config.php';
?>
<DOCTYPE html>
    <html>
    <html lang="fr">
    <head>

        <meta charset = "UTF-8"/>
        <title>La Cuisine à Jacqueline</title>

        <!-- css -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Miam</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Accueil</a></li>
                <li class="active"><a href="contenu/sucre.php">Sucré</a></li>
                <li class="active"><a href="contenu/sale.php">Salé</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['id']))
                {
                    $requser = $db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
                    $requser->execute(array($_SESSION['id']));
                    $user = $requser->fetch();

                    if (!empty($_SESSION['id']))
                    {
                        echo  '<li><a href="contenu/profil.php"><span class="glyphicon glyphicon-user">Bienvenue '.$user['pseudo_utilisateur'].'</span></a></li>';
                        echo '<li><a href=../contenu/deconnexion.php><span class="glyphicon glyphicon-log-out">Se deconnecter</span></a></li>';

                    }
                    else
                    {
                        echo '<li><a href="../contenu/connexion.php"><span class="glyphicon glyphicon-user">Se connecter</span></a></li>';
                    }
                }
                else
                {
                    echo '<li><a href=contenu/connexion.php><span class="glyphicon glyphicon-log-in">Se connecter</span></a></li>';
                    echo '<li><a href=contenu/inscription.php><span class="glyphicon glyphicon-tree-conifer">S\'inscrire</span></a></li>';
                }

                ?>
            </ul>
        </div>
    </nav>
    <body>
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




