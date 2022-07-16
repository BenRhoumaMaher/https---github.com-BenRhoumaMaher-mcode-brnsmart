<?php

/* Template Name: table_inscription_stagiaires Page */

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


    $query = "INSERT into `inscription_stagiaires`(code,date,presence,format,civilité,prénom,nom,email,telephone,adresse,ville,code_postal,pays,approuvement, create_datetime)
    VALUES ('$code','$date','$presence','$format',
        '$civilité','$prénom','$nom','$email',
        '$telephone', '$adresse',
        '$ville','$code_postal','$pays','Off',
        '$create_datetime')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header(
            "Location: http://localhost/brnsmart/table_inscription_stagiaires"
        );
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
    $entreprise = $_POST['entreprise'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $approuvement = $_POST['approuvement'];
    $id = $_POST['id'];

    $sql = "update inscription_stagiaires set code = '$code',
    date = '$date',
    presence = '$presence',
    format = '$format',
    civilité = '$civilité',
    prénom = '$prénom',
    nom = '$nom',
    entreprise = '$entreprise',
    telephone = '$telephone',
    adresse = '$adresse',
    ville = '$ville',
    code_postal = '$code_postal',
    pays = '$pays',
    approuvement = '$approuvement'
    where id = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_inscription_stagiaires"
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
    <title>Table-Inscription_Stagiaires</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</head>

<body class="sb-nav-fixed" >


    <div>
        <?php echo Message(); ?>
    </div>
    <button type="button" data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-primary ajouting" style="float:left; margin-top: 40px;margin-left: 220px">Ajouter Stagiaire</button>
</div>
<div>
    <a href="http://localhost/brnsmart/telecharger_inscription_stagiaires">
        <button type="button" class="btn btn-warning pull-right" name="download" style="float:right; margin-top: 40px;margin-right: 220px">Télécharger</button>
    </a>
</div><br><br>


<hr style="margin-top: 60px; width: 1250px; margin-left: 40px; display: block;margin-right: auto;margin-left: auto"><br>

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
                          <option value="" disabled  selected hidden>Veuiller indiquer votre formation</option>
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
                            <input type="text"  name="code" class="form-control" placeholder="code" autocomplete="rutjfkde"
                            id="code" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date :</label>
                            <input type="date"  name="date" class="form-control" placeholder="Date" autocomplete="rutjfkde"
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
                            <input type="text"  name="prénom" class="form-control" placeholder="nom" id="prénom">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nom :</label>
                            <input type="text"  name="nom" class="form-control" placeholder="sexe" id="nom">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Entreprise :</label>
                            <input type="text"  name="entreprise" class="form-control" placeholder="entreprise" id="entreprise">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Telephone :</label>
                            <input type="number"  name="telephone" class="form-control" placeholder=Telephone id="telephone">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Adresee :</label>
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
                        <div class="form-group col-md-6">
                            <label>Approuvement :</label>
                            <input type="text"  name="approuvement" class="form-control" placeholder="Approuvement" id="approuvement">
                        </div>
                        <div class="form-group col-md-6">
                            <label></label>
                            <input type="hidden"  id="id" class="form-control">
                        </div>
                        <div class="col-xs-3 ">
                            <input type="submit" name="modifier" id="save" value="Modifier" class="btn btn-info"></div>
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="rechercher">
            <input type="text" placeholder="Rechercher" style="width: 660px;display: block;margin-right: auto;margin-left: auto; margin-bottom: 40px" 
            name="rechercher" class="form-control" id="rechercher" autocomplete="off"  >
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead style="vertical-align: middle;">
                <tr class="table-primary">
                    <th class="">ID</th>
                    <th class="">Code</th>
                    <th class="">Date</th>
                    <th class="">Presence</th>
                    <th class="">Format</th>
                    <th class="">Civilité</th>
                    <th class="">Prénom</th>
                    <th class="">Nom</th>
                    <th class="">Entreprise</th>
                    <th class="">Email</th>
                    <th class="">Telephone</th>
                    <th class="">Adresse</th>
                    <th class="">Ville</th>
                    <th class="">Code Postal</th>
                    <th class="">Pays</th>
                    <th class="">Etat</th>
                    <th class="">Date de création</th>
                    <th class="">Modifier</th>
                    <th class="">Supprimer</th>
                    <th class="">Accepter</th>
                </tr>
            </thead>
            <tbody id="table">
                <?php
                $sql = "Select * from inscription_stagiaires";
                $result = mysqli_query($con,$sql);
                $num = mysqli_num_rows($result);
                if ($num>0){
                    while($row=mysqli_fetch_assoc($result)) {
                        echo "  
                        <tr  style='vertical-align: middle;' id='" . $row["id"] ."'>
                        <td  class='table-secondary' data-bs-target='id'>" . $row["id"] . "</td>
                        <td class='table-success' data-bs-target='code']>" . $row["code"] . "</td>
                        <td class='table-danger' data-bs-target='date']>" . $row["date"] . "</td>
                        <td class='table-warning' data-bs-target='presence']>" . $row["presence"] . "</td>
                        <td class='table-info' data-bs-target='format']>" . $row["format"] . "</td>
                        <td class='table-light' data-bs-target='civilité']>" . $row["civilité"] . "</td>
                        <td class='table-info' data-bs-target='prénom']>" . $row["prénom"] . "</td>
                        <td class='table-warning' data-bs-target='nom']>" . $row["nom"] . "</td>
                        <td class='table-danger' data-bs-target='entreprise']>" . $row["entreprise"] . "</td>
                        <td >" . $row["email"] . "</td>
                        <td class='table-danger' data-bs-target='telephone']>" . $row["telephone"] . "</td>
                        <td class='table-success' data-bs-target='adresse']>" . $row["adresse"] . "</td>
                        <td class='table-secondary' data-bs-target='ville']>" . $row["ville"] . "</td>
                        <td class='table-info' data-bs-target='code_postal']>" . $row["code_postal"] . "</td>
                        <td class='table-warning' data-bs-target='pays']>" . $row["pays"] . "</td>
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
            </tbody>
        </table>
    </body>

    </html>
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
         $(document).on('click','a[data-role=update]', function(){
             var id = $(this).data('id');
             var code = $('#'+id).children('td[data-bs-target=code]').text();
             var date = $('#'+id).children('td[data-bs-target=date]').text();
             var presence = $('#'+id).children('td[data-bs-target=presence]').text();
             var format = $('#'+id).children('td[data-bs-target=format]').text();
             var civilité = $('#'+id).children('td[data-bs-target=civilité]').text();
             var prénom = $('#'+id).children('td[data-bs-target=prénom]').text();
             var nom = $('#'+id).children('td[data-bs-target=nom]').text();
             var entreprise = $('#'+id).children('td[data-bs-target=entreprise]').text();
             var telephone = $('#'+id).children('td[data-bs-target=telephone]').text();
             var adresse = $('#'+id).children('td[data-bs-target=adresse]').text();
             var ville = $('#'+id).children('td[data-bs-target=ville]').text();
             var code_postal = $('#'+id).children('td[data-bs-target=code_postal]').text();
             var pays = $('#'+id).children('td[data-bs-target=pays]').text();
             var approuvement = $('#'+id).children('td[data-bs-target=approuvement]').text();

             $('#code').val(code);
             $('#date').val(date);
             $('#presence').val(presence);
             $('#format').val(format);
             $('#civilité').val(civilité);
             $('#prénom').val(prénom);
             $('#nom').val(nom);
             $('#entreprise').val(entreprise);
             $('#telephone').val(telephone);
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
             var entreprise = $('#entreprise').val();
             var telephone = $('#telephone').val();
             var adresse = $('#adresse').val();
             var ville = $('#ville').val();
             var code_postal = $('#code_postal').val();
             var pays = $('#pays').val();
             var approuvement = $('#approuvement').val();

             $.ajax({
                url: 'http://localhost/brnsmart/table_inscription_stagiaires',
                method: 'POST',
                data : {code : code, date: date, presence : presence, format : format,entreprise : entreprise,civilité : civilité, prénom: prénom, nom : nom, telephone : telephone,adresse : adresse, ville: ville, code_postal : code_postal, pays : pays,approuvement : approuvement, id : id},
                success : function(response){
        //update records in table
        $('#'+id).children('td[data-bs-target=code]').text(code);
        $('#'+id).children('td[data-bs-target=date]').text(date);
        $('#'+id).children('td[data-bs-target=presence]').text(presence);
        $('#'+id).children('td[data-bs-target=format]').text(format);
        $('#'+id).children('td[data-bs-target=civilité]').text(civilité);
        $('#'+id).children('td[data-bs-target=prénom]').text(prénom);
        $('#'+id).children('td[data-bs-target=nom]').text(nom);
        $('#'+id).children('td[data-bs-target=entreprise]').text(entreprise);
        $('#'+id).children('td[data-bs-target=telephone]').text(telephone);
        $('#'+id).children('td[data-bs-target=adresse]').text(adresse);
        $('#'+id).children('td[data-bs-target=ville]').text(ville);
        $('#'+id).children('td[data-bs-target=code_postal]').text(code_postal);
        $('#'+id).children('td[data-bs-target=pays]').text(pays);
        $('#'+id).children('td[data-bs-target=approuvement]').text(approuvement);
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
         url:' http://localhost/brnsmart/rechercher_inscription_stagiaires',
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