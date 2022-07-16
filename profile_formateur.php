<?php
/* Template Name: profile_formateur Page */
get_header(); 
session_start();
require "include/functions.php";
require "include/Session.php";
require "db.php";
require "formations_formateur.php";
ConfirmerConnexionFormateur();
?>

<?php


//initialisation des erreurs

$error_prenom = '';
$error_nom = '';
$error_email = '';
$error_sujet = '';
$error_message = '';

$confirm = '';


if (isset($_REQUEST['button'])) {

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
  if ($error_prenom == '' && $error_nom == '' && $error_sujet == '' 
    && $error_email == '' && $error_message == ''
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
      $mail->Password = "dev0000.";
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
       $confirmation = "<label class='text-primary'>Votre message a été bien transmise !!!</label>";
     }
     
   }
 } 
}
?>
<?php
$msg = ''; 
if(isset($_POST['modifier'])){
  $formateuremail = $_SESSION["formateuremail"];
  $formateurid = $_SESSION["formateurid"];
  $prenom = stripslashes($_REQUEST["prenom"]);
  $prenom = mysqli_real_escape_string($con,$_POST['prenom']);
  $nom = $_REQUEST["nom"];
  $telephone = $_REQUEST["telephone"];
  $email = $_REQUEST["email"];
  $adresse = $_REQUEST["adresse"];
  $pays = $_REQUEST["pays"];
  $ville = $_REQUEST["ville"];
  $code_postal = $_REQUEST["code_postal"];

  $mysql = "UPDATE enregistrement_formateur SET prenom='$prenom',nom='$nom',adresse='$adresse', telephone='$telephone' ,email='$email' ,pays='$pays' ,ville='$ville' ,code_postal='$code_postal' 
  WHERE email = '$formateuremail'";
  $res=mysqli_query($con,$mysql);
  if($res){
    $confirm = "<label class='text-primary'>Votre profile est à jours !!!</label>";
  }
}
?>
<?php
$error_mot_de_passe = '';
$error_confirm_mot_de_passe = '';
$error_length = ''; 
if(isset($_POST['updateme'])){

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
    $formateurid = $_SESSION["formateurid"];
    $mot_de_passe = stripslashes($_REQUEST["mot_de_passe"]);
    $mot_de_passe = mysqli_real_escape_string($con,$_POST['mot_de_passe']);

//changer mot de passe dans DB par nouveau mot de passe changé ici
    $Hashed_Password = Password_Encryption($mot_de_passe);
    $sql = "UPDATE enregistrement_formateur SET mot_de_passe='$Hashed_Password' 
    WHERE id = '$formateurid'";
    $result=mysqli_query($con,$sql);
    if($result){
      $confirmation = "<label class='text-primary'> Votre profile est à jours !!!</label>";
    }

  }   

}
?>
<style>
  <?php include "css/inscriptionformateur.css"; ?>
</style>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />

  <link
  rel="stylesheet"
  href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
  />
  <link rel="stylesheet" href="assets/css/formateur.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  rel="stylesheet"
  />
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
  />
  <style type="text/css">
    .container {
      margin-top: -100px;
      margin-left: 60px;
    }
    .formateur {
      margin-left: 250px;
    }
    #cycle {
      margin-top: 100px;
      margin-left: -450px;
    }
    #java {
      margin-top: 90px;
      margin-left: 250px;
    }
    #historique, #approuvement {
      margin-top: 40px;
      margin-left: -300px;
    }
    #aboutModal {
      margin-left: 250px;
      margin-top: 20px;
    }
    #date, #presence, #format {
      background-color: white;
      border:none;
    }
    .inputs {
      cursor: default;
    }
  </style>

</head>

