<?php
include_once 'basededatosInfo.php';
$conexion = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
if (!$conexion) {
    die('Could not connect: ' . mysqli_error($con));
}

