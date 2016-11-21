<?php
include "../inc/header.php";

if (isset($_GET['mdr']) and !empty($_GET['mdr'])){

    $mdrsecurisé = htmlspecialchars($_GET['mdr']);
    $requete = $db->prepare('DELETE from utilisateurs WHERE id_utilisateur = ?');
    $requete->execute(array($mdrsecurisé));

    header('location: membres.php');

}



?>