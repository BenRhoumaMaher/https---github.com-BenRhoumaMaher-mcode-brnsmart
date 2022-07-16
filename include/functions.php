<?php
function Password_Encryption($Password){

	$BlowFish_Hash_Format="$2y$10$"; 
	$Salt_Length = 22;
	$Salt = Generate_Salt($Salt_Length);
	$Formating_Blowfish_With_Salt=$BlowFish_Hash_Format .$Salt;
	$Hash = crypt($Password, $Formating_Blowfish_With_Salt);
	return $Hash;
}
function ConfirmAccountActiveStatus($email){
	global $con;
	$sql = "SELECT * FROM `inscription_administrateur` where email='$email' and active = 'On'";
	$res=mysqli_query($con,$sql);
	$total=mysqli_num_rows($res);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function Generate_Salt($length){

	$Unique_Random_String = md5(uniqid(mt_rand(),true));
	$Base64_String = base64_encode($Unique_Random_String);
	$Salt = substr($Base64_String,0,$length);
	return $Salt;
}
function Password_Check($mot_de_passe, $Existing_Password){

	$Hash = crypt($mot_de_passe, $Existing_Password);
	if ($Hash === $Existing_Password) {
		return true;
	} else {
		return false;
	}

}
function EmailExisteStagiaire($email){
	global $con;
	$query = "SELECT * FROM `enregistrement_stagiaires` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function EmailExisteInscriptionStagiaire($email){
	global $con;
	$query = "SELECT * FROM `inscription_stagiaires` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function EmailExisteInscriptionPersonneMorale($email){
	global $con;
	$query = "SELECT * FROM `inscription_personne_morale` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function EmailExisteInscriptionFormateur($email){
	global $con;
	$query = "SELECT * FROM `inscription_formateur` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}


function EmailExisteformateur($email){
	global $con;
	$query = "SELECT * FROM `enregistrement_formateur` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function EmailExisteformateurInscription($email){
	global $con;
	$query = "SELECT * FROM `inscription_formateur` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function EmailExistePersonneMorale($email){
	global $con;
	$query = "SELECT * FROM `enregistrement_personne_morale` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}


function UtilisateurExistePersonneMorale($utilisateur){
	global $con;
	$query = "SELECT * FROM `enregistrement_personne_morale` WHERE utilisateur = 
	'$utilisateur'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

//to verifier is l'email existe
function CheckEmailExistAdmin($email){
	global $con;
	$query = "SELECT * FROM `inscription_administrateur` WHERE email = '$email'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function VerificationConnexionStagiaires($email,$mot_de_passe){
	global $con;
	$sql = "Select * from enregistrement_stagiaires where email='$email'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if ($num == 1){
		if($row=mysqli_fetch_assoc($result)) {
			if(Password_Check($mot_de_passe, $row["mot_de_passe"])){
				return $row;
			}
		}else
		return null;
	}	
}


function VerificationConnexionPersonneMorale($email,$mot_de_passe){
	global $con;
	$sql = "Select * from enregistrement_personne_morale where email='$email'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if ($num == 1){
		if($row=mysqli_fetch_assoc($result)) {
			if(Password_Check($mot_de_passe, $row["mot_de_passe"])){
				return $row;
			}
		}else
		return null;
	}	
}

function VerificationConnexionFormateur($email,$mot_de_passe){
	global $con;
	$sql = "Select * from enregistrement_formateur where email='$email'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if ($num == 1){
		if($row=mysqli_fetch_assoc($result)) {
			if(Password_Check($mot_de_passe, $row["mot_de_passe"])){
				return $row;
			}
		}else
		return null;
	}	
}


function Login_AttemptAdmin($email,$mot_de_passe){
	global $con;
	$sql = "SELECT * FROM `inscription_administrateur` where email='$email'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if ($num == 1){
		if($row=mysqli_fetch_assoc($result)) {
			if(Password_Check($mot_de_passe, $row["mot_de_passe"])){
				return $row;
			}
		}else
		return null;
	}	
}

function ConfirmerActivationStagiaires($email){
	global $con;
	$query = "select * from enregistrement_stagiaires where email='$email' and active = 'On'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function ConfirmerActivationPersonneMorale(){
	global $con;
	$query = "select * from enregistrement_personne_morale where active = 'On'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}

function ConfirmerActivationFormateur(){
	global $con;
	$query = "select * from enregistrement_formateur where active = 'On'";
	$result=mysqli_query($con,$query);
	$total=mysqli_num_rows($result);
	if($total>0){
		return true;
	}else {
		return false;
	}
}



function login(){
	if(isset($_SESSION["stagiaireid"]) || isset($_COOKIE["SettingEmail"])){
		return true;
	}
}

function loginformateur(){
	if(isset($_SESSION["formateurid"]) || isset($_COOKIE["SettingEmail"])){
		return true;
	}
}

function loginmorale(){
	if(isset($_SESSION["moraleid"]) || isset($_COOKIE["SettingEmail"])){
		return true;
	}
}

function loginadmin(){
	if(isset($_SESSION["idadmin"]) || isset($_COOKIE["SettingEmail"])){
		return true;
	}
}

function ConfirmerConnexionStagiaires(){

	if(!login()){
		$_SESSION['message']="Veuiller connecter !!!!!";
		header(
			"Location: http://localhost/brnsmart/connexion_stagiaires"
		);
	}

}

function ConfirmerConnexionFormateur(){

	if(!loginformateur()){
		$_SESSION['message']="Veuiller connecter !!!!!";
		header(
			"Location: http://localhost/brnsmart/connexion_formateur"
		);
	}

}

function ConfirmerConnexionPersonneMorale(){

	if(!loginmorale()){
		$_SESSION['message']="Veuiller connecter !!!!!";
		header(
			"Location: http://localhost/brnsmart/connexion_personne_morale"
		);
	}

}

function Confirm_loginAdmin(){

	if(!loginadmin()){
		$_SESSION['message']="Veuiller connecter !!!!!";
		header(
			"Location: http://localhost/brnsmart/connexion_administrateur"
		);
	}

} 



?>  