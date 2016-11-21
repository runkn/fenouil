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


            <div class="page-header">
                <h1>Bienvenue <?= ucfirst($user['pseudo_utilisateur'])?><span class="glyphicon glyphicon-grain"></span></h1><br>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?php
                    $req = $db->query('SELECT * from utilisateurs WHERE id_utilisateur = ' . $_SESSION['id'] . ' ');


                    $row = $req->fetch();
        ?><img class="img-circle" src="../membres/avatar/<?= $row['img_utilisateur']; ?>" width="200px"
               height="200px" class="img-responsive"/>

                </div>

                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Vos infos profil:</h3>
                        </div>
                        <div class="panel-body">
                            <p>Pseudo: <?= $row['pseudo_utilisateur']?></p>
                            <p>Nom: <?= $row['nom_utilisateur']?></p>
                            <p>Prenom: <?= $row['prenom_utilisateur']?></p>
                            <p>Email: <?= $row['email_utilisateur']?></p>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="list-group">
                        <a href="membres.php" class="list-group-item">Gestion membres</a>
                        <a href="gestion_a.php" class="list-group-item">Gestion articles</a>
                        <a href="gestion_b.php" class="list-group-item">Gestion brouillons</a>
                        <a href="n_cat.php" class="list-group-item">Creer une nouvelle catégorie</a>
                        <a href="n_article.php" class="list-group-item">Ecrire un nouvel article</a>
                        <a href="../contenu/edition_p.php" class="list-group-item">Modifier ses infos personnelles</a>
                    </div>
                </div>



            </div>

        </div>


        <?php
    }
}
?>

<?php
include '../inc/footer.php';
?>
