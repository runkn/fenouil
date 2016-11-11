<?php
session_start();
?>

<DOCTYPE html>
    <html>
    <html lang="fr">
    <head>

        <meta charset = "UTF-8"/>
        <title>La Cuisine à Jacqueline</title>

        <!-- css -->
        <link rel="stylesheet" href="../css/bootstrap.css" />
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/bootstrap-theme.css" />
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css" />



    </head>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">Miam</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="../index.php">Accueil</a></li>
                <li class="active"><a href="../contenu/sucre.php">Sucré</a></li>
                <li class="active"><a href="../contenu/sale.php">Salé</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php

                ?>
                <li><a href="../contenu/inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>

                <li><a href=../contenu/connexion.php><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
            </ul>
        </div>
    </nav>
