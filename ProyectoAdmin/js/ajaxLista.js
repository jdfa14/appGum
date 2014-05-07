var sendReq = getXmlHttpRequestObject();
var receiveReq = getXmlHttpRequestObject();

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
            die("cant create Request Object");
	}
}

function getAlumnos(instructor) {
    if (receiveReq.readyState === 4 || receiveReq.readyState === 0) {
            receiveReq.open("GET",'includes/obtenerAlumnos.php',true);
            receiveReq.onreadystatechange = xmlAlumnos; 
            receiveReq.send(null);
    }
}

function xmlAlumnos(){
    if(receiveReq.readyState === 4){
        var xmlDoc = receiveReq.responseXML;
        var alumnos = xmlDoc.getElementsByTagName("alumno");
        var table = document.getElementById("alumnos");
        var tbody = table.getElementsByTagName("tbody")[0];
        for(var i = 0; i < alumnos.length; i++){
            var tr = document.createElement("tr");
            var tdMatricula = document.createElement("td");
            var tdNombre = document.createElement("td");
            var tdApellido = document.createElement("td");
            tdMatricula.innerHTML = alumnos[i].getElementsByTagName("matricula")[0].innerHTML;
            tdNombre.innerHTML = alumnos[i].getElementsByTagName("nombre")[0].innerHTML;
            tdApellido.innerHTML = alumnos[i].getElementsByTagName("apellido")[0].innerHTML;
            tr.appendChild(tdMatricula);
            tr.appendChild(tdNombre);
            tr.appendChild(tdApellido);
            tbody.appendChild(tr);
        }
    }
}
