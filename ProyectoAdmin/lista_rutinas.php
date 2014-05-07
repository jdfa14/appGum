<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

login_check($mysqli) or die("No has iniciado sesion");




$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$conexion = new mysqli(
	'localhost', 'usuario', 'paydelimon', 'appGym');

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $mysqli->query(
	"select  * " .
	"from alumno inner join member on idAlumno = id "
) or die($mysqli->error.__LINE__);


?> 

<table>


<?php

while($row = mysqli_fetch_assoc($result)) {
	?> 
		<tr>
			<td><a href="lista_rutinas.php"><?= $row["username"] ?></a></td>
			<td></td>
			<td></td>
		</tr>
	<?php
	
	$i++;
}


mysqli_close($conexion);

?>

</table>


