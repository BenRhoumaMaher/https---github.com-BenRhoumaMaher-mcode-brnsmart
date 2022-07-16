<?php
/* Template Name: formations_personne_morale Page */
get_header(); 
session_start();
ConfirmerConnexionPersonneMorale();
require "db.php";
?>

<?php

$error_date = '';
$error_presence = '';
$conf = '';



if (isset($_REQUEST["enregistrer"])) {
  if (empty($_POST["date"])) {
    $error_date = "<label class='text-danger'>Veuiller sélectionner une date</label>";
}

if (empty($_POST["presence"])) {
    $error_presence = "<label class='text-danger'>Veuiller sélectionner votre état de présence</label>";
}
if ($error_date == '' && $error_presence == '' 
) {
    $code = stripslashes($_REQUEST["code"]);
$code = mysqli_real_escape_string($con, $code);
$date = $_REQUEST["date"];
$presence = $_REQUEST["presence"];
$prenom = $_SESSION["moraleprenom"];
$nom = $_SESSION["moralenom"];
$civilité = $_SESSION["moralecivilité"];
$format = $_REQUEST["format"];
$societe = $_SESSION["moralesociete"];
$fonction = $_SESSION["moralefonction"];
$email = $_SESSION["moraleemail"];
$adresse =$_SESSION["moraleadresse"];
$telephone = $_SESSION["moraletelephone"];
$code_postal = $_SESSION["moralecode_postal"];
$pays = $_SESSION["moralepays"];
$ville = $_SESSION["moraleville"];
$create_datetime = date("Y-m-d H:i:s");
$query = "INSERT into `inscription_personne_morale` (code,date,presence,format, civilité,prénom,nom,email,telephone,societe,fonction,adresse,ville,code_postal,pays,approuvement, create_datetime)
VALUES ( '$code','$date', '$presence','$format',
  '$civilité','$prénom','$nom','$email',
  '$telephone', '$societe','$fonction','$adresse',
  '$ville','$code_postal','$pays','off',
  '$create_datetime')";
$result = mysqli_query($con, $query);    


$emails = $_POST['emails'];
$noms = $_POST['noms'];
$prenoms = $_POST['prenoms'];             

foreach($emails as $index => $emails)
{
    $s_email = $emails;
    $s_noms = $noms[$index];
    $s_prenoms = $prenoms[$index];

    $query1 = "INSERT INTO  `inscription_stagiaires` (code,date,presence,format,civilité,prénom,nom,entreprise,email,telephone,adresse,ville,code_postal,pays,approuvement, create_datetime)
    VALUES ('$code','$date','$presence','$format',
        '$civilité','$s_prenoms','$s_noms','$societe','$s_email','$telephone', '$adresse',
        '$ville','$code_postal','$pays','Off',
        '$create_datetime')";
    $queryss = mysqli_query($con, $query1);
}             
if ($result) {
  if ($queryss){ 
      require_once "phpmailer/PHPMailerAutoload.php";
      $mail = new PHPMailer();

      $mail->CharSet = "utf-8"; 
      $mail->IsSMTP(); //
      $mail->SMTPAuth = true;
      $mail->Username = "ddev7546@gmail.com";
      $mail->Password = "dev0000.";
      $mail->SMTPSecure = "ssl";
      $mail->Host = "smtp.gmail.com";
      $mail->Port = "465";

      
      $mail->From = "ddev7546@gmail.com";
      $mail->FromName = "BRNSMART";
      $mail->AddAddress($_SESSION["moraleemail"], $_SESSION["moralenom"]);
      $mail->Subject = "Confirmation d'inscription";
      $mail->IsHTML(true);
      $mail->Body = "Bienvenue";
      if ($mail->Send()) {
       $conf = "<label class='text-primary'>Votre inscription a été bien transmise !!!</label>";
   }
}
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
        #informatique, #personnel, #ressources, #bureautique, #management{
            margin-top: 20px;
            margin-left: 250px;
        }
        .bo {
          display: none;
          margin-top: 30px;
          margin-bottom: 30px;
      }
      .bo {
          overflow: hidden;
      }
      .bo .col1,
      .bo .col2 {
          width: 49%;
      }
      .bo .col1 {
          float: left;
      }
      .bo .col2 {
          float: right;
      }
      .bo label {
          display: block;
      }
  </style>
</head>
<body>

    <!-- Cycle Informatique -->
    <div class="modal fade" id="informatique" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Envoyer votre demande</h5>
              <button
              class='btn-close'
              type='button'
              data-bs-dismiss='modal'
              aria-label='Close'
              ></button>
          </div>
          <div class="modal-body">
              <form  class="row g-3" method="POST">
                <label class="form-label">Formation:</label>
                <select class="form-select"  id="code" name="code" >
                  <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
                  <?php 
                  $sql = "Select * from liste_formation LIMIT 6";
                  $result = mysqli_query($con,$sql);
                  $num = mysqli_num_rows($result);
                  if($result){
                    if ($num>0){
                        while($row=mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row["id_formation"]; ?>" >
                                <?php $vall = $row["code_formation"]?> 
                                <?php echo $vall ?>
                            </option>
                            <?php 
                        }}}
                        ?>
                    </select>
                    <div class="col-md-12">
                        <label class="form-label">Date:</label>
                        <select class="form-select" name="date" id="show">
                            <option value="" disabled selected hidden>Veuiller choisir une date</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                      <label class="form-label">Presence:</label>
                      <select name="presence" class="form-select biew">
                          <option value="" disabled selected hidden>- selectionner ici -</option>
                          <option value="presenciel">En presence</option>
                          <option value="a distance">À distance</option>
                      </select>
                      <?php echo $error_presence; ?>
                  </div>

                  <div class="col-md-12 presenciel boxx">
                      <label class="form-label ">Format:</label>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="format" value="Inter" >
                          <label class="form-check-label" for="flexRadioDefault1">
                            Inter
                        </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="format" value="Intra">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Intra
                    </label>
                </div>
            </div>

            <div class="contains">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Participants Entreprise
                                    <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Ajouter</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="main-form mt-3 border-bottom">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label for="">Email</label>
                                                <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label for="">Nom</label>
                                                <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label for="">Prenom</label>
                                                <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="paste-new-forms"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <div  class="modal fade" id="confirm" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous confirmer votre inscription?</p>
                            <p class="text-secondary"><small>Si vous ne le souhaitez pas, cliquez sur le bouton d’annulation</small></p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"  name="enregistrer">Confirmer</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <a
                href="#"
                class="btn btn-danger"
                role="button"
                data-bs-toggle="modal"
                data-bs-target="#confirm"
                >S'inscrire</a>
                <a
                href="http://localhost/brnsmart/developpement-informatique/"
                target="_blank"
                class="btn btn-info col-4"
                role="button"
                >S'avoir+</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>


<div class="modal fade" id="personnel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Envoyer votre demande</div>
          <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <form  class="row g-3" method="POST">
            <label class="form-label">Formation:</label>
            <select class="form-select"  id="codes" name="code" >
              <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
              <?php 
              $sql = "Select * from liste_formation LIMIT 6, 3";
              $result = mysqli_query($con,$sql);
              $num = mysqli_num_rows($result);
              if($result){
                if ($num>0){
                    while($row=mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row["id_formation"]; ?>" >
                            <?php $vall = $row["code_formation"]?> 
                            <?php echo $vall ?>
                        </option>
                        <?php 
                    }}}
                    ?>
                </select>
                <div class="col-md-12">
                    <label class="form-label">Date:</label>
                    <select class="form-select" name="date" id="shows">
                        <option value="" disabled selected hidden>Veuiller choisir une date</option>
                    </select>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Presence:</label>
                  <select name="presence" class="form-select biew">
                      <option value="" disabled selected hidden>- selectionner ici -</option>
                      <option value="presenciel">En presence</option>
                      <option value="a distance">À distance</option>
                  </select>
                  <?php echo $error_presence; ?>
              </div>

              <div class="col-md-12 presenciel boxx">
                  <label class="form-label ">Format:</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="format" value="Inter" >
                      <label class="form-check-label" for="flexRadioDefault1">
                        Inter
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="format" value="Intra">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Intra
                </label>
            </div>
        </div>

        <div class="contains">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Participants Entreprise
                                <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Ajouter</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Email</label>
                                            <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Nom</label>
                                            <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Prenom</label>
                                            <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div  class="modal fade" id="confirmphp" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous confirmer votre inscription?</p>
                        <p class="text-secondary"><small>Si vous ne le souhaitez pas, cliquez sur le bouton d’annulation</small></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"  name="enregistrer">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a
            href="#"
            class="btn btn-danger"
            role="button"
            data-bs-toggle="modal"
            data-bs-target="#confirmphp"
            >S'inscrire</a>
            <a
            href="http://localhost/brnsmart/developpement-personnel/"
            target="_blank"
            class="btn btn-info col-4"
            role="button"
            >S'avoir+</a>
        </div>
    </form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="ressources" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Envoyer votre demande</div>
          <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <form  class="row g-3" method="POST">
           <label class="form-label">Formation:</label>
           <select class="form-select"  id="codess" name="code" >
            <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
            <?php 
            $sql = "Select * from liste_formation LIMIT 9, 5";
            $result = mysqli_query($con,$sql);
            $num = mysqli_num_rows($result);
            if($result){
              if ($num>0){
                  while($row=mysqli_fetch_assoc($result)) {
                      ?>
                      <option value="<?php echo $row["id_formation"]; ?>" >
                          <?php $vall = $row["code_formation"]?> 
                          <?php echo $vall ?>
                      </option>
                      <?php 
                  }}}
                  ?>
              </select>
              <div class="col-md-12">
                <label class="form-label">Date:</label>
                <select name="date" class="form-select" id="showss">
                    <option value="" disabled selected hidden>- selectionner ici -</option>
                </select>
                <?php echo $error_date; ?>
            </div>

            <div class="col-md-12">
              <label class="form-label">Presence:</label>
              <select name="presence" class="form-select biew">
                  <option value="" disabled selected hidden>- selectionner ici -</option>
                  <option value="presenciel">En presence</option>
                  <option value="a distance">À distance</option>
              </select>
              <?php echo $error_presence; ?>
          </div>

          <div class="col-md-12 presenciel boxx">
              <label class="form-label ">Format:</label>
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="format" value="Inter" >
                  <label class="form-check-label" for="flexRadioDefault1">
                    Inter
                </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="format" value="Intra">
              <label class="form-check-label" for="flexRadioDefault2">
                Intra
            </label>
        </div>
    </div>

    <div class="contains">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Participants Entreprise
                            <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Ajouter</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="main-form mt-3 border-bottom">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Email</label>
                                        <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Nom</label>
                                        <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Prenom</label>
                                        <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="paste-new-forms"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div  class="modal fade" id="confirmmysql" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous confirmer votre inscription?</p>
                    <p class="text-secondary"><small>Si vous ne le souhaitez pas, cliquez sur le bouton d’annulation</small></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"  name="enregistrer">Confirmer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <a
        href="#"
        class="btn btn-danger"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#confirmmysql"
        >S'inscrire</a>
        <a
        href="http://localhost/brnsmart/ressources-humaines/"
        target="_blank"
        class="btn btn-info col-4"
        role="button"
        >S'avoir+</a>
    </div>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="bureautique" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Envoyer votre demande</div>
          <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <form  class="row g-3" method="POST">
            <label class="form-label">Formation:</label>
            <select class="form-select"  id="codesss" name="code" >
              <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
              <?php 
              $sql = "Select * from liste_formation LIMIT 14, 6";
              $result = mysqli_query($con,$sql);
              $num = mysqli_num_rows($result);
              if($result){
                if ($num>0){
                    while($row=mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row["id_formation"]; ?>" >
                            <?php $vall = $row["code_formation"]?> 
                            <?php echo $vall ?>
                        </option>
                        <?php 
                    }}}
                    ?>
                </select>
                <div class="col-md-12">
                  <label class="form-label">Date:</label>
                  <select name="date" class="form-select" id="showsss">
                      <option value="" disabled selected hidden>- selectionner ici -</option>
                  </select>
                  <?php echo $error_date; ?>
              </div>

              <div class="col-md-12">
                  <label class="form-label">Presence:</label>
                  <select name="presence" class="form-select biew">
                      <option value="" disabled selected hidden>- selectionner ici -</option>
                      <option value="presenciel">En presence</option>
                      <option value="a distance">À distance</option>
                  </select>
                  <?php echo $error_presence; ?>
              </div>

              <div class="col-md-12 presenciel boxx">
                  <label class="form-label ">Format:</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="format" value="Inter" >
                      <label class="form-check-label" for="flexRadioDefault1">
                        Inter
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="format" value="Intra">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Intra
                </label>
            </div>
        </div>

        <div class="contains">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Participants Entreprise
                                <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Ajouter</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Email</label>
                                            <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Nom</label>
                                            <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Prenom</label>
                                            <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div  class="modal fade" id="confirmangular" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous confirmer votre inscription?</p>
                        <p class="text-secondary"><small>Si vous ne le souhaitez pas, cliquez sur le bouton d’annulation</small></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"  name="enregistrer">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a
            href="#"
            class="btn btn-danger"
            role="button"
            data-bs-toggle="modal"
            data-bs-target="#confirmangular"
            >S'inscrire</a>
            <a
            href="http://localhost/brnsmart/bureautique/"
            target="_blank"
            class="btn btn-info col-4"
            role="button"
            >S'avoir+</a>
        </div>
    </form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="management" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Envoyer votre demande</div>
          <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <form  class="row g-3" method="POST">
            <label class="form-label">Formation:</label>
            <select class="form-select"  id="codessss" name="code" >
              <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
              <?php 
              $sql = "Select * from liste_formation LIMIT 20, 9";
              $result = mysqli_query($con,$sql);
              $num = mysqli_num_rows($result);
              if($result){
                if ($num>0){
                    while($row=mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row["id_formation"]; ?>" >
                            <?php $vall = $row["code_formation"]?> 
                            <?php echo $vall ?>
                        </option>
                        <?php 
                    }}}
                    ?>
                </select>
                <div class="col-md-12">
                  <label class="form-label">Date:</label>
                  <select name="date" class="form-select" id="showssss">
                      <option value="" disabled selected hidden>- selectionner ici -</option>
                  </select>
                  <?php echo $error_date; ?>
              </div>

              <div class="col-md-12">
                  <label class="form-label">Presence:</label>
                  <select name="presence" class="form-select biew">
                      <option value="" disabled selected hidden>- selectionner ici -</option>
                      <option value="presenciel">En presence</option>
                      <option value="a distance">À distance</option>
                  </select>
                  <?php echo $error_presence; ?>
              </div>

              <div class="col-md-12 presenciel boxx">
                  <label class="form-label ">Format:</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="format" value="Inter" >
                      <label class="form-check-label" for="flexRadioDefault1">
                        Inter
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="format" value="Intra">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Intra
                </label>
            </div>
        </div>

        <div class="contains">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Participants Entreprise
                                <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Ajouter</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Email</label>
                                            <input type="text" name="emails[]" class="form-control" required placeholder="Entrer email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Nom</label>
                                            <input type="text" name="noms[]" class="form-control" required placeholder="Entrer nom">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="">Prenom</label>
                                            <input type="text" name="prenoms[]" class="form-control" required placeholder="Entrer prenom">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="paste-new-forms"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <div  class="modal fade" id="confirmjavascript" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous confirmer votre inscription?</p>
                        <p class="text-secondary"><small>Si vous ne le souhaitez pas, cliquez sur le bouton d’annulation</small></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"  name="enregistrer">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a
            href="#"
            class="btn btn-danger"
            role="button"
            data-bs-toggle="modal"
            data-bs-target="#confirmjavascript"
            >S'inscrire</a>
            <a
            href="http://localhost/brnsmart/management-de-projet/"
            target="_blank"
            class="btn btn-info col-4"
            role="button"
            >S'avoir+</a>
        </div>
    </form>
</div>
</div>
</div>
</div>

</body>
</html>