<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

login_check($mysqli) or die("No has iniciado sesion");
isset($_POST['idAlumno'] or die;

isset($_POST['idAlumno'] or die;

$alumno = $_POST['idAlumno'];


$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$result = $mysqli->query(
	"select  * " .
	"from rutina " .
	"where alumno = " . $alumno
) or die($mysqli->error.__LINE__);


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
		<div id="contenido"></div>
		<script>
        <?php 
			while($row = mysqli_fetch_assoc($result)) {
		?>
				despliega_rutina("contenido", <?=$row['definicion']?>, <?=$row['avance']?>);
				
				
		<?php 
				$i++;
			}
		?>
		</script>
            
        
    </body>
</html>
			
