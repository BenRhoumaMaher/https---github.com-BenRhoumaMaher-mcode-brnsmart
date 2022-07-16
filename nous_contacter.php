<?php

    /* Template Name: nous_contacter Page */

// on utilise get_header() pour afficher ici le footer de notre thème wordpress    
get_header(); 

?>
<?php
//appel au fichier de configuration de connexion au base des données.
    require('db.php');


//initialisation des erreurs
$error_prenom = '';
$error_nom = '';
$error_email = '';
$error_sujet = '';
$error_message = '';

$confirm = '';


//ici, on utilise la fonction isset() pour vérifier si la requet ($_REQUEST["register"]) est définie, ce qui signifie qu'elle existe et n'est pas null.
//la variable SuperGlobal $_REQUEST est utilisée pour collecter les données soumises par le formulaire HTML.
// $_REQUEST peut capturer les données qui sont envoyées en utilisant les deux méthodes POST et GET.
// $_REQUEST() est exécutée lorsque l'utilisateur clique sur le boutton dont le nom est "register".
    if (isset($_REQUEST['button'])) {

  if(empty($_POST["prenom"]))
  {
    $error_prenom = "<label class='text-danger'>Veuiller indiquer votre prenom</label>";
  }
  else 
  {
     //ici, on utilise la fonction trim() pour supprimer les espaces blancs au début et à la fin.
    $prenom = trim($_POST["prenom"]);
  }

if(empty($_POST["nom"]))
  {
    $error_nom = "<label class='text-danger'>Veuiller indiquer votre nom</label>";
  }
  else 
  {
     //ici, on utilise la fonction trim() pour supprimer les espaces blancs au début et à la fin.
    $nom = trim($_POST["nom"]);
  }
    // ici, la variable Super Global $_POST() est utilisée pour collecter les informations provenants de l'input dont le nom est "date".
  // ici, la fonction empty véfie si l'input dont le nom est "date" est null
  if(empty($_POST["email"]))
  {
    $error_email = "<label class='text-danger'>Veuiller entrer votre email</label>";
  }
  else 
  {
    $email = trim($_POST["email"]);
    //filter_var() est une fonction qui filtre une variable avec un filtre spécifié.
    //Filter_validate_email est utilisé pour vérifier si la variable passant en paramètre, ici "$email" est s'agit d’une adresse e-mail valide.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_email = "<label class='text-danger'>entrer email valid</label>";
    }
  }
  if(empty($_POST["sujet"]))
  {
    $error_sujet = "<label class='text-danger'>Veuiller indiquer votre sujet</label>";
  }
  else 
  {
     //ici, on utilise la fonction trim() pour supprimer les espaces blancs au début et à la fin.
    $sujet = trim($_POST["sujet"]);
  }
   //strlen() est une fonction qui renvoie la longueur d'une string donnée, ici l'adresse.
if(empty($_POST["message"]))
  {
    $error_message = "<label class='text-danger'>Veuiller indiquer votre message</label>";
  }
  else 
  {
    $message = trim($_POST["message"]);
  }
  //ici on va vérifier si tous les erreurs sont null.
    if ($error_prenom == '' && $error_nom == ''
    && $error_email == '' && $error_sujet == '' && $error_message == ''
  )

    {

        //ici on va stocker les valeurs input dans des variables.

    //on va utilisé les fonctions stripslahes() et mysqli_real_escape_string() pour empêcher les injections sql.
    //stripslahes() esr une fonction utilisée pour supprimer les antislashs afin de nettoyoer les données récupérées d'un formulaire HTML avant les transmettre au base des données.
        $prenom = stripslashes($_REQUEST['prenom']);
        $prenom = mysqli_real_escape_string($con, $prenom);
        $nom = stripslashes($_REQUEST['nom']);
        //mysqli_real_escape_string() est une fonction qui échappe les caractères spéciaux d’une chaîne à utiliser dans une requête SQL.
        $nom = mysqli_real_escape_string($con, $nom);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $sujet = stripslashes($_REQUEST['sujet']);
        $sujet = mysqli_real_escape_string($con, $sujet); 
        $message= stripslashes($_REQUEST['message']);
        $message = mysqli_real_escape_string($con, $message);
        //variable qui stocke la date de création du la requête SQL
        $create_datetime = date("Y-m-d H:i:s");

       //On va faire maintenant L'insertion de données dans notre table mysql "inscription_stagiaire_particulier" à l'aide de la commande INSERT INTO.
        $query    = "INSERT into `contact_administrateur` (prenom,nom,email,sujet,message, create_datetime)
                     VALUES ('$prenom', '$nom', '$email','$sujet','$message',
                      '$create_datetime')";

        //ici, mysqli_query() accepte deux paramètres, $con qui un objet qui présente la connexion avec le serveur mysql, et $query qui présente la requête à exécuter.             
        $result   = mysqli_query($con, $query);

         //on va maintenant faire la configuration pour envoyer un email à l'utilisateur à l'aide de la  bibliothèque php 'phpmailer'.
        if ($result) {
         //l'instruction require_once ici nou permettre d'inclure le contenu d'un autre fichier php à l'intérieur de notre page ici just une seul fois.    
        require_once "phpmailer/PHPMailerAutoload.php";
        //ici, mail est un objet phpmailer
        $mail = new PHPMailer();

        //smtp configuration
        $mail->CharSet = "utf-8";
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ddev7546@gmail.com";
        $mail->Password = "cioeujqppsynnpol";
        $mail->Port = "465";
        $mail->SMTPSecure = "ssl";

        //email configuration 
        $mail->IsHTML(true);
        $mail->SetFrom($email, $nom);
        $mail->AddAddress("ddev7546@gmail.com");
        $mail->Subject = ("$email");
        $mail->Body = $message;
        
        //ici, si l'email a été envoyé, on va rediriger l'utilisateur vers une autre page à l'aide de la fonction header().
        if ($mail->Send()) {
             $confirm = "<label class='text-primary'>Votre message a été bien transmise !!!</label>";
        }
           
        }
    } 
    }
