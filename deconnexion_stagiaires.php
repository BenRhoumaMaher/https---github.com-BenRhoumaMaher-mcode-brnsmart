<?php
/* Template Name: deconnexion_stagiaires Page */
get_header(); 
session_start();
require "include/Session.php";
require "include/functions.php";


$_SESSION["stagiaireid"] = null;

$ExpireTime=time() - 86400;
setcookie("SettingEmail","",$ExpireTime, '/');
session_destroy();
header(
    "Location: http://localhost/brnsmart/connexion_stagiaires"
);

?>
<?php get_footer();
