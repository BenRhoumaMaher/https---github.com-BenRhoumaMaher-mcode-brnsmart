<?php

/* Template Name: rechercher_calendrier_formation Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from calendrier_formation where id_formation LIKE '$recherche%'
or code_formation LIKE '$recherche%' or date LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "  
       <tr id='" . $row["id"] ."'>
       <td>" . $row["id"] ."</td>
       <td data-bs-target='id'>" . $row["id_formation"] ."</td>
       <td data-bs-target='prenom'>" . $row["code_formation"] . "</td>
       <td data-bs-target='nom'>" . $row["date"] . "</td>
       <td>" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_calendrier_formation?supprimer=
       " .$row["id"]. " '>Supprimer</a>
       </td>
       </tr>"; 
   }  
}
?>
