<?php
/* Template Name: connexion_stagiaires Page */
get_header(); 
session_start();
?>
<?php
require "db.php";
require "include/functions.php";
require "include/Session.php";
//errors
$msg = '';
$error_email = '';
$error_mot_de_passe = '';



if(isset($_REQUEST['login'])){

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
if(empty($_POST["mot_de_passe"]))
{
    $error_mot_de_passe = "<label class='text-danger'>Veuiller indiquer votre mot de passe</label>";
}


if ($error_email == '' || $error_mot_de_passe == '' )
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mot_de_passe = mysqli_real_escape_string($con, $_POST['mot_de_passe']);


    $activation = ConfirmerActivationStagiaires($email);
    $Profil = VerificationConnexionStagiaires($email,$mot_de_passe);
    if (!$activation) {
     $msg = "<label class='text-danger'>Veuiller activer votre compte</label>";
 }elseif(!$Profil){   
        $msg = "<label class='text-danger'>Veuiller vérifier vos coordonnées</label>";
    } else {  


     
        $_SESSION["stagiaireid"] = $Profil['id'];
        $_SESSION["stagiaireprenom"] = $Profil['prenom'];
        $_SESSION["stagiaireimage"] = $Profil['image'];
        $_SESSION["stagiairenom"] = $Profil['nom'];
        $_SESSION["stagiairetypepiece"] = $Profil['typepiece'];
        $_SESSION["stagiairenumpiece"] = $Profil['numpiece'];
        $_SESSION["stagiaireemail"] = $Profil['email'];
        $_SESSION["stagiairetelephone"] = $Profil['telephone'];
        $_SESSION["stagiairecivilité"] = $Profil['civilité'];
        $_SESSION["stagiaireadresse"] = $Profil['adresse'];
        $_SESSION["stagiaireville"] = $Profil['ville'];
        $_SESSION["stagiairepays"] = $Profil['pays'];
        $_SESSION["stagiairecode_postal"] = $Profil['code_postal'];
        $_SESSION["stagiairecreate_datetime"] = $Profil['create_datetime'];

        if (isset($_REQUEST['remember'])) {
          
            $ExpireTime=time() + 86400;
            setcookie("SettingEmail",$email,$ExpireTime, '/');
        }

        header(
            "Location: http://localhost/brnsmart/profile_stagiaires"
        );
    }
}
}
?>
<style>
    <?php include "css/sty.css"; ?>
</style>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
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
                    <h2>Connexion</h2>
                </div>
                <hr>
                <div> <?php echo Message(); ?> </div>
                <?php echo $msg; ?>
                <form action="" method="post" role="form">

                    <div class="form-group">
                        <label for="email"><span class="req"></span> Email: </label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="entrer votre email" />
                        <div class="status" id="status"></div>
                        <?php echo $error_email; ?>
                    </div>

                    <div class="form-group">

                        <label for="password"><span class="req"></span> Mot de Passe: </label>
                        <input name="mot_de_passe" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass1" placeholder="Entrer votre mot de passe" /> 
                        <?php echo $error_mot_de_passe; ?>
                    </p>
                    <div>
                        <input type="checkbox" name="remember">
                        <label><span class="req"></span>Se souvenir de moi</label>
                    </div>
                    <span class="req">
                        <a href="http://localhost/brnsmart/recuperer_personne_morale/">Mot de Passe Oubliée ???</a>
                    </span>
                    <div class="form-group">
                        <hr>
                        <input class="btn btn-success" type="submit" name="login"
                        value="Se connecter" id="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
<?php get_footer();