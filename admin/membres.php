<?php
include "../inc/header.php";


if ($_SESSION['role'] != 1)
{
    header('location: ../index.php?oh=oui');
}


$requserl = $db->query('SELECT * from utilisateurs');







?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Gestion des membres</h1><br>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">
            <div class="container">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Supprimer</th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $requserl->fetch()){?>

                        <tr>
                            <td><?= $row['id_utilisateur']?></td>
                            <td><?= $row['nom_utilisateur']?></td>
                            <td><?= $row['prenom_utilisateur']?></td>
                            <td><?= $row['pseudo_utilisateur']?></td>
                            <td><?= $row['email_utilisateur']?></td>
                            <td><a href="supprimer_m.php?mdr=<?=$row['id_utilisateur']?>" <span class="glyphicon glyphicon-trash"></span></a></td>


                        </tr>


                    <?php }?>





                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>