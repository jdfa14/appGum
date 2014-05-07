<?php
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista alumnos</title>
        <script src="js/ajaxLista.js" type="text/javascript"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="cuerpo" align="center">
            <h3>Bienvenido </h3>
            <h3>Alumnos </h3>
            <table id="alumnos">
                <tr>
                    <th>Nombre</th>
                </tr>
            </table>
            <form action="agregarUsuario.php">
                <input type="submit" value="Agregar Usuario"/>
            </form>
        </div>
        <script>
            getAlumnos('<?= $_SESSION['usuario']?>');
        </script>
    </body>
    
</html>
