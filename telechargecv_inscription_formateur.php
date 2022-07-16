<?php

/* Template Name: telechargecv_inscription_formateur Page */
session_start();
require "db.php";
?>
<?php
if(isset($_GET['telecharger'])) 
{
    
    $id  = $_GET['telecharger'];
    
    $query = "Select cv from candidature_formateur WHERE id = '$id'";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    $file = $row['cv'];
    header("Content-Type: application/pdf");
    header("Content-Description: File transfer");
    header('Content-Disposition: attachment;filename="' . basename($file) . '"');
    readfile('C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\uploads/' .$file);
}
?>