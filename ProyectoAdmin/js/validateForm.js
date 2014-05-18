var sendReq = getXmlHttpRequestObject();
var receiveReq = getXmlHttpRequestObject();

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		echo("Ajax not working");
	}
}

function usuarioExistente(idAlumno){
    if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
        var param = "";
        param += "idAlumno="+idAlumno;
        receiveReq.open("GET", 'includes/datosAlumno.php?' + param , true);
        receiveReq.onreadystatechange = autocompletar;
        receiveReq.send(null);
    }
}

function autocompletar(){
    if (receiveReq.readyState === 4){
        var json = JSON.parse(receiveReq.responseText);
        if(json !== null){
            var nombre = document.getElementById("nombres");
            var apellido = document.getElementById("apellidos");
            var correo = document.getElementById("correo");
            var peso = document.getElementById("peso");

            nombre.value = json['nombre'];
            apellido.value = json['apellido'];
            correo.value = json['correo'];
            peso.value = json['peso'];


            var fecha = json['nacimiento']
            var anio = fecha.substring(0,4);
            var mes = fecha.substring(5,7);
            var dia = fecha.substring(8,10);
            var sexo = json['sexo'];

            var sDia = document.getElementById("dia");
            var sMes = document.getElementById("mes");
            var sAnio = document.getElementById("anio");
            var sSexo = document.getElementById("sexo");

            for(var i = 0; i < sDia.options.length; i++){
                if(sDia.options[i].value === dia){
                    sDia.selectedIndex = i;
                    break;
                }
            }
            for(var i = 0; i < sMes.options.length; i++){
                if(sMes.options[i].value === mes){
                    sMes.selectedIndex = i;
                    break;
                }
            }
            for(var i = 0; i < sAnio.options.length; i++){
                if(sAnio.options[i].value === anio){
                    sAnio.selectedIndex = i;
                    break;
                }
            }
            for(var i = 0; i < sSexo.options.length; i++){
                if(sSexo.options[i].value === sexo){
                    sSexo.selectedIndex = i;
                    break;
                }
            }
        }
    }
}

function validMatricula(input){
    var div = document.getElementById("divMat");
    var labelO = document.getElementById("aqws12");
    var label = document.createElement("label");
    label.id = "aqws12";
    if(!labelO){
        div.appendChild(label);
    }else{
        div.replaceChild(label,labelO);
    }
    if(input.value.length != 9){
        label.innerHTML = "Error en formato";
        label.style.color = "red";
        return 0;
    }else{
        label.innerHTML = "Correcto";
        label.style.color = "green";
        usuarioExistente(input.value);
        return 1;
    }
    
}
