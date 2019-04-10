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
        nodo.setAttribute("name",  "img");
        nodo.setAttribute("accept", "Image/*");
        nodo.setAttribute("oninput", "annadirInputFile()");
        document.getElementById("files").appendChild(nodo);
    }
}