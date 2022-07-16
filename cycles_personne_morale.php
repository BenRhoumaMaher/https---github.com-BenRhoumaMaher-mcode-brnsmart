<?php
/* Template Name: cycles_personne_morale Page */
session_start();
get_header(); 
ConfirmerConnexionPersonneMorale();
require "formations_personne_morale.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
  crossorigin="anonymous"
  />
  <title></title>
  <style>
   #informatiquea, #personnela, #ressourcesa, #bureautiquea, #managementa {
    margin-top: 100px;
    margin-left: -450px;
  }     
</style>
</head>
<body>

  <!-- Cycle Informatique -->
  <div class="modal fade" id="informatiquea" 
  tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Découvrir tous les formations</h5>
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
          <button
          class="btn btn btn-danger col-md-12"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#php"
          >php
        </button>
      </div>
      <div class="col-md-6">
        <button
        class="btn btn btn-primary col-md-12"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#mysql"
        >mysql
      </button>
    </div>
    <div class="col-md-6">
      <button
      class="btn btn btn-info col-md-12"
      type="button"
      data-bs-toggle="modal"
      data-bs-target="#angular"
      >angular
    </button>
  </div>
  <div class="col-md-6">
    <button
    class="btn btn btn-success col-md-12"
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#javascript"
    >javascript
  </button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-warning col-md-12"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#react"
  >react
</button>
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


<!-- Cycle Personnel -->
<div class="modal fade" id="personnela" tabindex="-1" aria-hidden="true">
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
            class="btn btn-warning btn-sm"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#Gestion_du_temps_en_entreprise"
            >Gestion du temps en entreprise
          </button>
        </div>
        <div class="col-md-6">
          <button
          class="btn btn btn-info btn-sm"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#Gestion_des_clients_difficiles_et_des_conflits"
          >Gestion des clients difficiles et des conflits
        </button>
      </div>
      <div class="">
        <button
        class="btn btn btn-danger  w-100	h-100"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#Communication_interpersonnele_et_intelligence_émotionnelle">
        Communication interpersonnele et intelligence émotionnelle
      </button>
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
<!-- Cycle Ressources -->
<div class="modal fade" id="ressourcesa" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Découvrir tous les formations</div>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form  class="row g-3" method="POST">
          <div class="">
            <button
            class="btn btn btn-warning w-100 h-100"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#Gestion_prévisionnelle_des_emplois_et_compétences"
            >Gestion prévisionnelle des emplois et compétences
          </button>
        </div>
        <div class="col-md-6">
          <button
          class="btn btn btn-info h-100 w-100"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#Gestion_des_carrières"
          >Gestion des carrières
        </button>
      </div>
      <div class="col-md-6">
        <button
        class="btn btn btn-danger"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#Techniques_dévolution_des_personnels"
        >Techniques d'évolution des personnels
      </button>
    </div>
    <div class="col-md-6">
     <button
     class="btn btn btn-success col-md-12"
     type="button"
     data-bs-toggle="modal"
     data-bs-target="#Lessentiel_du_droit_du_travail"
     >L'essentiel du droit du travail
   </button>
 </div>
 <div class="col-md-6">
  <button
  class="btn btn btn-primary col-md-12"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Identification_des_besoins_en_formation "
  >Identification des besoins en formation
</button> 
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
<!-- Cycle Bureautique -->
<div class="modal fade" id="bureautiquea" tabindex="-1" aria-hidden="true">
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
            data-bs-target="#Word"
            >Word
          </button>
        </div>
        <div class="col-md-6">
         <button
         class="btn btn btn-info col-md-12"
         type="button"
         data-bs-toggle="modal"
         data-bs-target="#Powerpoint"
         >Powerpoint
       </button> 
     </div>
     <div class="col-md-6">
       <button
       class="btn btn btn-success col-md-12"
       type="button"
       data-bs-toggle="modal"
       data-bs-target="#Excel"
       >Excel
     </button> 
   </div>
   <div class="col-md-6">
    <button
    class="btn btn btn-danger col-md-12"
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#Outlook"
    >Outlook
  </button> 
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-primary col-md-12"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Access"
  >Access
</button> 
</div>
<div class="col-md-6">
 <button
 class="btn btn btn-warning col-md-12"
 type="button"
 data-bs-toggle="modal"
 data-bs-target="#OneNote"
 >OneNote
</button> 
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
<!-- Cycle Management -->
<div class="modal fade" id="managementa" tabindex="-1" aria-hidden="true">
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
            class="btn btn btn-warning w-100 h-100"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#Leadership"
            >Leadership
          </button>
        </div>
        <div class="col-md-6">
          <button
          class="btn btn btn-primary w-100 h-100"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#Gestion_de_projet"
          >Gestion de projet
        </button>
      </div>
      <div class="col-md-6">
       <button
       class="btn btn btn-success w-100 h-100"
       type="button"
       data-bs-toggle="modal"
       data-bs-target="#Risk_management"
       >Risk management
     </button>
   </div>
   <div class="col-md-6">
    <button
    class="btn btn btn-danger w-100 h-100"
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#Management_déquipe_projet"
    >Management d'équipe projet
  </button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-info w-100 h-100"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Gestion_de_projet_Agile"
  >Gestion de projet Agile
</button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-warning w-100 h-100"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Comptabilité_et_finance"
  >Comptabilité et finance
</button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-danger w-100 h-100"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Audit"
  >Audit
</button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-primary"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Techniques_de_communication"
  >Techniques de communication
</button>
</div>
<div class="">
  <button
  class="btn btn btn-info w-100 h-100"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Communication"
  >Communication 
</button>
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


</body>
</html>