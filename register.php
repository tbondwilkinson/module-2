<?php

$h = file_get_contents("../server_data/users.txt");
if(strpos($h, '[' . $_POST['username'] . ']' ) !== false) {
	header("Location: add_user.php?error=taken");
}
else {
	$myFile = "../server_data/users.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, "\n" .  "[" . $_POST['username'] . "]");
	mkdir("../server_data/users/" . $_POST['username']);
	header("Location: ftpgui.php");
	exit;
}
?>
