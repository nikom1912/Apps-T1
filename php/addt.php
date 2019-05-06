<?php
function validarTraslados(){
    include('validaciones.php');
    mb_internal_encoding('UTF-8');
    // if ($_POST) {
    //     echo '<pre>';
    //     echo htmlspecialchars(print_r($_POST, true));
    //     echo '</pre>';
    // }
    // if($_FILES){
    //     echo '<pre>';
    //     echo htmlspecialchars(print_r($_FILES, true));
    //     echo '</pre>';
    // }
    // return true;
    if(isset($_POST['boton-submit'])){
        $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
        if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
        } 
        $mysql->set_charset("utf8");
        $validacion = !validarComuna('comuna-origen', 'region-origen', $mysql, 'origen') or !validarComuna('comuna-destino', 'region-destino', $mysql, 'destino') or
                    !validarFecha('fecha-viaje') or !validarEspacio('espacio-necesario') or !validarTipo('Tipo-mascota') or !validarImg('Foto-mascota', 1) or !validarDescripcion('descripcion-mascota') or
                    !validarNombre('nombre') or !validarEmail('email') or !validarNumero('celular'); 


        //
        // echo "<p>"."comuna1 ".validarComuna('comuna-origen', 'region-origen', $mysql, 'origen');
        // echo "<p>"."com2 ".validarComuna('comuna-destino', 'region-destino', $mysql, 'destino');
        // echo "<p>"."fecha ".validarFecha('fecha-viaje');
        // echo "<p>"."espacio ".validarEspacio('espacio-necesario');
        // echo "<p>"."tipo ".validarTipo('Tipo-mascota');
        // echo "<p>"."des ".validarDescripcion('descripcion-mascota');
        // echo "<p>"."nombre ".validarNombre('nombre');
        // echo "<p>"."email ".validarEmail('email');
        // echo "<p>"."num ".validarNumero('celular');
        //

        if($validacion){
            return FALSE;
        }

        $comunaOrigen = validarComuna('comuna-origen', 'region-origen', $mysql, 'origen');
        $comunaDestino = validarComuna('comuna-destino', 'region-destino', $mysql, 'destino');
        $fecha = validarFecha('fecha-viaje');
        $espacio = masEsp(validarEspacio('espacio-necesario'), $mysql);
        $tipo = otraMascota(validarTipo('Tipo-mascota'), $mysql);
        $descripcion = validarDescripcion('descripcion-mascota');
        $nombre = validarNombre('nombre');
        $email = validarEmail('email');
        $celular = validarNumero('celular');
        $img = validarImg('Foto-mascota', 1);
        if(!subirImg('Foto-mascota', 1)){
            return false;
        }


        // $comuna1_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaOrigen'";
        // $comuna2_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaDestino'";
        // $comuna1_result = $mysql->query($comuna1_query);
        // $comuna2_result = $mysql->query($comuna2_query);
        // $comuna1 = $comuna1_result->fetch_assoc()['id'];
        // $comuna2 = $comuna2_result->fetch_assoc()['id'];


        $insert = "INSERT INTO traslado (comuna_origen, comuna_destino, fecha_viaje, espacio, tipo_mascota_id,
                        descripcion, nombre_contacto, email_contacto, celular_contacto) VALUES 
                        ('$comunaOrigen', '$comunaDestino', '$fecha', '$espacio', '$tipo', '$descripcion', 
                        '$nombre', '$email', '$celular');";

        if($mysql->query($insert) === TRUE){

            
            $ida = $mysql->query("SELECT MAX(id) AS id FROM traslado");
            $id = $ida->fetch_assoc()['id'];
            $insert2 = "INSERT INTO foto_mascota (ruta_archivo, nombre_archivo, traslado_id)
                            VALUES ('traslados/img', '$img', '$id');";
            $insert3 = "";               
            for($i = 2; $i <= 5; $i++){
                if(validarImg("Foto_mascota$i", $i)){
                    $img = subirImg("Foto-mascota$i", $i);
                    $insert3 = $insert3 +  "INSERT INTO foto_mascota (ruta_archivo, nombre_archivo, traslado_id)
                                        VALUES ('../traslados/img', '$img', '$id';);  ";
                }
                else{
                    continue;
                }
            }

            // $insert = "INSERT INTO traslado (comuna_origen, comuna_destino, fecha_viaje, espacio, tipo_mascota_id,
            //     descripcion, nombre_contacto, email_contacto, celular_contacto) VALUES 
            //     ('$comunaOrigen', '$comunaDestino', '$fecha', '$espacio', '$tipo', '$descripcion', 
            //     '$nombre', '$email', '$celular')";
            if($mysql->query($insert2) === TRUE ){
                $mysql->close();
                return TRUE;
            }
        }
        
        else{
            echo "Error: ". $insert . "<br>". $mysql->error;
            $mysql->close();
            return FALSE;
        }
        
    }
    // $mysqli = new mysqli('127.0.0.1', 'root', '','tarea2');
    // $mysqli->set_charset("utf8");
    // // $db = mysqli_connect("host=localhost port=3306 dbname=tarea2 user=root password=123") or die("No se ha podido concectar : ". pg_last_error());
    // $o = $mysqli->query("select * from region");
    // while($f = $o->fetch_object()){
    //     echo $f->nombre."<br/>";
    // }
}
if(validarTraslados()){
    echo "<script>";
    echo "alert('Ingreso de datos exitoso')";
    echo "</script>";
    echo "<script>";
    echo "window.location = '../index.html';";
    echo "</script>";
}
else{
    echo "<script type='text/javascript'>";
    echo "window.history.back(-1)";
    echo "</script>";
}
?>
