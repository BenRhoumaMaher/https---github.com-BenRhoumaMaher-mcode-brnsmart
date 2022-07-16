<?php

/* Template Name: table_inscription_personne_morale Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
$msg = '';
?>
<?php
$msg = '';
if (isset($_REQUEST["create"])) 
{
    $code = stripslashes($_REQUEST["code"]);
    $code = mysqli_real_escape_string($con, $code);
    $date = $_REQUEST["date"];
    $presence = $_REQUEST["presence"];
    $format = $_REQUEST["format"];
    $prenom = stripslashes($_REQUEST["prenom"]);
    $prenom = mysqli_real_escape_string($con, $prenom);
    $nom = stripslashes($_REQUEST["nom"]);
    $nom = mysqli_real_escape_string($con, $nom);
    $email = stripslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $email);
    $societe = stripslashes($_REQUEST['societe']);
    $societe = mysqli_real_escape_string($con, $societe);
    $fonction = stripslashes($_REQUEST['fonction']);
    $fonction = mysqli_real_escape_string($con, $fonction);
    $telephone = stripslashes($_REQUEST["telephone"]);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $civilité = stripslashes($_REQUEST["civilité"]);
    $civilité = mysqli_real_escape_string($con, $civilité);
    $adresse = stripslashes($_REQUEST["adresse"]);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $pays = stripslashes($_REQUEST["pays"]);
    $pays = mysqli_real_escape_string($con, $pays);
    $ville = stripslashes($_REQUEST["ville"]);
    $ville = mysqli_real_escape_string($con, $ville);
    $code_postal = stripslashes($_REQUEST["code_postal"]);
    $code_postal = mysqli_real_escape_string($con, $code_postal); 
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT into `inscription_personne_morale` (code,date,presence,format, civilité,prénom,nom,email,telephone,societe,fonction,adresse,ville,code_postal,pays,approuvement, create_datetime)
    VALUES ( '$code','$date', '$presence','$format',
      '$civilité','$prénom','$nom','$email',
      '$telephone', '$societe','$fonction','$adresse',
      '$ville','$code_postal','$pays','off',
      '$create_datetime')";
    $result = mysqli_query($con, $query);

    $emails = $_POST['emails'];
    $noms = $_POST['noms'];
    $prenoms = $_POST['prenoms'];

    foreach($emails as $index => $emails)
    {
        $s_email = $emails;
        $s_noms = $noms[$index];
        $s_prenoms = $prenoms[$index];

        $query = "INSERT INTO  inscription_stagiaires (code,date,presence,format,civilité,prénom,nom,entreprise,email,telephone,adresse,ville,code_postal,pays,approuvement, create_datetime)
        VALUES ('$code','$date','$presence','$format',
            '$civilité','$s_prenoms','$s_noms','$societe','$s_email','$telephone', '$adresse',
            '$ville','$code_postal','$pays','Off',
            '$create_datetime')";
        $queryss = mysqli_query($con, $query);
    }

    if ($result) {
        if ($queryss){
            header(
                "Location: http://localhost/brnsmart/table_inscription_personne_morale"
            );
        }
        
    }
}


?>
<?php
if(isset($_POST['code'])){

    $code = $_POST['code'];
    $date = $_POST['date'];
    $presence = $_POST['presence'];
    $format = $_POST['format'];
    $civilité = $_POST['civilité'];
    $prénom = $_POST['prénom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $societe = $_POST['societe'];
    $fonction = $_POST['fonction'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $id = $_POST['id'];

    $sql = "update inscription_personne_morale set code = '$code',
    date = '$date',
    presence = '$presence',
    format = '$format',
    civilité = '$civilité',
    prénom = '$prénom',
    nom = '$nom',
    telephone = '$telephone',
    societe = '$societe',
    fonction = '$fonction',
    adresse = '$adresse',
    ville = '$ville',
    code_postal = '$code_postal',
    pays = '$pays'
    where id = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_inscription_personne_morale"
        );
    }
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Table-Inscription_Personne_Morale</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link href="css/styling.css" rel="stylesheet" />
    
    <style>
        
        .conta {
            background-size: cover;
            margin-top: -20px;
            margin-left: 20px;
        }
        #myModal {
            margin-top: 10px;
        }
        
    </style>
    
</head>
<body class="sb-nav-fixed" style="margin-top: 100px;">
    
    
    <main>
        <div class="conta">
            <div> <?php echo Message(); ?> </div>
            <button type="button" data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-primary ajouting" style="float:left; margin-top: 10px;margin-left: 100px">Ajouter Stagiaire</button>
            <div>
                <a href="http://localhost/brnsmart/telecharger_inscription_personne_morale">
                    <button type="button" class="btn btn-warning pull-right" name="download" style="float:right; margin-top: 10px;margin-right: 100px">Télécharger</button>
                </a>
            </div><br><br>
        </main>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" class="row g-3">
                            <div class="input-group col-md-12">
                                <span class="input-group-text col-md-3">Code</span>
                                <select class="form-control" required id="code" name="code" >
                                  <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
                                  <?php 
                                  $sql = "Select * from liste_formation";
                                  $result = mysqli_query($con,$sql);
                                  $num = mysqli_num_rows($result);
                                  if($result){
                                    if ($num>0){
                                        while($row=mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row["id_formation"]; ?>" >
                                                <?php $vall = $row["code_formation"]?> 
                                                <?php echo $vall ?>
                                            </option>
                                            <?php 
                                        }}}
                                        ?>
                                    </select>
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Date</span>
                                    <select class="form-control" required name="date" id="show">
                                        <option value="" disabled selected hidden>Veuiller choisir une date</option>
                                    </select>
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Presence</span>
                                    <input type="text" required name="presence" class="form-control" placeholder="presence" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Format</span>
                                    <input type="text" required name="format" class="form-control" placeholder="format" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Civilité</span>
                                    <input type="text" required name="civilité" class="form-control" placeholder="civilite" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Prenom</span>
                                    <input type="text" required name="prenom" class="form-control" placeholder="prenom" autocomplete="rutjfkde">
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Nom</span>
                                    <input type="text" required name="nom" class="form-control" placeholder="nom" autocomplete="rutjfkde">
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Email</span>
                                    <input type="email" required name="email" class="form-control" placeholder="email" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Telephone</span>
                                    <input type="number" required name="telephone" class="form-control" placeholder="telephone" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Societe</span>
                                    <input type="text" required name="societe" class="form-control" placeholder="Societe" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Fonction</span>
                                    <input type="text" required name="fonction" class="form-control" placeholder="Fonction" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Adresse</span>
                                    <input type="text" required name="adresse" class="form-control" placeholder="adresse" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Ville</span>
                                    <input type="text" required name="ville" class="form-control" placeholder="ville" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Code Postal</span>
                                    <input type="number" required name="code_postal" class="form-control" placeholder="code_postal" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-3">Pays</span>
                                    <input type="text" required name="pays" class="form-control" placeholder="pays" >
                                </div><br>
                                <div class="input-group col-md-12">
                                    <span class="input-group-text col-md-5">Administration</span>
                                    <div class="contains">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card mt-4">
                                                    <div class="card-header">
                                                        <h4>Participants Entreprise
                                                            <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Ajouter</a>
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                        <div class="main-form mt-3 border-bottom">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label for="">Email</label>
                                                                        <input type="email" name="emails[]" class="form-control" required placeholder="Entrer email">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label for="">Nom</label>
                                                                        <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-2">
                                                                        <label for="">Prenom</label>
                                                                        <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="paste-new-forms"></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="modal-footer">
                                    <div class="col-xs-6 col-md-2">
                                        <button type="submit" class="btn btn-secondary" name="create">
                                         Ajouter
                                     </button>
                                 </div></div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>

             <hr class="hr"><br>
             <!-- Modal Modifier-->
             <div id="updateModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" class="row g-3">
                                <div class="form-group col-md-6">
                                    <label>Code :</label>
                                    <input type="text"  name="code" class="form-control" placeholder="prenom" autocomplete="rutjfkde"
                                    id="code" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date :</label>
                                    <input type="text"  name="date" class="form-control" placeholder="Date" autocomplete="rutjfkde"
                                    id="date" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Presence :</label>
                                    <input type="text"  name="presence" class="form-control" placeholder="presence" id="presence">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>format :</label>
                                    <input type="text"  name="format" class="form-control" placeholder="format" id="format"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Civilité :</label>
                                    <input type="text"  name="civilité" class="form-control" placeholder="civilite" id="civilité">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Prenom :</label>
                                    <input type="text"  name="prénom" class="form-control" placeholder="prenom" id="prénom">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nom :</label>
                                    <input type="text"  name="nom" class="form-control" placeholder="nom" id="nom"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Telephone :</label>
                                    <input type="number"  name="telephone" class="form-control" placeholder="telephone" id="telephone">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Societe :</label>
                                    <input type="text"  name="societe" class="form-control" placeholder="Societe" id="societe">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fonction :</label>
                                    <input type="text"  name="fonction" class="form-control" placeholder="Fonction" id="fonction">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Adresse :</label>
                                    <input type="text"  name="adresse" class="form-control" placeholder="adresse" id="adresse">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Ville :</label>
                                    <input type="text"  name="ville" class="form-control" placeholder="ville" id="ville">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Code Postal :</label>
                                    <input type="number"  name="code_postal" class="form-control" placeholder="code_postal" id="code_postal"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pays :</label>
                                    <input type="text"  name="pays" class="form-control" placeholder="pays" id="pays">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="hidden"  id="id" class="form-control">
                                </div>
                                <div class="col-xs-3 ">
                                <input type="submit" name="modifier" id="save" value="Modifier" class="btn btn-info"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <br>
                <?php echo $msg; ?>
                <p style="color: red;">Rechercher</p>
                <input type="text" placeholder="Rechercher"
                name="rechercher" class="form-control" id="rechercher" autocomplete="off" 
                style="width: 660px;display: block;margin-right: auto;margin-left: auto; margin-bottom: 40px" >
            </div>
            <table class="table table-striped table-bordered table-hover" style="margin-left: 10px;">
                <thead>
                    <tr class="table-primary">
                      <th class="">ID</th>
                      <th class="">Code</th>
                      <th class="">Date</th>
                      <th class="">Presence</th>
                      <th class="">Format</th>
                      <th class="">Civilité</th>
                      <th class="">Prénom</th>
                      <th class="">Nom</th>
                      <th class="">Matricule Fiscale</th>
                      <th class="">RNE</th>
                      <th class="">Email</th>
                      <th class="">Telephone</th>
                      <th class="">Societe</th>
                      <th class="">Fonction</th>
                      <th class="">Adresse</th>
                      <th class="">Ville</th>
                      <th class="">Code Postal</th>
                      <th class="">Pays</th>
                      <th class="">Etat</th>
                      <th class="">Date de création</th>
                      <th class="">Modifier</th>
                      <th class="">Supprimer</th>
                      <th class="">Approuvement</th>
                  </tr>
              </thead>
              <tbody id="table">
                <?php
                $sql = "Select * from inscription_personne_morale";
                $result = mysqli_query($con,$sql);
                $num = mysqli_num_rows($result);
                if ($num>0){
                    while($row=mysqli_fetch_assoc($result)) {
                        echo "  
                        <tr>
                        <tr style='vertical-align: middle;' id='" . $row["id"] ."'>
                        <td class='table-secondary' data-target='id'>" . $row["id"] . "</td>
                        <td class='table-success' data-target='code']>" . $row["code"] . "</td>
                        <td class='table-danger' data-target='date']>" . $row["date"] . "</td>
                        <td class='table-warning'class='table-info' data-target='presence']>" . $row["presence"] . "</td>
                        <td class='table-light' data-target='format']>" . $row["format"] . "</td>
                        <td class='table-info' data-target='civilité']>" . $row["civilité"] . "</td>
                        <td class='table-warning' data-target='prénom']>" . $row["prénom"] . "</td>
                        <td class='table-danger' data-target='nom']>" . $row["nom"] . "</td>
                        <td class='table-secondary' data-target='fiscal']>" . $row["matricule_fiscale"] . "</td>
                        <td class='table-info' ><a
                        href=' http://localhost/brnsmart/telechargerne_inscription_morale?telecharger=
                        " .$row["id"]. " '>". $row["rne"] ."</a> </td>
                        <td >" . $row["email"] . "</td>
                        <td class='table-success' data-target='telephone']>" . $row["telephone"] . "</td>
                        <td class='table-secondary' data-target='adresse']>" . $row["adresse"] . "</td>
                        <td class='table-info' data-target='societe']>" . $row["societe"] . "</td>
                        <td class='table-warning' data-target='fonction']>" . $row["fonction"] . "</td>
                        <td class='table-danger' data-target='ville']>" . $row["ville"] . "</td>
                        <td class='table-light' data-target='code_postal']>" . $row["code_postal"] . "</td>
                        <td class='table-success' data-target='pays']>" . $row["pays"] . "</td>
                        <td class='table-secondary' data-target='approuvement']>" . $row["approuvement"] . "</td>
                        <td>" . $row["create_datetime"] . "</td>
                        <td>
                        <a class='btn btn-primary btn-sm edit'
                        data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
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
    $(document).ready(function () {

        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.main-form').remove();
        });
        
        $(document).on('click', '.add-more-form', function () {
            $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                <div class="row">\
                <div class="col-md-4">\
                <div class="form-group mb-2">\
                <label for="">Email</label>\
                <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">\
                </div>\
                </div>\
                <div class="col-md-4">\
                <div class="form-group mb-2">\
                <label for="">Nom</label>\
                <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">\
                </div>\
                </div>\
                <div class="col-md-4">\
                <div class="form-group mb-2">\
                <label for="">Prenom</label>\
                <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">\
                </div>\
                </div>\
                <div class="col-md-4">\
                <div class="form-group mb-2">\
                <br>\
                <button type="button" class="remove-btn btn btn-danger">Supprimer</button>\
                </div>\
                </div>\
                </div>\
                </div>');
        });

    });
</script>
<script>
 $(document).ready(function(){
     $(document).on('click','a[data-role=update]', function(){
         var id = $(this).data('id');
         var code = $('#'+id).children('td[data-target=code]').text();
         var date = $('#'+id).children('td[data-target=date]').text();
         var presence = $('#'+id).children('td[data-target=presence]').text();
         var format = $('#'+id).children('td[data-target=format]').text();
         var civilité = $('#'+id).children('td[data-target=civilité]').text();
         var prénom = $('#'+id).children('td[data-target=prénom]').text();
         var nom = $('#'+id).children('td[data-target=nom]').text();
         var telephone = $('#'+id).children('td[data-target=telephone]').text();
         var societe = $('#'+id).children('td[data-target=societe]').text();
         var fonction = $('#'+id).children('td[data-target=fonction]').text();
         var adresse = $('#'+id).children('td[data-target=adresse]').text();
         var ville = $('#'+id).children('td[data-target=ville]').text();
         var code_postal = $('#'+id).children('td[data-target=code_postal]').text();
         var pays = $('#'+id).children('td[data-target=pays]').text();
         var approuvement = $('#'+id).children('td[data-target=approuvement]').text();

         $('#code').val(code);
         $('#date').val(date);
         $('#presence').val(presence);
         $('#format').val(format);
         $('#civilité').val(civilité);
         $('#prénom').val(prénom);
         $('#nom').val(nom);
         $('#telephone').val(telephone);
         $('#societe').val(societe);
         $('#fonction').val(fonction);
         $('#adresse').val(adresse);
         $('#ville').val(ville);
         $('#code_postal').val(code_postal);
         $('#pays').val(pays);
         $('#approuvement').val(approuvement);
         $('#id').val(id);    
     });

     $('#save').click(function(){
         var id = $('#id').val();
         var code = $('#code').val();
         var date = $('#date').val();
         var presence = $('#presence').val();
         var format = $('#format').val();
         var civilité = $('#civilité').val();
         var prénom = $('#prénom').val();
         var nom = $('#nom').val();
         var telephone = $('#telephone').val();
         var societe = $('#societe').val();
         var fonction = $('#fonction').val();
         var adresse = $('#adresse').val();
         var ville = $('#ville').val();
         var code_postal = $('#code_postal').val();
         var pays = $('#pays').val();
         var approuvement = $('#approuvement').val();

         $.ajax({
            url: 'http://localhost/brnsmart/table_inscription_personne_morale',
            method: 'POST',
            data : {code : code, date: date, presence : presence, format : format,civilité : civilité, prénom: prénom, nom : nom, telephone : telephone,societe : societe,fonction : fonction,adresse : adresse, ville: ville, code_postal : code_postal, pays : pays, id : id},
            success : function(response){
               $('#'+id).children('td[data-target=code]').text(code);
               $('#'+id).children('td[data-target=date]').text(date);
               $('#'+id).children('td[data-target=presence]').text(presence);
               $('#'+id).children('td[data-target=format]').text(format);
               $('#'+id).children('td[data-target=civilité]').text(civilité);
               $('#'+id).children('td[data-target=prénom]').text(prénom);
               $('#'+id).children('td[data-target=nom]').text(nom);
               $('#'+id).children('td[data-target=telephone]').text(telephone);
               $('#'+id).children('td[data-target=societe]').text(societe);
               $('#'+id).children('td[data-target=fonction]').text(fonction);
               $('#'+id).children('td[data-target=adresse]').text(adresse);
               $('#'+id).children('td[data-target=ville]').text(ville);
               $('#'+id).children('td[data-target=code_postal]').text(code_postal);
               $('#'+id).children('td[data-target=pays]').text(pays);
               $('#'+id).children('td[data-target=approuvement]').text(approuvement);
               $('#updateModal').modal('toggle');

           }
       });

     });
 });
</script>
<script>
    $(document).ready(function() { 
        $('#code').change(function(){
          var tid = $('#code').val();

          $.ajax({
            type: 'POST',
            url : 'http://localhost/brnsmart/fetch/',
            data : {id : tid},
            success: function(data)
            {
              $('#show').html(data);
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
         url:' http://localhost/brnsmart/rechercher_inscription_personne_morale',
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
</html>
