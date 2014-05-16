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
        <script type="text/javascript">
            function modificar(obj){
                var matricula = obj.getElementsByTagName("input")[0].value;
                window.location.href="rutina_actual.php?alumno="+matricula;
            }
            
            function eliminar(obj){
                var r = confirm("¿Estas seguro de borrar a este alumno?");
                if(r == true){
                    var row = document.getElementById(obj);
                    row.parentNode.removeChild(row);
                }
            }
        </script>
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
                    <th class="celdaBoton">Borrar</th>
                    <th class="celdaBoton">Editar</th>
                </tr>
                <?php
                    $resultado = alumnosDeInstructor($conexion, $_SESSION['usuario']);
                    while($renglon = mysqli_fetch_assoc($resultado)){
                ?>
                
                <tr id="<?=$renglon['matricula']?>">
                    <td>
                        <?=$renglon['matricula']?>
                    </td>
                    <td>
                        <?= $renglon['nombre'] ?>
                    </td>
                    <td>
                        <?= $renglon['apellido'] ?>
                    </td>
                    <td class="celdaBoton">
                        <form action="rutina_actual.php" method="post">
                            <input type="submit" value="Editar" />
                            <input type="hidden" value="<?=$renglon['matricula']?>" name="alumno"/>
                        </form>
                    </td>
                    <td class="celdaBoton">
                        <input onclick="eliminar('<?=$renglon['matricula']?>')" type="button" value="Borrar" />
                    </td>
                </tr>
                <?php
                    }
                ?>
                <tr>
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
