<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<?php if (login_check($mysqli) == true) {





$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $mysqli->query(
	"select  *, a.idAlumno as alumnoId, r.numRutina as rutinaId, " .
	"    e.idEjercicio as ejercicioId, e.nombre as ejercicioNombre " .
	"from alumno a " .
	"inner join rutina r on a.rutinaActual = r.numRutina " .
	"inner join rutina_ejercicio re on r.numRutina = re.numRutina " .
	"inner join ejercicio e on re.idEjercicio = e.idEjercicio " .
	"where a.idAlumno = " . $user_id
) or die($mysqli->error.__LINE__);

$peso_inicial = 0;
$peso_final = 0;
$num_rutina = -1;
$ejercicios = array();
$i = 0;

while($row = mysqli_fetch_assoc($result)) {
	$peso_inicial = (int)$row['pesoInicial'];
	$peso_inicial = (int)$row['pesoFinal'];
	$num_rutina =
	$ejercicios[$i] = array(
		"series"		=> (int)$row['series'], 
		"repeticiones"	=> (int)$row['repeticiones'], 
		"avance"		=> (int)$row['avance'], 
		"comentario"	=> $row['comentario'],
		
		"ejercicio"	=> (int)$row['ejercicioId'], 
		"nombre"		=> $row['nombreEjercicio'], 
		"descripcion"	=> $row['descripcion'], 
		"musculo"		=> $row['musculo']
	);
	$i++;
}

$output = array(
	"ejercicios" => $ejercicios,
	"pesoInicial" => $peso_inicial,
	"pesoFinal" => $peso_final,
	"status" => "ok"
);

echo json_encode($output);
mysqli_close($mysqli);

} else { ?>
            {"status": "error"}
<?php } ?>
