var sendReq = getXmlHttpRequestObject();
var receiveReq = getXmlHttpRequestObject();
var dia = 1;
var celdaInicial = 2;
var cantidadCeldas = 7;

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		echo("Ajax not working");
	}
}

function guardarJson(idAlumno,idInstructor,json) {
    if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
        var param = "";
        param += "idAlumno="+idAlumno + "&";
        param += "idInstructor="+idInstructor + "&";
        param += "json="+json;
        var path = 'servidor/actualizarRutina.php?' + param ;
        receiveReq.open("GET",path , true);
        receiveReq.send(null);
    }
}

function imprimirRutinas(idAlumno) {
    if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
        var param = "";
        param += "idAlumno="+idAlumno;
        receiveReq.open("GET", 'servidor/obtenerJson.php?' + param , true);
        receiveReq.onreadystatechange = interpretarJson; 
        receiveReq.send(null);
    }
}

function interpretarJson(){
    if (receiveReq.readyState === 4) {
        var idTabla = 'rutinas';
        var json = receiveReq.responseText;
        var arrDias = JSON.parse(json)['dias'];
        for(var i = 0; i < arrDias.length; i++){
            var rutina = arrDias[i];//objeto dicionari
            crearActividad(idTabla,rutina['nombre']);
            for(var j = 0; j < rutina['ejercicios'].length; j++){
                var ejercicioD = rutina['ejercicios'][j];
                if(ejercicioD.constructor === {}.constructor){
                    var musculo = ejercicioD['musculo'];
                    var ejercicio = ejercicioD['ejercicio'];
                    var series = ejercicioD['series'];
                    var repeticiones = ejercicioD['repeticiones'];
                    var avance = ejercicioD['avance'];
                    crearEjercicio(idTabla,celdaInicial + 3,musculo,ejercicio,series,repeticiones,avance,true);
                }
            }
            if(rutina['nombre'].substring(0,3) === "Dia"){
                dia++;
            }
        }
    }
}

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
    td.setAttribute("colspan",cantidadCeldas)
    tr.appendChild(td);
}
function guardarActividad(idTabla){
    var tabla = document.getElementById(idTabla);
    var forma = tabla.getElementsByTagName("div")[0];
    var nombre = forma.getElementsByTagName("input")[0].value;
    crearActividad(idTabla,nombre);
    cancelarActividad(idTabla);
    //obtenerJson(idTabla);
    if(nombre.substring(0,3) === "Dia"){
        dia ++;
    }
}

function crearActividad(idTabla,nombre){
    var tabla = document.getElementById(idTabla);
    var tr = tabla.insertRow(celdaInicial);
    var trBotonAgregar = tabla.insertRow(celdaInicial + 1);
    var trEncabezados = tabla.insertRow(celdaInicial + 2);
    var td = tr.insertCell();
    var td2 = tr.insertCell();
    var tdBotonAgregar = document.createElement("td");
    var boton = document.createElement("input");
    var botonB = document.createElement("input");

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
    botonB.type = "button";
    boton.value = "Agregar Ejercicio";
    botonB.value = "Borrar Actividad";
    boton.setAttribute("onClick","agregarEjercicio(this,'"+idTabla+"')");
    botonB.setAttribute("onClick","borrarActividad(this,'"+idTabla+"')");

    td.className = "celdaInteractiva";
    td.innerHTML = nombre;
    td.setAttribute("colspan",cantidadCeldas - 1);
    td.setAttribute("onclick","mostrarOpciones(this,'"+idTabla+"')");
    td2.setAttribute("style","width: 20px");
    tdBotonAgregar.setAttribute("colspan",cantidadCeldas + 1);
    th2.setAttribute("colspan",2);
    tr.className = "escondido";
    trBotonAgregar.className = "renglonEscondido";
    trEncabezados.className = "renglonEscondido";

    tdBotonAgregar.appendChild(boton);
    td2.appendChild(botonB);
    
    trEncabezados.appendChild(th1);
    trEncabezados.appendChild(th2);
    trEncabezados.appendChild(th3);
    trEncabezados.appendChild(th4);
    trEncabezados.appendChild(th5);
    trEncabezados.appendChild(th6);
    trBotonAgregar.appendChild(tdBotonAgregar);
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
        reset(idTabla);
        var tabla = document.getElementById(idTabla);
        var index = row.parentNode.rowIndex + 1;
        row.parentNode.className = "mostrando";

        while(index < tabla.rows.length && tabla.rows[index].className !== "escondido"){
            
            tabla.rows[index].className =tabla.rows[index].className == "renglonEscondido" ? "escondeme" : tabla.rows[index].className == "ejercicioEscondido" ? "ejercicio" : tabla.rows[index].className;
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
        }else if(tabla.rows[i].className == "ejercicio"){
            tabla.rows[i].className = "ejercicioEscondido";
        }else if(tabla.rows[i].className == "escondeme"){
            tabla.rows[i].className = "renglonEscondido";
        }
    }
}

