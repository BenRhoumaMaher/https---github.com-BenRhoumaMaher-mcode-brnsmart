<?php

	/* Template Name: archiver_session Page */
  
?>
<?php
require "db.php";
require "include/Session.php";
?>
<?php

	if (isset($_GET['archiver'])) {
		$id=$_GET['archiver'];
		$sql = "Select * from session where id_session = $id";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
		$code_formation = $row['code_formation'];
		$date = $row['date'];	
		$create_datetime = date("Y-m-d H:i:s");	
		//here the id from the table in DB is getting the $id we defined here
		$mysql = "insert into `formations_realisees`(code_formation,date, create_datetime) 
		values('$code_formation','$date', '$create_datetime')";
		$resultat = mysqli_query($con,$mysql);
		if($resultat){
			header(
                "Location: http://localhost/brnsmart/table_session"
            );
		}
	}
?>