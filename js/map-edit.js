function mapCities(){
    var url = "php/ciudadesInfo.php"
    $.ajax({
        type: "GET",
        url: url,
    })
    .done(function(resultado){
        var coordenadas = require('js/chile_wwith_regions.js');
        console.log(coordenadas);
    })
    var map = L.map('map').setView([-33.437, -70.6506], 12);
    L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=e5JrAd6MujUZ0xj87DUJ', {
        attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>'
        }).addTo(map);
    L.marker([-33.437, -70.6506]).addTo(map)
        .bindPopup('<a href="#"> holia </a>')
        .openPopup();
}

$(document).ready(mapCities())