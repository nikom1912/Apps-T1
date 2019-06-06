<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarea 1</title>
    <link type="text/css" rel="stylesheet" href="css/landing-styles.css">
    <link type="text/css" rel="stylesheet" href="css/banner-styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <link rel="stylesheet" href="css/boostrap v4 w3c fix.css">
   <!-- <script src="js/index.js"></script> -->
   <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" ></script>
    
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    
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
                            <button class="nav-button"> <img class="menu-icon" src="img/menu.png" alt="menu-icon"></button>
                            <a href="addtraslado.html"  class="nav-enlace desaparece">Agregar Traslado</a>
                            <a href="addvoluntario.html"  class="nav-enlace desaparece">Agregar Voluntarios </a>
                            <a href="vertraslados.php"  class="nav-enlace desaparece">Ver Traslados  </a>
                            <a href="vervoluntarios.php"  class="nav-enlace desaparece">VerVoluntarios  </a>
                        </div>
                    </div>
                
                </div>
            </header>
        </div>
        <div class="main" >

            <h1>
                El mejor servicio de transporte de mascotas, a las puertas de su casa.
            </h1>

            <button onClick="mapCities()"> Ver mapa</button>
            <div id = "map"></div>
            
            <script>
            function mapCities(){
                var data;
                var coordenadas;
                var map = L.map('map').setView([-33.437, -70.6506], 8);
                var request_coordenadas = new XMLHttpRequest();
                request_coordenadas.open('GET', 'js/chile_with_regions.json', false);
                request_coordenadas.onload = function(){
                    coordenadas = JSON.parse(request_coordenadas.responseText);
                    console.log(coordenadas);
                };
                request_coordenadas.send();
                L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=e5JrAd6MujUZ0xj87DUJ', {
                    attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>'
                    }).addTo(map);
                var url = 'php/ciudadesInfo.php';
                $.ajax({
                    url: url
                })
                .done(function(resultado){
                    data = JSON.parse(resultado);
                    for(var comuna in data){
                        var lat = 0;
                        var lng = 0;
                        var region = data[comuna][0]['region'];
                        console.log(eliminarDiacriticos(region));
                        for(var r in coordenadas){
                            var regex = new RegExp(eliminarDiacriticos(r.toLowerCase()));
                            console.log(r);
                            if(regex.test(eliminarDiacriticos(region.toLowerCase()))){
                                console.log("---------------------------------");
                                region = r;
                                break;
                            }
                        }
                        console.log(region);
                        for(var c in coordenadas[region]){
                            console.log(coordenadas[region][c]["name"]);
                            console.log(comuna);
                            if(eliminarDiacriticos(comuna.toLowerCase()) == eliminarDiacriticos(coordenadas[region][c]["name"].toLowerCase())){
                                lat = coordenadas[region][c]["lat"];
                                lng = coordenadas[region][c]["lng"];
                                break;
                            }
                        }
                        var html = "<table style='border-collapse: collapse;'>";
                        for(var d in data[comuna]){
                            datos = data[comuna][d];
                            var todo_html = "<tr style='border: 1px solid rgb(0, 0, 0);'>";
                            var datos_html = "<td><table style='border-collapse: collapse;'>";
                            var imagen_html = "<td><ul>";
                            var fecha = datos["fecha"];
                            var tipo = datos["tipo"];
                            var nombre = datos["nombre"];
                            var imagenes = datos["imagenes"];
                            var ver_mas = "<a href=''"
                            for (var img in imagenes){
                                imagen_html += "<li><img src='" + imagenes[img] + "' width='160' hwight='120'></li>"; 
                            }
                            imagen_html += "</ul>SS</td>";
                            datos_html += "<tr><td style='border: 1px solid rgb(0, 0, 0);'> Nombre de Contacto: " + nombre + "</td></tr>";
                            datos_html += "<tr><td style='border: 1px solid rgb(0, 0, 0);'> Tipo de mascota: " + tipo + "</td></tr>";
                            datos_html += "<tr><td style='border: 1px solid rgb(0, 0, 0);'> Fecha: " + fecha + "</td></tr>";
                            datos_html += "<tr><td style='border: 1px solid rgb(0, 0, 0);'> Fecha: " + fecha + "</td></tr>";
                            datos_html += "</table>";
                            todo_html += imagen_html + datos_html + "</tr>";
                            html += todo_html;
                            
                        }
                        html += "</table>";
                        marker = new L.marker([lat, lng])
                            .bindPopup(html)
                            .addTo(map);
                    }  
                })         
            }
            function eliminarDiacriticos(texto) {
                return texto.normalize('NFD').replace(/[\u0300-\u036f]/g,"");
            }
            </script>
            

        </div>
    </div>
</body>
</html>