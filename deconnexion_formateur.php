<?php
/* Template Name: deconnexion_formateur Page */
get_header(); 
session_start();
require "include/Session.php";
require "include/functions.php";

    
$_SESSION["formateurid"] = null;
    
$ExpireTime=time() - 86400;
setcookie("SettingEmail","",$ExpireTime, '/');
session_destroy();
header(
                "Location: http://localhost/brnsmart/connexion_formateur"
            );

?>
<?php get_footer();
