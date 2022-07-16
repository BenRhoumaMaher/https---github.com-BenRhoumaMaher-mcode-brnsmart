<?php

/* Template Name: telecharger_inscription_personne_morale Page */
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
        <th style="border: 2px solid black;" class="">Date</th>
        <th style="border: 2px solid black;" class="">Presence</th>
        <th style="border: 2px solid black;" class="">Format</th>
        <th style="border: 2px solid black;" class="">Civilité</th>
        <th style="border: 2px solid black;" class="">Prénom</th>
        <th style="border: 2px solid black;" class="">Nom</th>
        <th style="border: 2px solid black;" class="">Matricule Fiscale</th>
        <th style="border: 2px solid black;" class="">RNE</th>
        <th style="border: 2px solid black;" class="">Email</th>
        <th style="border: 2px solid black;" class="">Telephone</th>
        <th style="border: 2px solid black;" class="">Adresse</th>
        <th style="border: 2px solid black;" class="">Societe</th>
        <th style="border: 2px solid black;" class="">Fonction</th>
        <th style="border: 2px solid black;" class="">Ville</th>
        <th style="border: 2px solid black;" class="">Code Postal</th>
        <th style="border: 2px solid black;" class="">Pays</th>
        <th style="border: 2px solid black;" class="">Date de creation</th>
      </tr>
    </thead>
    <tbody>
     <?php
     $sql = "Select * from inscription_personne_morale";
     $result = mysqli_query($con,$sql);
     $num = mysqli_num_rows($result);
     if ($num>0){
       while($row=mysqli_fetch_assoc($result)) {
         echo "	
         <tr>
         <td>" . $row["id"] . "</td>
         <td>" . $row["date"] . "</td>
         <td>" . $row["presence"] . "</td>
         <td>" . $row["format"] . "</td>
         <td>" . $row["civilité"] . "</td>
         <td>" . $row["prénom"] . "</td>
         <td>" . $row["nom"] . "</td>
         <td>" . $row["matricule_fiscale"] . "</td>
         <td>" . $row["rne"] . "</td>
         <td>" . $row["email"] . "</td>
         <td>" . $row["telephone"] . "</td>
         <td>" . $row["societe"] . "</td>
         <td>" . $row["fonction"] . "</td>
         <td>" . $row["adresse"] . "</td>
         <td>" . $row["ville"] . "</td>
         <td>" . $row["code_postal"] . "</td>
         <td>" . $row["pays"] . "</td>
         <td>" . $row["create_datetime"] . "</td>
         
         
         </tr>";
       }
     }
     ?>
   </tbody>
 </table>	
 </html>


