<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

login_check($mysqli) or die;
isset($_POST['idAlumno'] or die;

$alumno = $_POST['idAlumno'];

if(isset($_POST['definicion'])) {
	
$definicion = $_POST['definicion'];
$result = $mysqli->query(
	"insert into rutina(alumno, definicion) " .
	"values (" . $alumno . ", '" . $definicion . "') " 
) or die($mysqli->error.__LINE__);

$rutinaActual = $mysqli->insert_id;

$result = $mysqli->query(
	"update alumno set rutinaJsonActual = " . $rutinaActual .
	" where idAlumno = " . $alumno 
) or die($mysqli->error.__LINE__);

}



?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <script type="text/JavaScript" src="jquery-1.11.1.min.js"></script> 
        <script type="text/JavaScript" src="jquery.serialize-object.min.js"></script> 
        <script type="text/JavaScript" src="rutinas.js"></script> 
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) { 
			$result = $mysqli->query(
				"select  * " .
				"from alumno " .
				"inner join rutina_json on rutinaJsonActual = numRutina " .
				"inner join member on idAlumno = id " .
				"where a.idAlumno = " . $alumno
			) or die($mysqli->error.__LINE__);
			
			$sexo = '';
			$peso_inicial = '';
			$peso_final = '';
			$dia0 = '';
			$definicion = '';
			$avance = '';
			
			if($row = mysqli_fetch_assoc($result)) {
				$sexo = $row['sexo'];
				$peso_inicial = $row['pesoInicial'];
				$peso_final = $row['pesoFinal'];
				$dia0 = $row['dia0'];
				$definicion = $row['definicion'];
				$avance = $row['avance'];
				
				$i++;
			}
			?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            
            
            <div id="contenido"></div>
            
            
            <script>
				forma_rutina("contenido", "nueva_rutina");
			</script>
				<button onclick="ejecutar()"></button>
			<script>
				despliega_rutina("contenido", <?=$definicion?>, <?=$avance?>);
            </script>
            <p>Return to <a href="index.php">login page</a></p>
        <?php } else { ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php }?>
    </body>
</html>