<body id="bb">
  <section class="hero-area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 col-md-12 col-12">
          <div class="hero-content">
            <div id="b">
             <?php echo $confirmation; ?>
           </div>
           <h1>
            <span class="color2 wow fadeInUp" data-wow-delay="1.6s">BRNSMART 
              <br>TRAINING CENTER</span>
            </h1>
            <p style="text-align: justify; text-justify: inter-word;">BRNSMART TRAINING CENTER est un organisme de formation continue, situé à Tunis et destiné aux apprenants dans différents domaines. La société est constituée d’ingénieurs et experts. Nos formateurs sont tous des spécialistes de leur domaine, exerçant en tant qu’experts depuis au moins 4 ans.</p>
            <div class="d-flex flex-sm-row flex-column mt-4">
              <button
              class="btn btn-danger btn-lg shadow"
              type="button"
              data-bs-toggle="modal"
              data-bs-target="#email"
              >
              <i class="bi bi-envelope"></i> Contact
            </button>
            <span class="fs-2 mt-5 mt-sm-0">
              <a href="https://www.facebook.com/BRN-Training-Center-101928965784102" target="_blank">
                <i class="bi bi-facebook text-primary ms-sm-3 ms-0"></i
                ></a>
                <a href="https://twitter.com/BrnCenter" target="_blank">
                  <i class="bi bi-twitter text-info ms-sm-3 ms-0"></i
                  ></a>
                  <a href="https://www.instagram.com/brn_training_center/" target="_blank">
                    <i class="bi bi-instagram text-danger ms-sm-3 ms-0"></i
                    ></a>
                    <a href="https://www.linkedin.com/company/brn-training-center/about/?viewAsMember=true" target="_blank">
                      <i class="bi bi-linkedin text-primary ms-sm-3 ms-0"></i
                      ></a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-12">
                <div class="">
                  <div class="image-bg-shape"></div>
                  <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="#" style="margin-left: 5px;
                  width: 650px; height: 450px;">
                </div>
              </div>

              <div class="text-end dropdown" style="width: 125px; margin-top: -820px; margin-left: 1500px;">
                <div data-bs-toggle="dropdown">
                  <img class="rounded-circle  me-2" 
                  src="<?php echo $_SESSION["formateurimage"]; ?>" alt="Profile Picture">
                </div>
                <ul class="dropdown-menu" style="width: 370px; text-align: center; margin-right: 10px; height: 450px;">
                  <li style="text-align: center;"><b>Gérer Votre Compte BRNSMART</b></li>
                  <li><hr class="dropdown-divider" ></li>
                  <img style="width: 125px; text-align:center;" class="rounded-circle  me-2" 
                  src="<?php echo $_SESSION["formateurimage"]; ?>" alt="Profile Picture"/>
                  <h5 class="text-muted mt-2 col-md-11"><?php echo $_SESSION["formateurprenom"]; ?> <?php echo $_SESSION["formateurnom"]; ?>
                  <h5 class="text-muted mt-2 col-md-11"><?php echo $_SESSION["formateuremail"]; ?>
                  <li><hr class="dropdown-divider" style="width: 109%"></li>
                  <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#updateModal"><p class="text-primary">Modifier mes informations</p></a></li>
                  <li><a class="dropdown-item" href=""  data-bs-toggle="modal" data-bs-target="#update">
                    <p class="text-success">Changer mot de passe</p></a></li>
                    <li><hr class="dropdown-divider" style="width: 109%"></li>
                    <li><a class="dropdown-item" href="http://localhost/brnsmart/deconnexion_formateur/">
                      <p class="text-danger">Déconnexion</p></a></li>
                    </ul>
                  </div>

                  
                </section>

                <div class="modal fade" id="email" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="modal-title">Envoyer un email</div>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <form  class="row g-3" method="POST">
                          <div class="col-md-6">
                            <label class="form-label">Prénom</label
                            ><input type="text" class="form-control" placeholder="Entrer votre prénom" name="prenom" />
                            <?php echo $error_prenom; ?>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Nom</label
                            ><input type="text" class="form-control" placeholder="Entrer votre nom"
                            name="nom"  />
                            <?php echo $error_nom; ?>
                          </div>
                          <div class="col-12">
                            <label class="form-label">Email</label
                            ><input
                            type="email"
                            class="form-control"
                            placeholder="Entrer votre email"
                            name="email"
                            />
                            <?php echo $error_email; ?>
                          </div>
                          <div class="col-12">
                            <label class="form-label">Sujet</label
                            ><input
                            name="sujet"
                            type="text"
                            class="form-control"
                            placeholder="Entrer votre sujet"
                            />
                            <?php echo $error_sujet; ?>
                          </div>
                          <div class="col-12">
                            <label class="form-label">Message</label
                            ><textarea
                            rows="5"
                            name="message"
                            class="form-control"
                            placeholder="Envoyer un message"
                            ></textarea>
                            <?php echo $error_message; ?>
                          </div>
                          
                          <div class="col-4">
                            <button type="submit" class="btn btn-primary w-80 h-150" name="button">
                              Envoyer
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


                <section class="services section">
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="section-title"  style="margin-left: 200px;">
                          <h1 >Soyer le Bienvenue !!!</h1><br><h2>Votre Espace</h2>
                          <p class="wow fadeInUp" data-wow-delay=".6s">Vous pouvez ici modifier vos coordonnées, explorer vos inscriptions, s'avoir plus sur notre site, et accéder à notre forum.</p>
                        </div>
                      </div>
                    </div>
                    <div class="row"  style="margin-left: 250px; width: 1500px;">
                      <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                       
                        <div class="single-service two">
                          <div class="service-icon">
                            <i class="uil uil-package"></i>
                          </div>
                          <h3>Mes inscriptions</h3>
                          <p>Vous pouvez ici explorer l'historique de vos inscriptions.</p>
                          <a href="" role="button" data-bs-toggle="modal" 
                          data-bs-target="#historique">Historique
                          <i class="lni lni-arrow-right"></i></a>
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                        <!-- Start Single Service -->
                        <div class="single-service one">
                          <div class="service-icon">
                            <i class="uil uil-user"></i>
                          </div>
                          <h3>Mes formations réalisées</h3>
                          <p>Vous pouvez ici consulter vos formations réalisées.</p>
                          <a href="" role="button" data-bs-toggle="modal" data-bs-target="#approuvement">Approuvées<i class="lni lni-arrow-right"></i></a>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </section>


                <div class="modal fade" id="historique" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable">  
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="modal-title">Historique</div>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      
                      <div class="modal-body">
                        <form action="#" class="row g-3" method="POST">
                          <?php 
                          $formateuremail = $_SESSION["formateuremail"];
                          $sql = "Select * from demande_formation where 
                          email = '$formateuremail'";
                          $result = mysqli_query($con,$sql);
                          $num = mysqli_num_rows($result);
                          if($result){
                            if ($num>0){
                              while($row=mysqli_fetch_assoc($result)) {
                                echo "
                                <div class='col-md-6' id='" . $row["id"] ."'>
                                <button
                                tabindex='0'
                                class='btn btn-sm btn-info w-100 h-100'
                                type='button'
                                data-id = '" . $row["id"] ."'
                                data-role='show'

                                >" . $row["formation"] ."</button>
                                </div> ";
                              }
                            }}
                            ?>

                          </form>
                        </div>
                      </div>
                    </div>
                  </div>


                  

                  <div class="modal fade" id="approuvement" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">  
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="modal-title">Formation approuvées</div>
                          <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        
                        <div class="modal-body">
                          <form action="#" class="row g-3" method="POST">
                            <?php 
                            $formateuremail = $_SESSION["formateuremail"];
                            $sql = "Select * from demande_formation where 
                            email = '$formateuremail' and approuvement = 'On'";
                            $result = mysqli_query($con,$sql);
                            $num = mysqli_num_rows($result);
                            if($result){
                              if ($num>0){
                                while($row=mysqli_fetch_assoc($result)) {
                                  echo "
                                  <div class='col-md-6' id='" . $row["id"] ."'>
                                  <button
                                  tabindex='0'
                                  class='btn btn-sm btn-info w-100 h-100'
                                  type='button'
                                  data-id = '" . $row["id"] ."'
                                  data-role='approuvement'

                                  >" . $row["formation"] ."</button>
                                  </div> ";
                                }
                              }}
                              ?>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="update" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <div class="modal-title">Mettre à jour</div>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <form action="#" class="row g-3" method="POST">
                              <div class="col-md-12">
                                <label class="form-label">Nouveau mot de passe:</label
                                ><input type="password" class="form-control" placeholder="Entrer votre mot de passe" name="mot_de_passe"  id="pass1" />
                                <?php echo $error_length; ?>
                                <?php echo $error_mot_de_passe; ?>
                              </div>
                              <div class="col-md-12">
                                <label class="form-label">Confirmation mot de passe:</label
                                ><input type="password" class="form-control" name="confirm_mot_de_passe" placeholder="Confirmer votre mot de passe"  id="pass2"  onkeyup="checkPass(); return false;"/>
                                <?php echo $error_confirm_mot_de_passe; ?>
                                <span id="confirmMessage" class="confirmMessage"></span></p>
                              </div>
                              <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100 h-100" name="updateme">
                                  Modifier
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade " id="updateModal" tabindex="-1" aria-hidden="true" >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <div class="modal-title">Modifier votre profile</div>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <form action="#" class="row g-3" method="POST">
                              <?php 
                              $formateuremail = $_SESSION["formateuremail"];
                              $sql = "Select * from enregistrement_formateur where email = '$formateuremail'";
                              $result = mysqli_query($con,$sql);
                              $num = mysqli_num_rows($result);
                              if($result){
                                if ($num>0){
                                  while($row=mysqli_fetch_assoc($result)) {
                                    ?>

                                    <div class="col-md-6">
                                      <label class="form-label">Prénom:</label
                                      ><input type="text" class="form-control" placeholder="Entrer votre prénom" id="prenom" name="prenom" data-target='prenom'
                                      value="<?php echo $row["prenom"]; ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Nom:</label
                                      ><input type="text" class="form-control" placeholder="Entrer votre nom" id="nom" name="nom" data-target='nom' value="<?php echo $row["nom"]; ?>"/>
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">adresse mail:</label
                                      ><input type="email" class="form-control" placeholder="Entrer votre email" name="email" value="<?php echo $row["email"]; ?>"/>
                                    </div>
                                    <div class="col-8">
                                      <label class="form-label">Téléphone:</label
                                      ><input
                                      type="number"
                                      maxlength="8"
                                      class="form-control"
                                      placeholder="Entrer votre telephone"
                                      id="telephone"
                                      name="telephone"
                                      data-target='telephone'
                                      value="<?php echo $row["telephone"]; ?>"
                                      />
                                    </div>
                                    <div class="col-4">
                                      <label class="form-label">Adresse:</label
                                      ><input
                                      type="text"
                                      class="form-control"
                                      placeholder="Entrer votre adresse"
                                      id="adresse"
                                      name="adresse"
                                      data-target='adresse'
                                      value="<?php echo $row["adresse"]; ?>"
                                      />
                                    </div>
                                    <div class="col-12">
                                      <label class="form-label">Pays:</label
                                      ><input
                                      type="text"
                                      class="form-control"
                                      placeholder="Entrer votre pays"
                                      id="pays"
                                      name="pays"
                                      data-target='pays'
                                      value="<?php echo $row["pays"]; ?>"
                                      />
                                    </div>
                                    <div class="col-6">
                                      <label class="form-label">Ville:</label
                                      ><input
                                      type="text"
                                      class="form-control"
                                      placeholder="Entrer votre ville"
                                      id="ville"
                                      name="ville"
                                      data-target='ville'
                                      value="<?php echo $row["ville"]; ?>"
                                      />
                                    </div>
                                    <div class="col-6">
                                      <label class="form-label">Code Postal:</label
                                      ><input
                                      type="number"
                                      class="form-control"
                                      placeholder="Entrer votre code postal"
                                      id="code_postal"
                                      name="code_postal"
                                      data-target='code_postal'
                                      value="<?php echo $row["code_postal"]; ?>"
                                      />
                                    </div>
                                    <div><input
                                      type="hidden"
                                      class="form-control"
                                      id="id"
                                      name="id"
                                      data-target='id'
                                      value="<?php echo $row["id"]; ?>"
                                      />
                                    </div>
                                    <div class="col-4">
                                      <button type="submit" class="btn btn-primary w-100 h-100" name="modifier" id="save" data-role=update>
                                        Modifier
                                      </button>
                                    </div>

                                    <?php 

                                  }}}
                                  ?>
                                  
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="cycle" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <div class="modal-title">Découvrir tous les formations</div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <form  class="row g-3" method="POST">
                                  <div class="col-md-6">
                                    <button
                                    class="btn btn btn-warning col-md-12"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#java"
                                    >java
                                  </button>
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control btn btn-primary" value="php" />
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control btn btn-danger" value="mysql" />
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control btn btn-success" value="angular" />
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control btn btn-warning" value="javascript" />
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control btn btn-danger" value="react" />
                                </div>
                                <hr>
                                <a href="http://localhost/brnsmart/faq/"
                                target="_blank"
                                class="btn btn-info"
                                role="button"
                                >S'avoir  +</a>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="java" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <div class="modal-title">Envoyer votre demande</div>
                              <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                              <form  class="row g-3" method="POST">
                                <div class="col-md-6">
                                  <input type="hidden" class="form-control" name="formation" value="java" />
                                </div>

                                <div class="col-md-12">
                                  <button
                                  class="btn btn-danger col-4"
                                  name="envoyer"
                                  >Envoyer</button>
                                  <a
                                  href="#"
                                  class="btn btn-info col-4"
                                  role="button"
                                  >S'avoir+</a>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>


                      <section id="Portfolio" class="row mx-5">
                        <div class="col-12 mt-5 text-center text-sm-start" style="width: 800px">
                          <div class="card-body">
                            <h6 class="card-title display-4 fw-bold">
                              Découvrez nos formations.
                            </h6>
                            <p class="card-text text-secondary mt-4" style="text-align: justify; text-justify: inter-word;">
                              Nos formations s’adressent aux apprenant se cherchant à développer leurs compétences ou à obtenir une certification, aux adultes en reconversion, aux managers désireux de comprendre les enjeux du numérique pour faire évoluer leur entreprise.
                            </p>
                          </div>
                        </div>
                        <div class="container mt-4" style="margin-left: -10px">
                          <div class="row">
                            <div class="col-12 col-md-6 col-xl-4 mb-4">
                              <div class="card">
                                <div class="badge bg-primary position-absolute mt-3 ms-3">BRNSMART</div>
                                <img class="card-img-top" src="https://source.unsplash.com/m_HRfLhgABo">
                                <div class="card-body">
                                  <h4 class="card-title">Développement Informatique</h4>
                                  <p class="card-text">Vous trouverez ici tous les formations concernant le cycle Développement informatique.</p>
                                  <button
                                  class="btn btn-primary w-100 stretched-link"
                                  type="button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#informatique"
                                  >Explorer
                                </button>
                              </div>

                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-xl-4 mb-4">
                            <div class="card">
                              <div class="badge bg-primary position-absolute mt-3 ms-3">BRNSMART</div>
                              <img class="card-img-top" src="https://source.unsplash.com/Ua-agENjmI4">
                              <div class="card-body">
                                <h4 class="card-title">Développemt personnel</h4>
                                <p class="card-text">Vous trouverez ici tous les formations concernant le cycle Développement personnel.</p>
                                <button
                                class="btn btn-primary w-100 stretched-link"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#personnel"
                                >Explorer
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                          <div class="card">
                            <div class="badge bg-primary position-absolute mt-3 ms-3">BRNSMART</div>
                            <img class="card-img-top" src="https://source.unsplash.com/K0c8ko3e6AA">
                            <div class="card-body">
                              <h4 class="card-title">Ressources humaines</h4>
                              <p class="card-text">Vous trouverez ici tous les formations concernant le cycle Ressources humaines.</p>
                              <button
                              class="btn btn-primary w-100 stretched-link"
                              type="button"
                              data-bs-toggle="modal"
                              data-bs-target="#ressources"
                              >Explorer
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6 col-xl-4 mb-4">
                        <div class="card">
                          <div class="badge bg-primary position-absolute mt-3 ms-3">BRNSMART</div>
                          <img class="card-img-top" src="https://source.unsplash.com/xG02JzIBf7o">
                          <div class="card-body">
                            <h4 class="card-title">Bureautique</h4>
                            <p class="card-text">Vous trouverez ici tous les formations concernant le cycle Bureautique.</p>
                            <button
                            class="btn btn-primary w-100 stretched-link"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#bureautique"
                            >Explorer
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4 mb-4">
                      <div class="card">
                        <div class="badge bg-primary position-absolute mt-3 ms-3">BRNSMART</div>
                        <img class="card-img-top" src="https://source.unsplash.com/5aiRb5f464A">
                        <div class="card-body">
                          <h4 class="card-title">Management de projet</h4>
                          <p class="card-text">Vous trouverez ici tous les formations concernant le cycle Management de projet.</p>
                          <button
                          class="btn btn-primary w-100 stretched-link"
                          type="button"
                          data-bs-toggle="modal"
                          data-bs-target="#management"
                          >Explorer
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              
            </body>
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
            <script type="text/javascript">
             
              const btn = document.getElementById('bb');

              btn.addEventListener('click', () => {
                setTimeout(() => {
                  const b = document.getElementById('b');
                  b.style.display = 'none';
                }, 1000);
              });
            </script> 
            <script>
             $(document).ready(function(){
               $(document).on('click','button[data-role=show]', function(){
                 var id = $(this).data('id'); 
                 var date = $('#'+id).children('button[data-target=date]').text();
                 var presence = $('#'+id).children('button[data-target=presence]').text();
                 var format = $('#'+id).children('button[data-target=format]').text(); 


                 $('#date').val(date);
                 $('#presence').val(presence);
                 $('#format').val(format);
                 $('#id').val(id);
                 $('#aboutModal').modal('toggle');
               });
             });
           </script>
           <script>
             $(document).ready(function(){
               $(document).on('click','button[data-role=approuvement]', function(){
                 var id = $(this).data('id'); 
                 var date = $('#'+id).children('button[data-target=date]').text();
                 var presence = $('#'+id).children('button[data-target=presence]').text();
                 var format = $('#'+id).children('button[data-target=format]').text(); 


                 $('#date').val(date);
                 $('#presence').val(presence);
                 $('#format').val(format);
                 $('#id').val(id);
                 $('#aboutModal').modal('toggle');
               });
             });
           </script>
           <script
           src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
           ></script>
           <script>
            if ( window.history.replaceState ) {
              window.history.replaceState( null, null, window.location.href );
            }
          </script>
          </html>
          <?php get_footer();
