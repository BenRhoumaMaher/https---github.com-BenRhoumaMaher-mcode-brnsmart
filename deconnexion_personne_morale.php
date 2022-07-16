<?php
/* Template Name: deconnexion_personne_morale Page */
get_header(); 
session_start();
require "include/Session.php";
require "include/functions.php";


$_SESSION["moraleid"] = null;

$ExpireTime=time() - 86400;
setcookie("SettingEmail","",$ExpireTime, '/');
session_destroy();
header(
    "Location: http://localhost/brnsmart/connexion_personne_morale"
);

?>
<?php get_footer();
