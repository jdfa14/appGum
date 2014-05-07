<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) {





$username = $_SESSION['username'];
$alumno = $_SESSION['user_id'];

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $mysqli->query(
	"select  * " .
	"alumno " .
	"inner join rutina_json on rutinaJsonActual = numRutina " .
	"where a.idAlumno = " . $alumno
) or die($mysqli->error.__LINE__);

$definicion

if($row = mysqli_fetch_assoc($result)) {
	$definicion = $row['definicion'];
}

echo $definicion;
mysqli_close($conexion);

} else { ?>
            {"status": "error"}
<?php } ?>
