<?php
/* Template Name: enregistrement_formateur Page */
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
$error_sexe = '';
$error_adresse = '';
$error_mot_de_passe = '';
$error_ville = '';
$error_code_postal = '';
$error_pays = '';
$error_confirm_mot_de_passe = '';
$error_length = '';
//variables
$prenom = '';
$nom = '';
$email = '';
$sexe = '';
$adresse = '';
$mot_de_passe = '';
$confirm_mot_de_passe = '';

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
  if(empty($_POST["sexe"]))
  {
    $error_sexe = "<label class='text-danger'>Veuiller indiquer votre sexe</label>";
}
else 
{
    $sexe = trim($_POST["sexe"]);
}
if(empty($_POST["telephone"]))
{
    $error_telephone = "<label class='text-danger'>Veuiller indiquer votre telephone</label>";
}
else 
{
    $telephone = trim($_POST["telephone"]);
}
if(!strlen(trim($_POST["adresse"])))
{
    $error_adresse = "<label class='text-danger'>Veuiller indiquer votre adresse</label>";
}
else 
{
    $adresse = trim($_POST["adresse"]);
}
if(empty($_POST["mot_de_passe"]))
{
    $error_mot_de_passe = "<label class='text-danger'>Veuiller indiquer votre mot de passe</label>";
}
else 
{
    $mot_de_passe = trim($_POST["mot_de_passe"]);
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
if (trim($_POST['mot_de_passe']) !== trim($_POST['confirm_mot_de_passe'])) {
    $error_confirm_mot_de_passe = "<label class='text-danger'>Veuiller confirmer les mots de passe</label>";
}
if (strlen($mot_de_passe) < 6) {
    $error_length = "<label class='text-danger'>mot de passe doit contenir au moins 6 characters</label>";
}  


if ($error_prenom == '' && $error_nom == ''
    && $error_email == '' && $error_adresse == '' && $error_sexe == ''
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
    $_SESSION['email'] =  $email;
    $sexe = stripslashes($_REQUEST["sexe"]);
    $sexe = mysqli_real_escape_string($con, $sexe);
    $adresse = stripslashes($_REQUEST["adresse"]);
    $adresse = mysqli_real_escape_string($con, $adresse);
    $pays = stripslashes($_REQUEST["pays"]);
    $pays = mysqli_real_escape_string($con, $_POST['pays']);
    $civilité = stripslashes($_REQUEST["civilité"]);
    $civilité = mysqli_real_escape_string($con, $_POST['civilité']);
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
  if(!EmailExisteInscriptionFormateur($email)){

    $msg = "<label class='text-danger'>Email n'existe pas !!!</label>";

}
elseif(EmailExisteformateur($email)){

    $msg = "<label class='text-danger'>Email existe !!!</label>";

} else {
    $Hashed_Password = Password_Encryption($mot_de_passe);
    $query = "INSERT into `enregistrement_formateur` (image,prenom,nom,email,telephone,sexe,adresse,pays,ville,code_postal,
        mot_de_passe,token,active, create_datetime)
    VALUES ('$profile_pic','$prenom','$nom','$email',
        '$telephone', '$sexe', '$adresse',
        '$pays','$ville', '$code_postal',
        '$Hashed_Password',
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
        $mail->Body = 'Bonjour ' .$prenom. ' vous trouverez ici le lien pour activer votre compte http://localhost/brnsmart/activation_formateur?token=' .$Token;
        if ($mail->Send()) {
            $_SESSION['message'] = "Vérifier votre email pour l'activation";
            header(
                "Location: http://localhost/brnsmart/connexion_formateur"
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
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                        <label for="name"><span class="req"></span> Prénom: </label>
                        <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Entrer votre prenom" />
                        <?php echo $error_prenom; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Nom: </label>
                        <input class="form-control" type="text" name="nom" id="prenom" placeholder="entrer votre nom" />
                        <?php echo $error_nom; ?>
                    </div>

                    <div class="form-group">
                        <label for="email"><span class="req"></span> Email: </label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="entrer votre email" />
                        <div class="status" id="status"></div>
                        <?php echo $error_email; ?>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="req"></span> Telephone: </label>
                        <input class="form-control" type="tel" name="telephone" id="telephone" placeholder="entrer votre email" maxlength="8"/>
                        <div class="status" id="status"></div>
                        <?php echo $error_telephone; ?>
                    </div>

                    <div class="form-group">
                        <label for="category"><span class="req"></span> Sexe: </label>
                        <select class="form-select" id="sexe" name="sexe">
                            <option selected value="homme">Homme</option>
                            <option value="Femme">Femme</option>
                            <?php echo $error_sexe; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Adresse: </label>
                        <input class="form-control" type="text" name="adresse" id="adresse"  placeholder="entrer votre Adresse" />
                        <?php echo $error_adresse; ?>
                    </div>

                    <div class="form-group">
                        <label for="name"><span class="req"></span> Ville: </label>
                        <input class="form-control" type="text" name="ville" id="ville"  placeholder="entrer votre Adresse" />
                        <?php echo $error_ville; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Code Postal: </label>
                        <input class="form-control" type="number" name="code_postal" id="code_postal"  placeholder="entrer votre Adresse" />
                        <?php echo $error_code_postal; ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><span class="req"></span> Pays: </label>
                        <input class="form-control" type="text" name="pays" id="pays"  placeholder="entrer votre Adresse" />
                        <?php echo $error_pays; ?>
                    </div>

                    <div class="form-group">

                        <label for="password"><span class="req"></span> Mot de Passe: </label>
                        <input name="mot_de_passe" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass1" placeholder="Entrer votre mot de passe" /> 
                        <?php echo $error_length; ?>
                        <?php echo $error_mot_de_passe; ?>
                    </p>
                    
                    <label for="confirm_password"><span class="req"></span> Confirme Mot de Passe: </label>
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
            //Set the colors we will be using ...
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