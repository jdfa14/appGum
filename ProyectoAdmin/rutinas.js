var ejercicios_options = 
'<option value="unicep">unicep</option>'+
'<option value="bicep">bicep</option>'+
'<option value="tricep">tricep</option>'+
'<option value="cuadricep">cuadricep</option>'+
'<option value="plancho">plancho</option>'+
'<option value="sentadillas">sentadillas</option>';

function forma_rutina(destino, idforma) {
	var divdest = document.getElementById(destino);
	
	var forma = document.createElement("form");
	forma.id = idforma;
	divdest.appendChild(forma);
	var tabla = document.createElement("table");
	forma.appendChild(tabla);
	
	var fila;
	
	for(var i = 0; i < 10; i++) {
		(function(i){
		
		if(i % 5 == 0) {
			fila = tabla.insertRow(-1);
			for(var j = 0; j < 5; j++) {
				var cell = fila.insertCell(-1);
				cell.innerHTML = "Dia " + (i + j + 1);
			}
			
			fila = tabla.insertRow(-1);
		}
		
		var dia_cell = fila.insertCell(-1);
		//dia_cell.id = idtabla + "_" + i;
		
		var boton = document.createElement("button");
		dia_cell.appendChild(boton);
		boton.innerHTML = "Agregar ejercicio";
		boton.setAttribute("type", "button");
		var ejercicios = document.createElement("table");
		dia_cell.appendChild(ejercicios);
		
		var add_ejercicio_cell = ejercicios.insertRow(0).insertCell(0);
		boton.onclick = function() {
			
			var rowindex = ejercicios.getElementsByTagName("tr").length;
			var row = ejercicios.insertRow(rowindex);
			//var nuevo_ejercicio_cell = row.insertCell(-1);
			
			var ejercicioindex = rowindex - 1;
			
			$(row.insertCell(-1)).append(
				'<select name="dias[' + i + '][' + ejercicioindex + '][ejercicio]">' + ejercicios_options +'</select>'
			);
			$(row.insertCell(-1)).append(
				'S: <input type="number" size="4" name="dias[' + i + '][' + ejercicioindex + '][series]" />'
			);
			$(row.insertCell(-1)).append(
				'R: <input type="number" size="4" name="dias[' + i + '][' + ejercicioindex + '][repeticiones]" />'
			); 
		};
		})(i);
	}
}

function despliega_rutina(destino, datos, avance) {
	var divdest = document.getElementById(destino);
	
	var tabla = document.createElement("table");
	divdest.appendChild(tabla);
	
	var fila;
	
	for(var i = 0; i < 10; i++) {
		
		if(i % 5 == 0) {
			fila = tabla.insertRow(-1);
			for(var j = 0; j < 5; j++) {
				var cell = fila.insertCell(-1);
				cell.innerHTML = "Dia " + (i + j + 1);
			}
			
			fila = tabla.insertRow(-1);
		}
		
		var dia_cell = fila.insertCell(-1);
		//dia_cell.id = idtabla + "_" + i;
		
		
		var ejercicios = document.createElement("table");
		dia_cell.appendChild(ejercicios);
		
		for(var j = 0; j < datos.dias[i].length; j++) {
			console.log("i " + i + " j " + j);
			var row = ejercicios.insertRow(-1);
			
			$(row.insertCell(-1)).append(
				datos.dias[i][j].ejercicio
			);
			$(row.insertCell(-1)).append(
				"S: " + datos.dias[i][j].series
			);
			$(row.insertCell(-1)).append(
				"R: " + datos.dias[i][j].repeticiones
			);
			
			if(avance) {
				row = ejercicios.insertRow(-1);
				$(row.insertCell(-1)).append(
					"C: " + avance.dias[i][j].comentario
				);
				$(row.insertCell(-1)).append(
					"T: " + avance.dias[i][j].completado
				);
			}
		}
	}
}


function ejecutar() {
	/*alert("rutina_actual.php?alumno=" + alumno);
	
	$.post( "rutina_actual.php?alumno=" + alumno, { definicion: $("#nueva_rutina").serializeJSON()})
		.done(function( data ) {
			window.location.reload(true); 
			
			
	});*/
	
	var forma = document.createElement("form");
	forma.method = "POST";
	forma.action = "rutina_actual.php?alumno=" + alumno;
	var input = document.createElement("input");
	input.type = "hidden";
	input.name = "definicion";
	input.id = "definicion";
	input.value = $("#nueva_rutina").serializeJSON();

	alert(input.value);
	
	forma.appendChild(input);
	document.body.appendChild(forma);
	forma.submit();
}

// del servidor al movil
var ejemplo_rutina = {
	"dias" : [
		[ // dia 0
			{ // primer ejercicio
				"ejercicio" : "triceps",
				"series" : 10,
				"repeticiones" : 5
			},
			{ // segundo
				"ejercicio" : "pierna",
				"series" : 12,
				"repeticiones" : 3
			}
		],
		
		[ // dia 1
			{
				"ejercicio" : "triceps",
				"series" : 10,
				"repeticiones" : 5
			},
			{
				"ejercicio" : "pierna",
				"series" : 12,
				"repeticiones" : 3
			}
		]
		
		//... hasta el dia 10
	],
	
	"peso_inicial" : 75.3
}

//del movil al servidor

var ejemplo_llenado = {
	"dias" : [
		[ // dia 0
			{
				"completado" : true,
				"comentarios" : ""
			},
			
			
			{
				"completado" : false,
				"comentarios" : "no hice eso pero corri 12km"
			}
		]
	],
	
	"peso_final" : 48.0
}