function agregarEjercicio(celda,idTabla){
    var indice = celda.parentNode.parentNode.rowIndex + 2;
    ejercicioEditable(idTabla,indice,"","",0,0,false);
}

function ejercicioEditable(idTabla,indice,musculo,ejercicio,series,repeticiones,completado){
    var tabla = document.getElementById(idTabla);
    var trNuevo = tabla.insertRow(indice);
    
    var td1 = trNuevo.insertCell();
    var td2 = trNuevo.insertCell();
    td2.setAttribute("colspan",2);
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
    
    option1.innerHTML = option1.value = "";
    option2.innerHTML = option2.value = "Pierna";
    option3.innerHTML = option3.value = "Pecho";
    option4.innerHTML = option4.value = "Espalda";
    option5.innerHTML = option5.value = "Biceps";
    option6.innerHTML = option6.value = "Triceps";
    option7.innerHTML = option7.value = "Hombros";
    option8.innerHTML = option8.value = "Antebrazo";
    option9.innerHTML = option9.value = "Abdomen";
    
    input1.type = "number";
    input2.type = "number";
    input3.type = "checkbox";
    botonG.type = "button";
    botonC.type = "button";
    botonG.value = "Guardar";
    botonC.value = "Eliminar";
    input3.name = "completado";
    botonG.setAttribute("onClick","guardarEjercicio(this,'"+idTabla+"')");
    botonC.setAttribute("onClick","cancelarEjercicio(this,'"+idTabla+"')");
    trNuevo.className = "escondeme";
    
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
    
    input1.value = series;
    input2.value = repeticiones;
    input3.checked = completado;
    
    for(var i = 0; i < select.options.length; i++){
        if(select.options[i].value === musculo){
            select.selectedIndex = i;
            break;
        }
    }
    poblar(select);
    for(var i = 0; i < select2.options.length; i++){
        if(select2.options[i].value === ejercicio){
            select2.selectedIndex = i;
            break;
        }
    }
}

function cancelarEjercicio(celda,idTabla){
    celda.parentNode.parentNode.remove(celda.parentNode);
    obtenerJson(idTabla);
}

