<?php
/* Template Name: enregistrement_personne_morale Page */
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
$error_utilisateur = '';
$error_civilité = '';
$error_email = '';
$error_telephone = '';
$error_societe = '';
$error_fonction = '';
$error_adresse = '';
$error_presentation = '';
$error_pays = '';
$error_ville = '';
$error_code_postal = '';
$error_mot_de_passe = '';
$error_confirm_mot_de_passe = '';
$error_length = '';


if(isset($_REQUEST['register'])){

    if(empty($_POST["prenom"]))
    {
        $error_prenom = "<label class='text-danger'>Veuiller indiquer votre nom d'utilisateur</label>";
    }
    else 
    {
        $prenom = trim($_POST["prenom"]);
    }

    if(empty($_POST["nom"]))
    {
        $error_nom = "<label class='text-danger'>Veuiller indiquer votre nom d'utilisateur</label>";
    }
    else 
    {
        $nom = trim($_POST["nom"]);
    }      

    if(empty($_POST["utilisateur"]))
    {
        $error_utilisateur = "<label class='text-danger'>Veuiller indiquer votre nom d'utilisateur</label>";
    }
    else 
    {
        $utilisateur = trim($_POST["utilisateur"]);
    }

    if(empty($_POST["civilité"]))
    {
        $error_civilité = "<label class='text-danger'>Veuiller indiquer votre nom d'utilisateur</label>";
    }
    else 
    {
        $civilité = trim($_POST["civilité"]);
    } 
    if(empty($_POST["email"]))
    {
        $error_email = "<label class='text-danger'>Veuiller indiquer votre email</label>";
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
    
    $error_telephone = "<label class='text-danger'>Veuiller entrer votre telephone</label>";
}
else 
{
    $telephone = trim($_POST["telephone"]);
}
if(empty($_POST["societe"]))
{
    $error_societe = "<label class='text-danger'>Veuiller indiquer votre societe</label>";
}
else 
{
    $societe = trim($_POST["societe"]);
}
if(empty($_POST["fonction"]))
{
    $error_fonction = "<label class='text-danger'>Veuiller indiquer votre fonction</label>";
}
else 
{
    $fonction = trim($_POST["fonction"]);
}
if(empty($_POST["adresse"]))
{
    $error_adresse = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
}
else 
{
    $adresse = trim($_POST["adresse"]);
}
if(!strlen(trim($_POST["presentation"])))
{
    $error_presentation = "<label class='text-danger'>Veuiller indiquer votre presentation</label>";
}
if(empty($_POST["pays"]))
{
    $error_pays = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
}
else 
{
    $pays = trim($_POST["pays"]);
}
if(empty($_POST["ville"]))
{
    $error_ville = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
}
else 
{
    $ville = trim($_POST["ville"]);
}
if(empty($_POST["code_postal"]))
{
    $error_code_postal = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
}
else 
{
    $code_postal = trim($_POST["code_postal"]);
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

if ($error_prenom == '' && $error_nom == '' && $error_utilisateur == '' && 
    $error_civilité == '' && $error_email == ''
    && $error_telephone == '' && $error_societe == ''
    && $error_fonction == '' && $error_adresse == '' && $error_presentation == '' 
    && $error_pays == '' && $error_ville == '' && $error_code_postal == ''
    && $error_mot_de_passe == ''
    && $error_confirm_mot_de_passe == '' && $error_length == ''
)
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
    $email = mysqli_real_escape_string($con, $_POST['email']);
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

  if(!EmailExisteInscriptionPersonneMorale($email)){

    $msg = "<label class='text-danger'>Email n'existe pas !!!</label>";

}
elseif(EmailExistePersonneMorale($email)){

    $msg = "<label class='text-danger'>Email existe !!!</label>";

}

elseif(UtilisateurExistePersonneMorale($utilisateur)) 

{

    $msg = "<label class='text-danger'>Nom d'utilisateur existe !!!</label>";

}
else {
    $Hashed_Password = Password_Encryption($mot_de_passe);
    $query = "INSERT into `enregistrement_personne_morale` (image,prenom,nom,utilisateur,civilité,email,telephone,societe,fonction,adresse,presentation,pays,ville,code_postal,
        mot_de_passe,token,active, create_datetime)
    VALUES ('$profile_pic','$prenom','$nom','$utilisateur','$civilité',
        '$email','$telephone',
        '$societe', '$fonction',
        '$adresse','$presentation',
        '$pays', '$ville',
        '$code_postal','$Hashed_Password',
        '$Token','OFF',
        '$create_datetime'
    )";
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
        $mail->Body = 'Bonjour ' .$utilisateur. ' vous trouverez ici le lien pour activer votre compte http://localhost/brnsmart/activation_personne_morale?token=' .$Token;
        if ($mail->Send()) {
            $_SESSION['message'] = "Vérifier votre email pour l'activation";
            header(
                "Location: http://localhost/brnsmart/connexion_personne_morale"
            );
        }
    }

}
}   
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'components/head.html' ?>
    <title>SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
    	.contains {
    		margin-top: 120px;
    	}

    </style>
