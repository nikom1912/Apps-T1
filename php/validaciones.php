<?php

function validarComuna($name, $regionName, $bdd, $tipo){
    if(isset($_POST[$regionName])){
        $region_value = $_POST[$regionName];
    }
    else if(isset($_GET[$name])){
        $region_value = $_GET[$regionName];
    }
    else{
        echo '<script language="javascript">'."alert('Error en Region $tipo');"."</script>";
        return false;
    }
    
    $region_result = $bdd->query("SELECT id FROM region WHERE nombre = '$region_value'");
    $region_dbval = $region_result->fetch_assoc()['id'];
    if($region_dbval == ""){
        echo '<script language="javascript">'." alert('Region ". $tipo ." inválida');"."</script>";
        return false;
    }

    if(isset($_POST[$name])){
        $com_value = $_POST[$name];
    }
    else if(isset($_GET[$name])){
        $com_value = $_GET[$name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en Comuna $tipo');"."</script>";
        return false;
    }

    $com_result = $bdd->query("SELECT comuna.id FROM comuna WHERE region_id = id AND comuna.nombre = '$name'");
    $com_dbval = $com_result->fetch_assoc()['id'];
    if($com_dbval == ""){
        echo '<script language="javascript">'."alert('Comuna'"."$tipo "."'inválida');"."</script>";
        return false;
    }
    return $com_dbval;
}

Function validarFecha($fecha_name){
    if(isset($_POST[$fecha_name])){
        $value = $_POST[$fecha_name]; 
    }
    else if(isset($_GET[$fecha_name])){
        $value = $_GET[$fecha_name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en fecha de viaje');"."</script>";
        return false;
    }
    if($value < date('y-m-d')){
        echo '<script language="javascript">'."alert('Fecha de viaje debe ser posterior a la fecha actual');"."</script>";
        return false;
    }
    return $value;
}

function validarEspacio($esp_name, $bdd){
    if(isset($_POST[$esp_name])){
        $value = $_POST[$esp_name]; 
        if($value == 'mas'){
            $value = $_POST['opcion-mas'];
        }
    }
    else if(isset($_GET[$esp_name])){
        $value = $_GET[$esp_name];
        if($value == 'mas'){
            $value = $_GET['opcion-mas'];
        }
    }
    else{
        echo '<script language="javascript">'."alert('Error en espacio necesario');"."</script>";
        return false;
    }

    
    $arr_esp = explode("x", $value);
    if(sizeof($arr_esp) != 3){
        echo '<script language="javascript">'."alert('Espacio necesario inválido');"."</script>";
        return false;
    }
    for($i = 0; $i < 3; $i++){
        if(!is_numeric($arr_esp[$i]) && ((int) $arr_esp[$i]) > 0 ){
            echo '<script language="javascript">'."alert('Espacio necesario inválido');"."</script>";
            return false;
        }
    }

    $esp_query = "SELECT id FROM espacio WHERE valor = '$value'";
    $dbesp = $bdd->query($esp_query);
    $id = $dbesp->fetch_assoc()['id'];
    if($id == ""){
        $max_id_query = $bdd->query("SELECT MAX(id) as id FROM espacio");
        $max_id = $max_id_query->fetch_assoc()['id'];
        $max_id++;
        $id = $max_id;
        $bdd->query("INSERT INTO espacio (id, valor) VALUES ('$max_id', '$value')");
    }
    return $id;
}

function validarTipo($type_name, $bdd){
    if(isset($_POST[$type_name])){
        $value = $_POST;
    }
    else if(isset($_GET[$type_name])){
        $value = $_GET[$type_name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en tipo mascota');"."</script>";
        return false;
    }
    if($value = ""){
        echo '<script language="javascript">'."alert('Tipo mascota inválido');"."</script>";
        return false;
    }
    $type_result = $bdd->query("SELECT id FROM tipo_mascota WHERE descripcion = '$value'");
    $type_id = $type_result->fetch_assoc()['id'];
    if($type_id == ""){
        $max_tipo_id_query = $bdd->query("SELECT MAX(id) as id FROM tipo_mascota");
        $max_tipo_id = $max_tipo_id_query->fetch_assoc()['id'];
        $max_tipo_id++;
        $type_id = $max_tipo_id;
        $bdd->query("INSERT INTO tipo_mascota (id, descripcion) VALUES ('$max_tipo_id', '$value')");
    }
    return $type_id;
}

function validarDescripcion($des_name){
    if(isset($_POST[$des_name])){
        $value = $_POST[$des_name];
    }
    else if(isset($_POST[$des_name])){
        $value = $_GET[$des_name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en Descripcion mascota');"."</script>";
        return false;
    }

    if(strlen($value) > 500){
        echo '<script language="javascript">'."alert('Descripcion de mascota demasiado larga (Max. 500 caracteres)');"."</script>";
        return false;
    }
    if($value == ""){
        echo '<script language="javascript">'."alert('Descripcion de mascota inválida');"."</script>";
        return false;
    }
    return $value;
}

function validarNombre($name){
    if(isset($_POST[$name])){
        $value = $_POST[$name];
    }
    else if(isset($_POST[$name])){
        $value = $_GET[$name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en Nombre contacto');"."</script>";
        return false;
    }
    if(strlen($value) > 500){
        echo '<script language="javascript">'."alert('Nombre contacto demasiado larga (Máx. 80 caracteres)');"."</script>";
        return false;
    }
    if(strlen($value) < 3){
        echo '<script language="javascript">'."alert('Nombre contacto demasiado corto (Min. 3 caracteres)');"."</script>";
        return false;
    }
    return $value;
}
function validarEmail($email_name){
    if(isset($_POST[$email_name])){
        $value = $_POST[$email_name];
    }
    else if(isset($_POST[$email_name])){
        $value = $_GET[$email_name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en Email contacto');"."</script>";
        return false;
    }
    $correoRegex = '/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
    if(!preg_match($correoRegex, $value)){
        echo '<script language="javascript">'."alert('Email contacto inválido');"."</script>";
        return false;
    }
    return $value;
}
function validarNumero($num_name){
    if(isset($_POST[$num_name])){
        $value = $_POST[$num_name];
    }
    else if(isset($_POST[$num_name])){
        $value = $_GET[$num_name];
    }
    else{
        echo '<script language="javascript">'."alert('Error en Número contacto');"."</script>";
        return false;
    }
    $numeReg = '/^[9][0-9]{8}$/';
    if(!preg_match($numeReg, $value)){
        echo '<script language="javascript">'."alert('Número contacto inválido');"."</script>";
        return false;
    }
    return $value; 
}
?>