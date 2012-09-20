<?php
session_start();

// Take the user straight to the file upload screen if they've already logged in.
if (!$_SESSION['logged_in']) {
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>
<head>
	<title>cse330 File Manager</title>
</head>
<body>
	<h1>Your Humble cse330 File Manager</h1>
	<div id="error">
		<?php
			// Error handling
			if (isset($_GET['error'])) {
				if ($_GET['error'] == 'nofile') {
					echo "File could not be deleted.";
				}
				elseif ($_GET['error'] == 'failed_upload') {
					echo "File could not be uploaded.";
				}
				elseif ($_GET['error'] == 'invalid_filename') {
					echo "Invaild filename";
				}
				elseif ($_GET['error'] == 'invalid_token') {
					echo "Invalid token.  Try logging in again.";
				}
			}
		?>
	</div>
	<hr>
	<div id="fupload">
		<div id="fupload-header">
			<h2>Upload a file</h2>
			<form enctype="multipart/form-data" action="uploader.php" method="POST">
				<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
				<input name="uploadedfile" type="file" id="uploadfile_input" >
				<input type="hidden" name="token" value="<?=$_SESSION['token'];?>" />
				<select name="visibility">
					<option value="private">Private</option>
					<option value="public">Public</option>
					<option value="group">Group</option>
				</select>
				<input type="submit" value="Upload File" />
			</form>
		</div>
		<hr>
		<div id="fupload-filenames">
			<h2>Personal Files</h2>
			<?php
			$username = $_SESSION['username'];
			$files = scandir("../server_data/users/" . $username);
			if ($files == FALSE || count($files) == 0) {
				printf("No files found.");
			}
			else {
				echo "<form action='delete.php' method='POST'>";
				foreach ($files as $file) {
					if (!is_dir("../server_data/users/" . $username . "/" . $file)) {
						printf("<input type='radio' name='file' value='" . $username . "/" . $file . "'>");
						printf("<a href='download.php?file=%s&visibility=%s'>%s</a><br>", $file, "private", $file);
					}
				}
				$token = "<input type='hidden' name='token' value='" . $_SESSION['token'] . "' />";
				echo "<br>";
				echo "<input type='hidden' name='visibility' value='private'>";
				echo "<input type='submit' value='Delete'>";
				echo "</form>";
			}
			?>
			<hr>
			<h2>Group files</h2>
			<?php
			if (isset($_SESSION['group'])) {
				$username = $_SESSION['username'];
				$group = $_SESSION['group'];
				$files = scandir("../server_data/groups/" . $group);
				if ($files == FALSE || count($files) == 0) {
					echo "No files found.";
				}
				else {
					echo "<form action='delete.php' method='POST'>";
					foreach ($files as $file) {
						if (!is_dir("../server_data/groups/" . $group . "/" . $file)) {
							printf("<input type = 'radio' name = 'file' value = '%s/%s'>",  $group,  $file);
							printf("<a href = 'download.php?file=%s&visibility=%s'>%s</a><br>", $file, "group", $file);
						}
					}
					$token = "<input type='hidden' name='token' value='" . $_SESSION['token'] . "' />";
       				echo "<br>";
					echo "<input type='hidden' name='visibility' value='group'>";
        			echo "<input type='submit' value='Delete'>";
        			echo "</form>";
				}
			}
			else {
				echo "You are not currently in a group";
			}
			?>
			<hr>
			<h2>Public Files</h2>
			<?php
			$files = scandir("../server_data/public");
        	if ($files == FALSE || count($files) == 0) {
          		echo "No files found.";
        	}
        	else {
          		echo "<form action='delete.php' method='POST'>";
          		foreach ($files as $file) {
            		if (!is_dir("../server_data/public/" . $file)) {
              			printf("<input type = 'radio' name = 'file' value = '%s'>", $file);
              			printf("<a href = 'download.php?file=%s&visibility=%s'>%s</a><br>", $file, "public", $file);
            		}
          		}
          		$token = "<input type='hidden' name='token' value='" . $_SESSION['token'] . "' />";
          		echo "<br>";
				echo "<input type='hidden' name='visibility' value='public'>";
          		echo "<input type='submit' value='Delete'>";
          		echo "</form>";
        	}
			?>
			<hr>
		</div>
		<div id="join_group">
			<?php
			if(isset($_SESSION['group'])) {
				echo "You are currently a member of " . $_SESSION['group'];
			}
			?>
			<form action="join_group.php" method="POST">
				Group name:<input type="text" name="group"><br>
				<input type="submit" value="Join!">
			</form>
		</div>
		<hr>
    	<div id="fupload-logout">
      		<form action="logout.php" method="POST">
        		<input type="submit" value="Logout">
      		</form>
    	</div>
	</div>
</body>
