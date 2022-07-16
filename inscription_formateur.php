<?php

/* Template Name: Inscription_formateur Page */

// on utilise get_header() pour afficher ici le footer de notre thème wordpress
get_header();
require 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\include/db.php';
?>

<?php
$error_prenom = '';
$error_nom = '';
$error_email = '';
$error_telephone = '';
$error_cv = '';
$error_experience = '';
$error_formation = '';
$error_tarif = '';
$error_nbr_jour = '';
$error_message = '';

//variables
$prenom = '';
$nom = '';
$email = '';
$telephone = '';
$cv = '';
$experience = '';
$formation = '';
$tarif = '';
$nbr_jour = '';
$message = '';
const UploadKey = 'cv';
if (isset($_REQUEST['register']))
{

  if(empty($_POST["prenom"]))
  {
    $error_prenom = "<label class='text-danger'>Veuiller indiquer votre prenom</label>";
  }
  else 
  {

    $prenom = trim($_POST["prenom"]);
  }
  if(empty($_POST["nom"]))
  {
    $error_nom = "<label class='text-danger'>Veuiller indiquer votre nom</label>";
  }
  else 
  {
    $nom = trim($_POST["nom"]);
  }
  if(empty($_POST["email"]))
  {
    $error_email = "<label class='text-danger'>Veuiller entrer votre email</label>";
  }
  else 
  {
    $email = trim($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_email = "<label class='text-danger'>entrer email valid</label>";
    }
  }
  if(empty($_POST["telephone"]))
  {
    $error_telephone = "<label class='text-danger'>Veuiller indiquer votre telephone</label>";
  }
  if(empty($_FILES[UploadKey]['type']))
  {
    $error_cv = "<label class='text-danger'>Veuiller indiquer votre cv</label>";
  }

  if(!strlen(trim($_POST["experience"])))
  {
    $error_experience = "<label class='text-danger'>Veuiller indiquer votre experience</label>";
  }
  if(empty($_POST["formation"]))
  {
    $error_formation = "<label class='text-danger'>Veuiller indiquer votre formation</label>";
  }
  if(empty($_POST["tarif"]))
  {
    $error_tarif = "<label class='text-danger'>Veuiller indiquer votre tarif</label>";
  }
  else 
  {
    $tarif = trim($_POST["tarif"]);
  }
  if(empty($_POST["nbr_jour"]))
  {
    $error_nbr_jour = "<label class='text-danger'>Veuiller indiquer votre nbr de jours</label>";
  }
  else 
  {
    $nbr_jour = trim($_POST["nbr_jour"]);
  }
  if(!strlen(trim($_POST["message"])))
  {
    $error_message = "<label class='text-danger'>Veuiller indiquer votre message</label>";
  }
  else 
  {
    $message = trim($_POST["message"]);
  }

  if ($error_prenom == '' && $error_nom == ''
    && $error_email == '' && $error_telephone == ''
    && $error_cv == '' && $error_experience == '' 
    && $error_formation == ''
    && $error_tarif == '' && $error_nbr_jour == ''
    && $error_message == ''
  )
  {

    $prenom = stripslashes($_REQUEST['prenom']);

    $prenom = mysqli_real_escape_string($con, $prenom);
    $nom = stripslashes($_REQUEST['nom']);
    $nom = mysqli_real_escape_string($con, $nom);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = stripslashes($_REQUEST['telephone']);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $cv = $_FILES['cv']['name'];
    $destination = 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\uploads/' .$cv;
    $extension = pathinfo($cv, PATHINFO_EXTENSION);
    $file = $_FILES['cv']['tmp_name'];
    $size = $_FILES['cv']['size'];
    $experience = stripslashes($_REQUEST['experience']);
    $experience = mysqli_real_escape_string($con, $experience);
    $formation = $_REQUEST['formation'];
    $formation = mysqli_real_escape_string($con,$formation);
    $tarif = stripslashes($_REQUEST['tarif']);
    $tarif = mysqli_real_escape_string($con,$tarif);
    $nbr_jour = stripslashes($_REQUEST['nbr_jour']);
    $nbr_jour = mysqli_real_escape_string($con,$nbr_jour);
    $message = stripslashes($_REQUEST['message']);
    $message = mysqli_real_escape_string($con,$message);

    $create_datetime = date("Y-m-d H:i:s");

    if(move_uploaded_file($file, $destination)){
      $query    = "INSERT into 
      `inscription_formateur` (prenom,nom,email,telephone,cv,size,experience,formation,tarif,nbr_jour,message,create_datetime)
      VALUES ( 
        '$prenom','$nom',
        '$email','$telephone','$cv','$size',  
        '$experience',
        '$formation',
        '$tarif','$nbr_jour',
        '$message',
        '$create_datetime')";

      $result   = mysqli_query($con, $query);

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
        $mail->Subject = "Confirmation d'inscription";
        $mail->IsHTML(true);
        $mail->Body = "Bienvenue";

        if ($mail->Send()) {
          header ("Location: http://localhost/brnsmart/confirmation_inscriptiton/");
        }
        
      }
    } 
  }
};

