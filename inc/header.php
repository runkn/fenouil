<?php
session_start();
include 'config.php';
if(isset($_SESSION['id'])) {
    $requser = $db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
}
?>
<DOCTYPE html>
    <html>
    <html lang="fr">
    <head>
        <meta http-equiv="Content-Type" charset=utf-8" />
        <script src="https://use.fontawesome.com/85dd480a9d.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
        <title>La Cuisine à Jacqueline</title>

        <!-- css -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>


        a {
            text-decoration: none;
        }
        
        #pfooter {
            line-height: 60px;
        }
      

        #ifooter {
            line-height: 60px;
            display: inline-block;
            margin-left: 20px;
        }

        .limit {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        #wrap {
            min-height: 100%;
            height: auto;
            margin: 0 auto -60px;
            padding: 0 0 60px;
        }


        #footer {
            height: 60px;
            background-color: #eee;
        }

        .news-pic{
            float: right;
        }

        .well {
            overflow: hidden;
        }

        .thumbnail {

        }



        .navbar {
            margin-bottom:0;
        }
        .jumbotron {
            margin-bottom:0;
        }




    </style>
    </head>

    <body>










        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">Miam</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../index.php">Accueil</a></li>
                    <li class="active"><a href="../contenu/sucre.php">Sucré</a></li>
                    <li class="active"><a href="/contenu/sale.php">Salé</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['id']))
                    {
                        if (!empty($_SESSION['id']))
                        {?>
                            <li><a href="../contenu/profil.php"><span class="glyphicon glyphicon-user"></span> Bienvenue <?= ucfirst($user['pseudo_utilisateur'])?></a></li>
                            <li><a href="../contenu/deconnexion.php"><span class="glyphicon glyphicon-log-out"></span> Se deconnecter </a></li>
                       <?php }
                        else
                        {?>
                                                 <!-- <li><a href="../contenu/connexion.php"><span class="glyphicon glyphicon-user">Se connecter</span></a></li>-->
                       <?php }
                    }
                    else
                    {?>
                       <li><a href="../contenu/connexion.php"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
                       <li><a href="../contenu/inscription.php"><span class="glyphicon glyphicon-tree-conifer"></span> S'inscrire</a></li>
                    <?php }
                    ?>
                </ul>

            </div>

        </nav>



