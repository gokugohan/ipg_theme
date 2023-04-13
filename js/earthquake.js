var EarthquakeIcon = L.Icon.extend({options: {}});
// var EarthquakeActiveIcon = L.Icon.extend({options: {iconSize: [30, 30]}});

var Earthquake = function (lat, lng, radius, asset_url) {
    this.lat = lat;
    this.lng = lng;
    this.layers = [];
    // this.markerGroup = L.layerGroup();
    this.distance_from_centerPoint = 0;
    this.centerPoint = [-8.591884, 125.351257];
    this.preferedRadius = radius;
    this.marker_clusters = L.markerClusterGroup();
    this.assetBaseUrl = asset_url;

};

Earthquake.prototype.setMapLayers = function (arrayMayType, maxZoom) {
    if (Array.isArray(arrayMayType)) {
        arrayMayType.forEach(mapType => {
            var tileLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: maxZoom,
                id: mapType.id,
                accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ'
            });

            var layer = {
                "text": mapType.text,
                "layer": tileLayer
            };
            this.layers.push(layer);
        });
    }
}


Earthquake.prototype.initEarthquakeMap = function (mapContainer, initialZoom) {

    this.mapa = L.map(mapContainer, {
            attributionControl: false,
            zoomControl: false,
            // scrollWheelZoom: false,
            layers: [this.layers[1].layer],
            contextmenu: true
        }
    ).setView([this.lat, this.lng], initialZoom);
    // this.markerGroup.addTo(this.mapa);
    // this.marker_clusters.addLayer(this.markerGroup);

    L.circle([-8.560476, 125.541652], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).bindPopup('IPG-IP Office').openPopup()
        .addTo(this.mapa);
}

Earthquake.prototype.addBaseMapControl = function () {
    var baseLayers = {};
    this.layers.forEach(item => {
        baseLayers[item.text] = item.layer;
    });
    L.control.layers(baseLayers).addTo(this.mapa);
}

Earthquake.prototype.getEartquakeIcon = function (iconUrl,className='') {
    if (iconUrl === undefined) {
        return new EarthquakeIcon({
            iconUrl: "http://ipg.tl/wp-content/themes/ipg_new_layout/images/epicenter.png",
            iconSize: [50, 50],
            className:className
        });
    }
    return new EarthquakeIcon({iconUrl: iconUrl, iconSize: [30, 30]});

}

Earthquake.prototype.addLayerToMap = function (mapType, maxZoom) {
    this.mapType = mapType;
    this.maxZoom = maxZoom;
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: maxZoom,
        id: this.mapType,
        accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ'
    }).addTo(this.mapa);

}//addLayerToMap


Earthquake.prototype.addScale = function () {
    L.control.scale().addTo(this.mapa);
}

Earthquake.prototype.addZoomControl = function () {
    L.control.zoom().addTo(this.mapa);
    this.mapa.scrollWheelZoom.disable();
}

Earthquake.prototype.addLegendControl = function (imageUrl) {
    let thismap = this.mapa;

    // Legend
    L.Control.MyControl = L.Control.extend({
        onAdd: function (map) {
            var el = L.DomUtil.create('div', 'leaflet-control-layers leaflet-control earthquakes-legend');

            el.innerHTML = `
                            <div class="text-center pb-2" >
                                <span class="legend-title" style="border-bottom: 1px solid #4B4B4B;font-size:12px">Earthquakes Legend</span>
                                <img src="${imageUrl}" class="img-fluid img-legend" >
                            </div>
                            
                        `;

            return el;
        },
        onClick: function (map) {
            // Nothing to do here
        },
        onRemove: function (map) {
            // Nothing to do here
        }
    });
    L.control.myControl = function (opts) {
        return new L.Control.MyControl(opts);
    }

    L.control.myControl({
        position: 'topleft'
    }).addTo(thismap);

}


Earthquake.prototype.switchScrollWheelZoom = function (enabled) {
    if (enabled) {
        this.mapa.scrollWheelZoom.enable();
    } else {
        this.mapa.scrollWheelZoom.disable();
    }
}

Earthquake.prototype.addMarker = function (lat, lng, icon) {
    this.marker = L.marker([lat, lng], {icon: icon}).addTo(this.mapa);
}

Earthquake.prototype.setFrontPageElement = function (earthquakeFrontPageValue) {
    this.earthquakeFrontPageValue = earthquakeFrontPageValue;
}

