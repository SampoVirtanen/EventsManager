<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
$event = new Event($_POST["title"], $_POST["desc"], $_POST["adres"], $_POST["start"], $_POST["end"], []);
$event->setID($_POST["id"]);
$dataAccess->deleteEvent($event);
header("Location: ../?tapahtumat");
?>