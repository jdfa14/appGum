<?php

session_start();

include_once 'includes/basededatos.php';
include_once 'includes/funciones.php';


//login_check($mysqli) or die;
isset($_GET['alumno']) or die("No se especifico alumno");

$alumno = $_GET['alumno'];

if(isset($_POST['definicion'])) {
	
$definicion = $_POST['definicion'];
$result = $conexion->query(
	"insert into rutina_json(alumno, definicion) " .
	"values ('" . $alumno . "', '" . $definicion . "') " 
) or die($conexion->error.__LINE__);

$rutinaActual = $conexion->insert_id;

$result = $conexion->query(
	"update alumno set rutinaJsonActual = " . $rutinaActual .
	" where matricula = '" . $alumno . "'" 
) or die($conexion->error.__LINE__);

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
        <link rel="stylesheet" href="css/main.css" />
        
        <script>
        var alumno = "<?=$alumno?>";
        </script>
    </head>
    <body>
		<div class="formaEntrada">
        <?php 
        
			$result = $conexion->query(
				"select  * " .
				"from alumno " .
				"inner join rutina_json on rutinaJsonActual = numRutina " .
				"where matricula = '" . $alumno ."'"
			) or die($conexion->error.__LINE__);
			
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
				
			}
			?>
            
            
            <div id="contenido"></div>
            
            
            <script>
				forma_rutina("contenido", "nueva_rutina");
			</script>
				<button onclick="ejecutar()">Ejecutar</button>
			
			<?php
				if($definicion == '') {
					
				} else {
			?>
			<script>
				despliega_rutina("contenido", <?=$definicion?>, <?= ($avance ? $avance : "null") ?>);
            </script>
            <?php } ?>
            
            <p>Return to <a href="index.php">login page</a></p>
        </div>
    </body>
</html>
