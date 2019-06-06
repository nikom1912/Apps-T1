<?php
    // $mysql = new mysqli("localhost", 'cc500221_u', 'nissimnullaD','cc500221_db');
    $mysql = new mysqli("localhost", 'root', '','tarea2');

    $infoXpagina = 5;
    $contar = $mysql->query("SELECT count(*) AS cuenta FROM voluntario");
    $cuenta = $contar->fetch_assoc()['cuenta'];
    $paginas = ceil($cuenta/$infoXpagina);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Traslado | Tarea 1</title>
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
                            <button class="nav-button"> <img  class="menu-icon" src="img/menu.png" alt="menu-icon"></button>
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
            <h1>Voluntarios</h1>
            <?php
            if(!$_GET){
                header('Location:vervoluntarios.php?pagina=1');
            }
            $init = ($_GET['pagina'] - 1)*$infoXpagina;
            $queryPage = "SELECT voluntario.id AS id, nombre_voluntario AS nombre, email_voluntario AS email,
                            celular_voluntario AS celular ,region.nombre AS region, comuna.nombre AS comuna, espacio.valor AS espacio, descripcion FROM voluntario, espacio, comuna, region WHERE 
                            espacio_disponible = espacio.id AND comuna_disponible = comuna.id AND comuna.region_id = region.id ORDER BY voluntario.id DESC LIMIT $init , $infoXpagina";
            $result = $mysql->query($queryPage);  

            ?>
            <div class="caja">
            <div> Buscar voluntario: <div><input type="text" name="buscar" id="search" length="50" placeholder="Buscar..." onkeyup="sendRequest()"> </div>
                <div> 
                    <ul id="busqueda_resultado">

                    </ul>
                    
                </div>
            </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Espacio Disponible</th>
                            <th>Comuna Disponible</th>
                            <th>Numero de Celular</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    
                    $i = 1;
                    if($result){
                        while( $datos = $result->fetch_array()){
                            $id = ['id'];
                            $r = $datos['region'];
                            $des = $datos['descripcion'];
                            $nombre = $datos['nombre'];
                            $celular = $datos['celular'];
                            $c = $datos['comuna'];
                            $esp = $datos['espacio'];
                            $email = $datos['email'];

                        ?>
                        
                        <tr class="a" onclick="mostrarInfo('<?php echo 'dato'. $i; ?>')">
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $esp; ?></td>
                            <td><?php echo $c; ?></td>
                            <td><?php echo $celular;?></td>
                            
                        </tr>
                        <tr class = '<?php echo "dato$i" ?>' style ='display:none' >
                            <?php
                            echo "<td colspan='5' >";
                            echo "<table width='90%'>";
                            echo "<tr><td>"."Nombre de voluntario:  ".$nombre."</td></tr>";
                            echo "<tr><td>"."Email de voluntario:  ".$email."</td></tr>";
                            echo "<tr><td>"."Celular de voluntario:  ".$celular."</td></tr>";
                            echo "<tr><td>"."Espacio disponible:  ".$esp."</td></tr>";
                            echo "<tr><td>"."Region disponible:  ".$r."</td></tr>";
                            echo "<tr><td>"."Comuna disponible:  ".$c."</td></tr>";
                            echo "<tr><td>"."Descripcion:  ".$des."</td></tr>";  
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
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="vervoluntarios.php?pagina=<?php echo $_GET['pagina'] >= 1? 1: $_GET['paginas'] - 1 ?>">
                            Anterior
                            </a>
                            
                        </li>
                        
                        <?php for($i = 0; $i < $paginas; $i++){ ?>
                            <li class="page-item
                            <?php echo $_GET['pagina'] == $i+1 ? 'active' : '' ?>"> 
                                <a class="page-link" href="vervoluntarios.php?pagina=<?php echo $i+1 ?>" ><?php echo $i+1 ?></a>
                                 
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="vervoluntarios.php?pagina=<?php echo $_GET['pagina'] >= $paginas ? $paginas : $_GET['pagina'] + 1?>">
                        Siguiente
                        </a>
                        </li>
                </nav>

            </div>
            </div>
        </div>
        <script> 
            function sendRequest(){
                var val = document.getElementById("search").value;
                if(val.length >= 3){
                    var url = 'php/volrequest.php';
                    
                    // var request = new XMLHttpRequest();
                    // request.open('POST', 'php/volrequest.php', true);
                    // request.setRequestHeader('Content-Type', 'application/x-ww-form-urlencoded');
                    // request.onreadystatechange = function () {
                        
                    // }
                    // request.send();
                    $.ajax({

                        type: "GET",
                        url: url,
                        data: {buscar: val},

                    })
                    .done(function(resultado){
                        $('#busqueda_resultado').html(resultado);
                    })
                }
                else{
                    document.getElementById("busqueda_resultado").innerHTML = "";
                }
            }

        </script>
    </body>
</html>
        