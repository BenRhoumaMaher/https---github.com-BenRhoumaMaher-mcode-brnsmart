<?php

/* Template Name: table_journal_comptable Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>
<?php
if(isset($_POST['type_de_mouvement'])){

    $type_de_mouvement = $_POST['type_de_mouvement'];
    $date = $_POST['date'];
    $rubrique = $_POST['rubrique'];
    $reference_origine = $_POST['reference_origine'];
    $objet = $_POST['objet'];
    $tiers = $_POST['tiers'];
    $fournisseur = $_POST['fournisseur'];
    $montant_ht = $_POST['montant_ht'];
    $montant_net = $_POST['montant_net'];
    $mode_de_payement = $_POST['mode_de_payement'];
    $observations = $_POST['observations'];
    $numero_operation = $_POST['numero_operation'];
    $date_reference_origine = $_POST['date_reference_origine'];
    $session = $_POST['session'];
    $tva = $_POST['tva'];
    $reference_payement = $_POST['reference_payement'];
    $id = $_POST['id'];

    $sql = "update journal_comptable set 
    type_de_mouvement = '$type_de_mouvement',
    date = '$date',
    rubrique = '$rubrique',
    reference_origine = '$reference_origine',
    objet = '$objet',
    tiers = '$tiers',
    fournisseur = '$fournisseur',
    montant_ht = '$montant_ht',
    montant_net = '$montant_net',
    mode_de_payement = '$mode_de_payement',
    observation = '$observations',
    numero_operation = '$numero_operation',
    date_reference_origine = '$date_reference_origine',
    session = '$session',
    tva = '$tva',
    reference_payement = '$reference_payement'
    where id = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_journal_comptable"
        );
    }
}

?>
<?php
$msg = '';
$message = '';
$error_type_de_mouvement = '';
$error_date = '';
$error_rubrique = '';
$error_reference_origine = '';
$error_objet = '';
$error_tiers = '';
$error_montant_ht = '';
$error_montant_net = '';
$error_mode_de_payement = '';
$error_observation = '';
$error_numero_operation = '';
$error_date_reference_origine = '';
$error_session = '';
$error_tva = '';
$error_reference_payement = '';
if (isset($_REQUEST["create"])) 
{

  if (empty($_POST["type_de_mouvement"])) {
    $error_type_de_mouvement = "<label class='text-danger'>Veuiller sélectionner un type de mouvement</label>";
}

if (empty($_POST["date"])) {
    $error_date = "<label class='text-danger'>Veuiller sélectionner une date</label>";
}

if (empty($_POST["rubrique"])) {
    $error_rubrique = "<label class='text-danger'>Veuiller sélectionner un rubrique</label>";
}

if (empty($_POST["reference_origine"])) {
    $error_reference_origine = "<label class='text-danger'>Veuiller remplir ce champs</label>";
}

if (empty($_POST["objet"])) {
    $error_objet = "<label class='text-danger'>Veuiller indiquer un objet</label>";
} else
  //ici, on utilise la fonction trim() pour supprimer les espaces blancs au début et à la fin.
{
    $objet = trim($_POST["objet"]);
}
if (empty($_POST["tiers"])) {
    $error_tiers = "<label class='text-danger'>Veuiller indiquer un tier</label>";
} else {
    $tiers = trim($_POST["tiers"]);
}

if (empty($_POST["montant_ht"])) {
    $error_montant_ht = "<label class='text-danger'>Veuiller indiquer un montant_ht</label>";
} else {
    $montant_ht = trim($_POST["montant_ht"]);
}
if (empty($_POST["montant_net"])) {
    $error_montant_net = "<label class='text-danger'>Veuiller indiquer un montant_net</label>";
} else {
    $montant_net = trim($_POST["montant_net"]);
}
if (empty($_POST["mode_de_payement"])) {
    $error_mode_de_payement = "<label class='text-danger'>Veuiller indiquer un mode_de_payement</label>";
} else {
    $mode_de_payement = trim($_POST["mode_de_payement"]);
}
if (empty($_POST["observations"])) {
    $error_observation = "<label class='text-danger'>Veuiller indiquer une observation</label>";
} else
  //ici, on utilise la fonction trim() pour supprimer les espaces blancs au début et à la fin.
{
    $observations = trim($_POST["observations"]);
}
if (empty($_POST["numero_operation"])) {
    $error_numero_operation = "<label class='text-danger'>Veuiller indiquer un numero_operation</label>";
} else {
    $numero_operation = trim($_POST["numero_operation"]);
}

if (empty($_POST["date_reference_origine"])) {
    $error_date_reference_origine = "<label class='text-danger'>Veuiller indiquer un date_reference_origine</label>";
} else {
    $date_reference_origine = trim($_POST["date_reference_origine"]);
}
if (empty($_POST["session"])) {
    $error_session = "<label class='text-danger'>Veuiller indiquer une session</label>";
} else {
    $session = trim($_POST["session"]);
}
if (empty($_POST["tva"])) {
    $error_tva = "<label class='text-danger'>Veuiller indiquer le tva</label>";
} else {
    $tva = trim($_POST["tva"]);
}
if (empty($_POST["reference_payement"])) {
    $error_reference_payement = "<label class='text-danger'>Veuiller indiquer le reference_payement</label>";
} else {
    $reference_payement = trim($_POST["reference_payement"]);
}
  //ici on va vérifier si tous les erreurs sont null.
if (
    $error_type_de_mouvement == '' && $error_date == '' && $error_rubrique == ''
    && $error_reference_origine == ''
    && $error_objet == '' && $error_tiers == ''
    && $error_montant_ht == '' && $error_montant_net == ''
    && $error_mode_de_payement == '' && $error_observation == ''
    && $error_date_reference_origine == '' && $error_numero_operation == '' 
    && $error_session == ''
    && $error_tva == '' && $error_reference_payement == ''
) {



    $type_de_mouvement = stripslashes($_REQUEST["type_de_mouvement"]);
    $type_de_mouvement = mysqli_real_escape_string($con, $type_de_mouvement);
    $date = stripslashes($_REQUEST["date"]);
    $date = mysqli_real_escape_string($con, $date);
    $rubrique = stripslashes($_REQUEST["rubrique"]);
    $rubrique = mysqli_real_escape_string($con, $rubrique);
    $reference_origine = stripslashes($_REQUEST["reference_origine"]);
    $reference_origine = mysqli_real_escape_string($con, $reference_origine);
    $objet = stripslashes($_REQUEST["objet"]);
    $objet = mysqli_real_escape_string($con, $objet);   
    $tiers = stripslashes($_REQUEST["tiers"]);
    $tiers = mysqli_real_escape_string($con, $tiers);
    $fournisseur = stripslashes($_REQUEST["fournisseur"]);
    $fournisseur = mysqli_real_escape_string($con, $fournisseur);
    $montant_ht = stripslashes($_REQUEST["montant_ht"]);
    $montant_ht = mysqli_real_escape_string($con, $montant_ht);
    $montant_net = stripslashes($_REQUEST["montant_net"]);
    $montant_net = mysqli_real_escape_string($con, $montant_net);
    $mode_de_payement = stripslashes($_REQUEST["mode_de_payement"]);
    $mode_de_payement = mysqli_real_escape_string($con, $mode_de_payement);
    $observations = stripslashes($_REQUEST["observations"]);
    $observations = mysqli_real_escape_string($con, $observations);
    $numero_operation = stripslashes($_REQUEST["numero_operation"]);
    $numero_operation = mysqli_real_escape_string($con, $numero_operation);
    $date_reference_origine = stripslashes($_REQUEST["date_reference_origine"]);
    $date_reference_origine = mysqli_real_escape_string($con, $date_reference_origine);
    $session = stripslashes($_REQUEST["session"]);
    $session = mysqli_real_escape_string($con, $session);
    $tva = stripslashes($_REQUEST["tva"]);
    $tva = mysqli_real_escape_string($con, $tva);
    $reference_payement = stripslashes($_REQUEST["reference_payement"]);
    $reference_payement = mysqli_real_escape_string($con, $reference_payement);
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT into `journal_comptable` (type_de_mouvement,date,rubrique,reference_origine,objet,tiers,fournisseur,montant_ht,montant_net,mode_de_payement,observation,numero_operation,date_reference_origine,session,tva,reference_payement,create_datetime)
    VALUES (
        '$type_de_mouvement','$date','$rubrique','$reference_origine','$objet',
        '$tiers','$fournisseur', '$montant_ht','$montant_net',
        '$mode_de_payement','$observations','$numero_operation',
        '$date_reference_origine','$session','$tva','$reference_payement',
        '$create_datetime')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header(
            "Location: http://localhost/brnsmart/table_journal_comptable"
        );
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Table-Journal_Comptable</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js">
    </script>
    
    <style>
        
        .conta {
            background-size: cover;
            margin-top: -20px;
            margin-left: 160px;
        }

        .download {
            margin-top: -35px;
            margin-left: 970px;

        }
        .tabling {
            margin-left: -135px;
        }
    </style>
    
</head>
<body style=" margin-left: 160px; ">
    <main>
        <div class="conta">
            <div class="row" style="margin-top: 70px;">
                <div class="col-md-10 col-md-offset-1" >
                    <div class="tabling">
                        <table class="table">
                            <div>
                                <button type="button" data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-primary ajouting">Ajouter Journal</button>
                            </div>
                            <div>
                                <a href="http://localhost/brnsmart/telecharger_journal_comptable">
                                    <button type="button" class="btn btn-warning pull-right download" name="download" style="float:right; margin-top: -35px;margin-right: -20 px">Télécharger</button>
                                </a>
                            </div>
                        </main>
                        <hr><br>
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Type de mouvement:</label>    
                                                    <select  name="type_de_mouvement" class="form-control" required>
                                                        <option value="" disabled selected hidden>Type de Mouvement</option>
                                                        <option value="recette">Recette</option>
                                                        <option value="depense">Dépense</option>
                                                    </select>
                                                    <?php echo $error_type_de_mouvement; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Date:</label>    
                                                    <input type="date"required  name="date" class="form-control" placeholder="Date">
                                                    <?php echo $error_date; ?>
                                                </div>
                                                
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Rubrique:</label>
                                                    <select required name="rubrique" class="form-control">
                                                        <option value="" disabled selected hidden>Rubrique</option>
                                                        <option value="formateur">Formateur</option>
                                                        <option value="personnel">Personnel</option>
                                                        <option value="logistique">Logistique</option>
                                                        <option value="autre">Autre</option>
                                                    </select>
                                                    <?php echo $error_rubrique; ?>
                                                </div>
                                                <div class="col-md-6">
                                                   <label class="form-label">Reference Origine:</label>   
                                                   <input type="text" name="reference_origine" class="form-control" placeholder="Référence Origine" required>
                                                   <?php echo $error_reference_origine; ?>
                                               </div>
                                               
                                           </div><br>
                                           <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Objet :</label>        
                                                <input type="text" required name="objet" class="form-control" placeholder="Objet" >
                                                <?php echo $error_objet; ?>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Tiers :</label>    
                                                <input type="text" required name="tiers" class="form-control" placeholder="Tier" >
                                                <?php echo $error_tiers; ?>
                                            </div>
                                        </div><br>
                                        <div class="col-md-12 autre boxx">
                                            <label class="form-label">Fournisseur :</label>
                                            <input type="text" required name="fournisseur" class="form-control" placeholder="Fournisseur" >
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Montant-HT :</label>
                                                <input type="text" required name="montant_ht" class="form-control" placeholder="Montant HT">
                                                <?php echo $error_montant_ht; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Montant-Net :</label>
                                                <input type="text" required name="montant_net" class="form-control" placeholder="Montant Net">
                                                <?php echo $error_montant_net; ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Mode de Payement :</label>
                                                <select required name="mode_de_payement" class="form-control">
                                                    <option value="" disabled selected hidden>Mode de Payement</option>
                                                    <option value="espece">Espèce</option>
                                                    <option value="cheque">Chèque</option>
                                                    <option value="carte_bancaire">Carte Bancaire</option>
                                                </select>
                                                <?php echo $error_mode_de_payement; ?>    
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Observations :</label>
                                                <input type="text" required name="observations" class="form-control" placeholder="Observations" >
                                                <?php echo $error_observation; ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Numéro Operation :</label>
                                                <input type="number" required name="numero_operation" class="form-control" placeholder="Numéro Opération">
                                                <?php echo $error_numero_operation; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Date reference origine :</label>
                                                <input type="date" required name="date_reference_origine" class="form-control" placeholder="Date Référence Origine">
                                                <?php echo $error_date_reference_origine; ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Session :</label>
                                                <input type="text" required name="session" class="form-control" placeholder="Session"  autocomplete="new-password">
                                                <?php echo $error_session; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">TVA :</label>
                                                <input type="text" required name="tva" class="form-control" placeholder="TVA" >
                                                <?php echo $error_tva; ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Référence Payement :</label>
                                                <input type="text" required name="reference_payement" class="form-control" placeholder="Référence Payement">
                                                <?php echo $error_reference_payement; ?>
                                            </div>
                                        </div><br>
                                        <div class="modal-footer">
                                            <div class="col-xs-6 col-md-2">
                                                <button type="submit" class="btn btn-primary" name="create">
                                                 Ajouter
                                             </button>
                                         </div></div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div id="updateModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Type de mouvement:</label>    
                                                <select  name="type_de_mouvement" id="type_de_mouvement" class="form-control">
                                                    <option value="" disabled selected hidden>Type de Mouvement</option>
                                                    <option value="recette">Recette</option>
                                                    <option value="depense">Dépense</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Date:</label>    
                                                <input type="date"  id="date" name="date" class="form-control" placeholder="Date">
                                            </div>
                                            
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Rubrique:</label>
                                                <select  name="rubrique" id="rubrique" class="form-control">
                                                    <option value="" disabled selected hidden>Rubrique</option>
                                                    <option value="formateur">Formateur</option>
                                                    <option value="personnel">Personnel</option>
                                                    <option value="logistique">Logistique</option>
                                                    <option value="autre">Autre</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                               <label class="form-label">Reference Origine:</label>   
                                               <input type="text" id="reference_origine" name="reference_origine" class="form-control" placeholder="Référence Origine" >
                                           </div>
                                           
                                       </div><br>
                                       <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Objet :</label>        
                                            <input type="text" id="objet" name="objet" class="form-control" placeholder="Objet" >
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Tiers :</label>    
                                            <input type="text" id="tiers" name="tiers" class="form-control" placeholder="Tier" >
                                        </div>
                                    </div><br>
                                    <div class="col-md-12 autre boxx">
                                        <label class="form-label">Fournisseur :</label>
                                        <input type="text" id="fournisseur" name="fournisseur" class="form-control" placeholder="Fournisseur" >
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Montant-HT :</label>
                                            <input type="text"  id="montant_ht" name="montant_ht" class="form-control" placeholder="Montant HT">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Montant-Net :</label>
                                            <input type="text" id="montant_net" name="montant_net" class="form-control" placeholder="Montant Net">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Mode de Payement :</label>
                                            <select  id="mode_de_payement" name="mode_de_payement" class="form-control">
                                                <option value="" disabled selected hidden>Mode de Payement</option>
                                                <option value="espece">Espèce</option>
                                                <option value="cheque">Chèque</option>
                                                <option value="carte_bancaire">Carte Bancaire</option>
                                            </select>   
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Observations :</label>
                                            <input type="text" id="observations" name="observations" class="form-control" placeholder="Observations" >
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Numéro Operation :</label>
                                            <input type="number"  id="numero_operation" name="numero_operation" class="form-control" placeholder="Numéro Opération">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Date reference origine :</label>
                                            <input type="date" id="date_reference_origine" name="date_reference_origine" class="form-control" placeholder="Date Référence Origine">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Session :</label>
                                            <input type="text" id="session" name="session" class="form-control" placeholder="Session"  autocomplete="new-password">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">TVA :</label>
                                            <input type="text" id="tva" name="tva" class="form-control" placeholder="TVA" >
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Référence Payement :</label>
                                            <input type="text"   id="reference_payement" name="reference_payement" class="form-control" placeholder="Référence Payement">
                                        </div>
                                    </div><br>
                                    <div class="form-group col-md-6">
                                        <label></label>
                                        <input type="hidden"  id="id" class="form-control">
                                    </div><br>
                                    <div class="modal-footer">
                                        <div class="col-xs-6 col-md-2">
                                            <input type="submit" name="modifier" id="save" value="Modifier" class="btn btn-info"></div>
                                        </button>
                                    </div></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <br>
                    <div class="rechercher">
                        <input type="text" placeholder="Rechercher" style="width: 660px;display: block;margin-right: auto;margin-left: auto; margin-bottom: 40px" 
                        name="rechercher" class="form-control" id="rechercher" autocomplete="off"  >
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" 
                style="margin-left: -150px">
                <thead>
                    <tr class="table-primary">
                      <th class="">ID</th>
                      <th class="">Type de mouvement</th>
                      <th class="">Date</th>
                      <th class="">Rubrique</th>
                      <th class="">Référence Origine</th>
                      <th class="">Objet</th>
                      <th class="">Tiers</th>
                      <th class="">Fournisseur</th>
                      <th class="">Montant HT</th>
                      <th class="">Montant Net</th>
                      <th class="">Mode de payement</th>
                      <th class="">Observations</th>
                      <th class="">Numéro opération</th>
                      <th class="">Date Référence Origine</th>
                      <th class="">Session</th>
                      <th class="">TVA</th>
                      <th class="">Référence Payement</th>
                      <th class="">Date de création</th>
                      <th class="">Modifier</th>
                      <th class="">Supprimer</th>
                  </tr>
              </thead>
              <tbody id="table">
                <?php
                $sql = "Select * from journal_comptable";
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
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

<script>
 $(document).ready(function(){
     $(document).on('click','a[data-role=update]', function(){
         var id = $(this).data('id');
         var type_de_mouvement = $('#'+id).children('td[data-bs-target=type_de_mouvement]').text();
         var date = $('#'+id).children('td[data-bs-target=date]').text();
         var rubrique = $('#'+id).children('td[data-bs-target=rubrique]').text();
         var reference_origine = $('#'+id).children('td[data-bs-target=reference_origine]').text();
         var objet = $('#'+id).children('td[data-bs-target=objet]').text();
         var tiers = $('#'+id).children('td[data-bs-target=tiers]').text();
         var fournisseur = $('#'+id).children('td[data-bs-target=fournisseur]').text();
         var montant_ht = $('#'+id).children('td[data-bs-target=montant_ht]').text();
         var montant_net = $('#'+id).children('td[data-bs-target=montant_net]').text();
         var mode_de_payement = $('#'+id).children('td[data-bs-target=mode_de_payement]').text();
         var observations = $('#'+id).children('td[data-bs-target=observations]').text();
         var numero_operation = $('#'+id).children('td[data-bs-target=numero_operation]').text();
         var date_reference_origine = $('#'+id).children('td[data-bs-target=date_reference_origine]').text();
         var session = $('#'+id).children('td[data-bs-target=session]').text();
         var tva = $('#'+id).children('td[data-bs-target=tva]').text();
         var reference_payement = $('#'+id).children('td[data-bs-target=reference_payement]').text();

         $('#type_de_mouvement').val(type_de_mouvement);
         $('#date').val(date);
         $('#rubrique').val(rubrique);
         $('#reference_origine').val(reference_origine);
         $('#objet').val(objet);
         $('#tiers').val(tiers);
         $('#fournisseur').val(fournisseur);
         $('#montant_ht').val(montant_ht);
         $('#montant_net').val(montant_net);
         $('#mode_de_payement').val(mode_de_payement);
         $('#observations').val(observations);
         $('#numero_operation').val(numero_operation);
         $('#date_reference_origine').val(date_reference_origine);
         $('#session').val(session);
         $('#tva').val(tva);
         $('#reference_payement').val(reference_payement);
         $('#id').val(id);    
     });
     $('#save').click(function(){
         var id = $('#id').val();
         var type_de_mouvement = $('#type_de_mouvement').val();
         var date = $('#date').val();
         var rubrique = $('#rubrique').val();
         var reference_origine = $('#reference_origine').val();
         var objet = $('#objet').val();
         var tiers = $('#tiers').val();
         var fournisseur = $('#fournisseur').val();
         var montant_ht = $('#montant_ht').val();
         var montant_net = $('#montant_net').val();
         var mode_de_payement = $('#mode_de_payement').val();
         var observations = $('#observations').val();
         var numero_operation = $('#numero_operation').val();
         var date_reference_origine = $('#date_reference_origine').val();
         var session = $('#session').val();
         var tva = $('#tva').val();
         var reference_payement = $('#reference_payement').val();

         $.ajax({
            url: 'http://localhost/brnsmart/table_journal_comptable',
            method: 'POST',
            data : {type_de_mouvement : type_de_mouvement, date: date, rubrique : rubrique,reference_origine : reference_origine, objet : objet,
                tiers : tiers,fournisseur : fournisseur,montant_ht : montant_ht,montant_net : montant_net, mode_de_payement: mode_de_payement, observations : observations,numero_operation : numero_operation, date_reference_origine : date_reference_origine,
                session : session,tva : tva,reference_payement : reference_payement, id : id},
                success : function(response){
        //update records in table
        $('#'+id).children('td[data-bs-target=type_de_mouvement]').text(type_de_mouvement);
        $('#'+id).children('td[data-bs-target=date]').text(date);
        $('#'+id).children('td[data-bs-target=rubrique]').text(rubrique);
        $('#'+id).children('td[data-bs-target=reference_origine]').text(reference_origine);
        $('#'+id).children('td[data-bs-target=objet]').text(objet);
        $('#'+id).children('td[data-bs-target=tiers]').text(tiers);
        $('#'+id).children('td[data-bs-target=fournisseur]').text(fournisseur);
        $('#'+id).children('td[data-bs-target=montant_ht]').text(montant_ht);
        $('#'+id).children('td[data-bs-target=montant_net]').text(montant_net);
        $('#'+id).children('td[data-bs-target=mode_de_payement]').text(mode_de_payement);
        $('#'+id).children('td[data-bs-target=observations]').text(observations);
        $('#'+id).children('td[data-bs-target=numero_operation]').text(numero_operation);
        $('#'+id).children('td[data-bs-target=date_reference_origine]').text(date_reference_origine);
        $('#'+id).children('td[data-bs-target=session]').text(session);
        $('#'+id).children('td[data-bs-target=tva]').text(tva);
        $('#'+id).children('td[data-bs-target=reference_payement]').text(reference_payement);
        $('#updateModal').modal('toggle');

    }
});

     });
 });



</script>
<script>
  $(document).ready(function(){
     $('#rechercher').on("keyup", function(){
       var rechercher = $(this).val();
       $.ajax({
         method:'POST',
         url:' http://localhost/brnsmart/rechercher_journal_comptable',
         data:{recherche:rechercher},
         success:function(response)
         {
            $("#table").html(response);
        } 
    });
   });
 });
</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $("select").change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue = $(this).attr("value");
          if (optionValue) {
            $(".boxx").not("." + optionValue).hide();
            $("." + optionValue).show();
        } else {
            $(".boxx").hide();
        }
    });
    }).change();
  });
</script>
</html>