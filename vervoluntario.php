<?php
// $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
$mysql = new mysqli("localhost", 'root', '','tarea2');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Ver traslados | Tarea 1</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/regiones.js"></script>
<script src="js/script-vert.js"></script>
<script src="js/val-traslados.js"></script>
<script src="js/script-aaddt.js"></script>

<link type="text/css" rel="stylesheet" href="css/addt-styles.css">
<link type="text/css" rel="stylesheet" href="css/banner-styles.css">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link rel="stylesheet" href="css/boostrap v4 w3c fix.css">
<link type="text/css" rel="stylesheet" href="css/verT.css">




</head>
<body>
<div class="container">
    <div class="banner">
        <header>
            <div class="content">
                <div class="barra">
                    <div class="logo-banner">
                        <a href="index.php">
                                <img class="logo" src="img/banner-real.png" alt="banner">
                        </a>
                    </div>
                    <div class="option-banner">
                        <button class="nav-button" > <img  class="menu-icon" src="img/menu.png" alt="menu-icon"></button>
                        <a href="addtraslado.html"  class="nav-enlace desaparece">Agregar Traslado</a>
                        <a href="addvoluntario.html"  class="nav-enlace desaparece">Agregar Voluntarios </a>
                        <a href="vertraslados.php"  class="nav-enlace desaparece">Ver Traslados  </a>
                        <a href="vervoluntarios.php"  class="nav-enlace desaparece">Ver Voluntarios  </a>
                    </div>
                </div>
            
            </div>
        </header>
    </div>
    <div class="main">
        <?php
        if(!$_GET){
            header("Location: vervoluntarios.php");
        }
        $vol_id = $_GET['id'];
        $query = "SELECT voluntario.id AS id, nombre_voluntario AS nombre, email_voluntario AS email,
                            celular_voluntario AS celular ,region.nombre AS region, comuna.nombre AS comuna, espacio.valor AS espacio, descripcion FROM voluntario, espacio, comuna, region WHERE 
                            espacio_disponible = espacio.id AND comuna_disponible = comuna.id AND comuna.region_id = region.id AND voluntario.id = $vol_id ";
        $result = $mysql->query($query);
        ?>
        <div class="caja">
            <?php if($result){ 
                $datos = $result->fetch_array();
                $r = $datos['region'];
                $des = $datos['descripcion'];
                $nombre = $datos['nombre'];
                $celular = $datos['celular'];
                $c = $datos['comuna'];
                $esp = $datos['espacio'];
                $email = $datos['email'];
                ?>
                    <?php
                    // echo "<td colspan='5' >";
                    echo "<table width='90%'>";
                    echo "<tr><td>"."Nombre de voluntario:  ".$nombre."</td></tr>";
                    echo "<tr><td>"."Email de voluntario:  ".$email."</td></tr>";
                    echo "<tr><td>"."Celular de voluntario:  ".$celular."</td></tr>";
                    echo "<tr><td>"."Espacio disponible:  ".$esp."</td></tr>";
                    echo "<tr><td>"."Region disponible:  ".$r."</td></tr>";
                    echo "<tr><td>"."Comuna disponible:  ".$c."</td></tr>";
                    echo "<tr><td>"."Descripcion:  ".$des."</td></tr>";  
                    echo "</table>";
                    // echo "<td class= 'dato$i' style='display:none'> "
                } 
            ?>
        </div>
        </div>
    </div>
    
</body>
</html>