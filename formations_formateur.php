<?php
/* Template Name: formations_formateur Page */
get_header(); 
session_start();
ConfirmerConnexionFormateur();
require "db.php";
?>

<?php
$confirmation = '';
$error_code = '';
$error_nbr_jour = '';
$error_message = '';
$error_tarif = '';
$error_experience = '';
$error_cv = '';
$cv = '';
const UploadKey = 'cv';
if (isset($_REQUEST["enregistrer"])) {

  if(empty($_POST["code"]))
  {
    $error_code = "<label class='text-danger'>Veuiller indiquer votre formation</label>";
  }
  if(!strlen(trim($_POST["experience"])))
  {
    $error_experience = "<label class='text-danger'>Veuiller indiquer votre experience</label>";
  }
  if(empty($_FILES[UploadKey]['type']))
  {
    $error_cv = "<label class='text-danger'>Veuiller indiquer votre cv</label>";
  }
  if(empty($_POST["tarif"]))
  {
    $error_tarif = "<label class='text-danger'>Veuiller indiquer votre tarif</label>";
  }
  else 
  {
    $tarif = trim($_POST["tarif"]);
  }
  if(empty($_POST["nbr_jour"]))
  {
    $error_nbr_jour = "<label class='text-danger'>Veuiller indiquer votre nbr de jours</label>";
  }
  else 
  {
    $nbr_jour = trim($_POST["nbr_jour"]);
  }
  if(!strlen(trim($_POST["message"])))
  {
    $error_message = "<label class='text-danger'>Veuiller indiquer votre message</label>";
  }
  else 
  {
    $message = trim($_POST["message"]);
  }
  if ($error_code == '' && $error_experience == ''
    && $error_tarif == '' && $error_nbr_jour == ''
    && $error_message == '' && $error_cv == '')
  {
    $code = stripslashes($_REQUEST["code"]);
    $code = mysqli_real_escape_string($con, $code);
    $experience = stripslashes($_REQUEST['experience']);
    $experience = mysqli_real_escape_string($con, $experience);
    $cv = $_FILES['cv']['name'];
    $destination = 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\uploads/' .$cv;
    $extension = pathinfo($cv, PATHINFO_EXTENSION);
    $file = $_FILES['cv']['tmp_name'];
    $size = $_FILES['cv']['size'];
    $tarif = stripslashes($_REQUEST['tarif']);
    $tarif = mysqli_real_escape_string($con,$tarif);
    $nbr_jour = stripslashes($_REQUEST['nbr_jour']);
    $nbr_jour = mysqli_real_escape_string($con,$nbr_jour);
    $message = stripslashes($_REQUEST['message']);
    $message = mysqli_real_escape_string($con,$message);
    $prenom = $_SESSION["formateurprenom"];
    $nom = $_SESSION["formateurnom"];
    $email = $_SESSION["formateuremail"];
    $telephone = $_SESSION["formateurtelephone"];
    $create_datetime = date("Y-m-d H:i:s");

    if(move_uploaded_file($file, $destination)){
      $query = "INSERT into `inscription_formateur` (prenom,nom,email,telephone,formation,cv,size,
        experience,tarif,nbr_jour,message,create_datetime)
      VALUES ('$prenom','$nom','$email','$telephone','$code','$cv','$size',
        '$experience',
        '$tarif','$nbr_jour','$message',
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
      $mail->AddAddress($_SESSION["formateuremail"], $_SESSION["formateurnom"]);
      $mail->Subject = "Confirmation d'inscription";
      $mail->IsHTML(true);
      $mail->Body = "Bienvenue";


      if ($mail->Send()) {
       $confirmation = "<label class='text-primary'>Votre inscription a été bien transmise !!!</label>";
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
      margin-top: 5px;
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
          <form  class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-12">
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
                      <option value="<?php echo $row["code_formation"]; ?>" >
                        <?php $vall = $row["code_formation"]?> 
                        <?php echo $vall ?>
                      </option>
                      <?php 
                    }}}
                    ?>
                  </select>
                </div>
                <!-- on utilise echo ici pour afficher le message d'erreur de data-->
                <?php echo $error_code; ?>
                <div class="col-md-12">
                  <label class="form-label">CV:</label>
                  <input  type="file" class="form-select" name="cv" accept=".pdf">  
                </div>
                <?php echo $error_cv; ?>
                <div class="col-md-12">
                  <label class="form-label">Experience:</label>
                  <textarea  name="experience">  
                  </textarea>
                  <?php echo $error_experience; ?>
                </div>
                <div class="col-md-12">
                  <label class="form-label">Tarif:</label>
                  <input  type="number" class="form-select" name="tarif">  
                  <?php echo $error_tarif; ?>
                </div>
                <div class="col-md-12">
                  <label class="form-label">Nbr de jours:</label>
                  <input  type="number" class="form-select" name="nbr_jour"> 
                  <?php echo $error_nbr_jour; ?> 
                </div>
                <div class="col-md-12">
                  <label class="form-label">Message:</label>
                  <textarea  name="message">  
                  </textarea>
                  <?php echo $error_message; ?>
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
              <form  class="row g-3" method="POST" enctype="multipart/form-data">
                <div class="col-md-12">
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
                          <option value="<?php echo $row["code_formation"]; ?>" >
                            <?php $vall = $row["code_formation"]?> 
                            <?php echo $vall ?>
                          </option>
                          <?php 
                        }}}
                        ?>
                      </select>
                    </div>

                    <?php echo $error_code; ?>
                    <div class="col-md-12">
                      <label class="form-label">CV:</label>
                      <input  type="file" class="form-select" name="cv" accept=".pdf">  
                    </div>
                    <?php echo $error_cv; ?>
                    <div class="col-md-12">
                      <label class="form-label">Experience:</label>
                      <textarea  name="experience">  
                      </textarea>
                      <?php echo $error_experience; ?>
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">tarif:</label>
                      <input  type="number" class="form-select" name="tarif">  
                      <?php echo $error_tarif; ?>
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Nbr de jours:</label>
                      <input  type="number" class="form-select" name="nbr_jour"> 
                      <?php echo $error_nbr_jour; ?> 
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Message:</label>
                      <textarea  name="message">  
                      </textarea>
                      <?php echo $error_message; ?>
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
                  <form  class="row g-3" method="POST" enctype="multipart/form-data">
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
                              <option value="<?php echo $row["code_formation"]; ?>" >
                                <?php $vall = $row["code_formation"]?> 
                                <?php echo $vall ?>
                              </option>
                              <?php 
                            }}}
                            ?>
                          </select>
                        </div>
                        <?php echo $error_code; ?>
                        <div class="col-md-12">
                          <label class="form-label">CV:</label>
                          <input  type="file" class="form-select" name="cv" accept=".pdf">  
                        </div>
                        <?php echo $error_cv; ?>
                        <div class="col-md-12">
                          <label class="form-label">Experience:</label>
                          <textarea  name="experience">  
                          </textarea>
                          <?php echo $error_experience; ?>
                        </div>
                        <div class="col-md-12">
                          <label class="form-label">Tarif:</label>
                          <input  type="number" class="form-select" name="tarif">  
                          <?php echo $error_tarif; ?>
                        </div>
                        <div class="col-md-12">
                          <label class="form-label">Nbr de jours:</label>
                          <input  type="number" class="form-select" name="nbr_jour"> 
                          <?php echo $error_nbr_jour; ?> 
                        </div>
                        <div class="col-md-12">
                          <label class="form-label">Message:</label>
                          <textarea  name="message">  
                          </textarea>
                          <?php echo $error_message; ?>
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
                      <form  class="row g-3" method="POST" enctype="multipart/form-data">
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
                                  <option value="<?php echo $row["code_formation"]; ?>" >
                                    <?php $vall = $row["code_formation"]?> 
                                    <?php echo $vall ?>
                                  </option>
                                  <?php 
                                }}}
                                ?>
                              </select>
                            </div>
                            <?php echo $error_code; ?>
                            <div class="col-md-12">
                              <label class="form-label">CV:</label>
                              <input  type="file" class="form-select" name="cv" accept=".pdf"> 
                            </div>
                            <?php echo $error_cv; ?>
                            <div class="col-md-12">
                              <label class="form-label">Experience:</label>
                              <textarea  name="experience">  
                              </textarea>
                              <?php echo $error_experience; ?>
                            </div>
                            <div class="col-md-12">
                              <label class="form-label">Tarif:</label>
                              <input  type="number" class="form-select" name="tarif">  
                              <?php echo $error_tarif; ?>
                            </div>
                            <div class="col-md-12">
                              <label class="form-label">Nbr de jours:</label>
                              <input  type="number" class="form-select" name="nbr_jour"> 
                              <?php echo $error_nbr_jour; ?> 
                            </div>
                            <div class="col-md-12">
                              <label class="form-label">Message:</label>
                              <textarea  name="message">  
                              </textarea>
                              <?php echo $error_message; ?>
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
                          <form  class="row g-3" method="POST" enctype="multipart/form-data">
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
                                      <option value="<?php echo $row["code_formation"]; ?>" >
                                        <?php $vall = $row["code_formation"]?> 
                                        <?php echo $vall ?>
                                      </option>
                                      <?php 
                                    }}}
                                    ?>
                                  </select>
                                </div>
                                <?php echo $error_code; ?>
                                <div class="col-md-12">
                                  <label class="form-label">CV:</label>
                                  <input  type="file" class="form-select" name="cv" accept=".pdf">  
                                </div>
                                <?php echo $error_cv; ?>
                                <div class="col-md-12">
                                  <label class="form-label">Experience:</label>
                                  <textarea  name="experience">  
                                  </textarea>
                                  <?php echo $error_experience; ?>
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label">Tarif:</label>
                                  <input  type="number" class="form-select" name="tarif">  
                                  <?php echo $error_tarif; ?>
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label">Nbr de jours:</label>
                                  <input  type="number" class="form-select" name="nbr_jour"> 
                                  <?php echo $error_nbr_jour; ?> 
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label">Message:</label>
                                  <textarea  name="message">  
                                  </textarea>
                                  <?php echo $error_message; ?>
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