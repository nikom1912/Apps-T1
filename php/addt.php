<?php
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

    $regionOrigen = $_POST['region-origen'];
    $comunaOrigen = $_POST['comuna-origen'];
    $regionDestino = $_POST['region-destino'];
    $comunaDestino = $_POST['comuna-destino'];
    $fecha = $_POST['fecha-viaje'];
    $espacio = $_POST['espacio-necesario'];
    $tipo = $_POST['Tipo-mascota'];
    $descripcion = $_POST['descripcion-mascota'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    if($espacio == 'mas'){
        $espacio = $_POST['opcion-mas'];
        echo "<br>"."holia"."<br/>";
    }

    $esp_query = "SELECT id FROM espacio WHERE valor = '$espacio'";
    $dbesp = $mysql->query($esp_query);
    $id = $dbesp->fetch_assoc()['id'];
    if($id == ""){
        $max_id_query = $mysql->query("SELECT MAX(id) as id FROM espacio");
        $max_id = $max_id_query->fetch_assoc()['id'];
        $max_id++;
        $id = $max_id;
        $mysql->query("INSERT INTO espacio (id, valor) VALUES ('$max_id', '$espacio')");
    }

    $tipo_query = "SELECT id FROM tipo_mascota WHERE descripcion = '$tipo'";
    $tipo_result = $mysql->query($tipo_query);
    $tipo_id = $tipo_result->fetch_assoc()['id'];
    if($tipo_id == ""){
        $max_tipo_id_query = $mysql->query("SELECT MAX(id) as id FROM tipo_mascota");
        $max_tipo_id = $max_id_query->fetch_assoc()['id'];
        $max_tipo_id++;
        $tipo_id = $max_tipo_id;
        $mysql->query("INSERT INTO tipo_mascota (id, descripcion) VALUES ('$max_tipo_id', '$tipo')");
    }


    $comuna1_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaOrigen'";
    $comuna2_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaDestino'";
    $comuna1_result = $mysql->query($comuna1_query);
    $comuna2_result = $mysql->query($comuna2_query);
    $comuna1 = $comuna1_result->fetch_assoc()['id'];
    $comuna2 = $comuna2_result->fetch_assoc()['id'];
    $insert = "INSERT INTO traslado (comuna_origen, comuna_destino, fecha_viaje, espacio, tipo_mascota_id,
        descripcion, nombre_contacto, email_contacto, celular_contacto) VALUES 
        ('$comuna1', '$comuna2', '$fecha', '$id', '$tipo_id', '$descripcion', 
        '$nombre', '$email', '$celular')
        ";
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
