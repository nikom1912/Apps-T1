<?php
function validarVoluntario(){
    include('validaciones.php');
    mb_internal_encoding('UTF-8');
    // if ($_POST) {
    //     echo '<pre>';
    //     echo htmlspecialchars(print_r($_POST, true));
    //     echo '</pre>';
    // }
    
    if(isset($_POST['boton-submit']) or isset($_GET['boton-submit'])){
        // $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
        $mysql = new mysqli("localhost", 'root', '','tarea2');
        if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
        } 
        $mysql->set_charset("utf8");
        $validacion = !validarNombre('nombre-voluntario') or !validarEmail('email-voluntario') or
                    !validarNumero('celular-voluntario') or !validarEspacio('espacio-disponible') or
                    !validarComuna('comuna-disponible', 'region-disponible', $mysql, 'disponible') or !validarDescripcion('descripcion-voluntario');
        
        //
        // echo "<p>"."comuna1 ".validarComuna('comuna-origen', 'region-origen', $mysql, 'origen');
        // echo "<p>"."com2 ".validarComuna('comuna-destino', 'region-destino', $mysql, 'destino');
        // echo "<p>"."fecha ".validarFecha('fecha-viaje');
        // echo "<p>"."espacio ".validarEspacio('espacio-disponible');
        // echo "<p>"."des ".validarDescripcion('descripcion-mascota');
        // echo "<p>"."nombre ".validarNombre('nombre-voluntario');
        // echo "<p>"."email ".validarEmail('email-voluntario');
        // echo "<p>"."num ".validarNumero('celular-voluntario');
        //

        if($validacion){
            return FALSE;
        }
        $nombre = validarNombre('nombre-voluntario');
        $email = validarEmail('email-voluntario');
        $celular = validarNumero('celular-voluntario');
        $espacio = masEsp(validarEspacio('espacio-disponible'), $mysql);
        $comuna = validarComuna('comuna-disponible', 'region-disponible', $mysql, 'disponible'); 
        $descripcion = validarDescripcion('descripcion-voluntario');
        

        // $comuna1_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaOrigen'";
        // $comuna2_query = "SELECT comuna.id FROM comuna, region WHERE region_id = region.id AND comuna.nombre = '$comunaDestino'";
        // $comuna1_result = $mysql->query($comuna1_query);
        // $comuna2_result = $mysql->query($comuna2_query);
        // $comuna1 = $comuna1_result->fetch_assoc()['id'];
        // $comuna2 = $comuna2_result->fetch_assoc()['id'];

        $insert = "INSERT INTO voluntario (nombre_voluntario, email_voluntario, celular_voluntario, 
                    espacio_disponible, comuna_disponible, descripcion) VALUES
            ('$nombre', '$email', '$celular', '$espacio', '$comuna',  '$descripcion')";
        if($mysql->query($insert) === TRUE){
            $mysql->close();
            return TRUE;
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
if(validarVoluntario()){
    echo "<script>";
    echo "alert('Ingreso de datos exitoso')";
    echo "</script>";
    echo "<script>";
    echo "window.location = '../index.php';";
    echo "</script>";
}
else{
    echo "<script type='text/javascript'>";
    echo "window.history.back(-1)";
    echo "</script>";
}
?>