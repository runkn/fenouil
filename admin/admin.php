<?php
include ('../inc/header.php');

if (isset($_SESSION))
{
    $requser = $db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if ($_SESSION['role'] != 1)
    {
        header('location: ../index.php?oh=oui');
    }
    else
    {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Compte Administrateur de : <?= $user['pseudo_utilisateur']?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                        <br/>
                        <?php
                        $req = $db->query('SELECT img_utilisateur from utilisateurs WHERE id_utilisateur = ' . $_SESSION['id'] . ' ');
                        while ($row = $req->fetch()) { ?>

                            <!-- J'ai créer un dossier membres a la racine de fenouil et dedans j'ai créer un dossier nommée avatar !" -->
                            <!-- Les photos seront nommés par l'ID de la personne! -->

                            <img class="img-circle" src="../membres/avatar/<?= $row['img_utilisateur']; ?>" width="200px"
                                 height="200px" class="img-responsive"/>


                            <?php
                        }
                        ?>
                    </div>
                <div class="col-md-6">
                </div>
                <br>
                <a href="deconnexion.php">Se deco</a> <br>
                <a href="edition_p.php">Modif profil</a> <br>
                <a href="membres.php">Gestion membres</a> <br>
                <a href="gestion_a.php">Gestion articles</a> <br>
                <a href="n_article.php">Ecrire un nouvel article</a> <br>
                <!-- Pense à changer l'URL en dessous !! -->
                <a href="/fenouil/contenu/edition_p.php">Modifier Info's perso</a>
            </div>
            <div class="row">


          
                </div>
            </div>

        </div>
        <?php
    }
}
?>