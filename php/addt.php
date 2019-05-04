<?php
include('validaciones.php');

mb_internal_encoding('UTF-8');
if ($_POST) {
    echo '<pre>';
    echo htmlspecialchars(print_r($_POST, true));
    echo '</pre>';
}
if(isset($_POST['boton-submit'])){
    $mysql = new mysqli('127.0.0.1', 'root', '','tarea2');
    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    } 
    $mysql->set_charset("utf8");
    $validacion = !validarComuna('comuna-origen', 'region-origen', $mysql, 'origen') or !validarComuna('comuna-destino', 'region-destino', $mysql, 'destino') or
                !validarFecha('fecha-viaje') or !validarEspacio('espacio-necesario', $mysql) or !validarTipo('Tipo-mascota', $mysql) or !validarDescripcion('descripcion-mascota') or
                !validarNombre('nombre') or !validarEmail('email') or !validarNumero('celular'); 


    //
    echo "<p>"."comuna1 ".validarComuna('comuna-origen', 'region-origen', $mysql, 'origen');
    echo "<p>"."com2 ".validarComuna('comuna-destino', 'region-destino', $mysql, 'destino');
    echo "<p>"."fecha ".validarFecha('fecha-viaje');
    echo "<p>"."espacio ".validarEspacio('espacio-necesario', $mysql);
    echo "<p>"."tipo ".validarTipo('Tipo-mascota', $mysql);
    echo "<p>"."des ".validarDescripcion('descripcion-mascota');
    echo "<p>"."nombre ".validarNombre('nombre');
    echo "<p>"."email ".validarEmail('email');
    echo "<p>"."num ".validarNumero('celular');
    //

    if($validacion){
        return false;
    }

    // $comunaOrigen = validarComuna('comuna-origen', 'region-origen', $mysql, 'origen');
    // $comunaDestino = validarComuna('comuna-destino', 'region-destino', $mysql, 'destino');
    // $fecha = validarFecha('fecha-viaje');
    // $espacio = validarEspacio('espacio-necesario', $mysql);
    // $tipo = validarTipo('Tipo-mascota', $mysql);
    // $descripcion = validarDescripcion('descripcion-mascota');
    // $nombre = validarNombre('nombre');
    // $email = validarEmail('email');
    // $celular = validarNumero('celular');

    echo "<b>".$comunaOrigen."</b>";
    // $comuna1_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaOrigen'";
    // $comuna2_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaDestino'";
    // $comuna1_result = $mysql->query($comuna1_query);
    // $comuna2_result = $mysql->query($comuna2_query);
    // $comuna1 = $comuna1_result->fetch_assoc()['id'];
    // $comuna2 = $comuna2_result->fetch_assoc()['id'];

    // $insert = "INSERT INTO traslado (comuna_origen, comuna_destino, fecha_viaje, espacio, tipo_mascota_id,
    //     descripcion, nombre_contacto, email_contacto, celular_contacto) VALUES 
    //     ('$comunaOrigen', '$comunaDestino', '$fecha', '$espacio', '$tipo', '$descripcion', 
    //     '$nombre', '$email', '$celular')";
    if($mysql->query($insert) === TRUE){
        echo "Nuevo ingreso de datos existoso";
    }
    else{
        echo "Error: ". $insert . "<br>". $mysql->error;
    }
    $mysql->close();
}
// $mysqli = new mysqli('127.0.0.1', 'root', '','tarea2');
// $mysqli->set_charset("utf8");
// // $db = mysqli_connect("host=localhost port=3306 dbname=tarea2 user=root password=123") or die("No se ha podido concectar : ". pg_last_error());
// $o = $mysqli->query("select * from region");
// while($f = $o->fetch_object()){
//     echo $f->nombre."<br/>";
// }
?>
