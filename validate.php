<?php
session_start();
if (isset($_POST['username'])) {
	$h = file_get_contents("../server_data/users.txt");
	$name = '[' . $_POST['username'] . ']'; 
	if(strpos($h, $name) !== false) {
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['token'] = md5(uniqid(rand(), true));
		if (file_exists("../server_data/users/" . $_POST['username'] . "/group.txt")) {
    	$g = file_get_contents("../server_data/users/" . $_POST['username'] . "/group.txt");
  		$_SESSION['group'] = $g;
		}
		header("Location: ftpgui.php");
		exit;
	}
	else {
		header("Location: login.php?attempts=1&name=$name");
		exit;
	}
}
?>
