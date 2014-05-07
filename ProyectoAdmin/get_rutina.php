<?php

session_start();

include_once 'includes/basededatos.php';
include_once 'includes/funciones.php';


//login_check($mysqli) or die;
isset($_SESSION['matricula']) or die('{"status" :  "error"}');

$alumno = $_SESSION['matricula'];


?>

<?php

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $conexion->query(
	"select  * " .
	"from alumno " .
	"inner join rutina_json on rutinaJsonActual = numRutina " .
	"where matricula = '" . $alumno . "'"
) or die($conexion->error.__LINE__);

if($row = mysqli_fetch_assoc($result)) {
	$definicion = $row['definicion'];
	echo $definicion;
}


?>
