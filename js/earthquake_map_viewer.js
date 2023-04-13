$(document).ready(function () {



    //var earthquake = new Earthquake('map-canvas',-8.874217, 125.672607,7);
    var earthquake = new Earthquake(-8.591884, 125.351257, $("#earthquake_radius").val(),$("#asset_url").val());
    var url = $("#earthquake_url").val();


    earthquake.setFrontPageElement($("#earthquake_front_page").val());
    earthquake.setEartquakeContainer("#earthquake_container");
    earthquake.setEartquakeLink(url);
    earthquake.setListOfRecentEarthquakeElement($("#list-recent-earthquake"));


    var layersObj = [
        // { "text": "Satellite view", "id": "mapbox.satellite" },
        { "text": " Satellite view", "id": "mapbox/satellite-streets-v11" },
        {"text":" Streets view","id":"mapbox/streets-v11"}
    ];


    earthquake.setMapLayers(layersObj, 20);

    earthquake.initEarthquakeMap('map-canvas', 7);

    earthquake.addScale();
    earthquake.addLegendControl($("#earthquake_url_legend").val());


    // earthquake.loadMunicipalitiesBoundary($("#municipality_map").val());

    $("#btn-show-earthquake-list").on("click", function () {
        $("#modal-earthquake-list").modal('show');
    });

    if(earthquake.isFrontPage()){
        earthquake.loadMap(10,true);
        earthquake.switchScrollWheelZoom(false);
    }else{
        earthquake.addBaseMapControl();
        // earthquake.addZoomControl();
        earthquake.switchScrollWheelZoom(true);
        // get total of eq within defined radius
        earthquake.loadMap($("#total_to_display").val(),true);
    }


    $("#total_to_display").on("change",function(){
        let val = $(this).val();
        console.log(val);
        if($("#display_all").is(":checked")){
            earthquake.loadMap(val)
        }else{
            earthquake.loadMap(val,false)
        }
    });


    $("#display_all").on("change",function(){
        console.log($(this).is(":checked"));
        let val = $("#total_to_display").val();
        if($(this).is(":checked")){
            earthquake.loadMap(val);
        }else{
            earthquake.loadMap(val,false);
        }
    });

    $("body").on("click", ".earthquake-item", function () {
        $(this).addClass("active");
        var lat = $(this).data("lat");
        var lon = $(this).data("lon");
        var region = $(this).data("region");
        var magnitude = $(this).data("mag");
        var depth = $(this).data("depth");
        var event_date = $(this).data("event-date");
        var data = {
            depth: depth,
            event_datetime: event_date,
            latitude: lat,
            longitude: lon,
            magnitude: magnitude,
            region: region
        };
        earthquake.showRecentEarthquake(data);

        $("#modal-earthquake-list").modal('hide');
    });


});
