<?php
include_once 'includes/basededatos.php';
include_once 'includes/funciones.php';




//$conexion = new mysqli(
//	'localhost', 'usuario', 'paydelimon', 'appGym');

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

if(isset($_POST['nombre']) && isset($_POST['musculo'])) {

echo "type" . $_FILES["imagen"]["type"];
echo "size" . $_FILES["imagen"]["size"];

if ((($_FILES["imagen"]["type"] == "image/jpeg")
|| ($_FILES["imagen"]["type"] == "image/jpg"))
&& ($_FILES["imagen"]["size"] < 250000)) {
  if ($_FILES["imagen"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
    $filename = $_POST['nombre'] . "_" . $_POST['musculo'] . ".jpg";
    move_uploaded_file($_FILES["imagen"]["tmp_name"],
      "upload/" . $filename);
      //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    //}
    
    if($stmt = $conexion->prepare("insert into ejercicio(nombre, descripcion, musculo, archivo) " .
		"values (?, ?, ?, ?)")) {
		$stmt->bind_param("ssss", 
			$_POST['nombre'], $_POST['descripcion'], 
			$_POST['musculo'], $filename);
		$stmt->execute();
		$stmt->close();
	}
  }
  
  echo "succ";
} else {
  echo "Invalid file";
}
} else {

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo Ejercicio</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Nuevo Ejercicio</h1>
        
        <form action="nuevo_ejercicio.php" 
                method="post" 
                name="ejercicio"
                enctype="multipart/form-data">
            Musculo: <input type='text' 
                name='musculo' 
                id='musculo' /><br>
            Ejercicio: <input type='text' 
                name='nombre' 
                id='nombre' /><br>
            Imagen: <input type='file' 
                name='imagen' 
                id='imagen' /><br>
            Descripci&oacute;n: <input type='text' 
                name='descripcion' 
                id='descripcion' /><br>
                <input type="submit" />
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>

<?php	


}

 ?>

