<?php

$servername = "localhost";
$username = "";
$password = "";
try {
    $connection = new PDO("mysql:host=$servername;dbname=events_manager", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
        echo "Ei yhteyttä tietokantaan!<br> " . $e->getMessage();
    }

?>