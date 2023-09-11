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
	<h1>Lisää käyttäjä</h1>
	<form action="addKayttaja.php" method="post">
		<label for="name">Nimi:</label><br>
		<input type="text" id="name" name="name" placeholder="Enter name"><br>
		<label for="email">Email:</label><br>
		<input type="text" id="email" name="email" placeholder="Enter email"><br>
		<label for="slsn">Salasana:</label><br>
		<input type="password" id="slsn" name="slsn" placeholder="Enter last name"><br>
		<label for="admin">Admin:</label><br>
		<input type="radio" id="true" name="admin" value="1">
		<label for="true">Kyllä</label>
		<input type="radio" id="false" name="admin" value="0">
		<label for="false">Ei</label><br>
		<input type="submit" value="Valmis">
	</form>
</body>

</html>