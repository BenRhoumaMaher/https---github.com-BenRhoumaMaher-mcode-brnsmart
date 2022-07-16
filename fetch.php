<?php 
/* Template Name: Fetch Page */
require "db.php"; 
?>
<?php
$id = $_POST['id'];
$sql = "SELECT * from calendrier_formation where id_formation = $id";
$result = mysqli_query($con,$sql);
$out = '';
while($row = mysqli_fetch_array($result))
{

  $out .= '
  "<option value="" disabled selected hidden>Veuiller choisir une date</option>"
  "<option value= "' .$row['date'].'">' .$row['date'].'</option>"';
}
echo $out;
?>