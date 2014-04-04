<?php



$usuario = $_SESSION['username'];

$conexion = new mysqli('localhost', 'appGym', 'ivdida', 'appGym');

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $mysqli->query(
	""
) or die($mysqli->error.__LINE__);

?>
