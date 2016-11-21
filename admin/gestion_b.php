<?php
include ('../inc/header.php');


if ($_SESSION['role'] != 1){
    header('location:../index.php?oh=oui');
}

$reqbrouillon = $db->query('SELECT * from articles
INNER JOIN categories ON articles.id_categorie_article = categories.id_categorie WHERE brouillon_article = 1');
$result = $reqbrouillon->fetch();


?>

<div class="row">
    <div class="col-md-8">
        <div class="container">
            <h2>Liste des brouillons</h2><hr><br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Categorie</th>
                    <th>Publier</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>


                </tr>
                </thead>
                <tbody>
                <?php
                while ($result = $reqbrouillon->fetch()){?>

                    <tr>
                        <td><?= $result['id_article']?></td>
                        <td><?= $result['titre_article']?></td>
                        <td><?= $result['nom_categorie']?></td>
                        <td><a href="p_article.php?id=<?=$result['id_article']?>"><span class="glyphicon glyphicon-heart"></span></a></td>
                        <td><a href="m_article.php?id=<?=$result['id_article']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                        <td><a href="supprimer.php?prout=<?=$result['id_article']?>" <span class="glyphicon glyphicon-trash"></span></a></td>


                    </tr>


                <?php }?>





                </tbody>
            </table>
        </div>
    </div>
</div>


