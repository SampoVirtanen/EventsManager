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
	"SELECT * FROM kayttajat"
);
$query->execute();
$tulos = $query->fetchAll();
if ($result["admin"] == 1) {
?>
	<nav class="navbar navbar-expand-sm bg-success navbar-dark">
		<a class="navbar-brand" href="#">Logo</a>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link btn btn-success" href="./?tapahtumat">Tapahtumat</a>
			</li>
			<li class="nav-item">
				<a class="nav-link btn btn-success" href="./?osallistujat">Osallistujat</a>
			</li>
			<li class="nav-item">
				<a class="nav-link btn btn-success active" href="./?kayttajat">Käyttäjät</a>
			</li>
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
<?php
} else {
	require_once __DIR__ . "/view/tapahtumat.php";
}
?>




<div id="lisaa" class="container tile-container text-center" style="display: none;">
	<button id="avaalisays" class="btn btn-primary btn-success" onclick="avaaLisays()">Peru</button>
	<h1>Lisää käyttäjä</h1>
	<form action="crud/addUser.php" method="post">
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
		<button type="submit" name="valmis" class="full-width btn btn-primary btn-success">Valmis</button>
	</form>
</div>
<div id="lista">
	<table>
		<tr>
			<th style="width: 5%;">ID</th>
			<th style="width: 30%;">Nimi</th>
			<th style="width: 30%;">Sähköposti</th>
			<th style="width: 30%;">Rooli</th>
			<th class="min">
				<button id="avaalisays" class="btn btn-primary btn-success" onclick="avaaLisays()"><i class="fa-solid fa-plus"></i></button>
			</th>
		</tr>
		<?php
		foreach ($tulos as $rivi) {
			if ($rivi["admin"] == 0) {
				$rooli = "Käyttäjä";
			} else {
				$rooli = "Admin";
			}
		?>
			<tr>
				<td><?php echo $rivi["id"] ?></td>
				<td><?php echo $rivi["nimi"] ?></td>
				<td><?php echo $rivi["email"] ?></td>
				<td><?php echo $rooli ?></td>
				<td class="min">
					<form action="crud/deleteUser.php" method="post">
						<input type="hidden" id="id" name="id" value="<?php echo $rivi["id"] ?>">
						<input type="hidden" id="name" name="name" value="<?php echo $rivi["nimi"] ?>">
						<input type="hidden" id="email" name="email" value="<?php echo $rivi["email"] ?>">
						<input type="hidden" id="admin" name="admin" value="<?php echo $rivi["admin"] ?>">
						<button type="submit" name="valmis" class="delete btn btn-primary btn-danger my-2 my-sm-0"><i class="fa-solid fa-trash-can"></i></button>
					</form>
					<button class="edit btn btn-warning my-2 my-sm-0" onclick="<?php echo "avaaMuokkaus(" . $rivi["id"] . ")" ?>"><i class="fa-solid fa-pen-to-square"></i></button>
				</td>
			</tr>
			<tr class="form" id="<?php echo $rivi["id"] ?>">
				<form action="crud/updateUser.php" method="post">
					<td><?php echo $rivi["id"] ?><input type="hidden" id="id" name="id" value="<?php echo $rivi["id"] ?>"></td>
					<td><input type="text" id="name" name="name" value="<?php echo $rivi["nimi"] ?>"></td>
					<td><input type="text" id="email" name="email" value="<?php echo $rivi["email"] ?>"></td>
					<td>
						<?php if ($rivi["admin"] == 1) {
						?>
							<input type="radio" id="true" name="admin" value="1" checked="">
							<label for="true">Admin</label>
							<input type="radio" id="false" name="admin" value="0">
							<label for="false">Käyttäjä</label>
						<?php } else {
						?>
							<input type="radio" id="true" name="admin" value="1">
							<label for="true">Admin</label>
							<input type="radio" id="false" name="admin" value="0" checked="">
							<label for="false">Käyttäjä</label>
						<?php
						}
						?>
					</td>
					<td class="min">
						<button type="submit" name="valmis" class="full-width btn btn-primary btn-success">Valmis</button>
					</td>
				</form>
			</tr>
		<?php
		}
		?>

	</table>
</div>