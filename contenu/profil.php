<?php
session_start();
include '../inc/header.php';
/*echo '<pre>';
var_dump($_SESSION);
echo '</pre>';*/

if(empty($_SESSION['id']))
{
    header('location:../index.php');
}


    var_dump($_SESSION['pseudo']);




?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Bonjour <?= $_SESSION['pseudo']; ?>
                <br> </h1>
            PROUT
        </div>

        <a href="deconnexion.php" >Se deco</a>
        <a href="edition_p.php" >Modif profil</a>


    </div>
</div>