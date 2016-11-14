<?php
include ('../inc/header.php');
var_dump($_SESSION);

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
                    <h1>Coucou admin <?= $user['pseudo_utilisateur']?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <a href="deconnexion.php" >Se deco</a>
                <a href="edition_p.php" >Modif profil</a>
            </div>
        </div>
        <?php
    }
}
?>