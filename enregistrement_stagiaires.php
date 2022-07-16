<?php
/* Template Name: enregistrement_stagiaires Page */
get_header(); 

?>
<?php
include 'db.php';
include 'include/functions.php';
include 'include/Session.php';
//errors
$msg = '';
$error_prenom = '';
$error_nom = '';
$error_email = '';
$error_telephone = '';
$error_adresse = '';
$error_pays = '';
$error_ville = '';
$error_civilité = '';
$error_code_postal = '';
$error_mot_de_passe = '';
$error_confirm_mot_de_passe = '';
$error_length = '';


if(isset($_REQUEST['register'])){

  if(empty($_POST["prenom"]))
  {
    $error_prenom = "<label class='text-danger'>Veuiller indiquer votre prénom</label>";
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
  else 
  {
    $telephone = trim($_POST["telephone"]);
  }
  if(empty($_POST["civilité"]))
  {
    $error_civilité = "<label class='text-danger'>Veuiller indiquer votre civilité</label>";
  }
  else 
  {
    $civilité = trim($_POST["civilité"]);
  }
  if(!strlen(trim($_POST["adresse"])))
  {
    $error_adresse = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
  }
  else 
  {
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
  if(empty($_POST["mot_de_passe"]))
  {
    $error_mot_de_passe = "<label class='text-danger'>Veuiller indiquer votre mot de passe</label>";
  }
  else 
  {
    $mot_de_passe = trim($_POST["mot_de_passe"]);
  }
  if (trim($_POST['mot_de_passe']) !== trim($_POST['confirm_mot_de_passe'])) {
    $error_confirm_mot_de_passe = "<label class='text-danger'>Veuiller confirmer les mots de passe</label>";
  }
  if (strlen($mot_de_passe) < 6) {
    $error_length = "<label class='text-danger'>mot de passe doit contenir au moins 6 characters</label>";
  }  


  if ($error_prenom == '' && $error_nom == ''
    && $error_email == '' && $error_adresse == '' && $error_civilité == ''
    && $error_telephone == '' && $error_pays == '' && $error_ville == ''
    && $error_code_postal == '' && $error_mot_de_passe == '' 
    && $error_confirm_mot_de_passe == '' && $error_length == ''
  )
  {

    $prenom = stripslashes($_REQUEST["prenom"]);
    $prenom = mysqli_real_escape_string($con, $prenom);
    $nom = stripslashes($_REQUEST["nom"]);
    $nom = mysqli_real_escape_string($con, $nom);
    $email = stripslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telephone = stripslashes($_REQUEST["telephone"]);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $adresse = stripslashes($_REQUEST["adresse"]);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $pays = stripslashes($_REQUEST["pays"]);
    $pays = mysqli_real_escape_string($con, $_POST['pays']);
    $civilité = stripslashes($_REQUEST["civilité"]);
    $civilité = mysqli_real_escape_string($con, $_POST['civilité']);
    $ville = stripslashes($_REQUEST["ville"]);
    $ville = mysqli_real_escape_string($con, $ville);
    $typepiece = stripslashes($_REQUEST["typepiece"]);
    $typepiece = mysqli_real_escape_string($con, $typepiece);
    $numpiece = stripslashes($_REQUEST["numpiece"]);
    $numpiece = mysqli_real_escape_string($con, $numpiece);
    $code_postal = stripslashes($_REQUEST["code_postal"]);
    $code_postal = mysqli_real_escape_string($con, $code_postal);
    $mot_de_passe = stripslashes($_REQUEST["mot_de_passe"]);
    $mot_de_passe = mysqli_real_escape_string($con,$_POST['mot_de_passe']);
//ce variable utilisé pour lien envoyé au email pour l'activation
    $Token = bin2hex(openssl_random_pseudo_bytes(40));
    $create_datetime = date("Y-m-d H:i:s");
    $rand = rand(1,2);
    if($rand == 1){
      $profile_pic = 'https://atformation.fr/wp-content/uploads/2021/09/at-formation-avis.png';
    }elseif($rand == 2){
      $profile_pic = 'https://cdn.icon-icons.com/icons2/1879/PNG/512/iconfinder-8-avatar-2754583_120515.png';
    }
    if(!EmailExisteInscriptionStagiaire($email)){

      $msg = "<label class='text-danger'>Email n'existe pas !!!</label>";

    } elseif(EmailExisteStagiaire($email)) {

     $msg = "<label class='text-danger'>Email existe !!!</label>";

   } else {
    $Hashed_Password = Password_Encryption($mot_de_passe);
    $query = "INSERT into `enregistrement_stagiaires` (image,prenom,nom,typepiece,numpiece,email,telephone,civilité,adresse,pays,ville,code_postal,
      mot_de_passe,token,active, create_datetime)
    VALUES ('$profile_pic','$prenom','$nom','$typepiece','$numpiece','$email',
      '$telephone', '$civilité', '$adresse',
      '$pays','$ville', '$code_postal',
      '$Hashed_Password',
      '$Token','OFF',
      '$create_datetime'
    )";
    $result = mysqli_query($con, $query);
    //supprimer session variables
    $_SESSION['prenom']="";
    $_SESSION['nom']="";
    $_SESSION['email']="";
    $_SESSION['telephone']="";
    $_SESSION['civilité']="";
    $_SESSION['adresse']="";
    $_SESSION['pays']="";
    $_SESSION['ville']="";
    $_SESSION['code_postal']="";
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
      $mail->Body = 'Bonjour ' .$prenom. ' vous trouverez ici le lien pour activer votre compte http://localhost/brnsmart/activation_stagiaires?token=' .$Token;
      if ($mail->Send()) {
        $_SESSION['message'] = "Vérifier votre email pour l'activation";
        header(
          "Location: http://localhost/brnsmart/connexion_stagiaires"
        );
      }
    }
  }

}   

}

