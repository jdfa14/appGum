<?PHP
    include_once 'includes/basededatos.php';
    include_once 'includes/funciones.php';
    session_start();
    if(isset($_GET['alumno'])){
        $matricula = $_GET['alumno'];
        $result = datosAlumno($conexion, $matricula);
        $row = mysqli_fetch_assoc($result);
        $nombre = $row["nombre"] . " " . $row["apellido"];
    }else{
        $matricula = "";
    }
    $contador = 1;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/funcionesListaRutinas.js" type="text/javascript"></script>
        <title>Lista Rutinas</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/tabla.css" rel="stylesheet" type="text/css"/>
        <link href="css/inputs.css" rel="stylesheet" type="text/css"/>
        <link href="css/celdaInteractiva.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <input type="hidden" id="idAlumno" value="<?=$matricula?>"/>
        <input type="hidden" id="idInstructor" value="<?=$_SESSION['usuario']?>"/>
        <table id="rutinas">
            <tr>
                <th colspan="7">
                    Rutinas de : <?=$nombre?>
                </th>
            </tr>
            <tr>
                <td colspan="7">
                    <input type="button" value="Agregar Actividad" onclick="agregaActividad('rutinas')"/>
                </td>
            </tr>
        </table>
        <textarea id="test">    
        </textarea>
        <script>
            imprimirRutinas('<?=$matricula?>');
        </script>
    </body>
</html>
