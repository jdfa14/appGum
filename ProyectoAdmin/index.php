<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <form action="includes/iniciarSesion.php" method="post">                      
            Usuario: <input type="text" name="usuario" id="usuario" />
            Password: <input type="password" name="contrasena" id="contrasena"/>
            <input type="submit" value="Login" /> 
        </form>
        <a href="register.php">Register</a>
    </body>
</html>
