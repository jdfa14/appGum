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

function modificar(obj){
    var matricula = obj.getElementsByTagName("input")[0].value;
    window.location.href="rutina_actual.php?alumno="+matricula;
}

function eliminarAlumno(idAlumno) {
    if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {
        var param = "";
        param += "idAlumno="+idAlumno;
        receiveReq.open("GET", 'includes/borrarAlumno.php?' + param , true);
        receiveReq.send(null);
    }
}

function eliminar(idAlumno){
    var r = confirm("¿Estas seguro de borrar a este alumno?");
    if(r == true){
        var row = document.getElementById(idAlumno);
        row.parentNode.removeChild(row);
        eliminarAlumno(idAlumno);
    }
}
