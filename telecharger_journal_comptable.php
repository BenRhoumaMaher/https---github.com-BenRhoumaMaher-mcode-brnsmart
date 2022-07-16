<?php

/* Template Name: telecharger_journal_comptable Page */
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
			<tr class="table-primary">
				<th class="">ID</th>
				<th class="">Type de mouvement</th>
				<th class="">Date</th>
				<th class="">Rubrique</th>
				<th class="">Référence Origine</th>
				<th class="">Objet</th>
				<th class="">Tiers</th>
				<th class="">Fournisseur</th>
				<th class="">Montant HT</th>
				<th class="">Montant Net</th>
				<th class="">Mode de payement</th>
				<th class="">Observations</th>
				<th class="">Numéro opération</th>
				<th class="">Date Référence Origine</th>
				<th class="">Session</th>
				<th class="">TVA</th>
				<th class="">Référence Payement</th>
				<th class="">Date de création</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "Select * from journal_comptable";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);
			if ($num>0){
				while($row=mysqli_fetch_assoc($result)) {
					echo "	
					<tr>
					<td>" . $row["id"] . "</td>
					<td>" . $row["type_de_mouvement"] . "</td>
					<td>" . $row["date"] . "</td>
					<td>" . $row["rubrique"] . "</td>
					<td>" . $row["reference_origine"] . "</td>
					<td>" . $row["objet"] . "</td>
					<td>" . $row["tiers"] . "</td>
					<td>" . $row["fournisseur"] . "</td>
					<td>" . $row["montant_ht"] . "</td>
					<td>" . $row["montant_net"] . "</td>
					<td>" . $row["mode_de_payement"] . "</td>
					<td>" . $row["observation"] . "</td>
					<td>" . $row["numero_operation"] . "</td>
					<td>" . $row["date_reference_origine"] . "</td>
					<td>" . $row["session"] . "</td>
					<td>" . $row["tva"] . "</td>
					<td>" . $row["reference_payement"] . "</td>
					<td>" . $row["create_datetime"] . "</td>
					
					
					</tr>";
				}
			}
			?>
		</tbody>
	</table>
	</html>