</head>

<body>
    <div class="contains">
        <div class="container">

            <div class="signup-form">
                <div style="text-align: center;">
                    <h1>BRNSMART TRAINING CENTER</h1>
                    <h2>Enregistrement</h2>
                </div>
                <hr>
                <?php echo $msg; ?>
                <form action="#" method="POST" role="form">
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Prenom: </label>
                        <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom" />
                        <?php echo $error_prenom; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Nom: </label>
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="entrer votre nom" />
                        <?php echo $error_nom; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Nom d'utilisateur: </label>
                        <input class="form-control" type="text" name="utilisateur" id="prenom" placeholder="Entrer votre prenom" />
                        <?php echo $error_utilisateur; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Civilité: </label><br>
                        <input type="radio" value="Madame" name="civilité"><label class="label">Madame</label>
                        <input type="radio" value="Monsieur" name="civilité"><label class="label">Monsieur</label>
                        <?php echo $error_civilité; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Email: </label>
                        <input class="form-control" type="email" name="email" id="prenom" placeholder="entrer votre nom" />
                        <?php echo $error_email; ?>
                    </div>

                    <div class="form-group">
                        <label for="email"><span class="req"></span> Telephone: </label>
                        <input class="form-control" type="tel" name="telephone" id="email" placeholder="entrer votre email" maxlength="8"/>
                        <div class="status" id="status"></div>
                        <?php echo $error_telephone; ?>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Societe: </label>
                        <input class="form-control" type="text" name="societe" id="prenom" placeholder="entrer votre nom" />
                        <?php echo $error_societe; ?>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Fonction: </label>
                        <input class="form-control" type="text" name="fonction" id="adresse"  placeholder="entrer votre Adresse" />
                        <?php echo $error_fonction; ?>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Adresse: </label>
                        <input class="form-control" type="text" name="adresse" id="adresse"  placeholder="entrer votre Adresse" />
                        <?php echo $error_adresse; ?>
                    </div>
                    <div class="form-group">
                        <label><span class="req"></span> Presentation: </label>
                        <textarea cols="80" rows="5" name="presentation">  
                        </textarea>
                        <?php echo $error_presentation; ?>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="req"></span> Pays: </label>
                        <input class="form-control" type="text" name="pays" id="email" placeholder="entrer votre email" />
                        <div class="status" id="status"></div>
                        <?php echo $error_pays; ?>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Ville: </label>
                        <input class="form-control" type="text" name="ville" id="prenom" placeholder="entrer votre nom" />
                        <?php echo $error_ville; ?>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Code Postal: </label>
                        <input class="form-control" type="number" name="code_postal" id="adresse"  placeholder="entrer votre Adresse" />
                        <?php echo $error_code_postal; ?>
                    </div>
                    <div class="form-group">

                        <label for="password"><span class="req"></span> Mot de Passe: </label>
                        <input name="mot_de_passe" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass1" placeholder="Entrer votre mot de passe" /> 
                        <?php echo $error_length; ?>
                        <?php echo $error_mot_de_passe; ?>
                    </p>
                    
                    <label for="confirm_password"><span class="req"></span> Confirmer Mot de Passe: </label>
                    <input name="confirm_mot_de_passe" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Valider votre mot de passe" id="pass2" onkeyup="checkPass(); return false;" />
                    <?php echo $error_confirm_mot_de_passe; ?>
                    <span id="confirmMessage" class="confirmMessage"></span></p>
                </div>


                <div class="form-group">
                    <hr>
                    <input class="btn btn-success" type="submit" name="register" value="enregistrer" id="submit">
                </div>
            </form>
        </div>
    </div>
</div>
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

</body>
</html>
<?php get_footer();