<?php

/* Template Name: rechercher_journal_comptable Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>

<?php

$recherche = $_POST['recherche'];
$sql = "Select * from journal_comptable where type_de_mouvement LIKE '$recherche%'
or date LIKE '$recherche%' or rubrique LIKE '$recherche%' or objet LIKE '$recherche%' or tiers LIKE '$recherche%' or fournisseur LIKE '$recherche%' or montant_ht LIKE '$recherche%' or montant_net LIKE '$recherche%' or mode_de_payement LIKE '$recherche%' or observation LIKE '$recherche%' or numero_operation LIKE '$recherche%' or date_reference_origine LIKE '$recherche%' or session LIKE '$recherche%' or tva LIKE '$recherche%' or reference_payement LIKE '$recherche%'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if ($num>0){
    while($row=mysqli_fetch_assoc($result)) {
       echo "  
       <tr style='vertical-align: middle;' id='" . $row["id"] ."'>
       <td class='table-secondary' data-bs-target='id'>" . $row["id"] ."</td>
       <td class='table-success' data-bs-target='type_de_mouvement'>" . $row["type_de_mouvement"] . "</td>
       <td class='table-danger' data-bs-target='date'>" . $row["date"] . "</td>
       <td class='table-warning' data-bs-target='rubrique'>" . $row["rubrique"] . "</td>
       <td class='table-white' data-bs-target='reference_origine'>" . $row["reference_origine"] . "</td>
       <td class='table-info' data-bs-target='objet'>" . $row["objet"] . "</td>
       <td class='table-success' data-bs-target='tiers'>" . $row["tiers"] . "</td>
       <td class='table-danger' data-bs-target='fournisseur'>" . $row["fournisseur"] . "</td>
       <td class='table-success' data-bs-target='montant_ht'>" . $row["montant_ht"] . "</td>
       <td data-bs-target='montant_net'>" . $row["montant_net"] . "</td>
       <td class='table-warning' data-bs-target='mode_de_payement'>" . $row["mode_de_payement"] . "</td>
       <td class='table-white' data-bs-target='observations'>" . $row["observation"] . "</td>
       <td class='table-info' data-bs-target='numero_operation'>" . $row["numero_operation"] . "</td>
       <td class='table-success' data-bs-target='date_reference_origine'>" . $row["date_reference_origine"] . "</td>
       <td class='table-danger' data-bs-target='session'>" . $row["session"] . "</td>
       <td class='table-success' data-bs-target='tva'>" . $row["tva"] . "</td>
       <td data-bs-target='reference_payement'>" . $row["reference_payement"] . "</td>
       <td class='table-secondary' data-bs-target='create_datetime'>" . $row["create_datetime"] . "</td>
       <td>
       <a class='btn btn-primary btn-sm edit'
       data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
       data-role='update'>Modifier</a>
       </td>
       <td>
       <a class='btn btn-danger btn-sm'
       href='
       http://localhost/brnsmart/supprimer_journal_comptable?supprimer=
       " .$row["id"]. " '>Supprimer</a>
       </td>
       </tr>";
   }  
}
?>
