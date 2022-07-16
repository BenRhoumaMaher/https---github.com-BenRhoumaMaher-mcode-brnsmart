<?php

	/* Template Name: action_administration_enregistrement Page */
 session_start();
?>

<?php
require "db.php";
if (isset($_POST['query'])) {
    $query = "SELECT * FROM enregistrement where nom like '{$_POST['query']}%' or email like '{$_POST['query']}%' or prenom like '{$_POST['query']}%'";
   	$result = mysqli_query($con,$query);
    $num = mysqli_num_rows($result);
	if ($num>0){
        while ($row = mysqli_fetch_array($query)) {

	echo '

		<tr>

                  	 	<td>" . $row["id"] . "</td>
						<td>" . $row["prenom"] . "</td>
						<td>" . $row["nom"] . "</td>
						<td>" . $row["email"] . "</td>
						<td>" . $row["sexe"] . "</td>
						<td>" . $row["adresse"] . "</td>
						<td>" . $row["active"] . "</td>
						<td>" . $row["create_datetime"] . "</td>


                  	</tr>

	';
}
}
}else {

echo '
  <tr>
    <td colspan="4"> No result found. </td>   
  </tr>';
}
?>






