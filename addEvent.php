<?php
include "dataaccess.php";
include "connection.php";
$dataAccess = new DataAccess($connection);

$_POST["title"];
$_POST["desc"];
$_POST["adres"];
$_POST["start"];
$_POST["end"];

$event = new Event($_POST["title"], $_POST["desc"], $_POST["adres"], $_POST["start"], $_POST["end"], []);

$dataAccess->addEvent($event);
?>