?>
<style>
  <?php include 'css/formateur.css'; ?>
</style>



<!DOCTYPE html>  
<html>  
<head> 
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/lib/w3.css">
</head>  
<body> 
  <div class="container">
    <label>

      <img class="image" src="https://img.freepik.com/free-photo/close-up-hand-writing-notebook-top-view_23-2148888824.jpg"/>
      <form method="POST" action="" enctype="multipart/form-data"> <br>   
        <h2 class="coordonne" style="margin-top: 150px"> Vos coordonées :</h2>
        <br>
        <div class="two-col">
          <div class="col1"> 
            <label for="field1"> Prénom :</label>  
            <input type="text" name="prenom" placeholder= "Entrer votre prénom" autocomplete="dgdfgdfg"/>
            <?php echo $error_prenom; ?> 
          </div> 

          <div class="col2">
            <label for="field2"> Nom :</label>   
            <input type="text" name="nom" placeholder="Entrer votre nom" autocomplete="vvdvdv" />
            <?php echo $error_nom; ?>
          </div>
        </div>

        <br><br>    

        <div class="two-col">  
          <div class="col1">
            <label for="field1"> Email :</label>   
            <input type="email" name="email" placeholder= "Entrer votre email" autocomplete="fvdfv"/>
            <?php echo $error_email; ?>
          </div>
          <div class="col2">
            <label for="field2"> Téléphone :</label>   
            <input type="tel" name="telephone" placeholder="Entrer votre Téléphone" autocomplete="vvdfdfnhv"   maxlength="8"/>
            <?php echo $error_telephone; ?> 
          </div>
        </div>
        <br><br>
        <div>
          <label>CV</label> <br>  
          <input type="file" name="cv" accept=".pdf" />
        </div>
        <?php echo $error_cv; ?>
        <br><br><br>
        <div>
          <label>Experience</label> <br>
          <textarea cols="80" rows="5" placeholder="indiquer votre Experience" value="adresse_particulier" name="experience">  
          </textarea> 
          <?php echo $error_experience; ?>
        </div><br><br>
        Votre référence en matière de formation professionnelle
        <div>
          <select  name="formation" >
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
              <?php echo $error_formation; ?>
            </div><br><br>
            <div class="two-col">  
              <div class="col1">
                <label for="field1"> Tarif :</label>   
                <input type="number" name="tarif" placeholder= "Entrer votre tarif" autocomplete="fvdfv"/>
                <?php echo $error_tarif; ?>
              </div>
              <div class="col2">
                <label for="field2"> Nombre de jours par mois :</label>   
                <input type="number" name="nbr_jour" placeholder="Entrer votre nombre des jours de travail" autocomplete="vvdfdfnhv"   maxlength="8"/>
                <?php echo $error_nbr_jour; ?> 
              </div>
            </div><br><br>
            Indiquez ici votre/vos certification(s), votre message ou autres informations pertinentes
            <div>
              <textarea cols="80" rows="5" placeholder="enter votre message" value="adresse_particulier" name="message">  
              </textarea>
              <?php echo $error_message; ?>
            </div><br>
            <button type="submit" formmethod="post" class="registerbtns" name="register">Envoyer ma demande</button>   
          </form>  
        </div>
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
          $(document).ready(function(){
            $("select").change(function(){
              $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                  $(".boxx").not("." + optionValue).hide();
                  $("." + optionValue).show();
                } else{
                  $(".boxx").hide();
                }
              });
            }).change();
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function () {
            $('input[type="radio"]').click(function () {
              var inputValue = $(this).attr("value");
              var target = $("." + inputValue);
              $(".sss").not(target).hide();
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
      <?php get_footer();