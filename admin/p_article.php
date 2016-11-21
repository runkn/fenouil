<?php
include ('../inc/header.php');

if ($_SESSION['role'] != 1){
    
    header('location:index.php?oh=oui');
}


var_dump($_GET);

if (isset($_GET['id'])) {


    $idarticle = htmlspecialchars($_GET['id']);

    $publierarticle = $db->prepare('UPDATE articles SET brouillon_article = 0 WHERE id_article = ? ');
    $publierarticle->execute(array($idarticle));

    header('location: admin.php');

}
?>
