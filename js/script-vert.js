function mostrarInfo(c){
    elems = document.getElementsByClassName(c);
    for(i = 0;  i < elems.length; i++){
        if(elems[i].style.display == "none"){
            console.log(1213131313131313131313);
            elems[i].style.display = '';
            
        }
        else{
            elems[i].style.display = 'none';
        }
    }
}

function cambiarSize(elem){
    if(elem.width == 320){
        elem.width = 800;
        elem.height = 600;
    }
    else{
        elem.width = 320;
        elem.height = 240;
    }
}