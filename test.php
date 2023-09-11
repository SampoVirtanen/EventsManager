<?php
include "dataaccess.php";
include "connection.php";

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

$user1 = new User("testi1", "tst84@gmail.com", "TestPassword1", false);
$user2 = new User("testi2", "tst51@gmail.com", "TestPassword2", true);
$user3 = new User("DeleteTest", "dt@gmail.com", "TestPassword3", false);

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
$dataAccess->deleteEvent($events[3]);

$dataAccess->addUser($user1);
$dataAccess->addUser($user2);
$dataAccess->addUser($user3);
$users = $dataAccess->getUsers();
echo '<pre>'; print_r($users); echo '</pre>';
$user2New = $users[3];
$user2New->setNimi("testi2New");
$user2New->setEmail("tst52@gmail.com");
$user2New->setSalasana("TestPassword2New");
$user2New->setAdmin(true);
$dataAccess->updateUser($user2New);
$dataAccess->deleteUser($users[4]);

?>