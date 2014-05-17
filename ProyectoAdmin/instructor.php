<!DOCTYPE html>
<html>
    <head>
        <title>Menu Instructor</title>\
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/form.css" rel="stylesheet" type="text/css"/>
        <link href="css/inputs.css" rel="stylesheet" type="text/css"/>
        <link href="css/tabla.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="formaEntrada" align="center">
            <h1>Menu Instructor</h1>
            <table>
                <tr>
                    <td>
                        <form action="listaAlumnos.php" method="post">                      
                            <input type="submit" value="Alumnos" style="width: 200px"/>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="includes/cerrarSesion.php" method="post">                      
                            <input type="submit" value="Cerrar Sesion" style="width: 200px">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
