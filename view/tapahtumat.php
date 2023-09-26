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
	$displayName = $result["nimi"];
}
$query = $connection->prepare(
	"SELECT * FROM events"
);
$query->execute();
$tulos = $query->fetchAll();
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark">
	<a class="navbar-brand" href="#">Logo</a>
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link btn btn-success active" href="./?tapahtumat">Tapahtumat</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-success" href="./?osallistujat">Osallistujat</a>
		</li>
		<?php
		if ($result["admin"] == 1) {
		?>
			<li class="nav-item">
				<a class="nav-link btn btn-success" href="./?kayttajat">Käyttäjät</a>
			</li>
		<?php
		}
		?>
	</ul>
	<ul class="navbar-nav ml-auto">
		<div class="dropdown">
			<button class="btn btn-success"><i class="fa-solid fa-user-gear"></i> <?php echo $displayName ?></button>
			<div class="dropdown-content">
				<a href="./?salasana" class="btn btn-warning my-2 my-sm-0">
					Vaihda salasana
				</a>
				<a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
					Kirjaudu ulos <i class="fa-solid fa-right-from-bracket"></i>
				</a>
			</div>
		</div>
	</ul>
</nav>
<button id="avaalisays" class="btn btn-primary btn-success" onclick="avaaLisays()">Lisää tapahtuma</button>
<div id="lisaa" class="container tile-container text-center" style="display: none;">
	<h1>Lisää tapahtuma</h1>
	<form action="crud/addEvent.php" method="post">
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
		<button type="submit" name="valmis" class="full-width btn btn-primary btn-success">Valmis</button>
	</form>
</div>
<div id="lista">
	<?php
	foreach ($tulos as $rivi) {
	?>
		<div class="tapahtuma">
			<h1 class="title"><?php echo $rivi["title"] ?></h1>
			<p class="description"><?php echo $rivi["description"] ?></p>
			<h5 class="startendtime"><?php echo $rivi["start_time"] . " - " . $rivi["end_time"] ?></h5>
			<h5 class="address"><?php echo $rivi["address"] ?></h5>
			<button class="delete btn btn-danger my-2 my-sm-0"><i class="fa-solid fa-trash-can"></i></button>
			<button class="edit btn btn-warning my-2 my-sm-0"><i class="fa-solid fa-pen-to-square"></i></button>
		</div>
	<?php
	}
	?>

</div>