<?php
    session_start();
    include_once 'includes/basededatos.php';
    include_once 'includes/funciones.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista alumnos</title>
        <script type="text/javascript">
            function modificar(obj){
                var matricula = obj.getElementsByTagName("td")[0].innerHTML;
                window.location.href="rutina_actual.php?alumno="+matricula;
            }
        </script>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
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
                </tr>
                <?php
                    $resultado = alumnosDeInstructor($conexion, $_SESSION['usuario']);
                    while($renglon = mysqli_fetch_assoc($resultado)){
                ?>
                <tr onclick="modificar(this)">
                    <td><?=$renglon['matricula']?></td>
                    <td><?= $renglon['nombre'] ?></td>
                    <td><?= $renglon['apellido'] ?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <form action="agregarUsuario.php">
                <input type="submit" value="Agregar Usuario"/>
            </form>
        </div>
    </body>
    
</html>
