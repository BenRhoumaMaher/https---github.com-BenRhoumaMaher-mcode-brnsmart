<?php

/* Template Name: telecharger_enregistrement_stagiaires Page */
session_start();
require "db.php";
?>
<?php
header("Content-Type: application/vnd.ms-excel");
$fichier="brnsmart_enregistrement";
$filename = 'Export_excel_' . $fichier . '.xls';
header("Content-Disposition:attachment;filename= $filename");
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
				<th style="border: 2px solid black;" class="">Type Piece</th>
				<th style="border: 2px solid black;" class="">Num Piece</th>
				<th style="border: 2px solid black;" class="">Email</th>
				<th style="border: 2px solid black;" class="">Telephone</th>
				<th style="border: 2px solid black;" class="">Civilité</th>
				<th style="border: 2px solid black;" class="">Adresse</th>
				<th style="border: 2px solid black;" class="">Pays</th>
				<th style="border: 2px solid black;" class="">Ville</th>
				<th style="border: 2px solid black;" class="">Date de creation</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "Select * from enregistrement_stagiaires";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);
			if ($num>0){
				while($row=mysqli_fetch_assoc($result)) {
					echo "	
					<tr>
					<td>" . $row["id"] . "</td>
					<td>" . $row["prenom"] . "</td>
					<td>" . $row["nom"] . "</td>
					<td>" . $row["typepiece"] . "</td>
					<td>" . $row["numpiece"] . "</td>
					<td>" . $row["email"] . "</td>
					<td>" . $row["telephone"] . "</td>
					<td>" . $row["civilité"] . "</td>
					<td>" . $row["adresse"] . "</td>
					<td>" . $row["pays"] . "</td>
					<td>" . $row["ville"] . "</td>
					<td>" . $row["create_datetime"] . "</td>
					
					
					</tr>";
				}
			}
			?>
		</tbody>
	</table>
	</html>


