<?php

/* Template Name: table_inscription_formateur Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
?>

<?php
if(isset($_POST['prenom'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $experience = $_POST['experience'];
    $formation = $_POST['formation'];
    $tarif = $_POST['tarif'];
    $nbr_jour = $_POST['nbr_jour'];
    $message = $_POST['message'];
    $id = $_POST['id'];

    $sql = "update inscription_formateur set 
    prenom = '$prenom',
    nom = '$nom',
    telephone = '$telephone',   
    experience = '$experience',
    formation = '$formation',
    tarif = '$tarif',
    nbr_jour = '$nbr_jour',
    message = '$message'
    where id = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_inscription_formateur"
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
    $email = stripslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = stripslashes($_REQUEST["telephone"]);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $cv = $_FILES['cv']['name'];
    $destination = 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\uploads/' .$cv;
    $extension = pathinfo($cv, PATHINFO_EXTENSION);
    $file = $_FILES['cv']['tmp_name'];
    $size = $_FILES['cv']['size'];
    $experience = stripslashes($_REQUEST["experience"]);
    $experience = mysqli_real_escape_string($con, $experience);
    $formation = stripslashes($_REQUEST["formation"]);
    $formation = mysqli_real_escape_string($con, $formation);
    $tarif = stripslashes($_REQUEST["tarif"]);
    $tarif = mysqli_real_escape_string($con, $tarif);
    $nbr_jour = stripslashes($_REQUEST["nbr_jour"]);
    $nbr_jour = mysqli_real_escape_string($con, $nbr_jour);
    $message = stripslashes($_REQUEST["message"]);
    $message = mysqli_real_escape_string($con, $message);
    $create_datetime = date("Y-m-d H:i:s");

    if(EmailExisteformateurInscription($email)){

        $msg = "<label class='text-danger'>Email existe !!!</label>";

    } elseif(move_uploaded_file($file, $destination)){
        $query = "INSERT into `inscription_formateur` (prenom,nom,email,telephone,cv,size,experience,formation,tarif,nbr_jour,message,create_datetime)
        VALUES ('$prenom','$nom',
            '$email','$telephone','$cv','$size','$experience','$formation','$tarif',
            '$nbr_jour','$message',
            '$create_datetime')";
        $result = mysqli_query($con, $query);
        if ($result) {
            header(
                "Location: http://localhost/brnsmart/table_inscription_formateur"
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


    <title>Table-Inscription-Formateur</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js">
    </script>
    
    <style>
        
     
    </style>
    
</head>
<body class="sb-nav-fixed" style=" overflow-x: hidden;  margin-left: 10px; ">
   
    <div>
        <main>
            <div class="row" style="margin-top: 120px;">
                <div class="col-md-10 col-md-offset-1" >
                    <div>
                        <table class="table">
                            <div>
                                <button type="button" data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-primary ajouting" style=" 
                                margin-top: -20px ;margin-left: 60px">Ajouter Formateur</button>
                            </div>
                            <div>
                                <a href="http://localhost/brnsmart/telecharger_inscription_formateur">
                                    <button class="btn btn-warning " name="download" style=" float:right;
                                    margin-top: -40px ;margin-right: -200px">Télécharger</button>
                                </a>
                            </div>
                        </main>
                        <hr style="margin-top: 20px; width: 1550px; margin-left: 60px;"><br>
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="" class="row g-3" enctype="multipart/form-data">
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
                                                <span class="input-group-text col-md-3">CV</span>
                                                <input type="file" required name="cv" class="form-control">
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Experience</span>
                                                <input type="text" required name="experience" class="form-control" placeholder="experience" >
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Formation</span>
                                                <select  name="formation" required class="form-control">
            <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
            <?php 
            $sql = "Select * from liste_formation";
            $result = mysqli_query($con,$sql);
            $num = mysqli_num_rows($result);
            if($result){
              if ($num>0){
                while($row=mysqli_fetch_assoc($result)) {
                  ?>
                  <option value="<?php echo $row["code_formation"]; ?>" >
                    <?php $vall = $row["code_formation"]?> 
                    <?php echo $vall ?>
                  </option>
                  <?php 
                }}}
                ?>
              </select>
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Tarif</span>
                                                <input type="number" required name="tarif" class="form-control" placeholder="tarif" >
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Nbr de jours</span>
                                                <input type="number" required name="nbr_jour" class="form-control" placeholder="nbr_jour" >
                                            </div><br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Message</span>
                                                <input type="text" required name="message" class="form-control" placeholder="message" >
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
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="">

                                            
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Prenom</span>
                                                <input type="text"  name="prenom" class="form-control" placeholder="prenom" autocomplete="rutjfkde"
                                                id="prenom" value="">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Nom</span>
                                                <input type="text"  name="nom" class="form-control" placeholder="nom" id="nom">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Telephone</span>
                                                <input type="number"  name="telephone" class="form-control" placeholder="telephone" id="telephone">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Experience</span>
                                                <input type="text"  name="experience" class="form-control" placeholder="experience" id="experience">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Formation</span>
                                                <input type="text"  name="formation" class="form-control" placeholder="formation" id="formation">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Tarif</span>
                                                <input type="number"  name="tarif" class="form-control" placeholder="tarif" id="tarif">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Nbr jours</span>
                                                <input type="number"  name="nbr_jour" class="form-control" placeholder="nbr_jour" id="nbr_jour">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-3">Message</span>
                                                <input type="text"  name="message" class="form-control" placeholder="message" id="message">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="hidden"  id="id" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-xs-6 col-md-2">
                                                    <button type="submit" class="btn btn-primary" id="save" name="modifier">
                                                     Modifier
                                                 </button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="col-md-12 text-center">
                        <br>
                        <?php echo $msg; ?>
                        <input type="text" placeholder="Rechercher"
                        name="rechercher" class="form-control" id="rechercher" autocomplete="off" 
                        style="width: 1000px;display: block;margin-left: 300px; margin-bottom: 20px" >
                    </div>
                    <table class="table table-striped table-bordered" style="margin-left: 100px">
                        <thead>
                            <tr class="table-primary">
                              <th class="">ID</th>
                              <th class="">prenom</th>
                              <th class="">nom</th>
                              <th class="">email</th>
                              <th class="">telephone</th>
                              <th class="">cv</th>
                              <th class="">experience</th>
                              <th class="">formation</th>
                              <th class="">tarif</th>
                              <th class="">nbr_Jour</th>
                              <th class="">message</th>
                              <th class="">date de création</th>
                              <th class="">Modifier</th>
                              <th class="">Supprimer</th>
                          </tr>
                      </thead>
                      <tbody id="table">
                        <?php
                        $sql = "Select * from inscription_formateur";
                        $result = mysqli_query($con,$sql);
                        $num = mysqli_num_rows($result);
                        if ($num>0){
                            while($row=mysqli_fetch_assoc($result)) {
                                echo "  
                                <tr style='vertical-align: middle;' id='" . $row["id"] ."'>
                                <td class='table-secondary' data-bs-target='id'>" . $row["id"] . "</td>
                                <td class='table-danger' data-bs-target='prenom'>" . $row["prenom"] . "</td>
                                <td class='table-light' data-bs-target='nom'>" . $row["nom"] . "</td>
                                <td class='table-warning'>" . $row["email"] . "</td>
                                <td class='table-white' data-bs-target='telephone'>" . $row["telephone"] . "</td>
                                <td class='table-info'> <a
                                href=' http://localhost/brnsmart/telechargecv_inscription_formateur?telecharger=
                                " .$row["id"]. " '>". $row["cv"] ."</a> </td>
                                <td class='table-success' data-bs-target='experience'>" . $row["experience"] . "</td>
                                <td class='table-success' data-bs-target='formation'>" . $row["formation"] . "</td>
                                <td class='table-secondary' data-bs-target='tarif'>" . $row["tarif"] . "</td>
                                <td class='table-warning' data-bs-target='nbr_jour'>" . $row["nbr_jour"] . "</td>
                                <td class='table-info' data-bs-target='message'>" . $row["message"] . "</td>
                                <td>" . $row["create_datetime"] . "</td>
                                <td>
                                <a class='btn btn-primary btn-sm edit'
                                data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
                                data-role='update'>Modifier</a>
                                </td>
                                <td>
                                <a class='btn btn-danger btn-sm'
                                href='' data-bs-target='#sup' data-bs-toggle='modal'>Supprimer</a>
                                </td>
                                <div  class='modal fade' id='sup' tabindex='-1' style='margin-left: -300px; margin-top: 100px'>
                                <div class='modal-dialog'>
                                <div class='modal-content'>
                                <div class='modal-header'>
                                <h5 class='modal-title'>Confirmation</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>
                                <div class='modal-body'>
                                <p>Voulez-vous confirmer la supression de cette inscription?</p>
                                <p class='text-secondary'><small>Si vous ne le souhaitez pas, cliquez sur le bouton d’annulation</small></p>
                                </div>
                                <div class='modal-footer'>
                                <a class='btn btn-primary'
                                href='
                                http://localhost/brnsmart/supprimer_inscription_formateur?supprimer=
                                " .$row["id"]. " '>Confirmer</a>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Annuler</button>
                                </div>
                                </div>
                                </div>
                                </div>
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
         var telephone = $('#'+id).children('td[data-bs-target=telephone]').text();
         var experience = $('#'+id).children('td[data-bs-target=experience]').text();
         var formation = $('#'+id).children('td[data-bs-target=formation]').text();
         var tarif = $('#'+id).children('td[data-bs-target=tarif]').text();
         var nbr_jour = $('#'+id).children('td[data-bs-target=nbr_jour]').text();
         var message = $('#'+id).children('td[data-bs-target=message]').text();

         $('#prenom').val(prenom);
         $('#nom').val(nom);
         $('#telephone').val(telephone);
         $('#experience').val(experience);
         $('#formation').val(formation);
         $('#tarif').val(tarif);
         $('#nbr_jour').val(nbr_jour);
         $('#message').val(message);
         $('#id').val(id);    
     });

   //get data and update in db
   $('#save').click(function(){
     var id = $('#id').val();
     var prenom = $('#prenom').val();
     var nom = $('#nom').val();
     var telephone = $('#telephone').val();
     var experience = $('#experience').val();
     var formation = $('#formation').val();
     var tarif = $('#tarif').val();
     var nbr_jour = $('#nbr_jour').val();
     var message = $('#message').val();

     $.ajax({
        url: 'http://localhost/brnsmart/table_inscription_formateur',
        method: 'POST',
        data : {prenom : prenom, nom: nom, telephone : telephone, experience : experience,formation : formation, tarif : tarif,nbr_jour : nbr_jour,message : message, id : id},
        success : function(response){
        //update records in table
        $('#'+id).children('td[data-bs-target=prenom]').text(prenom);
        $('#'+id).children('td[data-bs-target=nom]').text(nom);
        $('#'+id).children('td[data-bs-target=telephone]').text(telephone);
        $('#'+id).children('td[data-bs-target=experience]').text(experience);
        $('#'+id).children('td[data-bs-target=formation]').text(formation);
        $('#'+id).children('td[data-bs-target=tarif]').text(tarif);
        $('#'+id).children('td[data-bs-target=nbr_jour]').text(nbr_jour);
        $('#'+id).children('td[data-bs-target=message]').text(message);
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
         url:' http://localhost/brnsmart/rechercher_inscription_formateur',
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
