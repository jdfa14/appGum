function validMatricula(input){
    var div = document.getElementById("divMat");
    var labelO = document.getElementById("aqws12");
    var label = document.createElement("label");
    //input.value = input.value.length;
    label.id = "aqws12";
    if(input.value.length != 9){
        label.innerHTML = "Error en formato";
        label.style.color = "red";
    }else{
        label.innerHTML = "Correcto";
        label.style.color = "green";
    }
    if(!labelO){
        div.appendChild(label);
    }else{
        div.replaceChild(label,labelO);
        //labelO.innerHTML = "HI";
    }
}

