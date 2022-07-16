<?php

/* Template Name: rechercher_inscription_stagiaires Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from inscription_stagiaires where nom LIKE '$recherche%'
or email LIKE '$recherche%' or code LIKE '$recherche%' or telephone LIKE '$recherche%' or entreprise LIKE '$recherche%' or prénom LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "
       <tr id='" . $row["id"] ."'>
       <td data-bs-target='id'>" . $row["id"] . "</td>
       <td data-bs-target='code']>" . $row["code"] . "</td>
       <td data-bs-target='date']>" . $row["date"] . "</td>
       <td data-bs-target='presence']>" . $row["presence"] . "</td>
       <td data-bs-target='format']>" . $row["format"] . "</td>
       <td data-bs-target='civilité']>" . $row["civilité"] . "</td>
       <td data-bs-target='prénom']>" . $row["prénom"] . "</td>
       <td data-bs-target='nom']>" . $row["nom"] . "</td>
       <td data-bs-target='entreprise']>" . $row["entreprise"] . "</td>
       <td data-bs-target='email'>" . $row["email"] . "</td>
       <td data-bs-target='telephone']>" . $row["telephone"] . "</td>
       <td data-bs-target='adresse']>" . $row["adresse"] . "</td>
       <td data-bs-target='ville']>" . $row["ville"] . "</td>
       <td data-bs-target='code_postal']>" . $row["code_postal"] . "</td>
       <td data-bs-target='pays']>" . $row["pays"] . "</td>
       <td class='table-danger' data-bs-target='approuvement'>" . $row["approuvement"] . "</td>
       <td>" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_inscription_stagiaires?supprimer=
       " .$row["id"]. " '>Supprimer</a>
       </td>
       <td>
       <a class='btn btn-warning btn-sm'
       href='
       http://localhost/brnsmart/approuver_inscription_stagiaires?approuver=
       " .$row["id"]. " '>Approuver</a>
       </td>
       </tr>";
   }  
}
?>
