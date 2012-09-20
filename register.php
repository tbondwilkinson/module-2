<?php
$usernames_file = "../server_data/users.txt";
$users = file_get_contents($usernames_file);

// Check to see if the username is already taken.
if (strpos($users, '[' . $_POST['username'] . ']' ) !== false) {
	header("Location: add_user.php?error=taken");
}
else {
	// Write the new username to the users.txt file and make a new directory.
	$usernames = fopen($usernames_file, 'a') or die("can't open file");
	fwrite($usernames, "\n" .  "[" . $_POST['username'] . "]");
	mkdir("../server_data/users/" . $_POST['username']);
	header("Location: ftpgui.php");
	exit;
}
?>
