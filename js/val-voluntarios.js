function validarEspacio(id, id2){
    val = document.getElementById(id).value;
    if(val == "mas"){
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

function validarNombre(id){
    valor = document.getElementById(id).value;
    if(valor.length < 3 || valor.length > 80 ){
        alert('Nombre de contacto invalido');
        return false;
    }
    return true; 
}
function validarDescripcion(id){
    valor= document.getElementById(id).value;
    if(valor.length > 500){
        alert('Descripcion demasiado larga');
        return false;
    }
    return true;
}

function validarCorreo(id){
    correoRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    valor = document.getElementById(id).value;
    if(!correoRegex.test(valor)){
        alert("Correo invalido");
    }
    return true;
}

function validarCelular(id){
    valor = document.getElementById(id).value;
    if(valor > 999999999 || valor < 900000000){
        alert('Celular invalido');
        return false;
    }
    return true;
}

function validacion(){
    return  validarNombre("nombre") &&
    validarCorreo("email") &&
    validarCelular("celular") &&
    validarEspacio("esp-necesario", "input-espacio") &&
    validarDescripcion("descripcion");
    
}