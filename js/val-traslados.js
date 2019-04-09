function validacion(){
    validarFecha("fecha-viaje");
    return false;
    
}

function validarFecha(id){
    
    fecha = document.getElementById(id).value;
    arrFecha = fecha.split("-");
    anno = arrFecha[0];
    mes = arrFecha[1];
    dia = arrFecha[2];
    f = new Date();
    if(parseInt(anno, 10) < f.getFullYear()){
        alert('La ' + id + ' debe ser posterior a la fecha actual.');
        return false;

    }
    else if( parseInt(mes) < f.getMonth() + 1){
        alert('La ' + id + ' debe ser posterior a la fecha actual.');
        return false;
    }
    else if(parseInt(dia) < f.getDate()){
        alert('La ' + id + ' debe ser posterior a la fecha actual.');
        return false;
    }
    return true;
}