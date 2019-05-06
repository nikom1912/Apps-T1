function validarEspacio(id, id2){
    val = document.getElementById(id).value;
    if(val == "mas"){
        console.log("holiaaaaaaaaaa")
        val = document.getElementById(id2).value;
    }
    arrVal = val.split("x");
    if(arrVal.length != 3){
        alert(id + ' invalido (formato intxintxint ej.: 100x100x100)');
        return false;
    }
    valor1 = arrVal[0];
    valor2 = arrVal[1];
    valor3 = arrVal[2];
    if(!jQuery.isNumeric(valor1) || !jQuery.isNumeric(valor2) || !jQuery.isNumeric(valor3)){
        alert(id + ' invalido (formato intxintxint ej.: 100x100x100)');
        return false;
    }
}
function validarFecha(id){
    
    fecha = document.getElementById(id).value;
    arrFecha = fecha.split("-");
    if(arrFecha.length != 3){
        alert(id + ' invalida (formato: aaaa-mm-dd')
        return false;
    }
    anno = arrFecha[0];
    mes = arrFecha[1];
    dia = arrFecha[2];
    if(!jQuery.isNumeric(anno) || !jQuery.isNumeric(mes) || !jQuery.isNumeric(dia)){
        alert(id + ' invalida')
        return false;
    }

    if(dia > 31 || dia < 0  || mes > 12 || mes < 1 || anno < 0){
        alert(id + ' invalida')
        return false;
    }

    // f = new Date();
    // if(parseInt(anno, 10) < f.getFullYear()){
    //     alert('La ' + id + ' debe ser posterior a la fecha actual.');
    //     return false;

    // }
    // else if( parseInt(mes) < f.getMonth() + 1){
    //     alert('La ' + id + ' debe ser posterior a la fecha actual.');
    //     return false;
    // }
    // else if(parseInt(dia) < f.getDate()){
    //     alert('La ' + id + ' debe ser posterior a la fecha actual.');
    //     return false;
    // }
    return true;
}

function validarNombre(id){
    valor = document.getElementById(id).value;
    if(valor.length < 3 || valor.length > 80 ){
        alert('Nombre de contacto invalido')
        return false;
    }
    return true; 
}
function validarDescripcion(id){
    valor= document.getElementById(id).value;
    if(valor.length > 500){
        alert('Descripcion de Mascota demasiado larga')
        return false;
    }
    return true;
}

function validarCorreo(id){
    correoRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    valor = document.getElementById(id).value;
    if(!correoRegex.test(valor)){
        alert("Correo invalido");
        return false;
    }
    return true;
}

function validarCelular(id){
    valor = document.getElementById(id).value;
    if(valor > 999999999 || valor < 900000000){
        alert('Celular invalido (formato: 912345678)')
        return false;
    }
    return true;
}

function validarImagenes(){
    fs = document.getElementById("files").getElementsByTagName("input");
    console.log(files);
    if(fs.length < 1){
        alert('No hay fotos agregadas');
        return false;
    }
    if(fs.length > 5){
        alert("Maximo de fotos superadas");
        return false;
    }
    i =1;
    console.log(fs);
    for (j = 0; j < fs.length; j++){
        if(fs[j].files.length==0){
            continue;
        }
        console.log(fs[j].files[0].name);
        
        imageRegex = /\.(jpg|png|jpeg|gif)$/i;
        if(!imageRegex.test(fs[j].files[0].name)){
            alert('Formato imagen ' + i + ' invalido');
            return false;
        }
        i++;
    }
    return true;
}

function validarMascota(id){
    val = document.getElementById(id).value;
    if(val.length <= 0){
        alert("Ingrese un tipo de mascota")
        return false;
    }
    return true;
}
function validarImagen(obj){
    if(obj.value == "") return;
    var inputFile = obj.files[0];
    console.log(inputFile.name);
    imageRegex = /\.(jpg|png|jpeg|gif)$/i;
    if(!imageRegex.test(inputFile.name)){
        alert('Formato imagen invalido');
        inputFile.name = "";
        return false;
    }
    return true;
}


function validacion(){
    return validarFecha("fecha-viaje") &&
    validarEspacio("esp-necesario", "input-espacio") &&
    validarMascota("tipo-mascota") &&
    validarImagenes() &&
    validarDescripcion("descripcion") &&
    validarNombre("nombre") &&
    validarCorreo("email") &&
    validarCelular("celular");
    
}
