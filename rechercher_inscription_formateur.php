<?php

/* Template Name: rechercher_inscription_formateur Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from inscription_formateur where nom LIKE '$recherche%'
or email LIKE '$recherche%' or telephone LIKE '$recherche%' or prenom LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "
       <tr id='" . $row["id"] ."'>
       <td data-bs-target='id'>" . $row["id"] . "</td>
       <td data-bs-target='prenom'>" . $row["prenom"] . "</td>
       <td data-bs-target='nom'>" . $row["nom"] . "</td>
       <td>" . $row["email"] . "</td>
       <td data-bs-target='telephone'>" . $row["telephone"] . "</td>
       <td data-bs-target='cv'> <a
       href=' http://localhost/brnsmart/telechargecv_inscription_formateur?telecharger=
       " .$row["id"]. " '>". $row["cv"] ."</a> </td>
       <td data-bs-target='experience'>" . $row["experience"] . "</td>
       <td data-bs-target='formation'>" . $row["formation"] . "</td>
       <td data-bs-target='tarif'>" . $row["tarif"] . "</td>
       <td data-bs-target='nbr_jour'>" . $row["nbr_jour"] . "</td>
       <td data-bs-target='message'>" . $row["message"] . "</td>
       <td>" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_inscription_formateur?supprimer=
       " .$row["id"]. " '>Supprimer</a>
       </td>
       </tr>";
   }  
}
?>
