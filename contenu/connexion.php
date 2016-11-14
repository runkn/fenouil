<?php session_start();

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
                <a class="navbar-brand" href="../index.php">Miam</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="../index.php">Accueil</a></li>
                <li class="active"><a href="sucre.php">Sucré</a></li>
                <li class="active"><a href="sale.php">Salé</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php

                $db = new PDO('mysql:host=localhost;dbname=fenouil', 'root', 'Johanna');


                if (isset($_SESSION['id']))
                {
                    if (!empty($_SESSION['id']))
                    {
                        echo  '<li><a href="../contenu/profil.php"><span class="glyphicon glyphicon-user">Bienvenue '.$_SESSION['pseudo'].'</span></a></li>';
                        echo '<li><a href=../contenu/deconnexion.php><span class="glyphicon glyphicon-log-out">Se deconnecter</span></a></li>';

                    }
                    else
                    {
                        echo '<li><a href="../contenu/connexion.php"><span class="glyphicon glyphicon-user">Se connecter</span></a></li>';
                    }
                }
                else
                {
                    echo '<li><a href=connexion.php><span class="glyphicon glyphicon-log-in">Se connecter</span></a></li>';
                    echo '<li><a href=inscription.php><span class="glyphicon glyphicon-tree-conifer">S\'inscrire</span></a></li>';
                }

                ?>
            </ul>
        </div>
    </nav>

    <?php

        if (isset($_POST['formconn'])) {
            $pseudoconn = htmlspecialchars($_POST['pseudoconn']); //Correspond au nom du champ formulaire
            $mdpconn = sha1($_POST['mdpconn']); // Idem, avec en + sha1 = Cryptage mdp

            //Si la variable mailconnect et mdpconnect n'est pas vide, on peux continuer.
            if (!empty($pseudoconn) AND !empty($mdpconn)) {
                //On vérifie que l'utilisateur existe.
                $requser = $db->prepare("SELECT * FROM utilisateurs WHERE pseudo_utilisateur = ? AND mdp_utilisateur = ?");

                //On execute la requête
                $requser->execute(array($pseudoconn, $mdpconn));

                //rowcount, petite fonction pour compter le nbres de colonnes.
                $userexist = $requser->rowCount();

                if ($userexist == 1) {
                    $userinfo = $requser->fetch();
                    $_SESSION['id'] = $userinfo['id_utilisateur'];
                    $_SESSION['role'] = $userinfo['id_role_utilisateur'];
                    $_SESSION['pseudo'] = $userinfo['pseudo_utilisateur'];
                    $_SESSION['mdp'] = $userinfo['mdp_utilisateur'];


                    header("location: profil.php?id=" . $_SESSION['id']);
                } //Sinon, la variable erreur sera égale à :
                else {
                    $erreur = "Mauvais mail ou mot de passe";
                }

            } else {
                $erreur = "Tous les champs doivent être complétés !";
            }
    }



    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <br><h1>Connectez-vous</h1><br>

            </div>
        </div>


        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <form method="post" action="">

                    <div class="form-group">
                        <label for="pseudo">Pseudo:</label>
                        <input type="text" class="form-control" name="pseudoconn" id="pseudo">
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de passe:</label>
                        <input type="password" class="form-control" name="mdpconn" id="mdp">
                    </div>

                    <input type="submit" class="form-control" value="Envoyer" name="formconn">
                </form>
                <?php

                if(isset($erreur)) {

                    echo '<br /><font color="red">' . $erreur . '</font>';

                }




                ?>

            </div>
        </div>


