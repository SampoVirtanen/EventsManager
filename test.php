<?php
include "dataaccess.php";

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

$dataAccess = new DataAccess($connection);

$participant1 = new Participant("Etunimi", "Sukunimi", "es@gmail.com");
$participant2 = new Participant("Sampo", "Virtanen", "sv8693@edu.turku.fi");
$participant3 = new Participant("Sdsafadgs", "Rtwtwwt", "sr@gmail.com");
$participant4 = new Participant("Testi", "Cles", "tc@gmail.com");
$participant5 = new Participant("Cvxcvxc", "Hdfhdfgdfg", "ch@gmail.com");
$participant6 = new Participant("Delete", "test", "dt@gmail.com");

$event1 = new Event("Ohjelmistokehittäjänä Toimiminen", "dhrhntynrtyrt", "Turku Amk", "2023-08-30 08:30:00", "2023-08-30 15:00:00", [$participant2, $participant4]);
$event2 = new Event("dngdfngdfndghn", "fngdfngdfgnfdf", "dngdfndfnf", "2023-10-11 10:00:00", "2023-10-15 16:00:00", [$participant1, $participant2, $participant3, $participant4, $participant5]);
$event3 = new Event("sgsdfgdfnbdyr", "dgdgndhnj", "yntyynhgn", "2024-05-23 18:45:00", "2024-05-25 10:26:00", [$participant1, $participant2, $participant3, $participant4, $participant5]);
$event4 = new Event("Delete test", "Testaan toimiiko poisto", "sfdhtnbrenoenryo", "2023-08-30 17:02:00", "2023-08-30 17:03:00", [$participant1, $participant2, $participant3, $participant4, $participant5]);

$dataAccess->addParticipant($participant1);
$dataAccess->addParticipant($participant2);
$dataAccess->addParticipant($participant3);
$dataAccess->addParticipant($participant4);
$dataAccess->addParticipant($participant5);
$dataAccess->addParticipant($participant6);
$participants = $dataAccess->getParticipants();
echo '<pre>'; print_r($participants); echo '</pre>';
$participant3New = $participants[2];
$participant3New->setFirstName("Oetgfgdf");
$participant3New->setLasttName("Kjlkhdffg");
$participant3New->setEmail("ok@gmail.com");
$dataAccess->updateParticipant($participant3New);
$dataAccess->deleteParticipant($participants[5]);
$dataAccess->addEvent($event1);
$dataAccess->addEvent($event2);
$dataAccess->addEvent($event3);
$dataAccess->addEvent($event4);
$events = $dataAccess->getEvents();
echo '<pre>'; print_r($events); echo '</pre>';
$event3New = $events[2];
$event3New->setTitle("gfnfghn hjg");
$event3New->setDescription("Weretwtrtwertwuertwertiuwer wret erterwi tre");
$event3New->setAddress("Mnvdsnfvjdsbs");
$event3New->setStartTime("2025-06-24 19:46:01");
$event3New->setEndTime("2025-06-26 11:27:01");
$dataAccess->updateEvent($event3New);
$dataAccess->deleteEvent($events[3])
?>