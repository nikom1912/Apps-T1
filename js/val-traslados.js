function validacion(){
    validarFecha("fecha-viaje");
    return false;
    
}

function validarFecha(id){
    
    fecha = document.getElementById(id).value;
    arrFecha = fecha.split("-");
    if(arrFecha.length != 3){
        alert(id + ' invalida')
        return false;
    }
    anno = arrFecha[0];
    mes = arrFecha[1];
    dia = arrFecha[2];
    if(!jQuery.isNumeric(anno) && !jQuery.isNumeric(mes) && !jQuery.isNumeric(dia)){
        alert(id + ' invalida')
        return false;
    }

    if(dia > 31 || dia < 0  || mes > 12 || mes < 1 || anno < 0){
        alert(id + ' invalida')
        return false;
    }
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


