<?php
if (!empty($_SESSION["userId"])) {
	include "connection.php";
	$result = $dataAccess->getUser($_SESSION["userId"]);
	$displayName = $result["nimi"];
}
$events = $dataAccess->getEvents();
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
				<input type="text" id="title" name="title" size="100%" placeholder="Enter title"><br>
			</div>
			<label for="desc">Description:</label><br>
			<textarea id="desc" name="desc" cols="50" rows="5" placeholder="Enter description"></textarea><br>

			<div class="startendtime">
				<div class="starttime">
					<label for="start">Start time:</label><br>
					<input type="datetime-local" id="start" name="start"><br>
				</div>
				<h1>-</h1>
				<div class="endtime">
					<label for="end">End time:</label><br>
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
	foreach ($events as $event) {
		$eventParticipants = $event->getParticipants()
	?>
		<div class="tapahtuma">
			<div class="header">
				<h2 class="id"><?php echo $event->getID() ?> </h2>
				<h1 class="title"><?php echo $event->getTitle() ?></h1>
			</div>
			<p class="description"><?php echo $event->getDescription() ?></p>
			<h5 class="startendtime"><?php echo $event->getStartTime()->format('Y-m-d H:i:s') . " - " . $event->getEndTime()->format('Y-m-d H:i:s') ?></h5>
			<h5 class="address"><?php echo $event->getAddress() ?></h5>
			<h4>Osallistujat:</h4>
			<table>
				<tr>
					<th style="width: 5%;">ID</th>
					<th style="width: 30%;">Etunimi</th>
					<th style="width: 30%;">Sukunimi</th>
					<th style="width: 30%;">Sähköposti</th>
					<th class="min">
						<button id="avaalisays" class="btn btn-primary btn-success" onclick='<?php echo 'avaaMuokkaus("osallistuja' . $event->getID() . '")' ?>'><i class="fa-solid fa-plus"></i></button>
					</th>
				</tr>
				<tr class="form" id="<?php echo "osallistuja" . $event->getID() ?>">
					<form action="crud/addEventParticipant.php" method="post">
						<input type="hidden" id="id" name="id" value="<?php echo $event->getID() ?>">
						<input type="hidden" id="title" name="title" value="<?php echo $event->getTitle() ?>">
						<input type="hidden" id="desc" name="desc" value="<?php echo $event->getDescription() ?>">
						<input type="hidden" id="adres" name="adres" value="<?php echo $event->getAddress() ?>">
						<input type="hidden" id="start" name="start" value="<?php echo $event->getStartTime()->format('Y-m-d H:i:s') ?>">
						<input type="hidden" id="end" name="end" value="<?php echo $event->getEndTime()->format('Y-m-d H:i:s') ?>">
						<td>
							<select name="osallistuja">
								<?php
								$participants = $dataAccess->getParticipants();
								foreach ($participants as $participant) {
									echo '<option value="' . $participant->getID() . '">' . $participant->getID() . " - " . $participant->getFirstName() . " " . $participant->getLastName() . " - " . $participant->getEmail() . '</option>';
								}
								?>
							</select>
						</td>
						<input type="hidden" id="fname" name="fname" value="<?php echo $participant->getFirstName() ?>">
						<input type="hidden" id="lname" name="lname" value="<?php echo $participant->getLastName() ?>">
						<input type="hidden" id="email" name="email" value="<?php echo $participant->getEmail() ?>">
						<td></td>
						<td></td>
						<td></td>
						<td class="min">
							<button type="submit" name="valmis" class="full-width btn btn-primary btn-success"><i class="fa-solid fa-floppy-disk"></i></button>
						</td>
					</form>
				</tr>
				<?php
				foreach ($eventParticipants as $participant) {
				?>
					<tr>
						<td><?php echo $participant->getID() ?></td>
						<td><?php echo $participant->getFirstName() ?></td>
						<td><?php echo $participant->getLastName() ?></td>
						<td><?php echo $participant->getEmail() ?></td>
						<td class="min">
							<form action="crud/deleteEventParticipant.php" method="post">
								<input type="hidden" id="id" name="id" value="<?php echo $participant->getID() ?>">
								<input type="hidden" id="fname" name="fname" value="<?php echo $participant->getFirstName() ?>">
								<input type="hidden" id="lname" name="lname" value="<?php echo $participant->getLastName() ?>">
								<input type="hidden" id="email" name="email" value="<?php echo $participant->getEmail() ?>">
								<button type="submit" name="valmis" class="delete btn btn-primary btn-danger my-2 my-sm-0"><i class="fa-solid fa-trash-can"></i></button>
							</form>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
			<div class="footer">
				<form action="crud/deleteEvent.php" method="post">
					<input type="hidden" id="id" name="id" value="<?php echo $event->getID() ?>">
					<input type="hidden" id="title" name="title" value="<?php echo $event->getTitle() ?>">
					<input type="hidden" id="desc" name="desc" value="<?php echo $event->getDescription() ?>">
					<input type="hidden" id="adres" name="adres" value="<?php echo $event->getAddress() ?>">
					<input type="hidden" id="start" name="start" value="<?php echo $event->getStartTime()->format('Y-m-d H:i:s') ?>">
					<input type="hidden" id="end" name="end" value="<?php echo $event->getEndTime()->format('Y-m-d H:i:s') ?>">
					<button type="submit" name="valmis" class="delete btn btn-primary btn-danger my-2 my-sm-0"><i class="fa-solid fa-trash-can"></i></button>
				</form>
				<button class="edit btn btn-warning my-2 my-sm-0" onclick="<?php echo "avaaMuokkaus(" . $event->getID() . ")" ?>"><i class="fa-solid fa-pen-to-square"></i></button>
			</div>

			<div class="form" id="<?php echo $event->getID() ?>">
				<form action="crud/updateEvent.php" method="post">
					<div class="header">
						<h3 class="id"><?php echo $event->getID() ?></h3>
						<input type="hidden" id="id" name="id" value="<?php echo $event->getID() ?>">
						<label for="title">Title:</label><br>
						<input type="text" id="title" name="title" size="100%" value="<?php echo $event->getTitle() ?>"><br>
					</div>
					<label for="desc">Description:</label><br>
					<textarea id="desc" name="desc" cols="50" rows="5"><?php echo $event->getDescription() ?></textarea><br>

					<div class="startendtime">
						<div class="starttime">
							<label for="start">Start time:</label><br>
							<input type="datetime-local" id="start" name="start"><br>
						</div>
						<h1>-</h1>
						<div class="endtime">
							<label for="end">End time:</label><br>
							<input type="datetime-local" id="end" name="end"><br>
						</div>
					</div>
					<label for="adres">Address:</label><br>
					<input type="text" id="adres" name="adres" value="<?php echo $event->getAddress() ?>"><br><br>
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