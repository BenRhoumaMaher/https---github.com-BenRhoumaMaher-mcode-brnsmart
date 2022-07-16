<?php
/* Template Name: recuperer_admin Page */
get_header(); 

?>
<?php
require "db.php";
require "include/functions.php";
require "include/Session.php";
//errors
$msg = '';
$error_email = '';

//variables
$email = '';


if(isset($_REQUEST['register'])){

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

if ($error_email == '')
{

    $email = stripslashes($_REQUEST["email"]);
    $email = mysqli_real_escape_string($con, $_POST['email']);


    if(!CheckEmailExistAdmin($email)){

        $msg = "<label class='text-danger'>Email n'existe pas !!!</label>";

    } else {
        $query = "SELECT * FROM `inscription_administrateur` WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        if ($user=mysqli_fetch_array($result)) {
         $user["prenom"];
         $user["token"];
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
         $mail->Subject = "Réinitialiser le mot de passe";
         $mail->Body = 'Bonjour ' .$user["prenom"]. ' vous trouverez ici le lien pour réinitialiser votre mot de passe http://localhost/brnsmart/reinitialisation_admin?token='.$user["token"];
         if ($mail->Send()) {
            $_SESSION['message'] = "Vérifier votre email pour réinitialiser votre mot de passe";
            header(
                "Location: http://localhost/brnsmart/connexion_administrateur"
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
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                    <h2>Mot De Passe Oubliée</h2>
                </div>
                <hr>
                <?php echo $msg; ?>
                <form action="#" method="POST" role="form">

                    <div class="form-group">
                        <label for="email"><span class="req"></span> Email: </label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="entrer votre email" />
                        <div class="status" id="status"></div>
                        <?php echo $error_email; ?>
                    </div>

                    <div class="form-group">
                        <hr>
                        <input class="btn btn-success" type="submit" name="register" value="recuperer" id="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
<?php get_footer();