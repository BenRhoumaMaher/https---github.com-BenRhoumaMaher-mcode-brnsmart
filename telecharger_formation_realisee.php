<?php

/* Template Name: telecharger_formation_realisee Page */
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
				<th style="border: 2px solid black;" class="">Code Formation</th>
				<th style="border: 2px solid black;" class="">Date</th>
				<th style="border: 2px solid black;" class="">Date de creation</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "Select * from formations_realisees";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);
			if ($num>0){
				while($row=mysqli_fetch_assoc($result)) {
					echo "	
					<tr>
					<td>" . $row["id"] . "</td>
					<td>" . $row["code_formation"] . "</td>
					<td>" . $row["date"] . "</td>
					<td>" . $row["create_datetime"] . "</td>
					
					
					</tr>";
				}
			}
			?>
		</tbody>
	</table>
	</html>


