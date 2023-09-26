<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
$event = new Event($_POST["title"], $_POST["desc"], $_POST["adres"], $_POST["start"], $_POST["end"], []);
$dataAccess->addEvent($event);
header("Location: ../?tapahtumat");
?>