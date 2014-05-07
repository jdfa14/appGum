<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrar Instructor</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Registro de Instructor</h1>
        <form action="includes/insertaInstructor.php" 
                method="post" 
                name="registration_form">
                
            <input type="hidden" name="tipo" value="i">
            Username: <input type='text' name='usuario' id='usuario' /><br>
            Email: <input type="text" name="correo" id="correo" /><br>
            Password: <input type="password" name="contrasena" id="contrasena"/><br>
            Confirm password: <input type="password" name="contrasena2" id="contrasena2" /><br>
            <input type="submit" value="Register"/> 
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>
