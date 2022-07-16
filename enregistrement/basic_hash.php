<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Name</title>
</head>
<body>
	<?php

		$Password="Tunisie";
		$BlowFish_Hash_Format="$2y$10$"; //2y is the type of algorithme the blowfish in here, and 10 is 10s for the hash to get applied
		$Salt="MYNAMEismaherbenrhouma";
		echo "Length: " .strlen($Salt);
		$Formating_Blowfish_With_Salt=$BlowFish_Hash_Format .$Salt;
		$Hash = crypt($Password, $Formating_Blowfish_With_Salt);
		echo "<br>";
		echo $Hash;
		$Password="Maher";
		$BlowFish_Hash_Format="$2y$10$"; //2y is the type of algorithme the blowfish in here, and 10 is 10s for the hash to get applied
		$Salt="MYNAMEismaherbenrmakrem";
		echo "Length: " .strlen($Salt);
		$Formating_Blowfish_With_Salt=$BlowFish_Hash_Format .$Salt;
		$Hash = crypt($Password, $Formating_Blowfish_With_Salt);
		echo "<br>";
		echo $Hash;
	?>
</body>
</html>