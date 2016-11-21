<?php

//On créer les variables pour la connexion
$host = 'localhost';
$username = 'root';
$password = 'root';


try {
    $db = new PDO("mysql:host=$host;dbname=fenouil", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Rajout de cette putain de ligne qui m'a bien saoulé ! pour afficher les caractères !!
    $db->exec("SET CHARACTER SET utf8");

}
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }


?>