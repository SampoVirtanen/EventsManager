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
<button id="avaalisays" class="btn btn-primary btn-success" onclick="avaaMuokkaus(0)">Lisää tapahtuma</button>
<div id="lista">
	<div class="form tapahtuma" id="0">
		<form action="crud/addEvent.php" method="post">
			<div class="header">
				<label for="title">Title:</label><br>
				<input type="text" id="title" name="title" placeholder="Enter title"><br>
			</div>
			<label for="desc">Description:</label><br>
			<input type="textarea" id="desc" name="desc" placeholder="Enter description"><br>

			<div class="startendtime">
				<div class="starttime">
					<label for="start">Start Time:</label><br>
					<input type="datetime-local" id="start" name="start"><br>
				</div>
				<h1>-</h1>
				<div class="endtime">
					<label for="end">End Time:</label><br>
					<input type="datetime-local" id="end" name="end"><br>
				</div>
			</div>
			<label for="adres">Address:</label><br>
			<input type="text" id="adres" name="adres" placeholder="Enter address"><br><br>
			<div class="footer">
				<button type="submit" name="valmis" class="full-width btn btn-primary btn-success">Valmis</button>
			</div>
		</form>
	</div>
	<?php
	foreach ($tulos as $rivi) {
	?>
		<div class="tapahtuma">
			<div class="header">
				<h2 class="id"><?php echo $rivi["id"] ?> </h2>
				<h1 class="title"><?php echo $rivi["title"] ?></h1>
			</div>
			<p class="description"><?php echo $rivi["description"] ?></p>
			<h5 class="startendtime"><?php echo $rivi["start_time"] . " - " . $rivi["end_time"] ?></h5>
			<h5 class="address"><?php echo $rivi["address"] ?></h5>
			<div class="footer">
				<form action="crud/deleteEvent.php" method="post">
					<input type="hidden" id="id" name="id" value="<?php echo $rivi["id"] ?>">
					<input type="hidden" id="title" name="title" value="<?php echo $rivi["title"] ?>">
					<input type="hidden" id="desc" name="desc" value="<?php echo $rivi["description"] ?>">
					<input type="hidden" id="adres" name="adres" value="<?php echo $rivi["address"] ?>">
					<input type="hidden" id="start" name="start" value="<?php echo $rivi["start_time"] ?>">
					<input type="hidden" id="end" name="end" value="<?php echo $rivi["end_time"] ?>">
					<button type="submit" name="valmis" class="delete btn btn-primary btn-danger my-2 my-sm-0"><i class="fa-solid fa-trash-can"></i></button>
				</form>
				<button class="edit btn btn-warning my-2 my-sm-0" onclick="<?php echo "avaaMuokkaus(" . $rivi["id"] . ")" ?>"><i class="fa-solid fa-pen-to-square"></i></button>
			</div>

			<div class="form" id="<?php echo $rivi["id"] ?>">
				<form action="crud/updateEvent.php" method="post">
					<div class="header">
						<h3 class="id"><?php echo $rivi["id"] ?></h3>
						<input type="hidden" id="id" name="id" value="<?php echo $rivi["id"] ?>">
						<label for="title">Title:</label><br>
						<input type="text" id="title" name="title" value="<?php echo $rivi["title"] ?>"><br>
					</div>
					<label for="desc">Description:</label><br>
					<input type="textarea" id="desc" name="desc" value="<?php echo $rivi["description"] ?>"><br>

					<div class="startendtime">
						<div class="starttime">
							<label for="start">Start Time:</label><br>
							<input type="datetime-local" id="start" name="start"><br>
						</div>
						<h1>-</h1>
						<div class="endtime">
							<label for="end">End Time:</label><br>
							<input type="datetime-local" id="end" name="end"><br>
						</div>
					</div>
					<label for="adres">Address:</label><br>
					<input type="text" id="adres" name="adres" value="<?php echo $rivi["address"] ?>"><br><br>
					<div class="footer">
						<button type="submit" name="valmis" class="full-width btn btn-primary btn-success">Valmis</button>
					</div>
				</form>
			</div>
		</div>
	<?php
	}
	?>

</div>