Earthquake.prototype.isFrontPage = function () {
    return this.earthquakeFrontPageValue == 1;
}

Earthquake.prototype.setEartquakeContainer = function (containerElement) {
    this.earthquakeContainer = containerElement;
}

Earthquake.prototype.setEartquakeLink = function (earthquakeLink) {
    this.earthquakeLink = earthquakeLink;
}
/*
Earthquake.prototype.isFrontPage = function(){
	return this.earthquakeFrontPageValue == 1;
}
*/

Earthquake.prototype.setEartquakeContainer = function (containerElement) {
    this.earthquakeContainer = containerElement;
}

Earthquake.prototype.setEartquakeLink = function (earthquakeLink) {
    this.earthquakeLink = earthquakeLink;
}

Earthquake.prototype.setListOfRecentEarthquakeElement = function (listOfRecentEarthquakeElement) {
    this.listOfRecentEarthquakeElement = listOfRecentEarthquakeElement;
}


Earthquake.prototype.loadMap = function (total, withinRadius = true) {


    // this.markerGroup.clearLayers();
    // this.markerGroup = L.layerGroup();
    this.marker_clusters.clearLayers();
    let self = this;
    let url = this.earthquakeLink;


    if (withinRadius) {
        url += 'radius' + '/' + this.preferedRadius + '/limit/' + total;
    } else {
        url += 'limit/' + total;
    }


    $.ajax({
        url: url,
        method: "get",
        dataType: "json",
        crossDomain: true,
        success: function (response) {

            // get only items in defined radius
            var lista = response;
            // if (withinRadius) {
            //     lista = self.ItemsInPreferedRadius(response.events);
            // }

            if (self.earthquakeFrontPageValue == 1) {
                if (lista[0] !== undefined) {
                    self.listOfRecentEarthquakeElement.html("");
                    self.showRecentEarthquake(lista[0], true);
                    self.showListOfEarthquakeToFrontPage(lista);
                } else {
                    $("#frontpage-recent-earthquake-list").html("<li class='mb-4'><p class='text-danger'>No recent earthquake within radius of " + $("#earthquake_radius").val() + " km</p></li>");
                    $("#slide-recent-earthquake").html("<span class='text-danger'>No recent earthquake within radius of " + $("#earthquake_radius").val() + " km</span>");

                }
            } else {
                self.showInEarthquakeLista(lista); // show on list
                self.showAllRecentEarthquakeOnMap(lista); // show on map
            }

            /*var radiusOptions = {
                color: 'red',
                weight: 0.5,
                fillColor: '#fff',
                fillOpacity: 0
            };

            var circleBoundary = L.circle(self.centerPoint,parseFloat(self.preferedRadius) ,radiusOptions);
            circleBoundary.addTo(self.mapa);*/

        },
        error: function (error) {
            $("#frontpage-recent-earthquake-list").html("<li class='mb-4'><p class='text-danger'>Error getting earthquake data[Server down]</p></li>");
            $("#slide-recent-earthquake").html("<span class='text-danger'>Error getting earthquake data[Server down]</span>");
        }
    });
}

Earthquake.prototype.showInEarthquakeLista = function (list) {

    let list_of_recent_eq = $("#most-recent-earthquake-list");
    let li_items = "";
    let len = list.length;
    if (len == 0) {
        $("#most-recent-earthquake-list").html("<li class='mb-4'><p class='text-danger'>No recent earthquake within radius of " + $("#earthquake_radius").val() + " km</p></li>");
        return;
    }
    for (let i = 0; i < len; i++) {
        let item = list[i];
        let event_datetime = moment(item.event_datetime).add(9, "hours").format("ddd DD MMMM YYYY, HH:mm:ss");
        let li = "";

        if (i == 0) {
            li = "<li class='mb-4 active-eq-list-item'>";
        } else {
            li = "<li class='mb-4'>";
        }
        li += "<h5><a href='#!' class='btn-goto-earthquake-point' data-lat='" + item.latitude + "'  data-lng='" + item.longitude + "' >" + item.region + "</a></h5>";

        li += "<p class='text-small text-muted'>"
            + "Magnitude: " + item.magnitude + " | Depth: " + item.depth + "km<br>"
            + "Distance: " + item.distance_to_center_point + "km<br>"
            + event_datetime + " OTL"
            + "</p>";
        li += "</li>";
        li_items += li;
    }

    list_of_recent_eq.html(li_items);
    let self = this;
    $("body").on("click", ".btn-goto-earthquake-point", function () {
        self.mapa.flyTo([$(this).data('lat'), $(this).data('lng')], 10);
    });
}

