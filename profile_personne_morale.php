<?php
/* Template Name: profile_personne_morale Page */
session_start();
get_header(); 
error_reporting(0);
require "include/functions.php";
require "include/Session.php";
require "formations_personne_morale.php";
require "db.php";
ConfirmerConnexionPersonneMorale();
?>
<?php
$confirmation = '';
$msg = ''; 
if(isset($_POST['modifier'])){
  $moraleemail = $_SESSION["physiqueemail"];
  $moraleid = $_SESSION["physiqueid"];
  $utilisateur = stripslashes($_REQUEST["utilisateur"]);
  $utilisateur = mysqli_real_escape_string($con,$_POST['utilisateur']);
  $telephone = $_REQUEST["telephone"];
  $email = $_REQUEST["email"];
  $adresse = $_REQUEST["adresse"];
  $societe = $_REQUEST["societe"];
  $fonction = $_REQUEST["fonction"];
  $presentation = $_REQUEST["presentation"];

  $mysql = "UPDATE enregistrement_personne_morale SET utilisateur='$utilisateur',adresse='$adresse', telephone='$telephone' ,email='$email' ,societe='$societe' ,fonction='$fonction', presentation = '$presentation' 
  WHERE email = '$moraleemail'";
  $res=mysqli_query($con,$mysql);
  if($res){
    $confirmation = "<label class='text-primary'>Votre profile est à jours !!!</label>";
  }
}
?>


<?php
$confir = '';
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
    $moraleid = $_SESSION["moraleid"];
    $mot_de_passe = stripslashes($_REQUEST["mot_de_passe"]);
    $mot_de_passe = mysqli_real_escape_string($con,$_POST['mot_de_passe']);

//changer mot de passe dans DB par nouveau mot de passe changé ici
    $Hashed_Password = Password_Encryption($mot_de_passe);
    $sql = "UPDATE enregistrement_personne_morale SET mot_de_passe='$Hashed_Password' 
    WHERE id = '$moraleid'";
    $result=mysqli_query($con,$sql);
    if($result){
      $confir = "<label class='text-primary'>Votre mot de passt  a  été changée !!!</label>";
    }

  }   

}
?>


