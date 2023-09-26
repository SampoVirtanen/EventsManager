<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
$user = new User($_POST["name"], $_POST["email"], $_POST["slsn"], $_POST["admin"]);
$dataAccess->addUser($user);
header("Location: ../?kayttajat");
?>