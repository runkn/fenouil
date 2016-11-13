<?php
session_start();
include '../inc/header.php';

$db = new PDO('mysql:host=localhost;dbname=fenouil', 'root', 'Johanna');

if(isset($_SESSION['id']))
{
    $requser = $db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Bonjour <?= $user['pseudo_utilisateur']; ?>
                    <br> </h1>
                PROUT
                <br><br>
            </div>

            <a href="deconnexion.php" >Se deco</a>
            <a href="edition_p.php" >Modif profil</a>


        </div>
        <div class="row">
            <div class="col-md-6">


                <?php

                $req = $db->query('SELECT img_utilisateur from utilisateurs WHERE id_utilisateur = '.$_SESSION['id'].' ');


                while($row = $req->fetch()) { ?>

                    <!-- J'ai créer un dossier membres a la racine de fenouil et dedans j'ai créer un dossier nommée avatar !" -->
                    <!-- Les photos seront nommés par l'ID de la personne! -->
                    <img class="img-circle" src="../membres/avatar/<?= $row['img_utilisateur']; ?>" width="300px" height="300px" class="img-responsive" />


                    <?php
               }
               ?>


            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>