<?php
	session_start();

	if (isset($_SESSION['user_id'])) {
		echo '<h4>Username: ' . $_SESSION['user_id'] . '</h4>';
		echo '<h4>Contatore accessi: ' . $_SESSION['accessi'] . '</h4>';
		echo "<button onclick='logout();'>Logout</button>";
	} else
		header('Location: login.php');
?>

<!DOCTYPE html>
<html lang="it">
<head>
	<title>Contatore accessi</title>
	
	<script>
		function logout() {
			window.location.href = "logout.php";
		}
	</script>
</head>

<body>
</body>
</html>