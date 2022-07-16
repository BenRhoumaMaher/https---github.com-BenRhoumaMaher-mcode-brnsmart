<?php

/* Template Name: administration_enregistrement Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
?>
<?php
$msg = ''; 
if(isset($_POST['modifier'])){
  $email = $_SESSION["email"];
  $id = $_SESSION["idadmin"];
  $prenom = stripslashes($_REQUEST["prenom"]);
  $prenom = mysqli_real_escape_string($con,$_POST['prenom']);
  $nom = $_REQUEST["nom"];
  $utilisateur = $_REQUEST["utilisateur"];
  $age = $_REQUEST["age"];
  $presentation = $_REQUEST["presentation"];
  $specialite = $_REQUEST["specialite"];
  $telephone = $_REQUEST["telephone"];
  $email = $_REQUEST["email"];
  $adresse = $_REQUEST["adresse"];
  $pays = $_REQUEST["pays"];
  $ville = $_REQUEST["ville"];
  $code_postal = $_REQUEST["code_postal"];

  $mysql = "UPDATE inscription_administrateur SET utilisateur='$utilisateur',age='$age',prenom='$prenom',nom='$nom',specialite='$specialite',adresse='$adresse', telephone='$telephone' ,email='$email' ,pays='$pays' ,ville='$ville' ,code_postal='$code_postal',
  presentation='$presentation' 
  WHERE email = '$email'";
  $res=mysqli_query($con,$mysql);
  if($res){
   header(
    "Location: http://localhost/brnsmart/administration_enregistrement"
  );
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
    $id = $_SESSION["idadmin"];
    $mot_de_passe = stripslashes($_REQUEST["mot_de_passe"]);
    $mot_de_passe = mysqli_real_escape_string($con,$_POST['mot_de_passe']);

//changer mot de passe dans DB par nouveau mot de passe changé ici
    $Hashed_Password = Password_Encryption($mot_de_passe);
    $sql = "UPDATE inscription_administrateur SET mot_de_passe='$Hashed_Password' 
    WHERE id = '$id'";
    $result=mysqli_query($con,$sql);
    if($result){
     header(
      "Location: http://localhost/brnsmart/administration_enregistrement"
    );
   }

 }   

}
?>
<style>
  <?php include "css/main.css"; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BRNSMART TRAINING CENTER</title>
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  rel="stylesheet"
  />
  <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
  <link
  rel="stylesheet"
  href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
  />
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <style>
    .aside {
      width: 330px;
    }
    .main {
      width : 1400px;
      margin-left: 80px;
    }
  </style>
</head>
<body id="bb">
  
  <aside class="sidebar-nav-wrapper aside">
    <div class="navbar-logo">
      <a href="index.html">
        <span class="text">BRNSMART TRAINING CENTER</span>
      </a>
    </div>
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item">
          <span class="icon">
            <i class="uil uil-home"></i>
          </span>
          <span class="text">Acceuil</span>
        </li>
        <span class="divider"><hr /></span>
        <li class="nav-item">
          <span class="text">Gestion des inscriptions</span>
        </li>
        <li class="nav-item">
          <a
          href="http://localhost/brnsmart/table_inscription_stagiaires"
          target ="_blank"
          >
          <span class="icon">
            <i class="uil uil-user"></i>
          </span>
          <span class="text">Personnes physiques</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="http://localhost/brnsmart/table_inscription_personne_morale" 
        target="_blank">
        <span class="icon">
          <i class="uil uil-users-alt"></i>
        </span>
        <span class="text">Personnes morales</span>
      </a>
    </li>
    <li class="nav-item">
      <a
      href="http://localhost/brnsmart/table_inscription_formateur" 
      target="_blank"
      >
      <span class="icon">
        <i class="uil uil-book-reader"></i>
      </span>
      <span class="text">Formateurs</span>
    </a>
  </li>
  <span class="divider"><hr /></span>
  <li class="nav-item">
    <span class="text">Gestion des comptes</span>
  </li>
  <li class="nav-item">
    <a
    href="http://localhost/brnsmart/table_enregistrement_stagiaires" 
    target="_blank" 
    >
    <span class="icon">
      <i class="uil uil-user"></i>
    </span>
    <span class="text">Personnes physiques</span>
  </a>
</li>
<li class="nav-item">
  <a href="http://localhost/brnsmart/table_enregistrement_personne_morale" target="_blank" >
    <span class="icon">
      <i class="uil uil-users-alt"></i>
    </span>
    <span class="text">Personnes morales</span>
  </a>
</li>
<li class="nav-item">
  <a
  href="http://localhost/brnsmart/table_enregistrement_formateur"
  target="_blank"
  >
  <span class="icon">
    <i class="uil uil-book-reader"></i>
  </span>
  <span class="text">Formateurs</span>
</a>
</li>
<span class="divider"><hr /></span>
<li class="nav-item">
  <span class="text">Gestion des formations</span>
</li>
<li class="nav-item">
  <a
  href="http://localhost/brnsmart/table_session/"
  target="_blank"
  >
  <span class="icon">
    <i class="uil uil-bell"></i>
  </span>
  <span class="text">Gestion des sessions</span>
</a>
</li>
<li class="nav-item">
  <a href="http://localhost/brnsmart/table_formation_realisee/"
  target="_blank">
  <span class="icon">
    <i class="uil uil-stopwatch-slash"></i>
  </span>
  <span class="text">Formations réalisées</span>
</a>
</li>
<li class="nav-item">
  <a
  href="http://localhost/brnsmart/table_liste_formation/"
  target="_blank"
  >
  <span class="icon">
    <i class="uil uil-presentation-check"></i>
  </span>
  <span class="text">Liste des formations</span>
</a>
</li>
<li class="nav-item">
  <a
  href="http://localhost/brnsmart/table_calendrier_formation/"
  target="_blank"
  >
  <span class="icon">
    <i class="uil uil-clock-three"></i>
  </span>
  <span class="text">Calendrier</span>
</a>
</li>
<span class="divider"><hr /></span>
<li class="nav-item">
  <span class="text">Gestion financière</span>
</li>
<li class="nav-item">
  <a
  href="http://localhost/brnsmart/table_journal_comptable/"
  target="_blank"
  >
  <span class="icon">
    <i class="uil uil-user"></i>
  </span>
  <span class="text">Journal Comptable</span>
</a>
</li>
<li class="nav-item">
  <a href="invoice.html" target="_blank">
    <span class="icon">
      <i class="uil uil-users-alt"></i>
    </span>
    <span class="text">Table Rubrique</span>
  </a>
</li>
<span class="divider"><hr /></span>
<li class="nav-item">
  <span class="text">Configuration</span>
</li>
<li class="nav-item">
  <a href="http://localhost/brnsmart/deconnexion_administrateur/">
    <span class="icon">
      <i class="uil uil-ban"></i>
    </span>
    <span class="text">Déconnexion</span>
  </a>
</li>
</ul>
</nav>
</aside>
<div class="overlay"></div>
<main class="main-wrapper">
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-6">
        </div>
        <div class="col-lg-7 col-md-7 col-6">
          <div class="header-right">
            <!-- profile start -->
            <div class="profile-box ml-15">
              <button
              class="dropdown-toggle bg-transparent border-0"
              type="button"
              id="profile"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              >
              <div class="profile-info">
                <div class="info">
                  <h6 style="margin-top: 50px"><?php echo $_SESSION["utilisateur"]; ?></h6>
                </div>
                
              </button>
              <div class="text-end dropdown">
                <div data-bs-toggle="dropdown">
                  <img class="rounded-circle  me-2" 
                  src="<?php echo $_SESSION["image"]; ?>" alt="Profile Picture" style="width: 80px; margin-right: 10px">
                </div>
                <ul class="dropdown-menu" style="width: 370px; text-align: center;  height: 500px; margin-left: -250px">
                  <li style="text-align: center;"><b>Gérer Votre Compte BRNSMART</b></li>
                  <li><hr class="dropdown-divider" ></li>
                  <img style="width: 125px; text-align:center;" class="rounded-circle  me-2" 
                  src="<?php echo $_SESSION["image"]; ?>" alt="Profile Picture"/>
                  <h5 class="text-muted mt-2 col-md-11" style="text-align: center;"><?php echo $_SESSION["prenom"]; ?> <?php echo $_SESSION["nom"]; ?></h5>
                  <h5 class="text-muted mt-2 col-md-11" style="text-align:center;"><?php echo $_SESSION["email"]; ?></h5>
                  <li><hr class="dropdown-divider" style="width: 103%"></li>
                  <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#updateModal">
                    <p class="text-primary" style="margin-left: 50px">Modifier mes informations</p></a></li>
                    <li><a class="dropdown-item" href=""  data-bs-toggle="modal" data-bs-target="#update">
                      <p class="text-success" style="margin-left: 65px">Changer mot de passe</p></a></li>
                      <li><hr class="dropdown-divider" style="width: 103%"></li>
                      <li><a class="dropdown-item" href="http://localhost/brnsmart/deconnexion_administrateur/">
                        <p class="text-danger" style="margin-left: 100px">Déconnexion</p></a></li>
                      </ul>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </header>

        
        <br><br>
        <div class="main">
          <section class="section">
            <div class="container-fluid">
              <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                  <div class="col-md-6">
                    <div class="title mb-30">
                      <h2>Inscriptions</h2>
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                  <div class="icon-card mb-30 bg-gradient-danger text-white">
                    <div class="content">
                      <h6 class="mb-10">Inscription Stagiaires</h6>
                      <p class="h4 text-success">
                       <?php 

                       $sql = "SELECT * from inscription_stagiaires";
                       $result = mysqli_query($con,$sql);
                       if($num0 = mysqli_num_rows($result))
                       {
                        echo '<h4 class="text-success">'.$num0.'</h4>';
                      }
                      else 
                      {
                        echo '<h4 class="text-success">Pas d"informations</h4>';
                      }

                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="content">
                    <h6 class="mb-10">Inscription personne morale</h6>
                    <p class="h4 text-success">
                      <?php 

                      $sql = "SELECT * from inscription_personne_morale";
                      $result = mysqli_query($con,$sql);
                      if($num1 = mysqli_num_rows($result))
                      {
                        echo '<h4 class="text-success">'.$num1.'</h4>';
                      }
                      else 
                      {
                        echo '<h4 class="text-success">Pas d"informations</h4>';
                      }

                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                  <div class="content">
                    <h6 class="mb-10">Inscriptions des formateurs</h6>
                    <p class="h4 text-success">
                     <?php 

                     $sql = "SELECT * from inscription_formateur";
                     $result = mysqli_query($con,$sql);
                     if($num2 = mysqli_num_rows($result))
                     {
                      echo '<h4 class="text-success">'.$num2.'</h4>';
                    }
                    else 
                    {
                      echo '<h4 class="text-success">Pas d"informations</h4>';
                    }

                    ?>
                  </p>
                </div>
              </div>
            </div>
          </div>


          
          <canvas id="myChart" style="height: auto; width: fit-content;"></canvas>
          
          <?php 

          echo "<input type='hidden' id='num0' value=".$num0.">";
          echo "<input type='hidden' id='num1' value=".$num1.">";
          echo "<input type='hidden' id='num2' value=".$num2.">";

          ?>

          <hr>

          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title mb-30">
                  <h2>Enregistrements</h2>
                </div>
              </div>
            </div>
            
          </div>
          
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="content">
                  <h6 class="mb-10">Enregistrement Stagiaires</h6>
                  <p class="h4 text-success">
                    <?php 

                    $sql = "SELECT * from enregistrement_stagiaires";
                    $result = mysqli_query($con,$sql);
                    if($num4 = mysqli_num_rows($result))
                    {
                      echo '<h4 class="text-success">'.$num4.'</h4>';
                    }
                    else 
                    {
                      echo '<h4 class="text-success">Pas d"informations</h4>';
                    }

                    ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="content">
                  <h6 class="mb-10">Enregistrement Personnes Morales</h6>
                  <p class="h4 text-success">
                    <?php 

                    $sql = "SELECT * from enregistrement_personne_morale";
                    $result = mysqli_query($con,$sql);
                    if($num5 = mysqli_num_rows($result))
                    {
                      echo '<h4 class="text-success">'.$num5.'</h4>';
                    }
                    else 
                    {
                      echo '<h4 class="text-success">Pas d"informations</h4>';
                    }

                    ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="content">
                  <h6 class="mb-10">Enregistrement des formateurs</h6>
                  <p class="h4 text-success">
                   <?php 

                   $sql = "SELECT * from enregistrement_formateur";
                   $result = mysqli_query($con,$sql);
                   if($num6 = mysqli_num_rows($result))
                   {
                    echo '<h4 class="text-success">'.$num6.'</h4>';
                  }
                  else 
                  {
                    echo '<h4 class="text-success">Pas d"informations</h4>';
                  }

                  ?>
                </p>
              </div>
            </div>
          </div>
        </div>


        <canvas id="myChart1" style="height: auto; width: fit-content;"></canvas>
        
        <?php 

        echo "<input type='hidden' id='num4' value=".$num4.">";
        echo "<input type='hidden' id='num5' value=".$num5.">";
        echo "<input type='hidden' id='num6' value=".$num6.">";

        ?>

        <hr>

        <div class="title-wrapper pt-30">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="title mb-30">
                <h2>Formations</h2>
              </div>
            </div>
          </div>
          
        </div>
        
        <div class="row">
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="content">
                <h6 class="mb-10">Sessions</h6>
                <p class="h4 text-success">
                  <?php 

                  $sql = "SELECT * from session";
                  $result = mysqli_query($con,$sql);
                  if($num7 = mysqli_num_rows($result))
                  {
                    echo '<h4 class="text-success">'.$num7.'</h4>';
                  }
                  else 
                  {
                    echo '<h4 class="text-success">Pas d"informations</h4>';
                  }

                  ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="content">
                <h6 class="mb-10">Les formations réalisées</h6>
                <p class="h4 text-success">
                  <?php 

                  $sql = "SELECT * from inscription_stagiaires";
                  $result = mysqli_query($con,$sql);
                  if($num8 = mysqli_num_rows($result))
                  {
                    echo '<h4 class="text-success">'.$num8.'</h4>';
                  }
                  else 
                  {
                    echo '<h4 class="text-success">Pas d"informations</h4>';
                  }

                  ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="content">
                <h6 class="mb-10">Liste des formations</h6>
                <p class="h4 text-success">
                  <?php 

                  $sql = "SELECT * from liste_formation";
                  $result = mysqli_query($con,$sql);
                  if($num88 = mysqli_num_rows($result))
                  {
                    echo '<h4 class="text-success">'.$num88.'</h4>';
                  }
                  else 
                  {
                    echo '<h4 class="text-success">Pas d"informations</h4>';
                  }

                  ?>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
              <div class="content">
                <h6 class="mb-10">Calendrier</h6>
                <p class="h4 text-success">
                  <?php 

                  $sql = "SELECT * from calendrier_formation";
                  $result = mysqli_query($con,$sql);
                  if($num99 = mysqli_num_rows($result))
                  {
                    echo '<h4 class="text-success">'.$num99.'</h4>';
                  }
                  else 
                  {
                    echo '<h4 class="text-success">Pas d"informations</h4>';
                  }

                  ?>
                </p>
              </div>
            </div>
          </div>

          <canvas id="myChart2" style="height: auto; width: fit-content;"></canvas>
          
          <?php 

          echo "<input type='hidden' id='num7' value=".$num7.">";
          echo "<input type='hidden' id='num8' value=".$num8.">";
          echo "<input type='hidden' id='num88' value=".$num88.">";
          echo "<input type='hidden' id='num99' value=".$num99.">";

          ?>

          



          <canvas id="myChart3" style="height: auto; width: fit-content;"></canvas>
          



        </div> 
      </main>

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
                $email = $_SESSION["email"];
                $sql = "Select * from inscription_administrateur where email = '$email'";
                $result = mysqli_query($con,$sql);
                $num = mysqli_num_rows($result);
                if($result){
                  if ($num>0){
                    while($row=mysqli_fetch_assoc($result)) {
                      ?>
                      <div class="col-md-6">
                        <label class="form-label">Utilisateur:</label>
                        <input type="text" class="form-control" placeholder="Entrer votre nom d'utilisateur" id="utilisateur" name="utilisateur" data-target='utilisateur'
                        value="<?php echo $row["utilisateur"]; ?>"/>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Age:</label
                        ><input type="number" class="form-control" placeholder="Entrer votre age" id="age" name="age" data-target='age' value="<?php echo $row["Age"]; ?>"/>
                      </div>
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
                      <div class="col-md-12">
                        <label class="form-label">Specialité:</label
                        ><input type="text" class="form-control" placeholder="Entrer votre Specialité" name="specialite" value="<?php echo $row["Specialite"]; ?>"/>
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
                        value="<?php echo $row["Telephone"]; ?>"
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
                        value="<?php echo $row["Adresse"]; ?>"
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
                        value="<?php echo $row["Pays"]; ?>"
                        />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Presentation:</label
                        ><textarea
                        class="form-control"
                        id="presentation"
                        name="presentation"
                        data-target='presentation'
                        />
                        <?php echo $row["Presentation"]; ?>
                      </textarea>
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
                      value="<?php echo $row["Ville"]; ?>"
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
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
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
              message.innerHTML = "mot de passe ne correspondent pas!"
            }
          }
        </script>
        <script>
          
          var num0 = document.getElementById("num0").value;
          var num1 = document.getElementById("num1").value;
          var num2 = document.getElementById("num2").value;
          var num4 = document.getElementById("num4").value;
          var num5 = document.getElementById("num5").value;
          var num6 = document.getElementById("num6").value;
          var num7 = document.getElementById("num7").value;
          var num8 = document.getElementById("num8").value;
          var num88 = document.getElementById("num88").value;
          var num99 = document.getElementById("num99").value;

          window.onload = function()
          {
            var randomScalingFactor = function() {
              return Math.round(Math.random() * 100);
            };
            var config = {
              type: 'bar',
              data: {
                borderColor : "#fffff",
                datasets: [{
                  data: [
                  num0,
                  num1,
                  num2
                  ],
                  borderColor : "#fff",
                  borderWidth : "3",
                  hoverBorderColor : "#808080",
                  
                  label: 'Rapport des inscriptions',
                  
                  backgroundColor: [
                  "#FFBD63",
                  "#56d798",
                  "#ff8397"
                  
                  ],
                  hoverBackgroundColor: [
                  "#FFBD63",
                  "#56d798",
                  "#ff8397"
                  ]
                }],
                
                labels: [
                'Personne Morale',
                'Personne Physique',
                'Formateurs'
                ]
              },
              
              options: {
                responsive: true
                
              }
            };

            var ctx = document.getElementById('myChart').getContext('2d');
            window.myPie = new Chart(ctx, config);



            var config = {
              type: 'pie',
              data: {
                borderColor : "#fffff",
                datasets: [{
                  data: [
                  num7,
                  num8,
                  num88,
                  num99
                  ],
                  borderColor : "#fff",
                  borderWidth : "3",
                  hoverBorderColor : "#808080",
                  
                  label: 'Rapport des Formations',
                  
                  backgroundColor: [
                  "#FFBD63",
                  "#56d798",
                  "#ff8397",
                  "#FFC0CB"
                  ],
                  hoverBackgroundColor: [
                  "#FFBD63",
                  "#56d798",
                  "#ff8397",
                  "#FFC0CB"
                  ]
                }],
                
                labels: [
                'Demandes des formations',
                'Formations Réalisées',
                'Liste des formations',
                'Calendrier'
                ]
              },
              
              options: {
                responsive: true
                
              }
            };
            var ctxa = document.getElementById('myChart2').getContext('2d');
            window.myPies = new Chart(ctxa, config);



            var config = {
              type: 'doughnut',
              data: {
                borderColor : "#fffff",
                datasets: [{
                  data: [
                  num4,
                  num5,
                  num6
                  ],
                  borderColor : "#fff",
                  borderWidth : "3",
                  hoverBorderColor : "#808080",
                  
                  label: 'Rapport des enregistrements',
                  
                  backgroundColor: [
                  "#FFBD63",
                  "#56d798",
                  "#ff8397"
                  
                  ],
                  hoverBackgroundColor: [
                  "#FFBD63",
                  "#56d798",
                  "#ff8397"
                  ]
                }],
                
                labels: [
                'Personne Morale',
                'Personne Physique',
                'Formateurs'
                ]
              },
              
              options: {
                responsive: true
                
              }
            };

            var ctxw = document.getElementById('myChart1').getContext('2d');
            window.myPiew = new Chart(ctxw, config);




            


            
            
          };
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
          if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
          }
        </script>
        

      </body>
      </html>

