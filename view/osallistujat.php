<?php
if (!empty($_SESSION["userId"])) {
	include "connection.php";
	$result = $dataAccess->getUser($_SESSION["userId"]);
	$displayName = $result["nimi"];
}
$participants = $dataAccess->getParticipants();
?>
<nav class="navbar navbar-expand-sm bg-success navbar-dark">
	<a class="navbar-brand" href="#">Logo</a>
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link btn btn-success" href="./?tapahtumat">Tapahtumat</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn btn-success active" href="./?osallistujat">Osallistujat</a>
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

<div id="lista">
	<table>
		<tr>
			<th style="width: 5%;">ID</th>
			<th style="width: 30%;">Etunimi</th>
			<th style="width: 30%;">Sukunimi</th>
			<th style="width: 30%;">Sähköposti</th>
			<th class="min">
				<button id="avaalisays" class="btn btn-primary btn-success" onclick="avaaMuokkaus(0)"><i class="fa-solid fa-plus"></i></button>
			</th>
		</tr>
		<tr class="form" id="0">
			<form action="crud/addParticipant.php" method="post">
				<td><input type="hidden" id="id" name="id" value=""></td>
				<td><input type="text" id="fname" name="fname" placeholder="Enter first name"></td>
				<td><input type="text" id="lname" name="lname" placeholder="Enter last name"></td>
				<td><input type="text" id="email" name="email" placeholder="Enter email"></td>
				<td class="min">
					<button type="submit" name="valmis" class="full-width btn btn-primary btn-success"><i class="fa-solid fa-floppy-disk"></i></button>
				</td>
			</form>
		</tr>

		<?php
		foreach ($participants as $participant) {
		?>
			<tr>
				<td><?php echo $participant->getId() ?></td>
				<td><?php echo $participant->getFirstName() ?></td>
				<td><?php echo $participant->getLastName() ?></td>
				<td><?php echo $participant->getEmail() ?></td>
				<td class="min">
					<form action="crud/deleteParticipant.php" method="post">
						<input type="hidden" id="id" name="id" value="<?php echo $participant->getId() ?>">
						<input type="hidden" id="fname" name="fname" value="<?php echo $participant->getFirstName() ?>">
						<input type="hidden" id="lname" name="lname" value="<?php echo $participant->getLastName() ?>">
						<input type="hidden" id="email" name="email" value="<?php echo $participant->getEmail() ?>">
						<button type="submit" name="valmis" class="delete btn btn-primary btn-danger my-2 my-sm-0"><i class="fa-solid fa-trash-can"></i></button>
					</form>
					<button class="edit btn btn-warning my-2 my-sm-0" onclick="<?php echo "avaaMuokkaus(" . $participant->getId() . ")" ?>"><i class="fa-solid fa-pen-to-square"></i></button>
				</td>
			</tr>
			<tr class="form" id="<?php echo $participant->getId() ?>">
				<form action="crud/updateParticipant.php" method="post">
					<td><?php echo $participant->getId() ?><input type="hidden" id="id" name="id" value="<?php echo $participant->getId() ?>"></td>
					<td><input type="text" id="fname" name="fname" value="<?php echo $participant->getFirstName() ?>"></td>
					<td><input type="text" id="lname" name="lname" value="<?php echo $participant->getLastName() ?>"></td>
					<td><input type="text" id="email" name="email" value="<?php echo $participant->getEmail() ?>"></td>
					<td class="min">
						<button type="submit" name="valmis" class="full-width btn btn-primary btn-success"><i class="fa-solid fa-floppy-disk"></i></button>
					</td>
				</form>
			</tr>
		<?php
		}
		?>

	</table>
</div>