<?php
/* Template Name: cycles_formateur Page */
session_start();
get_header(); 
ConfirmerConnexionFormateur();
require "formations_formateur.php";
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
   #informatiques, #personnels, #ressourcess, #bureautiques, #managements {
    margin-top: 100px;
    margin-left: -450px;
  }     
</style>
</head>
<body>

  <!-- Cycle Informatique -->
  <div class="modal fade" id="informatiques" 
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
            data-bs-target="#javas"
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
        data-bs-target="#mysqls"
        >mysql
      </button>
    </div>
    <div class="col-md-6">
      <button
      class="btn btn btn-info col-md-12"
      type="button"
      data-bs-toggle="modal"
      data-bs-target="#angulars"
      >angular
    </button>
  </div>
  <div class="col-md-6">
    <button
    class="btn btn btn-success col-md-12"
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#javascripts"
    >javascript
  </button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-warning col-md-12"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#reacts"
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
<div class="modal fade" id="personnels" tabindex="-1" aria-hidden="true">
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
            data-bs-target="#Gestion_du_temps_en_entreprises"
            >Gestion du temps en entreprise
          </button>
        </div>
        <div class="col-md-6">
          <button
          class="btn btn btn-info btn-sm"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#Gestion_des_clients_difficiles_et_des_conflitss"
          >Gestion des clients difficiles et des conflits
        </button>
      </div>
      <div class="">
        <button
        class="btn btn btn-danger  w-100	h-100"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#Communication_interpersonnele_et_intelligence_émotionnelles">
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
<div class="modal fade" id="ressourcess" tabindex="-1" aria-hidden="true">
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
            data-bs-target="#Gestion_prévisionnelle_des_emplois_et_compétencess"
            >Gestion prévisionnelle des emplois et compétences
          </button>
        </div>
        <div class="col-md-6">
          <button
          class="btn btn btn-info h-100 w-100"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#Gestion_des_carrièress"
          >Gestion des carrières
        </button>
      </div>
      <div class="col-md-6">
        <button
        class="btn btn btn-danger"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#Techniques_dévolution_des_personnelss"
        >Techniques d'évolution des personnels
      </button>
    </div>
    <div class="col-md-6">
     <button
     class="btn btn btn-success col-md-12"
     type="button"
     data-bs-toggle="modal"
     data-bs-target="#Lessentiel_du_droit_du_travails"
     >L'essentiel du droit du travail
   </button>
 </div>
 <div class="col-md-6">
  <button
  class="btn btn btn-primary col-md-12"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Identification_des_besoins_en_formations "
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
<div class="modal fade" id="bureautiques" tabindex="-1" aria-hidden="true">
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
            data-bs-target="#Words"
            >Word
          </button>
        </div>
        <div class="col-md-6">
         <button
         class="btn btn btn-info col-md-12"
         type="button"
         data-bs-toggle="modal"
         data-bs-target="#Powerpoints"
         >Powerpoint
       </button> 
     </div>
     <div class="col-md-6">
       <button
       class="btn btn btn-success col-md-12"
       type="button"
       data-bs-toggle="modal"
       data-bs-target="#Excels"
       >Excel
     </button> 
   </div>
   <div class="col-md-6">
    <button
    class="btn btn btn-danger col-md-12"
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#Outlooks"
    >Outlook
  </button> 
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-primary col-md-12"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Accesss"
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
<div class="modal fade" id="managements" tabindex="-1" aria-hidden="true">
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
            data-bs-target="#Leaderships"
            >Leadership
          </button>
        </div>
        <div class="col-md-6">
          <button
          class="btn btn btn-primary w-100 h-100"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#Gestion_de_projets"
          >Gestion de projet
        </button>
      </div>
      <div class="col-md-6">
       <button
       class="btn btn btn-success w-100 h-100"
       type="button"
       data-bs-toggle="modal"
       data-bs-target="#Risk_managements"
       >Risk management
     </button>
   </div>
   <div class="col-md-6">
    <button
    class="btn btn btn-danger w-100 h-100"
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#Management_déquipe_projets"
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
  data-bs-target="#Comptabilité_et_finances"
  >Comptabilité et finance
</button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-danger w-100 h-100"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Audits"
  >Audit
</button>
</div>
<div class="col-md-6">
  <button
  class="btn btn btn-primary"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Techniques_de_communicationss"
  >Techniques de communication
</button>
</div>
<div class="">
  <button
  class="btn btn btn-info w-100 h-100"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#Communications"
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