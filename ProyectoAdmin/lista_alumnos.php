<?php
session_start();

    include_once 'includes/basededatos.php';
    include_once 'includes/funciones.php';
    
    
    $resultado = alumnosDeInstructor($conexion, $_SESSION['usuario']);
    
    ?>
    
    <!DOCTYPE html>
<html>
    <head>
        <title>Lista de alumnos</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>

<table>
<tr><th>Matricula</th><th>Nombre</th><th>Apellido</th></tr>
<?php
    while($renglon = mysqli_fetch_assoc($resultado)){
?>

<tr>
<td><a href="rutina_actual.php?alumno=<?=$renglon['matricula']?>"><?=$renglon['matricula']?></a></td>
<td><?=$renglon['nombre']?></td>
<td><?=$renglon['apellido']?></td>
</tr>

<?php
}
?>
</table>


    </body>
</html>
