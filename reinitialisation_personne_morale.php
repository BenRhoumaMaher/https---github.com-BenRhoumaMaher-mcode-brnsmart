<?php
/* Template Name: reinitialisation_personne_morale Page */
get_header(); 

?>
<?php
require "db.php";
require "include/functions.php";
require "include/Session.php";
//errors
$msg = '';
$error_mot_de_passe = '';
$error_confirm_mot_de_passe = '';
$error_length = '';
//variables
$mot_de_Passe = '';
$confirm_mot_de_passe = '';

if(isset($_GET['token'])){
    
    $TokenFromUrl=$_GET['token'];

    if(isset($_REQUEST['register'])){

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


    if ($error_mot_de_passe == '' 
        && $error_confirm_mot_de_passe == '' && $error_length == ''
    )
    {

        $mot_de_passe = stripslashes($_REQUEST["mot_de_passe"]);
        $mot_de_passe = mysqli_real_escape_string($con,$_POST['mot_de_passe']);

        $Hashed_Password = Password_Encryption($mot_de_passe);
        $sql = "UPDATE enregistrement_personne_morale SET mot_de_passe='$Hashed_Password' 
        WHERE token='$TokenFromUrl'";
        $result=mysqli_query($con,$sql);
        if($result){
           $_SESSION['message'] = "Votre mot de passe a été changé !!!";
           header(
            "Location: http://localhost/brnsmart/connexion_personne_morale"
        );
       }else {
        $_SESSION['message'] = "Erreur!!!";
        header(
            "Location: http://localhost/brnsmart/connexion_personne_morale"
        );
    }

}   

}
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'components/head.html' ?>
    <title>Create New Password</title>
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
                <form action="http://localhost/brnsmart/reinitialisation_personne_physique?token=<?php echo $TokenFromUrl; ?>" method="POST" role="form">

                    <div class="form-group">

                        <label for="password"><span class="req"></span> Nouveau Mot de Passe: </label>
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
                    <input class="btn btn-success" type="submit" name="register" value="changer" id="submit">
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