<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrar Instructor</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/form.css" rel="stylesheet" type="text/css"/>
        <link href="css/inputs.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="cuerpo">
            <div class="formaEntrada">
                <h1>Registro de Instructor</h1>
                <form action="includes/insertaInstructor.php" method="post" name="registration_form">
                    <div class="textoEntrada">Username: <input type='text' name='usuario' id='usuario' /></div>
                    <div class="textoEntrada">Email: <input type="text" name="correo" id="correo" /></div>
                    <div class="textoEntrada">Password: <input type="password" name="contrasena" id="contrasena"/></div>
                    <div class="textoEntrada">Confirm password: <input type="password" name="contrasena2" id="contrasena2" /></div>
                    <div class="textoEntrada"><input class="botonSumbmit" type="submit" value="Register"/> 
                </form>
                <p>Regresar a <a href="index.php">inicio</a>.</p>
            </div>
        </div>
    </body>
</html>
