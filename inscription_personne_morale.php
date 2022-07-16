<?php
/* Template Name: Inscription Personne Morale Page */

// on utilise get_header() pour afficher ici le footer de notre thème wordpress  
get_header();
?>


<?php
require('db.php');


$error_code = '';
$error_date = '';
$error_presence = '';
$error_civilité = '';
$error_prénom = '';
$error_nom = '';
$error_email = '';
$error_telephone = '';
$error_societe = '';
$error_fonction = '';
$error_adresse = '';
$error_ville = '';
$error_code_postal = '';
$error_pays = '';


if (isset($_REQUEST["save_multiple_data"])) {
  if (empty($_POST["code"])) {
    $error_code = "<label class='text-danger'>Veuiller sélectionner une formation</label>";
  }
  if (empty($_POST["date"])) {
    $error_date = "<label class='text-danger'>Veuiller sélectionner une date</label>";
  }

  if (empty($_POST["presence"])) {
    $error_presence = "<label class='text-danger'>Veuiller sélectionner votre état de présence</label>";
  }

  if (empty($_POST["civilité"])) {
    $error_civilité = "<label class='text-danger'>Veuiller remplir ce champs</label>";
  }

  if (empty($_POST["prénom"])) {
    $error_prénom = "<label class='text-danger'>Veuiller indiquer votre prénom</label>";
  } else
  {
    $prénom = trim($_POST["prénom"]);
  }
  if (empty($_POST["nom"])) {
    $error_nom = "<label class='text-danger'>Veuiller indiquer votre nom</label>";
  } else {
    $nom = trim($_POST["nom"]);
  }
  if (empty($_POST["email"])) {
    $error_email = "<label class='text-danger'>Veuiller entrer votre email</label>";
  } else {
    $email = trim($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_email = "<label class='text-danger'>entrer email valid</label>";
    }
  }
  if (empty($_POST["telephone"])) {
    $error_telephone = "<label class='text-danger'>Veuiller indiquer votre telephone</label>";
  } else {
    $telephone = trim($_POST["telephone"]);
    if (!filter_var($telephone, FILTER_VALIDATE_INT)) {
      $error_telephone = "<label class='text-danger'>entrer valid phone</label>";
    }
  }
  if (empty($_POST["societe"])) {
    $error_societe = "<label class='text-danger'>Veuiller indiquer votre societe</label>";
  } else {
    $societe = trim($_POST["societe"]);
  }
  if (empty($_POST["fonction"])) {
    $error_fonction = "<label class='text-danger'>Veuiller indiquer votre fonction</label>";
  } else {
    $fonction = trim($_POST["fonction"]);
  }
  if (!strlen(trim($_POST["adresse"]))) {
    $error_adresse = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
  } else {
    $adresse = trim($_POST["adresse"]);
  }
  if (empty($_POST["pays"])) {
    $error_pays = "<label class='text-danger'>Veuiller indiquer votre pays</label>";
  } else {
    $pays = trim($_POST["pays"]);
  }
  if (empty($_POST["ville"])) {
    $error_ville = "<label class='text-danger'>Veuiller indiquer votre ville</label>";
  } else {
    $ville = trim($_POST["ville"]);
  }
  if (empty($_POST["code_postal"])) {
    $error_code_postal = "<label class='text-danger'>Veuiller indiquer votre code postal</label>";
  } else {
    $code_postal = trim($_POST["code_postal"]);
  }

  //ici on va vérifier si tous les erreurs sont null.  
  if (
    $error_code == '' && $error_date == '' && $error_presence == ''
    && $error_civilité == ''
    && $error_prénom == '' && $error_nom == ''
    && $error_email == '' && $error_telephone == ''
    && $error_societe == '' && $error_fonction == ''
    && $error_adresse == ''  && $error_pays == ''
    && $error_ville == '' && $error_code_postal == ''
  ) {
    //ici on va stocker les valeurs input dans des variables.
    $code = stripslashes($_REQUEST["code"]);
    $code = mysqli_real_escape_string($con, $code);
    $date = $_REQUEST['date'];
    $presence = $_REQUEST['presence'];
    $format = $_REQUEST['format'];
    $civilité = $_REQUEST['civilité'];
    $prénom = stripslashes($_REQUEST['prénom']);
    $prénom = mysqli_real_escape_string($con, $prénom);
    $nom = stripslashes($_REQUEST['nom']);
    $nom = mysqli_real_escape_string($con, $nom);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = stripslashes($_REQUEST['telephone']);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $societe = stripslashes($_REQUEST['societe']);
    $societe = mysqli_real_escape_string($con, $societe);
    $fonction = stripslashes($_REQUEST['fonction']);
    $fonction = mysqli_real_escape_string($con, $fonction);
    $fiscal = stripslashes($_REQUEST['fiscal']);
    $fiscal = mysqli_real_escape_string($con, $fiscal);
    $rne = $_FILES['rne']['name'];
    $destination = 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\uploads/' .$rne;
    $extension = pathinfo($rne, PATHINFO_EXTENSION);
    $file = $_FILES['rne']['tmp_name'];
    $size = $_FILES['rne']['size'];
    $adresse = stripslashes($_REQUEST['adresse']);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $ville = stripslashes($_REQUEST['ville']);
    $ville = mysqli_real_escape_string($con, $ville);
    $code_postal = stripslashes($_REQUEST['code_postal']);
    $code_postal = mysqli_real_escape_string($con, $code_postal);
    $pays = stripslashes($_REQUEST['pays']);
    $pays = mysqli_real_escape_string($con, $pays); 
    
    $create_datetime = date("Y-m-d H:i:s");
    if(move_uploaded_file($file, $destination)){
      $query = "INSERT into `inscription_personne_morale` (code,date,presence,format,civilité,prénom,
        nom,matricule_fiscale,rne,size,email,telephone,societe,fonction,adresse,ville,code_postal,pays,approuvement, create_datetime)
      VALUES ( '$code','$date', '$presence','$format',
        '$civilité','$prénom','$nom','$fiscal','$rne','$size','$email',
        '$telephone', '$societe','$fonction','$adresse',
        '$ville','$code_postal','$pays','off',
        '$create_datetime')";
      $result   = mysqli_query($con, $query);
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
          $mail->Subject = "Confirmation d'inscription";
          $mail->IsHTML(true);
          $mail->Body = "Bienvenue";
          if ($mail->Send()) {
            header(
              "Location: http://localhost/brnsmart/confirmation_inscriptiton/"
            );
          }
        }
      }
    }
  }
}
?>
<style>
  <?php include "css/clone.css"; ?>
