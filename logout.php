<?php
session_start();

// Unset the session variables and all session data associated with the user.
$_SESSION['logged_in'] = false;
unset($_SESSION['username']);
unset($_SESSION['token']);
unset($_SESSION['group']);
header("Location: ftpgui.php");
exit;
?>
