<?php

/* Template Name: supprimer_calendrier_formation Page */

?>
<?php
require "db.php";

if (isset($_GET['supprimer'])) {
	$id=$_GET['supprimer'];		
	$mysql = "delete from `calendrier_formation` where id=$id";
	$resultat = mysqli_query($con,$mysql);
	if($resultat){
		header(
			"Location: http://localhost/brnsmart/table_calendrier_formation"
		);
	}
}
?>
