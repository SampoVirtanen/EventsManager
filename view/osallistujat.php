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
	<h1>Lisää osallistuja</h1>
	<form action="addParticipant.php" method="post">
		<label for="fname">First name:</label><br>
		<input type="text" id="fname" name="fname" placeholder="Enter first name"><br>
		<label for="lname">Last name:</label><br>
		<input type="text" id="lname" name="lname" placeholder="Enter last name"><br>
		<label for="email">Email:</label><br>
		<input type="text" id="email" name="email" placeholder="Enter email"><br><br>
		<input type="submit" value="Valmis">
	</form>
</body>

</html>