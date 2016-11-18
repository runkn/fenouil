<?php
include '../inc/header.php';

if (isset($_SESSION['id']))
{
    $requser = $db->prepare("SELECT * FROM utilisateurs where id_utilisateur=?");
    $requser->execute(array($_SESSION['id']));
    $user=$requser->fetch();

}

if ($_SESSION['role'] == 1 ){
    header('location: ../admin/admin.php');
}

/*var_dump($_SESSION);*/

if(empty($_SESSION['id']))

{
    header('location:../index.php');
}

else

{
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bonjour <br><?= $user['pseudo_utilisateur']?></h1>
                PROUT
            </div>

            <a href="deconnexion.php" >Se deco</a>
            <a href="edition_p.php" >Modif profil</a>

        </div>
        <div class="row">
            <div class="col-md-6">


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
        </div>

    <?php

}
?>
