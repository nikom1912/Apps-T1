<?php

function validarRegion($name, $bdd){
    if(isset($_POST[$name])){
        $value = $_POST[$name];
    }
    else if(isset($_GET[$name]){
        $value = $_GET[$name];
    }
    else{
        echo '<script language="javascript"> alert("Region Invalida");</script>';
    }
    $region_result = $bdd->query("SELECT ")

}

?>