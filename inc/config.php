<?php

//On créer les variables pour la connexion
$host = 'localhost';
$username = 'root';
$password = 'Johanna';


try {
    $db = new PDO("mysql:host=$host;dbname=fenouil", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion effectuée";
}
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }


?>