?>
<style>
  <?php include "css/enregistrementstagiaires.css"; ?>
</style>
<!DOCTYPE html>
<html>
<head>
  <?php include 'components/head.html' ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <img class="image" src="https://img.freepik.com/free-photo/close-up-hand-writing-notebook-top-view_23-2148888824.jpg"/>
    <div class="signup-form">
      <div style="text-align: center; margin-top: 180px;">
        <h1>BRNSMART TRAINING CENTER</h1>
        <h2>Enregistrement</h2>
      </div>
    </div>
    <hr>
    <?php echo $msg; ?>
    <form action="#" method="POST" role="form">

     <br>
     <br>
     <div class="two-col">
      <div class="col1"> 
        <label for="field1"> Prénom :</label>  
        <input type="text" name="prenom" placeholder= "Entrer votre prénom" autocomplete="dgdfgdfg"/>
        <?php echo $error_prenom; ?> 
      </div> 
      <!-- on utilise echo ici pour afficher le message d'erreur de prénom-->

      <div class="col2">
        <label for="field2"> Nom :</label>   
        <input type="text" name="nom" placeholder="Entrer votre nom" autocomplete="vvdvdv" />
        <?php echo $error_nom; ?>
      </div>
    </div>

    <br><br> 

    <div class="two-col">
      <div class="col1">
        <label for="field1"> Type pièce d'identité :</label>
        <select name="typepiece" class="selcs">
          <option value="" disabled selected hidden>Veuiller choisir un type</option>
          <option value="CIN">CIN</option>
          <option value="Passport">Passport</option>
          <option value="Permis">Permis</option>
          <option value="Carte de séjour">Carte de séjour</option>
        </select>
      </div>
      <!-- on utilise echo ici pour afficher le message d'erreur de prénom-->

      <div class="col2">
        <label for="field2"> Num.Pièce d'identité :</label>
        <input type="number" name="numpiece" placeholder="Entrer le numero de votre pièce d'identité" autocomplete="vvdvdv" />
      </div>
    </div>

    <br>
    <br>
    <div class="two-col">
      <div class="col1"> 
        <label for="field1"> Email :</label>  
        <input type="email" name="email" placeholder= "Entrer votre email" autocomplete="dgdfgdfg"/>
        <?php echo $error_email; ?> 
      </div> 
      <!-- on utilise echo ici pour afficher le message d'erreur de prénom-->

      <div class="col2">
        <label for="field2"> Telephone :</label>   
        <input type="tel" maxlength="8" name="telephone" placeholder="Entrer votre sexe" autocomplete="vvdvdv" />
        <?php echo $error_telephone; ?>
      </div>
    </div>
    <br><br> 
    <label> Civilité :</label>
    <div>
      <select name="civilité" class="in">
        <option value="" disabled selected hidden>Veuiller choisir votre civilité</option>
        <option value="Madame">Madame</option>
        <option value="Monsieur">Monsieur</option>
      </select>
      <?php echo $error_civilité; ?>
    </div>
    <br><br>
    <label> Adresse :</label>
    <div>
      <textarea cols="100" rows="5"value="adresse" name="adresse" 
      placeholder="entrer votre adresse" autocomplete="qqfv"> 
    </textarea>
  </div>
  <!-- on utilise echo ici pour afficher le message d'erreur d'adresse -->
  <?php echo $error_adresse; ?>
  <br><br>
  <label> Pays :</label>
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
      <?php echo $error_code_postal; ?>
    </div>
  </div>

  <br>
  <br>
  <div class="two-col">
    <div class="col1"> 
      <label for="password"> Mot de passe :</label>  
      <input type="password" name="mot_de_passe" placeholder= "Entrer votre mot de passe" autocomplete="dgdfgdfg" id="pass1"/>
      <?php echo $error_mot_de_passe; ?> 
    </div> 
    <!-- on utilise echo ici pour afficher le message d'erreur de prénom-->

    <div class="col2">
      <label for="field2"> Confirmer mot de passe :</label>   
      <input type="password" name="confirm_mot_de_passe" placeholder="Valider votre mot de passe" id="pass2" onkeyup="checkPass(); return false;" autocomplete="vvdvdv" />
      <?php echo $error_confirm_mot_de_passe; ?>
    </div>
    <span id="confirmMessage" class="confirmMessage"></span>
  </div>

  <br><br> 
  <button type="submit" formmethod="post" class="registerbtns" name="register">Envoyer ma demande</button>   
</form>
</div>
</body>
<script type="text/javascript">
  function checkPass() {
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    var message = document.getElementById('confirmMessage');
    var green = "#bdffbd";
    var red = "#c46a6a";
    if (pass1.value == pass2.value) {
      pass2.style.backgroundColor = green;
      message.style.color = '#178511';
      message.innerHTML = "Passwords match."
    } else {
      pass2.style.backgroundColor = red;
      message.style.color = '#85112e';
      message.innerHTML = "Passwords do not match!"
    }
  }
</script>
<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>

</html>
<?php get_footer();