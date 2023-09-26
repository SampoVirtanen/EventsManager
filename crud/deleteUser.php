<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
$user = new User($_POST["name"], $_POST["email"], "", $_POST["admin"]);
$user->setID($_POST["id"]);
$dataAccess->deleteUser($user);
header("Location: ../?kayttajat");
?>