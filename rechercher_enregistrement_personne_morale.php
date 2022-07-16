<?php

/* Template Name: rechercher_enregistrement_personne_morale Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from enregistrement_personne_morale where utilisateur LIKE '$recherche%'
or prenom LIKE '$recherche%'
or nom LIKE '$recherche%'
or pays LIKE '$recherche%'
or ville LIKE '$recherche%'
or code_postal LIKE '$recherche%'
or email LIKE '$recherche%' or adresse LIKE '$recherche%' or societe LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "  
       <tr id='" . $row["id"] ."'>
       <td data-bs-target='id'>" . $row["id"] . "</td>
       <td data-bs-target='prenom'>" . $row["prenom"] . "</td>
       <td data-bs-target='nom'>" . $row["nom"] . "</td>
       <td data-bs-target='utilisateur'>" . $row["utilisateur"] . "</td>
       <td data-bs-target='civilité'>" . $row["civilité"] . "</td>
       <td data-bs-target='email'>" . $row["email"] . "</td>
       <td data-bs-target='telephone'>" . $row["telephone"] . "</td>
       <td data-bs-target='societe'>" . $row["societe"] . "</td>
       <td data-bs-target='fonction'>" . $row["fonction"] . "</td>
       <td data-bs-target='adresse'>" . $row["adresse"] . "</td>
       <td data-bs-target='presentation'>" . $row["presentation"] . "</td>
       <td data-bs-target='pays'>" . $row["pays"] . "</td>
       <td data-bs-target='ville'>" . $row["ville"] . "</td>
       <td data-bs-target='code_postal'>" . $row["code_postal"] . "</td>
       <td>" . $row["active"] . "</td>
       <td>" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_enregistrement_personne_morale?supprimer=
       " .$row["id"]. " '>Supprimer</a>
       </td>
       </tr>";
   }  
}
?>
