<?php

session_start();
function Message(){
	if(isset($_SESSION["message"])){
		$Output="<div class=\"message\">";
		$Output .= htmlentities($_SESSION["message"]);
		$Output .="</div>";
		$_SESSION['message']=null;
		return $Output;
	}
}


?>