<?php

/* Template Name: supprimer_inscription_personne_morale Page */

?>
<?php
require "db.php";

if (isset($_GET['supprimer'])) {
	$id=$_GET['supprimer'];		
	$mysql = "delete from `inscription_personne_morale` where id=$id";
	$resultat = mysqli_query($con,$mysql);
	if($resultat){
		header(
			"Location: http://localhost/brnsmart/table_inscription_personne_morale"
		);
	}
}
?>
