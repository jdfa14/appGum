<?php



$usuario = $_SESSION['username'];

$conexion = new mysqli('localhost', 'appGym', 'ivdida', 'appGym');

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $mysqli->query(
	"select * from rutina r inner join rutina_ejercicio re on r.numRutina = re.numRutina where username = " . $usuario
) or die($mysqli->error.__LINE__);

?>