Earthquake.prototype.isItemBetweenPreferedRadius = function (data) {
    let coordenate = L.latLng(data.latitude, data.longitude);
    this.distance_from_centerPoint = coordenate.distanceTo(this.centerPoint);
    return (this.distance_from_centerPoint <= this.preferedRadius);
}


Earthquake.prototype.ItemsInPreferedRadius = function (items) {

    var result = [];
    var arr_index = 0;
    for (var i = 0; i < items.length; i++) {
        var item = items[i];
        // let coordenate = L.latLng(item.latitude, item.longitude);

        if (this.isItemBetweenPreferedRadius(item)) {
            result[arr_index] = item;
            arr_index++;
        }
    }


    return result;
}


Earthquake.prototype.showRecentEarthquake = function (data, eventTrigger = false) {

    var event_datetime = data.event_datetime;
    if (eventTrigger) {
        event_datetime = moment(data.event_datetime).add(9, "hours").format("ddd DD MMMM YYYY, HH:mm:ss");
    }

    this.mapa.flyTo([data.latitude, data.longitude], 8);

    var popupContent = "Region: " + data.region + "<br>";
    popupContent += "<br>Magnitude: " + data.magnitude + " | Depth: " + data.depth + "km";
    popupContent += "<br>Distance: " + data.distance_to_center_point + " km";
    popupContent += "<br>Event time: " + event_datetime + " OTL";

    // var icon = this.getEartquakeIcon();

    // var marker = this.createMarker(icon, data.latitude, data.longitude, popupContent, true);

    var pulsingIcon =L.icon.pulse({iconSize:[40,40],color:'red',heartbeat: '500m'});

    marker = L.marker([data.latitude,data.longitude],{icon: pulsingIcon});
    marker.bindPopup(popupContent).openPopup();

    this.marker_clusters.addLayer(marker);
    this.mapa.addLayer(this.marker_clusters);
    L.DomUtil.addClass(marker._icon, 'leaflet-marker-icon-active');
}

Earthquake.prototype.showAllRecentEarthquakeOnMap = function (listData, showOnlyWithinPreferedRadius = true) {

    var boundaries = [];
    var thismap = this.mapa;
    function addMarkerAndPopupContent() {


        var event_datetime = moment(item.event_datetime).add(9, "hours").format("ddd DD MMMM YYYY, HH:mm:ss");
        var marker;
        var popupContent = "<h5 class='eq-title'>" + item.region + "</h5>";
        popupContent += "<br>Magnitude: " + item.magnitude + " | Depth: " + item.depth + "km";
        popupContent += "<br>Distance: " + item.distance_to_center_point + " km";
        popupContent += "<br>Event time: " + event_datetime + " OTL";

        if (i == 0) {
            //
            let pulsingIcon = L.icon.pulse({iconSize:[35,35],color:'red',heartbeat:'400m'});
            var firstMarker = L.marker([item.latitude,item.longitude],{icon: pulsingIcon});

            firstMarker.bindPopup(popupContent);
            marker = firstMarker;


        } else {
            let pulsingIcon;
            if (item.magnitude <= 5) {
                pulsingIcon = L.icon.pulse({iconSize:[20,20],fillColor:'green',color:'green',animate:false});
            } else if (item.magnitude < 6) {
                pulsingIcon = L.icon.pulse({iconSize:[25,25],fillColor:'blue',color:'blue',animate:false});
            } else if (item.magnitude < 6.5) {
                let pulsingIcon = L.icon.pulse({iconSize:[30,30],fillColor:'orange',color:'orange',animate:false});
            } else {
                pulsingIcon = L.icon.pulse({iconSize:[35,35],fillColor:'red',color:'red',animate:false});
            }

            otherMarker = L.marker([item.latitude,item.longitude],{icon: pulsingIcon});
            otherMarker.bindPopup(popupContent);

            marker = otherMarker;
            // marker = this.createMarker(icon, item.latitude, item.longitude, popupContent, false);
        }
        return {marker};
    }

    let firstMarker = null;
    for (var i = 0; i < listData.length; i++) {

        var item = listData[i];

        var coordenate = L.latLng(item.latitude, item.longitude);
        boundaries[i] = coordenate;

        var {marker} = addMarkerAndPopupContent.call(this);
        this.marker_clusters.addLayer(marker);

        if(i==0){
            firstMarker = marker;
        }

    }

    
    this.mapa.addLayer(this.marker_clusters);
    if (boundaries.length > 0) {
        this.mapa.fitBounds(boundaries);
    }

    if(firstMarker!=null){
        this.mapa.flyTo(firstMarker._latlng, 8);
    }

}

