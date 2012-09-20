<!DOCTYPE html>
<head>
	<title>Login</title>
</head>
<body>
	<h2>LOGIN</h2>
	<form action="validate.php" method="post">
		<p>
			<?php
				if(isset($_GET['attempts'])) {
					echo "Invalid username<br>";
				}
				else {
					echo "<br>";
				}
			?>
			<label for="username">Username</label>
			<input type="text" name="username" id="username">
		</p>
		<p>
			<input type="submit" value="Submit">
		</p>
	</form><br><br>
<a href="add_user.php">Add a new user</a>
</body>
