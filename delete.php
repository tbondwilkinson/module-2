<?php
session_start();
if (isset($_POST['file'])) {
  // Check to make sure the token that this user has is 
  // still the same one we gave them before.
  if ($_SESSION['token'] !== $_POST['token']) {
    header("Location: ftpgui.php?error=invalid_token");
    exit;
  }

  $filename = $_POST['file'];
  // Three different visibilities.
  if ($_POST['visibility'] == 'private') {
    $full_path = sprintf("../server_data/users/%s", $filename);
  }
  elseif ($_POST['visibility'] == 'public') {
    $full_path = sprintf("../server_data/public/%s", $filename);
  }
  elseif ($_POST['visibility'] == 'group') {
    $full_path = sprintf("../server_data/groups/%s", $filename);
  }

  if (unlink($full_path) == false) {
    header("Location: ftpgui.php?error=nofile");
    exit;
  }

  header("Location: ftpgui.php");
  exit;
}
?>