Earthquake.prototype.showListOfEarthquake = function (listData) {

    this.listOfRecentEarthquakeElement.html("");
    var len = listData.length;

    for (var i = 0; i < len; i++) {
        var item = listData[i];
        var coordenate = L.latLng(item.latitude, item.longitude);

        if (this.isItemBetweenPreferedRadius(item)) {
            //var event_datetime = new Date(item.event_datetime+"z");
            var event_datetime = moment(item.event_datetime).add(9, "hours").format("ddd DD MMMM YYYY, HH:mm:ss");
            var li = "<li class='list-group-item'>";
            li += "<a class='earthquake-item' href='#!' data-lat='" + item.latitude + "' data-lon='" + item.longitude + "' ";
            li += "data-region='" + item.region + "' data-mag='" + item.magnitude + "' data-depth='" + item.depth + "' ";
            li += "data-event-date='" + event_datetime + "'>";
            li += "Location: " + item.region + "<br/>";
            li += "</a></li>";
            this.listOfRecentEarthquakeElement.append(li);
        }

    }

}


Earthquake.prototype.showListOfEarthquakeToFrontPage = function (listData) {
    let htmContainer = $("#frontpage-recent-earthquake-list");
    let marqueeEqList = $("#slide-recent-earthquake");
    let len = listData.length > 4 ? 4 : listData.length;

    let marqueeText = "";

    for (let i = 0; i < len; i++) {
        let item = listData[i];
        let coordenate = L.latLng(item.latitude, item.longitude);
        // if (this.isItemBetweenPreferedRadius(item)) {

        var event_datetime = moment(item.event_datetime).add(9, "hours").format("ddd DD MMMM YYYY, HH:mm:ss");
        var li = "<li class='mb-4'>";
        li += "<h5>" + item.region + "</h5>";
        li += "<p class='text-small text-muted'>"
            + "Magnitude: " + item.magnitude + " | Depth: " + item.depth + "km<br>"
            + "Distance: " + item.distance_to_center_point + "km<br>"
            + event_datetime + " OTL" + "</p>";
        li += "</li>";
        htmContainer.append(li);

        marqueeText += item.region + " - " + item.magnitude + " <span class='text-sm'>(" + event_datetime + " OTL)</span> | ";
        // }

        marqueeEqList.html("<a href='#section-earthquake'>" + marqueeText + "</a>");
    }

}


Earthquake.prototype.createMarker = function (icon, lat, lng, popupContent, isPopupOpen) {
    var marker = L.marker([lat, lng], {icon: icon})//.addTo(this.markerGroup);//.addTo(this.mapa);
    this.marker_clusters.addLayer(marker);

    if (isPopupOpen && popupContent != null) {
        marker.bindPopup(popupContent).openPopup();
    } else if (popupContent != null) {
        marker.bindPopup(popupContent);
    }
    return marker;
}

Earthquake.prototype.loadMunicipalitiesBoundary = function (map_url_path) {
    var eq = this
    $.getJSON(map_url_path, function (data) {
        eq.geojson = L.geoJson(data, {
            style: function (feature) {
                return {
                    fillColor: '#c2dd79',
                    weight: 2,
                    opacity: 1,
                    color: '#ffffff',  //Outline color
                    fillOpacity: 0.25
                };
            },
            onEachFeature: function (feature, layer) {
                layer.on('mouseover', function (e) {
                    layer.setStyle({
                        weight: 5,
                        fillOpacity: 0.1
                    });

                    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                        layer.bringToFront();
                    }
                    // info.update(layer.feature.properties);
                });
                layer.on('mouseout', function (e) {
                    eq.geojson.resetStyle(e.target);
                    // info.update();
                });

                layer.bindTooltip(feature.properties.Name, {
                    closeButton: false, offset: L.point(0, -20),
                    direction: 'right',
                    permanent: false,
                    sticky: true,
                    offset: [10, 0],
                    opacity: 1,
                    className: 'leaflet-tooltip'
                });
            }
        });

        eq.geojson.addTo(eq.mapa);
    });


}// loadMunicipalitiesBoundary

