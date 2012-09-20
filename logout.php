<?php
session_start();
$_SESSION['logged_in'] = false;
unset($_SESSION['username']);
unset($_SESSION['token']);
unset($_SESSION['group']);
header("Location: ftpgui.php");
exit;
?>
