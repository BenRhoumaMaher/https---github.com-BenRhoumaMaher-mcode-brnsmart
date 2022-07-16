<?php

/* Template Name: table_enregistrement_personne_morale Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
?>
<?php
if(isset($_POST['utilisateur'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $utilisateur = $_POST['utilisateur'];
    $civilité = $_POST['civilité'];
    $telephone = $_POST['telephone'];
    $societe = $_POST['societe'];
    $fonction = $_POST['fonction'];
    $adresse = $_POST['adresse'];
    $presentation = $_POST['presentation'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $id = $_POST['id'];

    $sql = "update enregistrement_personne_morale set prenom = '$prenom', nom = '$nom', utilisateur = '$utilisateur',civilité = '$civilité',
    telephone = '$telephone',
    societe = '$societe',
    fonction = '$fonction',
    adresse = '$adresse',
    presentation = '$presentation',
    pays = '$pays',
    ville = '$ville',
    code_postal = '$code_postal'
    where id = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_enregistrement_personne_morale"
        );
    }
}

?>
<?php
$msg = '';
if (isset($_REQUEST["create"])) 
{
    $prenom = stripslashes($_REQUEST["prenom"]);
    $prenom = mysqli_real_escape_string($con, $prenom);
    $nom = stripslashes($_REQUEST["nom"]);
    $nom = mysqli_real_escape_string($con, $nom);
    $utilisateur = stripslashes($_REQUEST["utilisateur"]);
    $utilisateur = mysqli_real_escape_string($con, $utilisateur);
    $civilité = stripslashes($_REQUEST["civilité"]);
    $civilité = mysqli_real_escape_string($con, $civilité);
    $email = stripslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = stripslashes($_REQUEST["telephone"]);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $societe = stripslashes($_REQUEST["societe"]);
    $societe = mysqli_real_escape_string($con, $societe);
    $fonction = stripslashes($_REQUEST["fonction"]);
    $fonction = mysqli_real_escape_string($con, $fonction);
    $adresse = stripslashes($_REQUEST["adresse"]);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $presentation = stripslashes($_REQUEST["presentation"]);
    $presentation = mysqli_real_escape_string($con, $presentation);
    $pays = stripslashes($_REQUEST["pays"]);
    $pays = mysqli_real_escape_string($con, $pays);
    $ville = stripslashes($_REQUEST["ville"]);
    $ville = mysqli_real_escape_string($con, $ville);
    $code_postal = stripslashes($_REQUEST["code_postal"]);
    $code_postal = mysqli_real_escape_string($con, $code_postal);
    $mot_de_passe = stripslashes($_REQUEST["mot_de_passe"]);
    $mot_de_passe = mysqli_real_escape_string($con, $mot_de_passe);
    $Token = bin2hex(openssl_random_pseudo_bytes(40));
    $create_datetime = date("Y-m-d H:i:s");

    if(EmailExistePersonneMorale($email)){

        $msg = "<label class='text-danger'>Email existe !!!</label>";

    } else {


        $Hashed_Password = Password_Encryption($mot_de_passe);
        $query = "INSERT into `enregistrement_personne_morale` (prenom,nom,utilisateur,civilité,email,telephone,societe,fonction,adresse,presentation,pays,ville,code_postal,mot_de_passe,token,active, create_datetime)
        VALUES (
            '$nom','$prenom','$utilisateur','$civilité','$email','$telephone',
            '$societe','$fonction','$adresse',
            '$presentation','$pays',
            '$ville','$code_postal',
            '$Hashed_Password','$Token',
            'OFF',
            '$create_datetime')";
        $result = mysqli_query($con, $query);
        if ($result) {
            require_once "phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer();
            $mail->CharSet = "utf-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = "ddev7546@gmail.com";
            $mail->Password = "dev0000.";
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = "465";
            $mail->From = "ddev7546@gmail.com";
            $mail->FromName = "BRNSMART";
            $mail->AddAddress($email, $nom);
            $mail->Subject = "Activation du compte";
            $mail->IsHTML(true);
            $mail->Body = 'Bonjour ' .$prenom. ' vous trouverez ici le lien pour activer votre compte http://localhost/brnsmart/activation_personne_morale?token=' .$Token;
            if ($mail->Send()) {
                header(
                    "Location: http://localhost/brnsmart/table_enregistrement_personne_morale"
                );
            }
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


    <title>Table-Enregistrement-Personne-Physique</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js">
    </script>
    
    <style>
        
        .conta {
            background-size: cover;
            margin-top: -20px;
            margin-left: 180px;
        }
        .tabling {
            margin-left: -135px;
        }
    </style>
    
</head>
<body style=" overflow-x: hidden;">
    <main>
        <div class="conta">
            <div class="row" style="margin-top: 70px;">
                <div class="col-md-10 col-md-offset-1" >
                    <div class="tabling">
                        <table class="table">
                            <div>
                                <button type="button" data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-primary ajouting">Ajouter Stagiaire</button>
                            </div>
                            <div>
                                <a href="http://localhost/brnsmart/telecharger_enregistrement_personne_morale">
                                    <button type="button" class="btn btn-warning pull-right download" name="download" style="margin-top: -55px; margin-left: 1490px;">Télécharger</button>
                                </a>
                            </div>
                        </main>
                        <hr style="width: 1600px;"><br>
                        <div id="updateModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="" class=" row g-3">
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Prenom</span>
                                                <input type="text" required name="prenom" class="form-control" placeholder="prenom" autocomplete="rutjfkde" id="prenom">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Nom</span>
                                                <input type="text" required name="nom" class="form-control" placeholder="nom" autocomplete="rutjfkde" id="nom">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Utilisateur</span>
                                                <input type="text" required name="utilisateur" class="form-control" placeholder="nom d'utilisateur" autocomplete="rutjfkde" id="utilisateur">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Civilité</span>
                                                <input type="text" required name="civilité" class="form-control" placeholder="civilite" autocomplete="rutjfkde" id="civilité">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Telephone</span>
                                                <input type="number" required name="telephone" class="form-control" placeholder="telephone" id="telephone">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Societe</span>
                                                <input type="text" required name="societe" class="form-control" placeholder="societe" id="societe"> 
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Fonction</span>
                                                <input type="text" required name="fonction" class="form-control" placeholder="fonction" id="fonction"> 
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Adresse</span>
                                                <input type="text" required name="adresse" class="form-control" placeholder="adresse" id="adresse">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Presentation</span>
                                                <input type="text" required name="presentation" class="form-control" placeholder="Presentation" autocomplete="rutjfkde" id="presentation">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Pays</span>
                                                <input type="text" required name="pays" class="form-control" placeholder="pays" autocomplete="rutjfkde" id="pays">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Ville</span>
                                                <input type="text" required name="ville" class="form-control" placeholder="ville" autocomplete="rutjfkde" id="ville">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Code Postal</span>
                                                <input type="number" required name="code_postal" class="form-control" placeholder="code_postal" autocomplete="rutjfkde" id="code_postal">
                                            </div><br>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="hidden"  id="id" class="form-control">
                                            </div><br>
                                            <div class="col-xs-6 col-md-2">
                                                <button type="submit" class="btn btn-primary" id="save" name="modifier">
                                                 Modifier
                                             </button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body"> 
                                    <form method="post" action="" class=" row g-3">
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Prenom</span>
                                            <input type="text" required name="prenom" class="form-control" placeholder="prenom" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Nom</span>
                                            <input type="text" required name="nom" class="form-control" placeholder="nom" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Utilisateur</span>
                                            <input type="text" required name="utilisateur" class="form-control" placeholder="utilisateur" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Civilité</span>
                                            <input type="text" required name="civilité" class="form-control" placeholder="civilité" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Email</span>
                                            <input type="text" required name="email" class="form-control" placeholder="email">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Telephone</span>
                                            <input type="text" required name="telephone" class="form-control" placeholder="telephone" >
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Societe</span>
                                            <input type="text" required name="societe" class="form-control" placeholder="societe" > 
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Fonction</span>
                                            <input type="text" required name="fonction" class="form-control" placeholder="fonction" > 
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Adresse</span>
                                            <input type="text" required name="adresse" class="form-control" placeholder="adresse" >
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Presentation</span>
                                            <input type="text" required name="presentation" class="form-control" placeholder="presentation" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Ville</span>
                                            <input type="text" required name="ville" class="form-control" placeholder="ville" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Pays</span>
                                            <input type="text" required name="pays" class="form-control" placeholder="pays" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Code postal</span>
                                            <input type="text" required name="code_postal" class="form-control" placeholder="code_postal" autocomplete="rutjfkde">
                                        </div><br>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-text col-md-3">Mot de passe</span>
                                            <input type="password" required name="mot_de_passe" class="form-control" placeholder="mot_de_passe"  autocomplete="new-password">
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

                     <div class="col-md-12 text-center">
                        <br>
                        <?php echo $msg; ?>
                        <p style="color: red;">Rechercher</p>
                        <input type="text" placeholder="Rechercher"
                        name="rechercher" class="form-control" id="rechercher" autocomplete="off" 
                        style="width: 1600px;display: block;margin-right: auto;margin-left: auto; margin-bottom: 40px" >
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="table-primary">
                              <th class="">ID</th>
                              <th class="">Prenom</th>
                              <th class="">Nom</th>
                              <th class="">Utilisateur</th>
                              <th class="">Civilité</th>
                              <th class="">Email</th>
                              <th class="">Telephone</th>
                              <th class="">Societe</th>
                              <th class="">Fonction</th>
                              <th class="">Adresse</th>
                              <th class="">Presentation</th>
                              <th class="">Pays</th>
                              <th class="">Ville</th>
                              <th class="">Code Postal</th>
                              <th class="">Active</th>
                              <th class="">Date de création</th>
                              <th class="">Modifier</th>
                              <th class="">Supprimer</th>
                          </tr>
                      </thead>
                      <tbody id="table">
                        <?php
                        $sql = "Select * from enregistrement_personne_morale";
                        $result = mysqli_query($con,$sql);
                        $num = mysqli_num_rows($result);
                        if ($num>0){
                            while($row=mysqli_fetch_assoc($result)) {  
                                echo "  
                                <tr style='vertical-align: middle;' id='" . $row["id"] ."'>
                                <td class='table-secondary' data-bs-target='id'>" . $row["id"] . "</td>
                                <td class='table-warning' data-bs-target='prenom'>" . $row["prenom"] . "</td>
                                <td class='table-info' data-bs-target='nom'>" . $row["nom"] . "</td>
                                <td class='table-success' data-bs-target='utilisateur'>" . $row["utilisateur"] . "</td>
                                <td class='table-secondary' data-bs-target='civilité'>" . $row["civilité"] . "</td>
                                <td class='table-danger' >" . $row["email"] . "</td>
                                <td class='table-warning' data-bs-target='telephone'>" . $row["telephone"] . "</td>
                                <td class='table-info' data-bs-target='societe'>" . $row["societe"] . "</td>
                                <td class='table-success' data-bs-target='fonction'>" . $row["fonction"] . "</td>
                                <td class='table-danger' data-bs-target='adresse'>" . $row["adresse"] . "</td>
                                <td class='table-warning' data-bs-target='presentation'>" . $row["presentation"] . "</td>
                                <td class='table-secondary' data-bs-target='pays'>" . $row["pays"] . "</td>
                                <td class='table-success' data-bs-target='ville'>" . $row["ville"] . "</td>
                                <td class='table-info' data-bs-target='code_postal'>" . $row["code_postal"] . "</td>
                                <td class='table-secondary'>" . $row["active"] . "</td>
                                <td class='table-success'>" . $row["create_datetime"] . "</td>
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
         var prenom = $('#'+id).children('td[data-bs-target=prenom]').text();
         var nom = $('#'+id).children('td[data-bs-target=nom]').text();
         var utilisateur = $('#'+id).children('td[data-bs-target=utilisateur]').text();
         var civilité = $('#'+id).children('td[data-bs-target=civilité]').text();
         var telephone = $('#'+id).children('td[data-bs-target=telephone]').text();
         var societe = $('#'+id).children('td[data-bs-target=societe]').text();
         var fonction = $('#'+id).children('td[data-bs-target=fonction]').text();
         var adresse = $('#'+id).children('td[data-bs-target=adresse]').text();
         var presentation = $('#'+id).children('td[data-bs-target=presentation]').text();
         var pays = $('#'+id).children('td[data-bs-target=pays]').text();
         var ville = $('#'+id).children('td[data-bs-target=ville]').text();
         var code_postal = $('#'+id).children('td[data-bs-target=code_postal]').text();

         $('#prenom').val(prenom);
         $('#nom').val(nom);
         $('#utilisateur').val(utilisateur);
         $('#civilité').val(civilité);
         $('#telephone').val(telephone);
         $('#societe').val(societe);
         $('#fonction').val(fonction);
         $('#adresse').val(adresse);
         $('#presentation').val(presentation);
         $('#pays').val(pays);
         $('#ville').val(ville);
         $('#code_postal').val(code_postal);
         $('#id').val(id);
     });

   //get data and update in db
   $('#save').click(function(){
     var id = $('#id').val();
     var prenom = $('#prenom').val();
     var nom = $('#nom').val();
     var utilisateur = $('#utilisateur').val();
     var civilité = $('#civilité').val();
     var telephone = $('#telephone').val();
     var societe = $('#societe').val();
     var fonction = $('#fonction').val();
     var adresse = $('#adresse').val();
     var presentation = $('#presentation').val();
     var pays = $('#pays').val();
     var ville = $('#ville').val();
     var code_postal = $('#code_postal').val();

     $.ajax({
        url: 'http://localhost/brnsmart/table_enregistrement_personne_morale',
        method: 'POST',
        data : {prenom : prenom, nom: nom,utilisateur : utilisateur,civilité : civilité, telephone: telephone, societe : societe , fonction : fonction, adresse : adresse,
            presentation : presentation,
            pays : pays,
            ville : ville,
            code_postal : code_postal,
            id : id},
            success : function(response){
               $('#'+id).children('td[data-bs-target=nom]').text(nom);
               $('#'+id).children('td[data-bs-target=prenom]').text(prenom);
               $('#'+id).children('td[data-bs-target=utilisateur]').text(utilisateur);
               $('#'+id).children('td[data-bs-target=civilité]').text(civilité);
               $('#'+id).children('td[data-bs-target=telephone]').text(telephone);
               $('#'+id).children('td[data-bs-target=societel]').text(societe);
               $('#'+id).children('td[data-bs-target=fonction]').text(fonction);
               $('#'+id).children('td[data-bs-target=adresse]').text(adresse);
               $('#'+id).children('td[data-bs-target=presentation]').text(presentation);
               $('#'+id).children('td[data-bs-target=pays]').text(pays);
               $('#'+id).children('td[data-bs-target=ville]').text(ville);
               $('#'+id).children('td[data-bs-target=code_postal]').text(code_postal);
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
         url:' http://localhost/brnsmart/rechercher_enregistrement_personne_morale',
         data:{recherche:rechercher},
         success:function(response)
         {
            $("#table").html(response);
        } 
    });
   });
 });
</script>
</html>
