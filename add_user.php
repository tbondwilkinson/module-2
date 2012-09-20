<!DOCTYPE html>
<head>
<title>Register new user</title>
</head>
<body>
<?php
// If the username is already taken, register.php
// will send the user back to this page with an error.
if (isset($_GET['error'])) {
  if ($_GET['error'] == "taken") {
    echo "That username is taken.";
  }
}
?>
<form action="register.php" method="POST">
Username: <input type="text" name="username">
<input type="submit" value="Create!">
</form>
</body>
</html>

