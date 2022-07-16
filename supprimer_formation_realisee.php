<?php

/* Template Name: supprimer_formation_realisee Page */

?>
<?php
require "db.php";

if (isset($_GET['supprimer'])) {
	$id=$_GET['supprimer'];		
	$mysql = "delete from `formations_realisees` where id=$id";
	$resultat = mysqli_query($con,$mysql);
	if($resultat){
		header(
			"Location: http://localhost/brnsmart/table_formation_realisee"
		);
	}
}
?>
