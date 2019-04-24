function mostrar(object, val, id){
    if(object.value== val){
        document.getElementById(id).style.display = 'inline-block';
    }
    else{
        document.getElementById(id).style.display = 'none';
    }
}

function annadirInputFile(){
    valo = document.getElementById("files").getElementsByTagName("input");
    val = valo[valo.length - 1];
    if(val.value == "" && valo.length > 1){
        val.parentNode.removeChild(val);
        return;
    }
    else if(valo.length< 5){
        var nodo = document.createElement("input");
        nodo.setAttribute("type", "file");
        nodo.setAttribute("accept", "Image/*");
        nodo.setAttribute("onchange", "validarImagen(this) && annadirInputFile()");
        document.getElementById("files").appendChild(nodo);
    }
}

function annadirComuna(){
    val = document.getElementsByClassName("c")[0];
    aux = document.getElementsByClassName("comuna");
    a = [];
    for(i = 0; i < aux.length; i++){
        a.push(aux[i].getElementsByTagName("input")[0]);
    }
    console.log(i);
    if(a.length < 4){
        i = i + 2;
        selectC = document.createElement("select");
        selectC.setAttribute("id", "comunas" + i);
        selectC.setAttribute("name", "comuna-disponible");
        selectR = document.createElement("select");
        selectR.setAttribute("id", "regiones" + i);
        selectR.setAttribute("name", "region-disponible");
        trR = document.createElement("tr");
        thTR =  document.createElement("th");
        thTR.appendChild(document.createTextNode("Region disponible"));
        trR.appendChild(thTR);
        val.appendChild(trR);
        trR2 = document.createElement("tr");
        tdR = document.createElement("td");
        divR = document.createElement("div");
        divR.setAttribute("class", "region");
        divR.appendChild(selectR);
        tdR.appendChild(divR);
        trR2.appendChild(tdR);
        val.appendChild(trR);
        val.appendChild(trR2);
        trC = document.createElement("tr");
        thTC =  document.createElement("th");
        thTC.appendChild(document.createTextNode("Comuna disponible"));
        trC.appendChild(thTC);
        val.appendChild(trC);
        trC2 = document.createElement("tr");
        tdC = document.createElement("td");
        divC = document.createElement("div");
        divC.setAttribute("class", "comuna");
        divC.appendChild(selectC);
        tdC.appendChild(divC);
        trC2.appendChild(tdC);
        val.appendChild(trC);
        val.appendChild(trC2);
    }

}