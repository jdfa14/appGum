<!DOCTYPE html>
<html>
    <head>
        <title>Iniciar sesion</title>\
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/form.css" rel="stylesheet" type="text/css"/>
        <link href="css/inputs.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="formaEntrada">
            <h1>Inicio sesion</h1>
            <form action="includes/iniciarSesion.php" method="post">                      
                <div class="campoEntrada"> Usuario: <input class="textoEntrada" type="text" name="usuario" id="usuario" required="" /></div>
                <div class="campoEntrada"> Contrase&ntilde;a: <input class="textoEntrada" type="password" name="contrasena" id="contrasena" required=""/> </div>
                <div class="campoEntrada"> <input class="botonSumbmit" type="submit" value="Iniciar sesion"/> </div>
            </form>
            <a href="register.php">Register</a>
        </div>
    </body>
</html>
