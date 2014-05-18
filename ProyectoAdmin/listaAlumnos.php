<?php
    session_start();
    include_once 'includes/basededatos.php';
    include_once 'includes/funciones.php';
    
    if(!sesionIniciada($conexion)){
        echo "<h1> att".$_SESSION['usuario']."</h1>"   ;
        //header("Location: errorPage.php");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista alumnos</title>
        <script src="js/funcionesListaAlumnos.js" type="text/javascript"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/tabla.css" rel="stylesheet" type="text/css"/>
        <link href="css/inputs.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="cuerpo" align="center">
                <h1>Bienvenido <?= $_SESSION['usuario']?></h1>
                <h1>Alumnos </h1>
            <table id="alumnos">
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th class="celdaBoton">Editar</th>
                    <th class="celdaBoton">Borrar</th>
                </tr>
                <?php
                    $resultado = alumnosDeInstructor($conexion, $_SESSION['usuario']);
                    while($renglon = mysqli_fetch_assoc($resultado)){
                        if($renglon['fechaFinal'] == null){
                ?>
                
                <tr id="<?=$renglon['idAlumno']?>">
                    <td>
                        <?=$renglon['idAlumno']?>
                    </td>
                    <td>
                        <?= $renglon['nombre'] ?>
                    </td>
                    <td>
                        <?= $renglon['apellido'] ?>
                    </td>
                    <td class="celdaBoton">
                        <form action="listaRutinas.php" method="GET">
                            <input type="submit" value="Editar" />
                            <input type="hidden" value="<?=$renglon['idAlumno']?>" name="alumno"/>
                        </form>
                    </td>
                    <td class="celdaBoton">
                        <input onclick="eliminar('<?=$renglon['idAlumno']?>')" type="button" value="Borrar" />
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
                <tr >
                    <td colspan="5">
                        <form action="agregarUsuario.php">
                            <input  type="submit" value="Agregar Usuario"/>
                        </form>
                    </td>
                </tr>
                
            </table>
        </div>
    </body>
    
</html>
