<?php
/* Template Name: activation_stagiaires Page */
get_header(); 

?>
<?php
require "db.php";
require "include/functions.php"; 
require "include/Session.php";
?>
<?php

global $con;
if(isset($_GET['token'])){

	$TokenFromUrl=$_GET['token'];
	$sql = "UPDATE enregistrement_stagiaires SET active='On' WHERE token='$TokenFromUrl'";
	$result=mysqli_query($con,$sql);
	if($result){
		$_SESSION['message'] = "Votre compte est activé !";
		header(
			"Location: http://localhost/brnsmart/connexion_stagiaires"
		);
	}else {
		header(
			"Location: http://localhost/brnsmart/enregistrement_stagiaires"
		);
	}


}


?>
























<?php get_footer();