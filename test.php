<?php
include "datamodel.php";
$participant1 = new Participant("Etunimi", "Sukunimi", "es@gmail.com");
$participant2 = new Participant("Sampo", "Virtanen", "sv8693@edu.turku.fi");
$participant3 = new Participant("Sdsafadgs", "Rtwtwwt", "sr@gmail.com");
$participant4 = new Participant("Testi", "Cles", "tc@gmail.com");
$participant5 = new Participant("Cvxcvxc", "Hdfhdfgdfg", "ch@gmail.com");

$event1 = new Event("Ohjelmistokehittäjänä Toimiminen", "dhrhntynrtyrt", "Turku Amk", 1693371600, 1693396800, [$participant2, $participant4]);
$event2 = new Event("dngdfngdfndghn", "fngdfngdfgnfdf", "dngdfndfnf", 1697009400, 1697374800, [$participant1, $participant2, $participant3, $participant4, $participant5]);


echo "<table>";
echo "<tr>";
echo "<th>Title</th>";
echo "<th>Description</th>";
echo "<th>Address</th>";
echo "<th>Starttime</th>";
echo "<th>Endtime</th>";
echo "</tr>";
echo "<tr>";
echo "<td>", $event1->getTitle(), "</td>";
echo "<td>", $event1->getDescription(), "</td>";
echo "<td>", $event1->getAddress(), "</td>";
echo "<td>", date_format($event1->getStartTime(), "d/m/Y H.i.s"), "</td>";
echo "<td>", date_format($event1->getEndTime(), "d/m/Y H.i.s"), "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>", $event2->getTitle(), "</td>";
echo "<td>", $event2->getDescription(), "</td>";
echo "<td>", $event2->getAddress(), "</td>";
echo "<td>", date_format($event2->getStartTime(), "d/m/Y H.i.s"), "</td>";
echo "<td>", date_format($event2->getEndTime(), "d/m/Y H.i.s"), "</td>";
echo "</tr>";
echo "</table>";

?>