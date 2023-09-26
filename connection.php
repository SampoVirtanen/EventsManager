<?php
require_once "getenv.php";
use DevCoder\DotEnv;

(new DotEnv(__DIR__ . "/.env"))->load();

$databaseDns = getenv("DATABASE_DNS");
$username = getenv("DATABASE_USER");
$password = getenv("DATABASE_PASSWORD");
try {
    $connection = new PDO($databaseDns, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
        echo "Ei yhteyttä tietokantaan!<br> " . $e->getMessage();
    }

?>