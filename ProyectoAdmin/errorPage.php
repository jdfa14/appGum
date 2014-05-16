<!DOCTYPE html>
<?php
    if(isset($_POST['error'])){
        $error = $_POST['error'];
    }else{
        $error = "";
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Error</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Hubo un problema</h1>
        <div class="formaEntrada">
            <h1>Hubo un problema</h1>
            <p class="mensajeError"> Error: <?= $error?></p>
        </div>
    </body>
</html>
