<!DOCTYPE html>
<html lang="it">
<head>
	<title>Contatore accessi PHP</title>
	
	<script>
		function logout() {
			window.location.href = "logout.php";
		}
	</script>
</head>

<body>
	<form action="" method="get">
		<input type="text" name="username" placeholder="Inserisci il nome utente" required><br>
		<input type="password" name="password" placeholder="Inserisci la password" required><br><br>
		<input type="submit" value="Login">
	</form>
</body>
</html>

<?php
	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "contatoreaccessi";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	
	$username = '';
	$password = '';
	if (isset($_GET["username"])) {
		$username = $_GET["username"];
		$password = $_GET["password"];
	} else
		return;
	
	$sql = "SELECT * FROM `utenti` WHERE username='$username' AND password='$password'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$_SESSION['user_id'] = $username;
		$conn->query("UPDATE `utenti` SET `accessi`=accessi + 1 WHERE username='$username' AND password='$password'");
		$_SESSION['accessi'] = $conn->query("SELECT `accessi` FROM `utenti` WHERE username='$username' AND password='$password'")->fetch_object()->accessi;
		
		header('Location: index.php');
	} else
		echo '<h4>Username o password errati!</h4>';
	
	$conn->close();
?>