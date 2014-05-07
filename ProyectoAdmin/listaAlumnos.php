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
                window.location.href="index.php?matricula="+matricula;
            }
        </script>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="cuerpo" align="center">
            <h3>Bienvenido </h3>
            <h3>Alumnos </h3>
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
                    <td><?= $renglon['matricula'] ?></td>
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