</style>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="container">
    <img class="image" src="https://img.freepik.com/free-photo/close-up-hand-writing-notebook-top-view_23-2148888824.jpg" />
    <div>
      <img src="https://free3dicon.com/wp-content/uploads/2022/04/master-300x300.png.webp" class="education" style="float:left;">
      <h2 style="margin-top: 52px; margin-left: 100px; position: absolute;">Votre Formation</h2>
    </div>
    <form method="POST" action="" style="margin-top: 150px"  enctype="multipart/form-data"> 
      <select class="sel" name="code" id="code">
        <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
        <?php 
        $sql = "Select * from liste_formation";
        $result = mysqli_query($con,$sql);
        $num = mysqli_num_rows($result);
        if($result){
          if ($num>0){
            while($row=mysqli_fetch_assoc($result)) {
              ?>
              <option value="<?php echo $row["id_formation"]; ?>"><?php echo $row["code_formation"]; ?></option>
              <?php 
            }}}
            ?>
          </select>
          <?php echo $error_code; ?>
          <br>
          <br>
          <div>
            <select name="date" id="show">
              <option value="13/04/2022" disabled selected hidden>Veuiller choisir une date</option>
            </select>
          </div>
          <?php echo $error_date; ?>
          <br>
          <br>

          <input type="radio" value="pre" name="presence"> <label class="label">En présentiel</label>
          <input type="radio" value="dis" name="presence" class="distance"><label class="label">A distance</label>


          <br>
          <br>
          <div class="pre ss">
            <label>
              Choisir une format:
            </label><br><br>
            <label>
              <input type="checkbox" class="radios" value="Inter" name="format" /><label class="label">Inter</label> </label>
              <label>
                <input type="checkbox" class="dis" value="Intra" name="format" /><label class="label">Intra</label> </label>

              </div>
              <div>
                <?php echo $error_presence; ?>
                <h2 class="coordonne"> Vos coordonées :</h2>
              </div><br>
              <div>
                <input type="radio" value="Madame" name="civilité"><label class="label">Madame</label>
                <input type="radio" value="Monsieur" name="civilité" class="distances"><label class="label">Monsieur</label>
              </div>
              <?php echo $error_civilité; ?>
              <br>
              <br>
              <div class="two-col">
                <div class="col1">
                  <label for="field1"> Prénom :</label>
                  <input type="text" name="prénom" placeholder="Entrer votre prénom" autocomplete="off" />
                  <?php echo $error_prénom; ?>

                </div>
                <div class="col2">
                  <label for="field2"> Nom :</label>
                  <input type="text" name="nom" placeholder="Entrer votre nom" />
                  <?php echo $error_nom; ?>
                </div>
              </div>
              <br><br>

              <div class="two-col">
                <div class="col1">
                  <label for="field1"> Email :</label>
                  <input type="email" name="email" placeholder="Entrer votre email" />
                  <?php echo $error_email; ?>
                </div>
                <div class="col2">
                  <label for="field2"> Téléphone :</label>
                  <input type="tel" name="telephone" placeholder="Entrer votre Téléphone" maxlength="8" />
                  <!-- on utilise echo ici pour afficher le message d'erreur de telephone-->
                  <?php echo $error_telephone; ?>
                </div>
              </div>
              <br><br>
              <div class="two-col">
                <div class="col1">
                  <label for="field1"> Societe :</label>
                  <input type="text" name="societe" placeholder="Entrer votre societe" />
                  <!-- on utilise echo ici pour afficher le message d'erreur de mail-->
                  <?php echo $error_societe; ?>
                </div>
                <div class="col2">
                  <label for="field2"> fonction :</label>
                  <input type="text" name="fonction" placeholder="Entrer votre fonction" />
                  <!-- on utilise echo ici pour afficher le message d'erreur de telephone-->
                  <?php echo $error_fonction; ?>
                </div>
              </div>
              <br><br>
              <div class="two-col">
                <div class="col1">
                  <label for="field1"> Matricule fiscale :</label>
                  <input type="text" name="fiscal" placeholder="Entrer votre numéro fiscal " />
                </div>
                <div class="col2">
                  <label for="field2"> RNE :</label>
                  <input type="file" name="rne" />
                </div>
              </div>
              <br><br>
              <div>
                <label> Adresse :</label>
              </div>
              <textarea cols="100" rows="5" name="adresse" placeholder="entrer votre adresse" autocomplete="qqfv">
              </textarea>
              <div>
                <!-- on utilise echo ici pour afficher le message d'erreur d'adresse -->
                <?php echo $error_adresse; ?>
              </div>
              <br><br>
              <div> <label>Pays :</label> </div>
              <div class="in">
                <input type="text" placeholder="Enter votre pays" name="pays" autocomplete="azef">
              </div>
              <!-- on utilise echo ici pour afficher le message d'erreur de pays -->
              <?php echo $error_pays; ?>
              <br><br>
              <div class="two-col">
                <div class="col1">
                  <label for="field1"> Ville :</label>
                  <input type="text" name="ville" placeholder="Entrer votre ville" />
                  <!-- on utilise echo ici pour afficher le message d'erreur de ville-->
                  <?php echo $error_ville; ?>
                </div>
                <div class="col2">
                  <label> Code Postal :</label>
                  <input type="number" name="code postal" placeholder="Entrer votre code postal" />
                  <!-- on utilise echo ici pour afficher le message d'erreur de code-postal -->
                  <?php echo $error_code_postal; ?>
                </div>
              </div>
              <br>
              <br>
              <h2> Administratif</h2>

              <div class="contains" style="margin-left: -40px ;">
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
                                <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">
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
              <div>
                <button type="submit" class="registerbtn" name="save_multiple_data">Envoyer ma demande</button>
              </div>
            </form>
          </div>
          <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
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
          <!-- choose only one check -->
          <script type="text/javascript">
            $("input:checkbox").on('click', function() {

              var $box = $(this);
              if ($box.is(":checked")) {

                var group = "input:checkbox[name='" + $box.attr("name") + "']";

                $(group).prop("checked", false);
                $box.prop("checked", true);
              }
            });
          </script>
          <script type="text/javascript">
            $(document).ready(function() {
              $('input[type="radio" ]').click(function() {
                var inputValue = $(this).attr("value");
                var target = $("." + inputValue);
                $(target).show();
              });
            });
          </script>
          <script>
            if ( window.history.replaceState ) {
              window.history.replaceState( null, null, window.location.href );
            }
          </script>
        </body>

        </html>
        <!-- on utilise get_footer() pour afficher ici le footer de notre thème wordpress -->
        <?php get_footer();