function editarEjercicio(celda,idTabla){
    var renglon = celda.parentNode.parentNode;
    var indice = renglon.rowIndex;
    renglon.parentNode.removeChild(renglon);
    var musculo = renglon.cells[0].innerHTML;
    var ejercicio = renglon.cells[1].innerHTML;
    var series = renglon.cells[2].innerHTML;
    var repeticiones = renglon.cells[3].innerHTML;
    var completado = renglon.cells[4].innerHTML === "SI" ? true : false;
    ejercicioEditable(idTabla,indice,musculo,ejercicio,series,repeticiones,completado);
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
            selector.add(option8);
            selector.add(option9);
            break;
        }
        case "Biceps" :{
            var option0 = document.createElement("option");
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            var option5 = document.createElement("option");
            var option6 = document.createElement("option");
            var option7 = document.createElement("option");

            option0.value = option0.innerHTML = "";
            option1.value = option1.innerHTML = "Predicador barra";
            option2.value = option2.innerHTML = "Predicador mancuerna";
            option3.value = option3.innerHTML = "Curl mancuerna";
            option4.value = option4.innerHTML = "Curl sentado";
            option5.value = option5.innerHTML = "Curl inclinado";
            option6.value = option6.innerHTML = "Conc. mancuerna";
            option7.value = option7.innerHTML = "Jalon con polea";

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
        case "Triceps" :{
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
            option1.value = option1.innerHTML = "Copa tras nuca";
            option2.value = option2.innerHTML = "Mancuerna";
            option3.value = option3.innerHTML = "Una mano";
            option4.value = option4.innerHTML = "Jalones c/ polea frente";
            option5.value = option5.innerHTML = "Jalones c/ polea detras";
            option6.value = option6.innerHTML = "Para de mula 2 manos";
            option7.value = option7.innerHTML = "Curl frances volado";
            option8.value = option8.innerHTML = "Curl tras nuca";

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
        case "Hombro" :{
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
            option1.value = option1.innerHTML = "Trapecio";
            option2.value = option2.innerHTML = "Press tras nuca";
            option3.value = option3.innerHTML = "Press mancuernas";
            option4.value = option4.innerHTML = "Press frente";
            option5.value = option5.innerHTML = "Flyes laterales";
            option6.value = option6.innerHTML = "Flyes frontales";
            option7.value = option7.innerHTML = "Mariposa";
            option8.value = option8.innerHTML = "Ext. polea";

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
        case "Antebrazo" :{
            var option0 = document.createElement("option");
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            var option5 = document.createElement("option");
            var option6 = document.createElement("option");

            option0.value = option0.innerHTML = "";
            option1.value = option1.innerHTML = "Con barra";
            option2.value = option2.innerHTML = "Con barra de frente";
            option3.value = option3.innerHTML = "Con barra incodo";
            option4.value = option4.innerHTML = "Con mancuernas";
            option5.value = option5.innerHTML = "Con mancuernas incodo";
            option6.value = option6.innerHTML = "Con barra espalda";

            selector.add(option0);
            selector.add(option1);
            selector.add(option2);
            selector.add(option3);
            selector.add(option4);
            selector.add(option5);
            selector.add(option6);
            break;
        }
        case "Abdomen" :{
            var option0 = document.createElement("option");
            var option1 = document.createElement("option");
            var option2 = document.createElement("option");
            var option3 = document.createElement("option");
            var option4 = document.createElement("option");
            var option5 = document.createElement("option");

            option0.value = option0.innerHTML = "";
            option1.value = option1.innerHTML = "Con mancuernas";
            option2.value = option2.innerHTML = "Inclinado cabeza abajo";
            option3.value = option3.innerHTML = "Inclinado cabeza arriba";
            option4.value = option4.innerHTML = "Con pies al aire";
            option5.value = option5.innerHTML = "Piernas y pecho al aire";

            selector.add(option0);
            selector.add(option1);
            selector.add(option2);
            selector.add(option3);
            selector.add(option4);
            selector.add(option5);
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
    
    
    var musculo = renglon.cells[0].firstChild.value;
    var ejercicio = renglon.cells[1].firstChild.value;
    var series = renglon.cells[2].firstChild.value;
    var repeticiones = renglon.cells[3].firstChild.value;
    var avance = renglon.cells[4].firstChild.checked;
    
    if(musculo === "" || ejercicio === "" || series === "" || series <= 0 || repeticiones === "" || repeticiones <= 0){
        alert("Favor de llenar todos los campos");
        return;
    }
    
    crearEjercicio(idTabla,indice,musculo,ejercicio,series,repeticiones,avance,false);
    
    renglon.parentNode.removeChild(renglon);
    obtenerJson(idTabla);
}

function crearEjercicio(idTabla,indice,musculo,ejercicio,series,repeticiones,avance,oculto){
    var tabla = document.getElementById(idTabla);
    var trNuevo = tabla.insertRow(indice);
    var td1 = trNuevo.insertCell();
    var td2 = trNuevo.insertCell();
    var td3 = trNuevo.insertCell();
    var td4 = trNuevo.insertCell();
    var td5 = trNuevo.insertCell();
    var td6 = trNuevo.insertCell();
    
    var boton = document.createElement("input");
    
    td1.innerHTML = musculo;
    td2.innerHTML = ejercicio;
    td3.innerHTML = series;
    td4.innerHTML = repeticiones;
    td5.innerHTML = avance === true ? "SI" : "NO";
    
    boton.type = "button";
    boton.value = "editar";
    boton.setAttribute("onClick","editarEjercicio(this,'"+idTabla+"')");
    td2.setAttribute("colspan",2);
    td6.appendChild(boton);
    if(oculto){
        trNuevo.className = "ejercicioEscondido";
    }else{
        trNuevo.className = "ejercicio";
    }
}

function obtenerJson(idTabla){
    var tabla = document.getElementById(idTabla);
    var txt = document.getElementById("test");
    
    var dias = '';
    var ejercicios = '';
    var banderaAux = true;
    var nombreEjercicio
    for(var i = celdaInicial; i < tabla.rows.length; i++){
        var renglon = tabla.rows[i];
        if(renglon.className == "escondido" || renglon.className == "mostrando"){//entonces es un nuevo dia
            if(banderaAux){
                nombreEjercicio = renglon.cells[0].innerHTML;
                banderaAux = false;
            }else{
                if(dias !== ''){
                    dias += ',';
                }
                dias += '{ "nombre" : "' + nombreEjercicio +'" , "ejercicios" : [ ' + ejercicios + '] }'; 
                ejercicios = '';
                nombreEjercicio = renglon.cells[0].innerHTML;
            }
            
            i++;//saltarnos el renglon del boton
        }else if(renglon.className === "ejercicio" || renglon.className === "ejercicioEscondido"){
            
            var musculo = renglon.cells[0].innerHTML;
            var ejercicio = renglon.cells[1].innerHTML;
            var series = renglon.cells[2].innerHTML;
            var repeticiones = renglon.cells[3].innerHTML;
            var estado = renglon.cells[4].innerHTML;
            estado = estado == "NO" ? 0 : 1;
            if(ejercicios !== ''){
                ejercicios += ',';
            }
            ejercicios += '{'
            ejercicios += '"musculo": "'+musculo+'",';
            ejercicios += '"ejercicio": "'+ejercicio+'",';
            ejercicios += '"series": "'+series+'",';
            ejercicios += '"repeticiones": "'+repeticiones+'",';
            ejercicios += '"avance": "'+estado+'"';
            ejercicios += '}';
        }
    }
    if(dias !== ''){
        dias += ',';
    }
    dias += '{ "nombre" : "' + nombreEjercicio +'" , "ejercicios" : [ ' + ejercicios + '] }'; 
    var json = '{ "dias": [ ' + dias + '] }';   
    document.getElementById("test").innerHTML = json;
    var idInstructor = document.getElementById("idInstructor").value;
    var idAlumno = document.getElementById("idAlumno").value;
    guardarJson(idAlumno,idInstructor,json);
}

function borrarActividad(celda, idTabla){
    var r = confirm("¿Estas seguro de borrar el dia entero?");
    if(r){
        var tabla = document.getElementById(idTabla);
        var indice = celda.parentNode.parentNode.rowIndex;
        var renglon = tabla.rows[indice];
        do{
            renglon.parentNode.removeChild(renglon);
            renglon = tabla.rows[indice];
        }while(renglon.className !== "escondido" && renglon.className !== "mostrando"); 
        obtenerJson(idTabla);
    }
    
}