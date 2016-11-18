<?php
include "../inc/header.php";

if (isset($_GET['prout']) and !empty($_GET['prout'])){

    $proutsecurisé = htmlspecialchars($_GET['prout']);
    $requete = $db->prepare('DELETE from articles WHERE id_article = ?');
    $requete->execute(array($proutsecurisé));
    
    header('location: gestion_a.php');

}



?>