<?php
// $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
$mysql = new mysqli("localhost", 'root', '','tarea2');
if(isset($_GET['buscar'])){
    $busqueda = $_GET['buscar'];
    $query = "SELECT  voluntario.id AS id, nombre_voluntario AS nombre FROM voluntario, espacio, comuna, region WHERE 
    espacio_disponible = espacio.id AND comuna_disponible = comuna.id AND comuna.region_id = region.id AND nombre_voluntario LIKE '%".$busqueda."%' ORDER BY voluntario.id DESC";

    $result = $mysql->query($query);               
                    
    if($result){
        if($result->num_rows > 0){
            while( $datos = $result->fetch_array()){
                $nombre = $datos['nombre'];
                $id = $datos['id'];
                echo "<li> <a href='vervoluntario.php?id=$id'> ". $nombre ."</a> </li>";
            }
        }
        else{
            echo "<li> No hay coincidencias... </li>";
        }
    }
    else{
        echo "<li> No hay coincidencias... </li>";
    }
}
?>