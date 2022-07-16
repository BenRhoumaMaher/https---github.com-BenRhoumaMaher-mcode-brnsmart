<?php

/* Template Name: rechercher_session Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from session where code_formateur LIKE '$recherche%'
or date LIKE '$recherche%' or code_formation LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "
       <tr style='vertical-align: middle;' id='" . $row["id_session"] ."'>
       <td class='table-secondary' data-bs-target='id'>" . $row["id_session"] ."</td>
       <td class='table-success' data-bs-target='code_formation'>" . $row["code_formation"] . "</td>
       <td class='table-danger' data-bs-target='date'>" . $row["date"] . "</td>
       <td class='table-info' data-bs-target='code_formateur'>" . $row["code_formateur"] . "</td>
       <td  class='table-danger' >" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id_session"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_session?supprimer=
       " .$row["id_session"]. " '>Supprimer</a>
       </td>
       </tr>"; 
   }  
}
?>
