<?php
/* Template Name: activation_administrateur Page */
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
	$sql = "UPDATE inscription_administrateur SET active='On' WHERE token='$TokenFromUrl'";
	$result=mysqli_query($con,$sql);
	if($result){
		$_SESSION['message'] = "Votre compte est activé !";
		header(
			"Location: http://localhost/brnsmart/connexion_administrateur"
		);
	}else {
		header(
			"Location: http://localhost/brnsmart/inscription_administrateur"
		);
	}


}


?>
<?php get_footer();