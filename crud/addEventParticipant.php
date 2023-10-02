<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
$participant = new Participant($_POST["fname"], $_POST["lname"], $_POST["email"]);
$participant->setID($_POST["osallistuja"]);
$event = new Event($_POST["title"], $_POST["desc"], $_POST["adres"], $_POST["start"], $_POST["end"], [$participant]);
$event->setID($_POST["id"]);
$dataAccess->addEventParticipants($event);
header("Location: ../?tapahtumat");
?>