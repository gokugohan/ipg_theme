<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA1Sw4KaqJ-Y3k5C_iW0g8gASP9HDv_Bv8'></script>


<?php
$earthquake_json_url = get_earthquake_setting('earthquake_url');
$earthquake_interval_time = get_earthquake_setting('interval_time');
$earthquake_map_zoom = get_earthquake_setting('zoom');

if (!filter_var($earthquake_json_url, FILTER_VALIDATE_URL) === false) {
    ?>
<div class="textwidget">
        <div class="earthquake_container" id="earthquake_container"></div>
        <style>
            #gmap_canvas img{max-width:none!important;background:none!important}
        </style>
    </div>
    <script>
        var container, html;

        window.onload = function () {

            container = document.getElementById("earthquake_container");
            html = "<div id='canvas' style='height:200px;width:100%;'></div>";
            html += "<div class='page-header' id='most-recent-earthquake-container'>";
            html += "<ul id='list-recent-earthquake' class='list-group'></ul></div>";
            getData();
            setInterval(getData, <?= $earthquake_interval_time; ?>); // triggered every 5 minute 
            
        };

        function getData() {
            //Pode usar o jQuery - é indiferente
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "<?= $earthquake_json_url; ?>", true);
            xhttp.send();

            xhttp.onreadystatechange = function () {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        container.innerHTML = html;
                        var response = JSON.parse(this.responseText);
                        //console.log(response);
                        init_earthquake_location(response);

                    } else {
                        container.innerHTML = "<i style='color:#FF0000;'>Server not available</i>";
                    }
                }
            };
        }//getData

        //google.maps.event.addDomListener(window, 'load', init_earthquake_location);

        function render_map(lat, long, region, magnitude, depth, event_datetime) {

            var centerLatLong = new google.maps.LatLng(lat, long);
            var canvas = document.getElementById("canvas");

            var map_options = {
                zoom: <?= $earthquake_map_zoom; ?>,
                center: centerLatLong,
                disableDefaultUI: true,
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };

            var map = new google.maps.Map(canvas, map_options);

            var marquerOptions = {
                map: map,
                animation: google.maps.Animation.BOUNCE,
                position: new google.maps.LatLng(lat, long)
            };

            var marker = new google.maps.Marker(marquerOptions);

            var content = "Region: " + region + " \nLatitude: " + lat + "\nLongitude: " + long + "\nMagnitude: " + magnitude + " \nDepth: " + depth;
            content += "\nEvent time: " + event_datetime + " GMT";

            var info = new google.maps.InfoWindow(
                    {
                        content: content});
            google.maps.event.addListener(marker, 'click', function () {
//                info.open(map, marker);
                alert(content);

            });

        }//render_map

        function init_earthquake_location(lista) {
            var len = lista.length;
            if (len > 0) {
                var data = lista[0];
                render_map(data.latitude, data.longitude, data.region, data.magnitude, data.depth, data.event_datetime);
                render_list_earthquake(lista);
            }
        }//init_earthquake_location


        function render_list_earthquake(lista) {

            var div = document.getElementById("most-recent-earthquake-container");
            var ul = "<ul id='list-recent-earthquake' class='list-group' style='margin-top:20px;'>";
            var len = 3;//lista.length;
            for (var i = 0; i < len; i++) {
                var item = lista[i];
                var li = "<li class='list-group-item'>";
				li += "Location: " + item.region + "<br/>";
				li += "Time: " + item.event_datetime+ " GMT <br/>";
				li += "Mag: " + item.magnitude + ", ";
				li += " Depth: " + item.depth;
				li += "</li>";

                ul += li;
            }
            div.innerHTML = ul;
        }//render_list_earthquake

        
    </script>

    <?php
} else {
    echo "<i style='color:#FF0000;'>Server not available</i>";
}
?>
