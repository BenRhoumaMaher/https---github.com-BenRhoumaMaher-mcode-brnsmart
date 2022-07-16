<?php

	/* Template Name: supprimer_enregistrement_stagiaires Page */
  
?>
<?php
	require "db.php";

	if (isset($_GET['supprimer'])) {
		$id=$_GET['supprimer'];		
		$mysql = "delete from `enregistrement_stagiaires` where id=$id";
		$resultat = mysqli_query($con,$mysql);
		if($resultat){
			header(
                "Location: http://localhost/brnsmart/table_enregistrement_stagiaires"
            );
		}
	}
?>
