<?php
    // $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
    $mysql = new mysqli("localhost", 'root', '','tarea2');

    $infoXpagina = 5;
    $contar = $mysql->query("SELECT count(*) AS cuenta FROM traslado");
    $cuenta = $contar->fetch_assoc()['cuenta'];
    $paginas = ceil($cuenta/$infoXpagina);
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
            <h1>Traslados</h1>
            <?php
            if(!$_GET){
                header('Location:vertraslados.php?pagina=1');
            }
            $init = ($_GET['pagina'] - 1)*$infoXpagina;
            $query = "SELECT traslado.id, c.nombre AS origen, co.nombre AS destino, r.nombre AS r_origen, ro.nombre AS r_destino, fecha_viaje AS fecha, e.valor AS espacio, m.descripcion AS tipo, traslado.descripcion AS descripcion, email_contacto AS 
                                    email, nombre_contacto AS nombre, celular_contacto AS celular FROM traslado, comuna c, comuna co, region r, region ro,  tipo_mascota m, espacio e WHERE comuna_origen = c.id AND comuna_destino = co.id
                                    AND r.id = c.region_id AND ro.id = co.region_id AND tipo_mascota_id = m.id AND espacio = e.id ORDER BY traslado.id DESC LIMIT $init , $infoXpagina";
            
            $result = $mysql->query($query);
            ?>
            <div class="caja">
            
                <table>
                    <thead>
                        <tr>
                            <th>
                                Origen
                            </th>
                            <th>
                                Destino
                            </th>
                            <th>Fecha viaje</th>
                            <th>Espacio</th>
                            <th>Tipo mascota</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <?php
    
                    $i = 1;
                    if($result){
                        while( $datos = $result->fetch_array()){
                            $id = $datos['id'];
                            $query_img = "SELECT  ruta_archivo AS ruta, nombre_archivo AS nombre FROM foto_mascota WHERE traslado_id = '$id'";
                            $result_img = $mysql->query($query_img);
                            $dbimg = $result_img->fetch_assoc();
                            $img = $dbimg['ruta'] . "/" . $dbimg['nombre'];
                            $r = $datos['r_origen'];
                            $ro = $datos['r_destino'];
                            $des = $datos['descripcion'];
                            $nombre = $datos['nombre'];
                            $celular = $datos['celular'];
                            $c = $datos['origen'];
                            $co = $datos['destino'];
                            $fecha = $datos['fecha']; 
                            $esp = $datos['espacio'];
                            $email = $datos['email'];
                            $tipo = $datos['tipo'];

                        ?>
                        
                        <tr class="a" onclick="mostrarInfo('<?php echo 'dato'. $i; ?>')">
                            <td><?php echo $datos['origen'] ?></td>
                            <td><?php echo $datos['destino'] ?></td>
                            <td><?php echo $datos['fecha'] ?></td>
                            <td><?php echo $datos['espacio'] ?></td>
                            <td><?php echo $datos['tipo'] ?></td>
                            <td><?php echo $datos['email'] ?></td>
                        </tr>
                        <tr>
                            <?php
                            echo "<td colspan='3' class= 'dato$i' style='display:none'>"; 
                            echo "<img src='$img' width ='320' height='240' onclick ='cambiarSize(this)'>";
                            echo "</td>";
                            echo "<td colspan='3' class= 'dato$i' style='display:none'>";
                            echo "<table width='90%'>";
                            echo "<tr><td>"."Region Origen:  ".$r."</td></tr>";
                            echo "<tr><td>"."Comuna Origen:  ".$c."</td></tr>";
                            echo "<tr><td>"."Region Destino:  ".$ro."</td></tr>";
                            echo "<tr><td>"."Comuna Destino:  ".$co."</td></tr>";
                            echo "<tr><td>"."Fecha de viaje:  ".$fecha."</td></tr>";
                            echo "<tr><td>"."Espacio necesario:  ".$esp."</td></tr>";
                            echo "<tr><td>"."Tipo de mascota:  ".$tipo."</td></tr>";
                            echo "<tr><td>"."Descripcion:  ".$des."</td></tr>";
                            echo "<tr><td>"."Nombre de contacto:  ".$nombre."</td></tr>";
                            echo "<tr><td>"."Email de contacto:  ".$email."</td></tr>";
                            echo "<tr><td>"."Celular de contacto:  ".$celular."</td></tr>";
                            echo "</table>";
                            echo "</td>";

                            // echo "<td class= 'dato$i' style='display:none'> "
                            ?>
                        </tr>
                        <?php
                        $i++;
                        }
                    }
                    ?>

                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="vertraslados.php?pagina=<?php echo $_GET['pagina'] >= 1? 1: $_GET['paginas'] - 1 ?>">
                            Anterior
                            </a>
                            
                        </li>
                        
                        <?php for($i = 0; $i < $paginas; $i++){ ?>
                            <li class="page-item
                            <?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>"> 
                                <a class="page-link" href="vertraslados.php?pagina=<?php echo $i+1 ?>" ><?php echo $i+1 ?></a>
                                 
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="vertraslados.php?pagina=<?php echo $_GET['pagina'] >= $paginas ? $paginas : $_GET['pagina'] + 1?>">
                        Siguiente
                        </a>
                        </li>
                </nav>
            </div>
            </div>
        </div>
        
    </body>
</html>
        