?>
    <style>
<?php include "css/contact.css"; ?>
</style>
<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Nous Contacter</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/lindy-uikit.css"/>
      </head>
  <body id="btn">
    <div class="container">
        <section id="contact" class="contact-section contact-style-3">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
            <div class="section-title text-center mb-50">
              <h3 class="mb-15">Prendre contact !!!</h3>
              <p style="color: grey;">N’hésitez pas à nous contacter si vous avez besoin d’aide
</p>
            </div>
          </div>
        </div>
        <div id="box">
        <?php echo $confirm; ?>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="contact-form-wrapper">
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <div class="single-input">
                      <input type="text"  name="prenom" class="form-input" placeholder="Prénom">
                      <i class="lni lni-user"></i>
                    </div>
                     <?php echo $error_prenom; ?>
                  </div>
                  <div class="col-md-6">
                    <div class="single-input">
                      <input type="text"  name="nom" class="form-input" placeholder="Nom">
                      <i class="lni lni-user"></i>
                    </div>
                     <?php echo $error_nom; ?>
                  </div>
                  <div class="col-md-6">
                    <div class="single-input">
                      <input type="email"  name="email" class="form-input" placeholder="Email">
                      <i class="lni lni-envelope"></i>
                    </div>
                     <?php echo $error_email; ?>
                  </div>
                  <div class="col-md-6">
                    <div class="single-input">
                      <input type="text"  name="sujet" class="form-input" placeholder="Sujet">
                      <i class="lni lni-text-format"></i>
                    </div>
                    <?php echo $error_sujet; ?>
                  </div>
                  <div class="col-md-12">
                    <div class="single-input">
                      <textarea name="message" class="form-input" placeholder="Message" rows="6"></textarea>
                      <i class="lni lni-comments-alt"></i>
                    </div>
                    <?php echo $error_message; ?>
                  </div>
                  <div class="col-md-12">
                    <div class="form-button">
                      <button type="submit" class="button" name="button"> <i class="lni lni-telegram-original"></i>Envoyer</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>

          <div class="col-lg-4">
            <div class="left-wrapper">
              <div class="row">
                <div class="col-lg-12 col-md-6">
                  <div class="single-item">
                    <div class="icon">
                      <i class="lni lni-phone"></i>
                    </div>
                    <div class="text">
                      <i class="fas fa-fw fa-phone"></i> <a href="tel:36366122">(+216) : 27 237 235</a><br>
                      <i class="fas fa-fw fa-phone"></i> <a href="tel:36366122">(+216) : 36366122</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-6">
                  <div class="single-item">
                    <div class="icon">
                      <i class="lni lni-envelope"></i>
                    </div>
                    <div class="text">
                      <i class="fas fa-fw fa-envelope"></i> <a href="mailto:info@domain.com"> contact@brnsmart.tn </a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-6">
                  <div class="single-item">
                    <div class="icon">
                      <i class="lni lni-map-marker"></i>
                    </div>
                    <div class="text" style="color: royalblue;">
                            BRN SMART, Imm.<br> SCI, Rue du Lac Toba,<br>
                            Les Berges du Lac,1053<br>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section><br><br>
    <section class="" style="text-align: center;">
      <div class="column">
                        <h3 class="mb-15">Où nous trouver</h3>
                        <figure>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3193.3423667120514!2d10.228547614659881!3d36.8342757734818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd353df50e9097%3A0xe94e060057e8763a!2s1053%20Rue%20Du%20Lac%20Toba%D8%8C%20Tunis!5e0!3m2!1sfr!2stn!4v1650469367114!5m2!1sfr!2stn" width="1300" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </figure>
                    </div>
    </section>
</div>
  </body>

   <script type="text/javascript">
   
    const btn = document.getElementById('btn');

  btn.addEventListener('click', () => {
    setTimeout(() => {
      const box = document.getElementById('box');
      box.style.display = 'none';
    }, 1000);
  });
  </script> 
  <script>
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
  </script>
</html>

<!-- on utilise get_footer() pour afficher ici le footer de notre thème wordpress -->
  <?php get_footer();