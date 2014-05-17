var dia = 1;
var celdaInicial = 2;
var cantidadCeldas = 6;
function agregaActividad(idTabla){
    reset(idTabla);
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
    var th6 = document.createElement("th");

    th1.innerHTML = "Musculo";
    th2.innerHTML = "Ejercicio";
    th3.innerHTML = "Series";
    th4.innerHTML = "Repeticiones";
    th5.innerHTML = "Completado";
    th6.innerHTML = "Opciones";

    boton.type = "button";
    boton.value = "Agregar Ejercicio";
    boton.setAttribute("onClick","agregarEjercicio(this,'"+idTabla+"','"+nombre.value+"')");

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
    trEncabezados.appendChild(th6);
    trBotonAgregar.appendChild(tdBotonAgregar);
    tr.appendChild(td);
    dia = dia + 1;

    cancelarActividad(idTabla);
    obtenerJson(idTabla);
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

function agregarEjercicio(celda,idTabla){
    var tabla = document.getElementById(idTabla);
    var indice = celda.parentNode.parentNode.rowIndex + 2;
    var trNuevo = tabla.insertRow(indice);
    
    var td1 = trNuevo.insertCell();
    var td2 = trNuevo.insertCell();
    var td3 = trNuevo.insertCell();
    var td4 = trNuevo.insertCell();
    var td5 = trNuevo.insertCell();
    var td6 = trNuevo.insertCell();
    
    var input1 = document.createElement("input");
    var input2 = document.createElement("input");
    var input3 = document.createElement("input");
    var botonG = document.createElement("input");
    var botonC = document.createElement("input");
    
    var select = document.createElement("select");
    var select2 = document.createElement("select");
    
    var option1 = document.createElement("option");
    var option2 = document.createElement("option");
    var option3 = document.createElement("option");
    var option4 = document.createElement("option");
    var option5 = document.createElement("option");
    var option6 = document.createElement("option");
    var option7 = document.createElement("option");
    var option8 = document.createElement("option");
    var option9 = document.createElement("option");
    
    select.setAttribute("onchange","poblar(this)");
    
    option1.value = "";
    option2.value = "Pierna";
    option3.value = "Pecho";
    option4.value = "Espalda";
    option5.value = "Biceps";
    option6.value = "Triceps";
    option7.value = "Hombros";
    option8.value = "Antebrazo";
    option9.value = "Abdomen";
    
    option1.innerHTML = "";
    option2.innerHTML = "Pierna";
    option3.innerHTML = "Pecho";
    option4.innerHTML = "Espalda";
    option5.innerHTML = "Biceps";
    option6.innerHTML = "Triceps";
    option7.innerHTML = "Hombros";
    option8.innerHTML = "Antebrazo";
    option9.innerHTML = "Abdomen";
    
    input1.type = "number";
    input2.type = "number";
    input3.type = "checkbox";
    botonG.type = "button";
    botonC.type = "button";
    botonG.value = "Guardar";
    botonC.value = "Cancelar";
    input3.name = "completado";
    input3.setAttribute("onClick","return false");
    botonG.setAttribute("onClick","guardarEjercicio(this,'"+idTabla+"')");
    botonC.setAttribute("onClick","cancelarEjercicio(this)");
    
    select.appendChild(option1);
    select.appendChild(option2);
    select.appendChild(option3);
    select.appendChild(option4);
    select.appendChild(option5);
    select.appendChild(option6);
    select.appendChild(option7);
    select.appendChild(option8);
    select.appendChild(option9);
    
    td1.appendChild(select);
    td2.appendChild(select2);
    td3.appendChild(input1);
    td4.appendChild(input2);
    td5.appendChild(input3);
    td6.appendChild(botonG);
    td6.appendChild(botonC);
}

function poblar(celda){
    var renglon = celda.parentNode.parentNode;
    var musculo = celda.value;
    var selector = renglon.cells[1].firstChild;
    selector.options.length = 0;
    switch(musculo){
        case "Pierna" : {
            var option0 = document.createElement("option");
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            var option5 = document.createElement("option");
            var option6 = document.createElement("option");
            var option7 = document.createElement("option");
            var option8 = document.createElement("option");

            option0.value = option0.innerHTML = "";
            option1.value = option1.innerHTML = "Sentadilla";
            option2.value = option2.innerHTML = "Desplantes";
            option3.value = option3.innerHTML = "Extensiones";
            option4.value = option4.innerHTML = "Curl Femoral";
            option5.value = option5.innerHTML = "Press Pierna";
            option6.value = option6.innerHTML = "Femoral Parado";
            option7.value = option7.innerHTML = "Pantorrilla";
            option8.value = option8.innerHTML = "Femoral Pierna";

            selector.add(option0);
            selector.add(option1);
            selector.add(option2);
            selector.add(option3);
            selector.add(option4);
            selector.add(option5);
            selector.add(option6);
            selector.add(option7);
            selector.add(option8);
            break;
        }
        case "Pecho" :{
            var option0 = document.createElement("option");
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            var option5 = document.createElement("option");
            var option6 = document.createElement("option");
            var option7 = document.createElement("option");

            option0.value = option0.innerHTML = "";
            option1.value = option1.innerHTML = "Press Horizontal";
            option2.value = option2.innerHTML = "Press Inclinado con Barra";
            option3.value = option3.innerHTML = "Press Inclinado con Mancuernas";
            option4.value = option4.innerHTML = "Press Declinado co Barra";
            option5.value = option5.innerHTML = "Press Declinado con Mancuernas";
            option6.value = option6.innerHTML = "Cristos";
            option7.value = option7.innerHTML = "Pullover";

            selector.add(option0);
            selector.add(option1);
            selector.add(option2);
            selector.add(option3);
            selector.add(option4);
            selector.add(option5);
            selector.add(option6);
            selector.add(option7);
            break;
        }
        case "Espalda" :{
            var option0 = document.createElement("option");
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            var option5 = document.createElement("option");
            var option6 = document.createElement("option");
            var option7 = document.createElement("option");
            var option8 = document.createElement("option");
            var option9 = document.createElement("option");

            option0.value = option0.innerHTML = "";
            option1.value = option1.innerHTML = "Jalones tras nuca";
            option2.value = option2.innerHTML = "Jalones al frente";
            option3.value = option3.innerHTML = "Remo sentado";
            option4.value = option4.innerHTML = "Remo con barra";
            option5.value = option5.innerHTML = "Remo con mancuerna";
            option6.value = option6.innerHTML = "Remo con dos mancuernas";
            option7.value = option7.innerHTML = "Dominadas";
            option8.value = option8.innerHTML = "Remo barra";
            option9.value = option9.innerHTML = "Espalda baja";

            selector.add(option0);
            selector.add(option1);
            selector.add(option2);
            selector.add(option3);
            selector.add(option4);
            selector.add(option5);
            selector.add(option6);
            selector.add(option7);
            break;
        }
        default: {
                selector.options.length = 0;
        }
    }
}

function guardarEjercicio(celda,idTabla){
    var tabla = document.getElementById(idTabla);
    var indice = celda.parentNode.parentNode.rowIndex + 1;
    var renglon = celda.parentNode.parentNode;
    var trNuevo = tabla.insertRow(indice);
    
    var musculo = renglon.cells[0].firstChild.value;
    var ejercicio = renglon.cells[1].firstChild.value;
    var series = renglon.cells[2].firstChild.value;
    var repeticiones = renglon.cells[3].firstChild.value;
    
    if(musculo === "" || ejercicio === "" || series === "" || series <= 0 || repeticiones === "" || repeticiones <= 0){
        alert("Favor de llenar todos los campos");
        return;
    }
    
    var td1 = trNuevo.insertCell();
    var td2 = trNuevo.insertCell();
    var td3 = trNuevo.insertCell();
    var td4 = trNuevo.insertCell();
    var td5 = trNuevo.insertCell();
    
    td1.innerHTML = musculo;
    td2.innerHTML = ejercicio;
    td3.innerHTML = series;
    td4.innerHTML = repeticiones;
    td5.innerHTML = "NO";
    
    trNuevo.className = "ejercicio";
    renglon.parentNode.removeChild(renglon);
    obtenerJson(idTabla);
}

function obtenerJson(idTabla){
    var tabla = document.getElementById(idTabla);
    var json = '{ "dias": [ ';
    var banderaAux = 0;
    for(var i = tabla.rows.length; i >= celdaInicial; i--){
        var renglon = tabla.rows[i];
        if(renglon.className == "escondido" || renglon.className == "mostrando"){//entonces es un nuevo dia
            if(banderaAux !== 0){
                json += '}],[{';
            }else{
                json += '[{';
                banderaAux = 1;
            }
            i++;//saltarnos el renglon del boton
        }else if(renglon.className === "ejercicio"){
            
            var musculo = renglon.cells[0].innerHTML;
            var ejercicio = renglon.cells[1].innerHTML;
            var series = renglon.cells[2].innerHTML;
            var repeticiones = renglon.cells[3].innerHTML;
            var estado = renglon.cells[4].innerHTML;
            
            json += '"musculo": "'+musculo+'",';
            json += '"ejercicio": "'+ejercicio+'",';
            json += '"series": "'+series+'",';
            json += '"repeticiones": "'+repeticiones+'",';
            json += '"estado": "'+estado+'"';
            //json += '},{'
        }
    }
    json +='}]]}';
    var txt = document.getElementById("test");
    txt.innerHTML = json;
}