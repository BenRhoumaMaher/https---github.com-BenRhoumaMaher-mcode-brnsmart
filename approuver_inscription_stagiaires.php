<?php

/* Template Name: approuver_inscription_stagiaires Page */

?>
<?php
require "db.php";
require "include/Session.php";
?>
<?php

if (isset($_GET['approuver'])) {
	$id=$_GET['approuver'];		
	$mysql = "update `inscription_stagiaires` set approuvement = 'On' where id=$id";
	$resultat = mysqli_query($con,$mysql);
	if($resultat){
		$_SESSION['message'] = "la demande est acceptée !";
		header(
			"Location: http://localhost/brnsmart/table_inscription_stagiaires"
		);
	}
}
?>
