<?php
/* Template Name: deconnexion_administrateur Page */
get_header(); 
session_start();
require "include/Session.php";
require "include/functions.php";


$_SESSION["idadmin"] = null;


$ExpireTime=time() - 86400;
setcookie("SettingEmail","",$ExpireTime, '/');
session_destroy();
header(
    "Location: http://localhost/brnsmart/connexion_administrateur"
);

?>
<?php get_footer();
