<?PHP
    include_once 'includes/basededatos.php';
    include_once 'includes/funciones.php';
    
    if(isset($_GET['alumno'])){
        $matricula = $_GET['alumno'];
        $result = datosAlumno($conexion, $matricula);
        $row = mysqli_fetch_assoc($result);
        $nombre = $row["nombre"] . " " . $row["apellido"];
    }else{
        $matricula = "";
    }
    $contador = 1;
?>
<!DOCTYPE html>
<html>
    <head>
        <script>
            var dia = 1;
            var celdaInicial = 2;
            var cantidadCeldas = 5;
            function agregaActividad(idTabla){
                var tabla = document.getElementById(idTabla);
                var oldForma = tabla.getElementsByTagName("div")[0];
                var forma = document.createElement("div");
                
                if(oldForma){
                    cancelarActividad(idTabla);
                }
                var nombre = document.createElement("input");
                var botonS = document.createElement("input");
                var botonC = document.createElement("input");
                var tr = tabla.insertRow(celdaInicial);
                var td = document.createElement("td");
                
                nombre.type = "text";
                botonS.type = "button";
                botonC.type = "button";
                
                nombre.value = "Dia " + dia;
                botonS.value = "Guardar"
                botonC.value = "Cancelar"
                
                botonS.setAttribute("onClick","guardarActividad('"+idTabla+"')");
                botonC.setAttribute("onClick","cancelarActividad('"+idTabla+"')");
                forma.id = "agregarForma";
                
                forma.appendChild(nombre);
                forma.appendChild(botonS);
                forma.appendChild(botonC);
                td.appendChild(forma);
                tr.appendChild(td);
            }
            function guardarActividad(idTabla){
                var tabla = document.getElementById(idTabla);
                var forma = tabla.getElementsByTagName("div")[0];
                var nombre = forma.getElementsByTagName("input")[0];
                var tr = tabla.insertRow(celdaInicial);
                var trBotonAgregar = tabla.insertRow(celdaInicial + 1);
                var trEncabezados = tabla.insertRow(celdaInicial + 2);
                var td = document.createElement("td");
                var tdBotonAgregar = document.createElement("td");
                var boton = document.createElement("input");
                
                var th1 = document.createElement("th");
                var th2 = document.createElement("th");
                var th3 = document.createElement("th");
                var th4 = document.createElement("th");
                var th5 = document.createElement("th");
                
                th1.innerHTML = "Musculo";
                th2.innerHTML = "Ejercicio";
                th3.innerHTML = "Series";
                th4.innerHTML = "Repeticiones";
                th5.innerHTML = "Completado";
                
                boton.type = "button";
                boton.value = "Agregar Ejercicio";
                
                td.className = "celdaInteractiva";
                td.innerHTML = nombre.value;
                td.setAttribute("colspan",cantidadCeldas);
                td.setAttribute("onclick","mostrarOpciones(this,'"+idTabla+"')");
                tdBotonAgregar.setAttribute("colspan",cantidadCeldas);
                tr.className = "escondido";
                trBotonAgregar.className = "renglonEscondido";
                trEncabezados.className = "renglonEscondido";
                
                tdBotonAgregar.appendChild(boton);
                
                trEncabezados.appendChild(th1);
                trEncabezados.appendChild(th2);
                trEncabezados.appendChild(th3);
                trEncabezados.appendChild(th4);
                trEncabezados.appendChild(th5);
                trBotonAgregar.appendChild(tdBotonAgregar);
                tr.appendChild(td);
                dia = dia + 1;
                
                cancelarActividad(idTabla);
            }
            
            function cancelarActividad(idTabla){
                var tabla = document.getElementById(idTabla);
                var forma = tabla.getElementsByTagName("div")[0];
                var tr = forma.parentNode.parentNode;
                if(forma){
                    tr.removeChild(forma.parentNode);
                    tr.parentNode.removeChild(tr);
                }
            }
            
            function mostrarOpciones(row,idTabla){
                if(row.parentNode.className === "escondido"){
                    var tabla = document.getElementById(idTabla);
                    var index = row.parentNode.rowIndex + 1;
                    row.parentNode.className = "mostrando";
                    
                    while(index < tabla.rows.length && tabla.rows[index].className !== "escondido"){
                        tabla.rows[index].className = "";
                        index++;
                    }
                }else{
                    reset(idTabla);
                }
            }
            
            function reset(idTabla){
                var tabla = document.getElementById(idTabla);
                for(var i = celdaInicial; i < tabla.rows.length; i++){
                    if(tabla.rows[i].className == "mostrando"){
                        tabla.rows[i].className = "escondido";
                    }
                    if(tabla.rows[i].className != "escondido"){
                        tabla.rows[i].className = "renglonEscondido";
                    }
                }
            }
        </script>
        <meta charset="UTF-8">
        <title>Lista Rutinas</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/tabla.css" rel="stylesheet" type="text/css"/>
        <link href="css/celdaInteractiva.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <table id="rutinas">
            <tr>
                <th colspan="5">
                    Rutinas de : <?=$nombre?>
                </th>
            </tr>
            <tr>
                <td colspan="5">
                    <input type="button" value="Agregar Actividad" onclick="agregaActividad('rutinas')"/>
                </td>
            </tr>
        </table>
    </body>
</html>
