<?php
// $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
$mysql = new mysqli("localhost", 'root', '','tarea2');
$query = "SELECT traslado.id, c.nombre AS origen, co.nombre AS destino, r.nombre AS r_origen, ro.nombre AS r_destino, fecha_viaje AS fecha, e.valor AS espacio, m.descripcion AS tipo,traslado.descripcion AS descripcion, email_contacto AS 
                email, nombre_contacto AS nombre, celular_contacto AS celular FROM traslado, comuna c, comuna co, region r, region ro,  tipo_mascota m, espacio e WHERE comuna_origen = c.id AND comuna_destino = co.id
                AND r.id = c.region_id AND ro.id = co.region_id AND tipo_mascota_id = m.id AND espacio = e.id";
$result = $mysql->query($query);
$arr = array();
if($result){
    while( $datos = $result->fetch_array()){
        $id = $datos['id'];
        $query_img = "SELECT  ruta_archivo AS ruta, nombre_archivo AS nombre FROM foto_mascota WHERE traslado_id = '$id'";
        $result_img = $mysql->query($query_img);
        $r = $datos['r_origen'];
        $ro = $datos['r_destino'];
        $nombre = $datos['nombre'];
        $c = utf8_encode($datos['origen']);
        $co = $datos['destino'];
        $fecha = $datos['fecha']; 
        $tipo = $datos['tipo'];
        $array = array(
            "region" => $r,
            "fecha" => $fecha,
            "tipo" => $tipo,
            "nombre" => $nombre
        );
        $imgarray = array();
        while($dbimg = $result_img->fetch_array()){
            $imgarray[] = $dbimg['ruta'] . "/" . $dbimg['nombre'];
        }
        $array["imagenes"] = $imgarray;
        if(array_key_exists($c, $arr)){
            $arr[$c][] = $array;
        }
        else{
            $arr[$c] = array();
            $arr[$c][] = $array;
        }
    }
    $ar = array();
    $as = "12313";
    $ar[$as] = 23;
    
    echo json_encode(utf8_converter($arr));
}

function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}
?>