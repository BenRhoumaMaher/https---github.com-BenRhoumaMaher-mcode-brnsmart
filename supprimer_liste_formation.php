<?php

/* Template Name: supprimer_liste_formation Page */

?>
<?php
require "db.php";

if (isset($_GET['supprimer'])) {
	$id=$_GET['supprimer'];		
	$mysql = "delete from `liste_formation` where id_formation=$id";
	$resultat = mysqli_query($con,$mysql);
	if($resultat){
		header(
			"Location: http://localhost/brnsmart/table_liste_formation"
		);
	}
}
?>
