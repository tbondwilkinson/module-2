<?php
	session_start();
	$group_file_name = sprintf("../server_data/users/%s/group.txt", $_SESSION['username']);
	$group_file = fopen($group_file_name, 'w') or die("can't open file");
	fwrite($group_file, $_POST['group']);
	fclose($group_file);
	if(!is_dir("../server_data/groups/" . $_POST['group'])) {
		mkdir("../server_data/groups/" . $_POST['group']);
	}
	$_SESSION['group'] = $_POST['group'];
	header("Location: ftpgui.php");
	exit;
?>
