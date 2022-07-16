<?php
/* Template Name: Inscription Stagiaires Page */

// on utilise get_header() pour afficher ici le footer de notre thème wordpress
get_header();
session_start();
require "db.php";
?>
<?php
//appel au fichier de configuration de connexion au base des données.
require "db.php";
require "include/functions.php";
require "include/Session.php";

//initialisation des erreurs
$message = '';
$error_date = '';
$error_code = '';
$error_presence = '';
$error_civilité = '';
$error_prénom = '';
$error_nom = '';
$error_email = '';
$error_telephone = '';
$error_adresse = '';
$error_ville = '';
$error_postal = '';
$error_pays = '';


if (isset($_REQUEST["register"])) {
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
  //ici, on utilise la fonction trim() pour supprimer les espaces blancs au début et à la fin.
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
    //Filter_validate_int est utilisé pour valider la variable passant en paramètre, ici "$telephone" en tant qu’entier. 
    if (!filter_var($telephone, FILTER_VALIDATE_INT)) {
      $error_telephone = "<label class='text-danger'>entrer valid phone</label>";
    }
  }
  //strlen() est une fonction qui renvoie la longueur d'une string donnée, ici l'adresse.
  if (!strlen(trim($_POST["adresse"]))) {
    $error_adresse = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
  } else {
    $adresse = trim($_POST["adresse"]);
  }
  if (empty($_POST["ville"])) {
    $error_ville = "<label class='text-danger'>Veuiller indiquer votre ville</label>";
  } else {
    $ville = trim($_POST["ville"]);
  }
  if (empty($_POST["code_postal"])) {
    $error_postal = "<label class='text-danger'>Veuiller indiquer votre code postal</label>";
  } else {
    $code_postal = trim($_POST["code_postal"]);
  }
  if (empty($_POST["pays"])) {
    $error_pays = "<label class='text-danger'>Veuiller indiquer votre pays</label>";
  } else {
    $pays = trim($_POST["pays"]);
  }
  //ici on va vérifier si tous les erreurs sont null.
  if (
    $error_code == '' && $error_date == '' && $error_presence == ''
    && $error_civilité == ''
    && $error_prénom == '' && $error_nom == ''
    && $error_email == '' && $error_telephone == ''
    && $error_adresse == '' && $error_ville == ''
    && $error_postal == '' && $error_pays == ''
  ) {
    //ici on va stocker les valeurs input dans des variables.
    $code = stripslashes($_REQUEST["code"]);
    $code = mysqli_real_escape_string($con, $code);
    $date = $_REQUEST["date"];
    $presence = $_REQUEST["presence"];
    $format = $_REQUEST["format"];
    $civilité = $_REQUEST["civilité"];
    $prénom = stripslashes($_REQUEST["prénom"]);
    $prénom = mysqli_real_escape_string($con, $prénom);
    $nom = stripslashes($_REQUEST["nom"]);
    $nom = mysqli_real_escape_string($con, $nom);
    $email = stripslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = stripslashes($_REQUEST["telephone"]);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $adresse = stripslashes($_REQUEST["adresse"]);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $ville = stripslashes($_REQUEST["ville"]);
    $ville = mysqli_real_escape_string($con, $ville);
    $code_postal = stripslashes($_REQUEST["code_postal"]);
    $code_postal = mysqli_real_escape_string($con, $code_postal);
    $pays = stripslashes($_REQUEST["pays"]);
    $pays = mysqli_real_escape_string($con, $pays);
    $create_datetime = date("Y-m-d H:i:s");
    $query = "INSERT into `inscription_stagiaires`(code,date,presence,format,civilité,prénom,nom,email,telephone,adresse,ville,code_postal,pays,approuvement, create_datetime)
    VALUES ('$code','$date','$presence','$format',
      '$civilité','$prénom','$nom','$email',
      '$telephone', '$adresse',
      '$ville','$code_postal','$pays','Off',
      '$create_datetime')";
    




    $query1 = "INSERT into `inscription` (email_stagiaire,code_formation,create_datetime)
    VALUES ( '$email','$code','$create_datetime')";

    $query2 = "INSERT into `session` (code_formation,date,create_datetime)
    VALUES ( '$code','$date','$create_datetime')";      
    $result = mysqli_query($con, $query);
    $result1 = mysqli_query($con, $query1);
    $result2 = mysqli_query($con, $query2);
    if ($result) {
      require_once "phpmailer/PHPMailerAutoload.php";
      //ici, mail est un objet phpmailer
      $mail = new PHPMailer();

      //smtp configuration
      $mail->CharSet = "utf-8"; //codage de caractères.
      $mail->IsSMTP(); //
      $mail->SMTPAuth = true;
      $mail->Username = "ddev7546@gmail.com";
      $mail->Password = "cioeujqppsynnpol";
      $mail->SMTPSecure = "ssl";
      $mail->Host = "smtp.gmail.com";
      $mail->Port = "465";

      //email configuration
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

?>
<style>
  <?php include "css/styles.css"; ?>
</style>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <!--ici, on va intégrer bootstrap et jquery dans notre code -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="container">
    <label>
      <div>
        <img class="image" src="https://img.freepik.com/free-photo/close-up-hand-writing-notebook-top-view_23-2148888824.jpg" />
        <form method="POST" action="">
          <div>
            <img src="https://cdn.icon-icons.com/icons2/2958/PNG/512/education_hat_graduation_graduate_cap_university_student_icon_185931.png" class="education" style="float:left;">
            <h2 style="margin-top: 52px; margin-left: 80px; position: absolute;">Votre Formation</h2>
          </div>
        </div>

      </label>
      <select class="sel"  id="code" name="code" >
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
          <!-- on utilise echo ici pour afficher le message d'erreur de data-->
          <?php echo $error_code; ?>
          <br>
          <br>
        </label>
        <select class="sel" name="date" id="show">
          <option value="" disabled selected hidden>Veuiller choisir une date</option>
        </select>
        <!-- on utilise echo ici pour afficher le message d'erreur de data-->
        <?php echo $error_date; ?>
        <br>
        <br>
        <input type="radio" value="pre" name="presence"> <label class="label">En présentiel</label>
        <input type="radio" value="dis" name="presence" class="distance"><label class="label">A distance</label>
        <!-- on utilise echo ici pour afficher le message d'erreur de presence-->
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
            <?php echo $error_presence; ?>
            <div>
              <h2 class="coordonne"> Vos coordonées :</h2>
            </div>
            <div>
              <input type="radio" value="Madame" name="civilité"><label class="label">Madame</label>
              <input type="radio" value="Monsieur" name="civilité" class="distances"><label class="label">Monsieur</label>
            </div>
            <!-- on utilise echo ici pour afficher le message d'erreur de civilité-->
            <?php echo $error_civilité; ?>
            <br>
            <br>

            
            <div class="two-col">
              <div class="col1">
                <label for="field1"> Prénom :</label>
                <input type="text" name="prénom" placeholder="Entrer votre prénom" autocomplete="dgdfgdfg" />
                <?php echo $error_prénom; ?>
              </div>
              <!-- on utilise echo ici pour afficher le message d'erreur de prénom-->

              <div class="col2">
                <label for="field2"> Nom :</label>
                <input type="text" name="nom" placeholder="Entrer votre nom" autocomplete="vvdvdv" />
                <?php echo $error_nom; ?>
              </div>
            </div>

            <br><br>
            <!-- on utilise echo ici pour afficher le message d'erreur de nom-->

            <div class="two-col">
              <div class="col1">
                <label for="field1"> Email :</label>
                <input type="email" name="email" placeholder="Entrer votre email" autocomplete="fvdfv" />
                <!-- on utilise echo ici pour afficher le message d'erreur de mail-->
                <?php echo $error_email; ?>
              </div>
              <div class="col2">
                <label for="field2"> Téléphone :</label>
                <input type="tel" name="telephone" placeholder="Entrer votre Téléphone" autocomplete="vvdfdfnhv" maxlength="8" />
                <!-- on utilise echo ici pour afficher le message d'erreur de telephone-->
                <?php echo $error_telephone; ?>
              </div>
            </div>
            <br><br>
            <div>
              <label> Adresse :</label>
            </div>
            <textarea cols="100" rows="5" value="adresse" name="adresse" placeholder="entrer votre adresse" autocomplete="qqfv">
            </textarea>
            <!-- on utilise echo ici pour afficher le message d'erreur d'adresse -->
            <?php echo $error_adresse; ?>
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
                <input type="text" name="ville" placeholder="Entrer votre ville" autocomplete="off" />
                <!-- on utilise echo ici pour afficher le message d'erreur de ville-->
                <?php echo $error_ville; ?>
              </div>
              <div class="col2">
                <label> Code Postal :</label>
                <input type="number" name="code postal" placeholder="Entrer votre code postal" autocomplete="off" />
                <!-- on utilise echo ici pour afficher le message d'erreur de code-postal -->
                <?php echo $error_postal; ?>
              </div>
            </div>
            <br>

            <button type="submit" formmethod="post" class="registerbtn" name="register">Envoyer ma demande</button>

          </form>
        </div>
      </div>
    </div>  

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
        $('input[type="radio"]').click(function() {
          var inputValue = $(this).attr("value");
          var target = $("." + inputValue);
          $(target).show();
        });
      });
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
    <script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
    </script>
  </body>

  </html>
  <!-- on utilise get_footer() pour afficher ici le footer de notre thème wordpress -->
  <?php get_footer(); ?>