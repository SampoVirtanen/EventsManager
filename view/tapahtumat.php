<?php
if (!empty($_SESSION["userId"])) {
	include "connection.php";

	$query = $connection->prepare(
		"SELECT * FROM kayttajat WHERE id = :id"
	);
	$query->execute(array(
		":id" => $_SESSION["userId"]
	));
	$result = $query->fetch();
}
?>
<html lang="fi">

<head>
	<meta charset="utf-8">
	<title> </title>
	<link rel="stylesheet" href="../BS/bootstrap.min.css">
	<script src="../BS/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/script.js"></script>
</head>

<body>
	<h1>Lisää tapahtuma</h1>
	<form action="addEvent.php" method="post">
		<label for="title">Title:</label><br>
		<input type="text" id="title" name="title" placeholder="Enter title"><br>
		<label for="desc">Description:</label><br>
		<input type="textarea" id="desc" name="desc" placeholder="Enter description"><br>
		<label for="adres">Address:</label><br>
		<input type="text" id="adres" name="adres" placeholder="Enter address"><br>
		<label for="start">Start Time:</label><br>
		<input type="datetime-local" id="start" name="start"><br>
		<label for="end">End Time:</label><br>
		<input type="datetime-local" id="end" name="end"><br><br>
		<input type="submit" value="Valmis">
	</form>
</body>

</html>