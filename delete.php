<?php
session_start();
if (isset($_POST['file'])) {
  if($_SESSION['token'] !== $_POST['token']) {
    header("Location: ftpgui.php?error=invalid_token");
    exit;
  }
  $filename = $_POST['file'];
  if($_POST['visibility'] == 'private') {
    $full_path = sprintf("../server_data/users/%s", $filename);
  }
  elseif($_POST['visibility'] == 'public') {
    $full_path = sprintf("../server_data/public/%s", $filename);
  }
  elseif($_POST['visibility'] == 'group') {
    $full_path = sprintf("../server_data/groups/%s", $filename);
  }
  if (unlink($full_path) == false) {
    header("Location: ftpgui.php?error=nofile&" . $full_path);
    exit;
  }
  header("Location: ftpgui.php");
  exit;
}
?>