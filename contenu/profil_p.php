<?php
include '../inc/header.php';

if (isset($_SESSION['id']))
{
    $requser = $db->prepare("SELECT * FROM utilisateurs where id_utilisateur=?");
    $requser->execute(array($_GET['id']));
    $user=$requser->fetch();

}

if ($_SESSION['role'] == 1 ){
    header('location: ../admin/admin.php');
}


if(empty($_SESSION['id']))

{
    header('location:../index.php');
}

else

{
    ?>

    <div class="container">


        <div class="page-header">
            <h1>Profil de <?= ucfirst($user['pseudo_utilisateur'])?><span class="glyphicon glyphicon-grain"></span></h1><br>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?php

                $req = $db->prepare('SELECT * from utilisateurs WHERE id_utilisateur = ?');
                $req->execute(array($_GET['id']));


                $row = $req->fetch();
                ?><img class="img-circle" src="../membres/avatar/<?= $row['img_utilisateur']; ?>" width="200px"
                       height="200px" class="img-responsive"/>

            </div>

            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ses infos profil:</h3>
                    </div>
                    <div class="panel-body">
                        <p>Pseudo: <?= $row['pseudo_utilisateur']?></p>
                        <p>Email: <?= $row['email_utilisateur']?></p>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <?php

}
?>
