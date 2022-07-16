<?php

/* Template Name: telecharger_inscription_formateur Page */
session_start();
require "db.php";
?>
<?php
header("Content-Type: application/xlsm");
$filename="brnsmart_enregistrement";
header("Content-Disposition:attachment;filename= $filename.xls");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		td {
			border: 2px solid black;
		}

	</style>
</head>
<body>
	<table class="table table-hover">
		<thead>
			<tr>
				<th style="border: 2px solid black;" class="">ID</th>
				<th style="border: 2px solid black;" class="">Prenom</th>
				<th style="border: 2px solid black;" class="">Nom</th>
				<th style="border: 2px solid black;" class="">Email</th>
				<th style="border: 2px solid black;" class="">Telephone</th>
				<th style="border: 2px solid black;" class="">Experience</th>
				<th style="border: 2px solid black;" class="">Formation</th>
				<th style="border: 2px solid black;" class="">Tarif</th>
				<th style="border: 2px solid black;" class="">Nbr_Jour</th>
				<th style="border: 2px solid black;" class="">Message</th>
				<th style="border: 2px solid black;" class="">Date de creation</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "Select * from inscription_formateur";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);
			if ($num>0){
				while($row=mysqli_fetch_assoc($result)) {
					echo "	
					<tr>
					<td>" . $row["id"] . "</td>
					<td>" . $row["prenom"] . "</td>
					<td>" . $row["nom"] . "</td>
					<td>" . $row["email"] . "</td>
					<td>" . $row["telephone"] . "</td>
					<td>" . $row["experience"] . "</td>
					<td>" . $row["formation"] . "</td>
					<td>" . $row["tarif"] . "</td>
					<td>" . $row["nbr_jour"] . "</td>
					<td>" . $row["message"] . "</td>
					<td>" . $row["create_datetime"] . "</td>
					
					
					</tr>";
				}
			}
			?>
		</tbody>
	</table>
	</html>


