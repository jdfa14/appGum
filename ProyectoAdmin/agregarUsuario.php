<?php

session_start();

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar Usuario</title>
        <script type="text/JavaScript" src="js/validateForm.js"></script> 
    </head>
    <body>
        <div class="cuerpo">
            <h1>Agregar Usuario</h1>
            <p>Nombre del Instructor <?php echo $_SESSION['usuario']?></p>
            <div class="formaEntrada">
                <form action="includes/insertaUsuario.php" method="post">  
                    <div class="campoEntrada" id="divMat">Matricula: <input class="textoEntrada" type="text" name="matricula" id="matricula" placeholder="A01234567" onblur="validMatricula(this)" required=""/> </div>
                    <div class="campoEntrada" id="divNom">Nombre: <input class="textoEntrada" type="text" name="nombres" id="nombres" placeholder="Maria Jose" required=""/> </div>                    
                    <div class="campoEntrada" id="divEma">Apellido: <input class="textoEntrada" type="text" name="apellidos" id="apellidos" placeholder="De La Torre Sifuentes" required=""/> </div>
                    <div class="campoEntrada" id="divApe">Correo: <input class="textoEntrada" type="text" name="correo" id="correo" placeholder="mail@host.mail" /> </div>
                    <div class="campoEntrada" id="divPes">Peso: <input class="textoEntrada" type="text" name="peso" id="peso" placeholder="55.8"/> </div>
                    <div class="campoEntrada" id="divFec">
                        Fecha de nacimiento:
                        <select class="textoEntrada" name="dia" id="dia" required="">
                            <?php
                                for($i = 1; $i <= 31; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                        <select class="textoEntrada" name="mes" id="mes" required="">
                            <?php
                                for($i = 1; $i <= 12; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                        <select class="textoEntrada" name="anio" id="anio" required="">
                            <?php
                                $anio = date("Y");
                                for($i = $anio - 10; $i >= $anio - 100; $i--){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="campoEntrada"  id="divSex">
                        Sexo:
                        <select class="textoEntrada" name="sexo" id="sexo" required="">
                            <option value=""></option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    <div class="campoEntrada"> <input class="botonSumbmit" type="submit"/> </div>
                </form>
            </div>
        </div>
    </body>
</html>
