<?php
/* Template Name: formations_stagiaires Page */
get_header(); 
session_start();
ConfirmerConnexionStagiaires();
error_reporting(0);
require "db.php";
?>

<?php
$error_date = '';
$error_presence = '';
$error_civilité = '';
$confirmation = '';

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
  $format = $_REQUEST["format"];
  $prenom = $_SESSION["stagiaireprenom"];
  $nom = $_SESSION["stagiairenom"];
  $email = $_SESSION["stagiaireemail"];
  $adresse = $_SESSION["stagiaireadresse"];
  $telephone = $_SESSION["stagiairetelephone"];
  $civilité = $_SESSION["stagiairecivilité"];
  $code_postal = $_SESSION["stagiairecode_postal"];
  $pays = $_SESSION["stagiairepays"];
  $ville = $_SESSION["stagiaireville"];
  $create_datetime = date("Y-m-d H:i:s");
  $query = "INSERT into `inscription_stagiaires` (code,date,presence,format,civilité,prénom,nom,email,telephone,adresse,ville,code_postal,pays,approuvement,create_datetime)
  VALUES ('$code','$date','$presence','$format',
    '$civilité','$prenom','$nom','$email','$telephone','$adresse',
    '$ville','$code_postal','$pays','Off',
    '$create_datetime')";
  $result = mysqli_query($con, $query);
  if ($result) {
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
      $mail->AddAddress($_SESSION["stagiaireemail"], $_SESSION["stagiairenom"]);
      $mail->Subject = "Confirmation d'inscription";
      $mail->IsHTML(true);
      $mail->Body = "Bienvenue";
      if ($mail->Send()) {
       $confirmation = "<label class='text-primary'>Votre inscription a été bien transmise !!!</label>";
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
      margin-top: 90px;
      margin-left: 250px;
    }
  </style>
</head>
<body>

  <!-- Cycle Informatique -->
  <div class="modal fade" id="informatique" aria-hidden="true">
    <div class="modal-dialog">
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
                <?php echo $error_code; ?>
                <br>
                <br>
              </label>
              <label class="form-label">Date:</label>
              <select class="form-select" name="date" id="show">
                <option value="" disabled selected hidden>Veuiller choisir une date</option>
              </select>

              <div class="col-md-12">
                <label class="form-label">Presence:</label>
                <select name="presence" class="form-select">
                  <option value="" disabled selected hidden>- selectionner ici -</option>
                  <option value="presenciel">En presenciel</option>
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
                >S'inscrire</a
                >
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
                $sql = "Select * from liste_formation LIMIT 6, 3 ";
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
                  <!-- on utilise echo ici pour afficher le message d'erreur de data-->
                  <?php echo $error_code; ?>
                  <br>
                  <br>
                </label>
                <label class="form-label">Date:</label>
                <select class="form-select" name="date" id="shows">
                  <option value="" disabled selected hidden>Veuiller choisir une date</option>
                </select>

                <div class="col-md-12">
                  <label class="form-label">Presence:</label>
                  <select name="presence" class="form-select">
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
                        <button class="btn btn-primary" name="enregistrer">Confirmer</button>
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
                  >S'inscrire</a
                  >
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
                <div class="col-md-12">
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
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Date:</label>
                      <select name="date" class="form-select" id="showss">
                        <option value="" disabled selected hidden>- selectionner ici -</option>
                      </select>
                      <?php echo $error_date; ?>
                    </div>

                    <div class="col-md-12">
                      <label class="form-label">Presence:</label>
                      <select name="presence" class="form-select">
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

                    <div  class="modal fade" id="confirmressources" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
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
                            <button class="btn btn-primary" name="enregistrer">Confirmer</button>
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
                      data-bs-target="#confirmressources"
                      >S'inscrire</a
                      >
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
                    <div class="col-md-12">
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
                        </div>
                        <div class="col-md-12">
                          <label class="form-label">Date:</label>
                          <select name="date" class="form-select" id="showsss">
                            <option value="" disabled selected hidden>- selectionner ici -</option>
                          </select>
                          <?php echo $error_date; ?>
                        </div>

                        <div class="col-md-12">
                          <label class="form-label">Presence:</label>
                          <select name="presence" class="form-select">
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

                        <div  class="modal fade" id="confirmbureautique" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
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
                                <button class="btn btn-primary" name="enregistrer">Confirmer</button>
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
                          data-bs-target="#confirmbureautique"
                          >S'inscrire</a
                          >
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
                        <div class="col-md-12">
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
                            </div>
                            <div class="col-md-12">
                              <label class="form-label">Date:</label>
                              <select name="date" class="form-select" id="showssss">
                                <option value="" disabled selected hidden>- selectionner ici -</option>
                              </select>
                              <?php echo $error_date; ?>
                            </div>

                            <div class="col-md-12">
                              <label class="form-label">Presence:</label>
                              <select name="presence" class="form-select">
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


                            <div  class="modal fade" id="confirmmanagement" tabindex="-1" style="margin-left: -300px; margin-top: 100px">
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
                                    <button class="btn btn-primary" name="enregistrer">Confirmer</button>
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
                              data-bs-target="#confirmmanagement"
                              >S'inscrire</a
                              >
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