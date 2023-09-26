<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
$participant = new Participant($_POST["fname"], $_POST["lname"], $_POST["email"]);
$participant->setID($_POST["id"]);
$dataAccess->updateParticipant($participant);
header("Location: ../?osallistujat");
?>