<?php

/* Template Name: rechercher_inscription_personne_morale Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from inscription_personne_morale where nom LIKE '$recherche%'
or email LIKE '$recherche%' or telephone LIKE '$recherche%' or rne LIKE '$recherche%' or prénom LIKE '$recherche%' or matricule_fiscale LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "
       <tr>
       <tr id='" . $row["id"] ."'>
       <td data-target='id'>" . $row["id"] . "</td>
       <td data-target='code']>" . $row["code"] . "</td>
       <td data-target='date']>" . $row["date"] . "</td>
       <td data-target='presence']>" . $row["presence"] . "</td>
       <td data-target='format']>" . $row["format"] . "</td>
       <td data-target='civilité']>" . $row["civilité"] . "</td>
       <td data-target='prénom']>" . $row["prénom"] . "</td>
       <td data-target='nom']>" . $row["nom"] . "</td>
       <td data-target='fiscal']>" . $row["matricule_fiscale"] . "</td>
       <td data-target='rne']>" . $row["rne"] . "</td>
       <td >" . $row["email"] . "</td>
       <td data-target='telephone']>" . $row["telephone"] . "</td>
       <td data-target='societe']>" . $row["societe"] . "</td>
       <td data-target='fonction']>" . $row["fonction"] . "</td>
       <td data-target='adresse']>" . $row["adresse"] . "</td>
       <td data-target='ville']>" . $row["ville"] . "</td>
       <td data-target='code_postal']>" . $row["code_postal"] . "</td>
       <td data-target='pays']>" . $row["pays"] . "</td>
       <td data-target='approuvement']>" . $row["approuvement"] . "</td>
       <td>" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-target='#updateModal' data-toggle='modal' data-id=" .$row["id"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_inscription_personne_morale?supprimer=
       " .$row["id"]. " '>Supprimer</a>
       </td>
       <td>
       <a class='btn btn-warning btn-sm'
       href='
       http://localhost/brnsmart/approuver_inscription_personne_morale?approuver=
       " .$row["id"]. " '>Approuver</a>
       </td>
       </tr>";
   }  
}
?>
