<?php
session_start();

// Check to see whether the username exists.
if (isset($_POST['username'])) {
	$users = file_get_contents("../server_data/users.txt");
	$username = '[' . $_POST['username'] . ']'; 
	if (strpos($users, $username) !== false) {
		// Set the session variables.
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['token'] = md5(uniqid(rand(), true));
		// Check to see if the user is in a group.
		if (file_exists("../server_data/users/" . $_POST['username'] . "/group.txt")) {
    		$group = file_get_contents("../server_data/users/" . $_POST['username'] . "/group.txt");
  			$_SESSION['group'] = $group;
		}
		header("Location: ftpgui.php");
		exit;
	}
	else {
		header("Location: login.php?attempts=1&username=" . $_POST['username']);
		exit;
	}
}
header("Location: login.php?attempts=1");
exit;
?>