<?php
//initialisation des erreurs
$error_prenom = '';
$error_nom = '';
$error_email = '';
$error_sujet = '';
$error_message = '';




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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  rel="stylesheet"
  />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <title>Profile Stagiaire</title>
  <style type="text/css">
    .container {
      margin-top: 10px;
    }
    #historique, #approuvement {
      margin-top: 50px;
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


  <header
  class="
  row row-cols-2
  vh-100
  flex-row
  align-items-center
  justify-content-center
  "
  >
  <div
  class="col-sm-6 container text-center text-sm-start"
  style="width: 500px"
  >

  <div class="card-body">
    <div id="conf">
     <?php echo $conf; ?>
   </div>
   <div id="b">
     <?php echo $confir; ?>
   </div>
   <div id="confirmation">
     <?php echo $confirmation; ?>
   </div>
   <h5 class="card-title display-3 fw-bold">BRNSMART TRAINING CENTER</h5>
   <p class="card-text text-secondary mt-4" style="text-align: justify; text-justify: inter-word;">
    <b>BRNSMART TRAINING CENTER</b> est un organisme de formation continue, situé à Tunis et destiné aux apprenants dans différents domaines. La société est constituée d’ingénieurs et experts. Nos formateurs sont tous des spécialistes de leur domaine, exerçant en tant qu’experts depuis au moins 4 ans.
  </p>
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
        <div id="b">
        </div>
      </div>
    </div>

    <div class="col-sm-6 text-center container">
      <div class="card border-0">
        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="mt-2 col-md-11" style="margin-left: -90px; width: 700px; height: 505px;">
      </div>
    </div>

    <div class="text-end dropdown" style="width: 125px; margin-top: -450px; margin-right: 30px;">
      <div data-bs-toggle="dropdown">
        <img class="rounded-circle  me-2" 
        src="<?php echo $_SESSION["moraleimage"]; ?>" alt="Profile Picture">
      </div>
      <ul class="dropdown-menu" style="width: 370px; text-align: center; margin-right: 10px; height: 450px;">
        <li style="text-align: center;"><b>Gérer Votre Compte BRNSMART</b></li>
        <li><hr class="dropdown-divider" ></li>
        <img style="width: 125px; text-align:center;" class="rounded-circle  me-2" 
        src="<?php echo $_SESSION["moraleimage"]; ?>" alt="Profile Picture"/>
        <h5 class="text-muted mt-2 col-md-11"><?php echo $_SESSION["moraleprenom"]; ?> <?php echo $_SESSION["moralenom"]; ?>
        <h5 class="text-muted mt-2 col-md-11"><?php echo $_SESSION["moraleemail"]; ?>
        <li><hr class="dropdown-divider" style="width: 109%"></li>
        <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#updateModal"><p class="text-primary">Modifier mes informations</p></a></li>
        <li><a class="dropdown-item" href=""  data-bs-toggle="modal" data-bs-target="#update">
          <p class="text-success">Changer mot de passe</p></a></li>
          <li><hr class="dropdown-divider" style="width: 109%"></li>
          <li><a class="dropdown-item" href="http://localhost/brnsmart/deconnexion_personne_morale/">
            <p class="text-danger">Déconnexion</p></a></li>
          </ul>
        </div>


        <div class="modal fade" id="email" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Envoyer un email</h5>
                <button   class="btn-close" data-bs-dismiss="modal"></button>
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
                    <button type="submit" class="btn btn-primary w-80 h-25" name="button">
                      Envoyer
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
                  $moraleemail = $_SESSION["moraleemail"];
                  $sql = "Select * from enregistrement_personne_morale where email = '$moraleemail'";
                  $result = mysqli_query($con,$sql);
                  $num = mysqli_num_rows($result);
                  if($result){
                    if ($num>0){
                      while($row=mysqli_fetch_assoc($result)) {
                        ?>

                        <div class="col-md-6">
                          <label class="form-label">Utilisateur:</label
                          ><input type="text" class="form-control" placeholder="Entrer votre nom d'utilisateur" id="Utilisateur" name="utilisateur" data-target='utilisateur'
                          value="<?php echo $row["utilisateur"]; ?>"/>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">adresse mail:</label
                          ><input type="email" class="form-control" placeholder="Entrer votre email" name="email" value="<?php echo $row["email"]; ?>"/>
                        </div>
                        <div class="col-6">
                          <label class="form-label">Societe:</label
                          ><input
                          type="text"
                          class="form-control"
                          placeholder="Entrer votre societe"
                          id="societe"
                          name="societe"
                          data-target='societe'
                          value="<?php echo $row["societe"]; ?>"
                          />
                        </div>
                        <div class="col-6">
                          <label class="form-label">Fonction:</label
                          ><input
                          type="text"
                          class="form-control"
                          placeholder="Entrer votre fonction"
                          id="fonction"
                          name="fonction"
                          data-target='fonction'
                          value="<?php echo $row["fonction"]; ?>"
                          />
                        </div>
                        <div class="col-6">
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
                        <div class="col-6">
                          <label class="form-label">Téléphone:</label
                          ><input
                          type="number"
                          class="form-control"
                          placeholder="Entrer votre telephone"
                          id="telephone"
                          name="telephone"
                          data-target='telephone'
                          value="<?php echo $row["telephone"]; ?>"
                          />
                        </div>
                        <div class="col-12">
                          <label class="form-label">Image:</label
                          ><input
                          type="file"
                          class="form-control"
                          />
                        </div>
                        <div class="col-12">
                          <label class="form-label">Presentation:</label
                          ><textarea
                          class="form-control"
                          placeholder="Entrer votre presentation"
                          id="presentation"
                          name="presentation"
                          data-target='presentation'
                          ><?php echo $row["presentation"]; ?></textarea>
                        </div>
                        <div>
                          <input
                          type="hidden"
                          class="form-control"
                          id="id"
                          name="id"
                          data-target='id'
                          value="<?php echo $row["id"]; ?>"
                          />
                        </div>
                        <div class="col-4">
                          <button type="submit" class="btn btn-primary w-100 h-25" name="modifier" id="save" data-role=update>
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
                        <button type="submit" class="btn btn-primary w-100 h-25" name="updateme">
                          Modifier
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
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
                      $inscriptionmoraleemail = $_SESSION["moraleemail"];
                      $sql = "Select * from  inscription_personne_morale where 
                      email = '$inscriptionmoraleemail' ORDER BY create_datetime DESC";
                      $result = mysqli_query($con,$sql);
                      $num = mysqli_num_rows($result);
                      if($result){
                        if ($num>0){
                          while($row=mysqli_fetch_assoc($result)) {
                            echo "
                            <div class='col-md-6' id='" . $row["id"] ."'>
                            <button type='button' hidden data-target='date'>" . $row["date"] . "</button>
                            <button type='button' hidden data-target='presence'>" . $row["presence"] . "</button>
                            <button type='button' hidden data-target='format'>" . $row["format"] . "</button>
                            <button
                            tabindex='0'
                            class='btn btn-sm btn-info w-100 h-100'
                            type='button'
                            data-id = '" . $row["id"] ."'
                            data-role='show'

                            >" . $row["code"] ."</button>
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
                        $inscriptionmoraleemail = $_SESSION["moraleemail"];
                        $sql = "Select * from  inscription_personne_morale where 
                        email = '$inscriptionmoraleemail' and approuvement = 'On' ORDER BY create_datetime DESC";
                        $result = mysqli_query($con,$sql);
                        $num = mysqli_num_rows($result);
                        if($result){
                          if ($num>0){
                            while($row=mysqli_fetch_assoc($result)) {
                              echo "
                              <div class='col-md-6' id='" . $row["id"] ."'>
                              <button type='button' hidden data-target='date'>" . $row["date"] . "</button>
                              <button type='button' hidden data-target='presence'>" . $row["presence"] . "</button>
                              <button type='button' hidden data-target='format'>" . $row["format"] . "</button>
                              <button
                              tabindex='0'
                              class='btn btn-sm btn-info w-100 h-100'
                              type='button'
                              data-id = '" . $row["id"] ."'
                              data-role='approuvement'

                              >" . $row["code"] ."</button>
                              </div> ";
                            }
                          }}
                          ?>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>



                <div
                class='modal fade'
                id='aboutModal'
                data-bs-backdrop='static'
                data-bs-keyboard='false'
                tabindex='-1'
                aria-hidden='true'
                >
                <div class='modal-dialog modal-dialog-scrollable'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title'>Historique de votre formation</h5>
                      <button
                      class='btn-close'
                      type='button'
                      data-bs-dismiss='modal'
                      aria-label='Close'
                      ></button>
                    </div>
                    <div class='modal-body'>
                      <form action="#" class="row g-3" method="POST">
                       
                        <h4>Date</h4>
                        <input type="text" id="date" name="date" class="form-control inputs" readonly="readonly">
                        <h4>Etat de presence</h4>
                        <input type="text" id="presence" name="presence" class="form-control inputs" readonly="readonly">
                        <h4>Format</h4>
                        <input type="text" id="format" name="format" class="form-control inputs" readonly="readonly">
                        <input type="hidden" id="id" name="id" class="form-control">
                        <div class='modal-footer'>
                          <button
                          class='btn btn-danger'
                          type='button'
                          data-bs-dismiss='modal'             
                          >
                          Fermer
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            
          </header>
          <main>
            <section
            id="Experience"
            class="
            row
            flex-row
            bg-light
            align-items-center
            justify-content-around
            pb-5
            "
            >
            <div
            class="col-sm-6 mt-5 text-center text-sm-start mb-5"
            style="width: 500px"
            >
            
            <div class="card-body">
              <h5 class="card-title display-3 fw-bold">
                Soyer le Bienvenue !!! Votre Espace
              </h5>
              <p class="card-text text-secondary mt-4" style="text-align: justify; text-justify: inter-word;">
                Vous pouvez ici modifier vos coordonnées, explorer vos inscriptions, s'avoir plus sur notre site, et accéder à notre forum.
              </p>
            </div>
          </div>
          <div class="col-sm-6">
            <div
            class="
            row
            gy-5
            row-cols-1 row-cols-md-2
            text-center text-sm-start
            mx-5 mx-sm-0
            "
            >
            <div class="col">
              <div class="card shadow">
                <div class="card-body">
                  <i class="bi bi-briefcase fs-3 text-danger"></i>
                  <h5 class="card-title">Mes inscriptions</h5>
                  <p class="card-text">
                    Vous pouvez ici explorer l'historique de vos inscriptions.
                  </p>
                  <a
                  class="btn btn-danger"
                  role="button"
                  data-bs-toggle="modal"
                  data-bs-target="#historique"
                  >Historique</a>
                  
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card shadow">
                <div class="card-body">
                  <i class="bi bi-person fs-3 text-danger"></i>
                  <h5 class="card-title">Mes formations réalisées</h5>
                  <p class="card-text">
                    Vous pouvez ici consulter vos formations réalisées.
                  </p>
                  <a
                  class="btn btn-success"
                  role="button"
                  data-bs-toggle="modal"
                  data-bs-target="#approuvement"
                  >Approuvées</a>

                </div>
              </div>
            </div>

            
          </section>

          <section id="Portfolio" class="row mx-5">
            <div class="col-12 mt-5 text-center text-sm-start" style="width: 800px">
              <div class="card-body">
                <h5 class="card-title display-4 fw-bold">
                  Découvrez nos formations.
                </h5>
                <h6 class="card-text text-secondary mt-4" style="width: 600px;text-align: justify; text-justify: inter-word;">
                  Nos formations s’adressent aux apprenant se cherchant à développer leurs compétences ou à obtenir une certification, aux adultes en reconversion, aux managers désireux de comprendre les enjeux du numérique pour faire évoluer leur entreprise.
                </h6>
              </div>
            </div>
            <div class="container mt-4">
              <div class="row">
                <div class="col-12 col-md-6 col-xl-4 mb-4">
                  <div class="card">
                    <div class="badge bg-primary position-absolute mt-3 ms-3">BRNSMART</div>
                    <img class="card-img-top" src="https://source.unsplash.com/m_HRfLhgABo">
                    <div class="card-body">
                      <h3 class="card-title">Développement Informatique</h3>
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
                    <h3 class="card-title">Développemt personnel</h3>
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
                  <h3 class="card-title">Ressources humaines</h3>
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
                <h3 class="card-title">Bureautique</h3>
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
              <h3 class="card-title">Management de projet</h3>
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
</main>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
></script>
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
<script>
  $(document).ready(function() { 
    $('#codes').change(function(){
      var tid = $('#codes').val();

      $.ajax({
        type: 'POST',
        url : 'http://localhost/brnsmart/fetch/',
        data : {id : tid},
        success: function(data)
        {
          $('#shows').html(data);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() { 
    $('#codess').change(function(){
      var tid = $('#codess').val();

      $.ajax({
        type: 'POST',
        url : 'http://localhost/brnsmart/fetch/',
        data : {id : tid},
        success: function(data)
        {
          $('#showss').html(data);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() { 
    $('#codesss').change(function(){
      var tid = $('#codesss').val();

      $.ajax({
        type: 'POST',
        url : 'http://localhost/brnsmart/fetch/',
        data : {id : tid},
        success: function(data)
        {
          $('#showsss').html(data);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() { 
    $('#codessss').change(function(){
      var tid = $('#codessss').val();

      $.ajax({
        type: 'POST',
        url : 'http://localhost/brnsmart/fetch/',
        data : {id : tid},
        success: function(data)
        {
          $('#showssss').html(data);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function () {

    $(document).on('click', '.remove-btn', function () {
      $(this).closest('.main-form').remove();
    });
    
    $(document).on('click', '.add-more-form', function () {
      $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
        <div class="row">\
        <div class="col-md-4">\
        <div class="form-group mb-2">\
        <label for="">Email</label>\
        <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">\
        </div>\
        </div>\
        <div class="col-md-4">\
        <div class="form-group mb-2">\
        <label for="">Nom</label>\
        <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">\
        </div>\
        </div>\
        <div class="col-md-4">\
        <div class="form-group mb-2">\
        <label for="">Prenom</label>\
        <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">\
        </div>\
        </div>\
        <div class="col-md-4">\
        <div class="form-group mb-2">\
        <br>\
        <button type="button" class="remove-btn btn btn-danger">Supprimer</button>\
        </div>\
        </div>\
        </div>\
        </div>');
    });

  });
</script>
<script type="text/javascript">
 
  const btn = document.getElementById('bb');

  btn.addEventListener('click', () => {
    setTimeout(() => {
      const b = document.getElementById('b');
      b.style.display = 'none';
      const bc = document.getElementById('conf');
      bc.style.display = 'none';
      const confirmation = document.getElementById('confirmation');
      confirmation.style.display = 'none';
    }, 1000);
  });
</script> 
<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
<script type="text/javascript">
  function checkPass() {
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('pass1');
            var pass2 = document.getElementById('pass2');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var green = "#bdffbd";
            var red = "#c46a6a";
            //Compare the values in the password field 
            //and the confirmation field
            if (pass1.value == pass2.value) {
                //The passwords match. 
                //Set the color to the good color and inform
                //the user that they have entered the correct password 
                pass2.style.backgroundColor = green;
                message.style.color = '#178511';
                message.innerHTML = "Passwords match."
              } else {
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = red;
                message.style.color = '#85112e';
                message.innerHTML = "mot de passe ne correspondent pas!"
              }
            }
          </script>
          <script type="text/javascript">
            $(document).ready(function() {
              $(".biew").change(function() {
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
            $(document).ready(function() {
              $(".selection").change(function() {
                $(this).find("option:selected").each(function() {
                  var optionValue = $(this).attr("value");
                  if (optionValue) {
                    $(".bo").not("." + optionValue).hide();
                    $("." + optionValue).show();
                  } else {
                    $(".bo").hide();
                  }
                });
              }).change();
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
         <script>
          $('.inputs').mousedown(function(e){
            e.preventDefault();
            $(this).blur();
            return false;
          });
        </script>
      </body>
      </html>

      <?php get_footer();
