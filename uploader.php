<?php
session_start();
 
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
  echo "Invalid filename";
  header("Location: ftpgui.php?error=invalid_filename");
  exit;
} 

$username = $_SESSION['username'];

if($_POST['visibility'] == "private") {
	$full_path = sprintf("../server_data/users/%s/%s", $username, $filename);
}
elseif($_POST['visibility'] == "public") {
	$full_path = sprintf("../server_data/public/%s", $filename);
}
elseif($_POST['visibility'] == "group") {
	$full_path = sprintf("../server_data/groups/%s/%s", $_SESSION['group'], $filename);
}

if($_SESSION['token'] !== $_POST['token']) {
	header("Location: ftpgui.php?error=invalid_token");
	exit;
} 

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: ftpgui.php");
	exit;
}else{
	header("Location: ftpgui.php?error=failed_upload");
	exit;
}
 
?>
