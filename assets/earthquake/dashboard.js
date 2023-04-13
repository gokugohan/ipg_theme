let base_url = $("#earthquake_url").val();
let prefered_radius = $("#earthquake_radius").val();
let current_year = new Date().getFullYear();
let current_magnitude = 5;

$("#current-magnitude").html(current_magnitude);
$("#current-year").html(current_year);

get_magnitudes();
get_years();
get_event_by_magnitude();
get_event_occurences_in_region_by_year();
get_event_occurences_in_region_by_radius();
get_event_occurences_by_year();

$("body").on("change", "#select-event-magnitude", function () {
    $("#current-magnitude").html($(this).val());
    get_event_by_magnitude($(this).val());
});

$("body").on("change", "#select-event-year", function () {
    $("#current-year").html($(this).val());
    get_event_occurences_in_region_by_year($(this).val());
});

$("body").on("input", "#input-radius-occ-region", function () {
    if($(this).val().length>0){
        get_event_occurences_in_region_by_radius($(this).val());
    }else{
        get_event_occurences_in_region_by_radius();
    }

});

$("body").on("input", "#input-radius-occ-year", function () {
    if($(this).val().length>0){
        get_event_occurences_by_year($(this).val());
    }else{
        get_event_occurences_by_year();
    }

});


function get_event_by_magnitude(magnitude = current_magnitude) {
    $.ajax({
        url: base_url + 'region-occurrences-by-magnitude/' + magnitude + '/' + prefered_radius,
        type: 'get',
        dataType: "json",
        crossDomain: true,
        success: function (response) {
            render_event_occurences_by_magnitude(response);
        }
    });
}//get_event_by_magnitude


function get_event_occurences_in_region_by_year(year=current_year) {
    $.ajax({
        url: base_url + 'region-occurrences/year/' + year +'/'+ prefered_radius,
        type: 'get',
        dataType: "json",
        crossDomain: true,
        success: function (response) {
            render_event_occurences_in_region_by_year(response);
        }
    });
}//get_event_by_magnitude

function get_event_occurences_in_region_by_radius(radius=prefered_radius) {
    $.ajax({
        url: base_url + 'region-occurrences/radius/' + radius,
        type: 'get',
        dataType: "json",
        crossDomain: true,
        success: function (response) {
            render_event_occurences_in_region_by_radius(response);
        }
    });
}//get_event_by_magnitude

function get_event_occurences_by_year(radius=prefered_radius) {
    $.ajax({
        url: base_url + 'occurrences-by-year/' + radius,
        type: 'get',
        dataType: "json",
        crossDomain: true,
        success: function (response) {
            render_event_occurences_in_year_by_radius(response);
        }
    });
}//get_event_by_magnitude


function get_magnitudes() {
    $.ajax({
        url: base_url + 'magnitudes',
        type: 'get',
        dataType: "json",
        crossDomain: true,
        success: function (response) {
            let html = '<option>Select Magnitude</option>';
            $.each(response, function (i, v) {
                html += '<option value="' + v.magnitude + '">' + v.magnitude + '</option>';
            });

            $("#select-event-magnitude").html(html);
        }
    });
}

function get_years() {
    $.ajax({
        url: base_url + 'years',
        type: 'get',
        dataType: "json",
        crossDomain: true,
        success: function (response) {
            let html = '<option>Select Year</option>';
            $.each(response, function (i, v) {
                html += '<option value="' + v.year + '">' + v.year + '</option>';
            });

            $("#select-event-year").html(html);
        }
    });
}


function render_event_occurences_by_magnitude(list_of_events) {
    let data = [];
    let category = [];

    $.each(list_of_events, function (i, v) {
        data.push(parseInt(v.occurrences));
        category.push(v.region);
    });

    Highcharts.chart('event-magnitude-chart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'column'
        },
        title: {
            text: '',
            align: 'left'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="http://ipg.tl/"' +'target="_blank">Instituto do Petróleo e Geologia - Instituto Público (IPG-IP)</a>',
            align: 'left'
        },
        xAxis: {
            categories: category
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        legend:{
            enable:false
        },
        credits: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Number of occurrences: <b>{point.y}</b>'
        },

        series: [{
            name: 'Event in Region by Magnitude',
            colorByPoint: true,
            data: data
        }]
    });
}//render_event_occurences_by_magnitude


function render_event_occurences_in_region_by_year(list_of_events) {

    let data = [];
    let category = [];

    $.each(list_of_events, function (i, v) {
        data.push(parseInt(v.occurrences));
        category.push(v.region);
    });


// Set up the chart
    const chart = new Highcharts.Chart({
        chart: {
            renderTo: 'current-year-event-chart',
            type: 'column',
            inverted: true,
            // options3d: {
            //     enabled: true,
            //     alpha: 15,
            //     beta: 15,
            //     depth: 50,
            //     viewDistance: 25
            // }

        },
        xAxis: {
            categories: category
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Number of occurrences: {point.y}'
        },
        title: {
            text: '',
            align: 'left'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="http://ipg.tl/"' +'target="_blank">Instituto do Petróleo e Geologia - Instituto Público (IPG-IP)</a>',
            align: 'left'
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            name:'Event Occurrences in Region by Year',
            data: data,
            colorByPoint: true
        }]
    });
} //render_event_occurences_in_region_by_year


//
// // Set up the chart
// Highcharts.chart('event-depth-chart', {
//     chart: {
//         type: 'funnel3d',
//         options3d: {
//             enabled: true,
//             alpha: 10,
//             depth: 50,
//             viewDistance: 50
//         }
//     },
//     title: {
//         text: ''
//     },
//     accessibility: {
//         screenReaderSection: {
//             beforeChartFormat: '<{headingTagName}>{chartTitle}</{headingTagName}><div>{typeDescription}</div><div>{chartSubtitle}</div><div>{chartLongdesc}</div>'
//         }
//     },
//     plotOptions: {
//         series: {
//             dataLabels: {
//                 enabled: true,
//                 format: '<b>{point.name}</b> ({point.y:,.0f})',
//                 allowOverlap: true,
//                 y: 10
//             },
//             neckWidth: '30%',
//             neckHeight: '25%',
//             width: '80%',
//             height: '80%'
//         }
//     },
//     series: [{
//         name: 'Earthquake Magnitude',
//         data: [
//             ['Samar, Philippines', 173],
//             ['Timor Sea', 750],
//             ['South of Australia', 10],
//             ['Banda Sea', 750],
//             ['Near Coast of Southeastern China', 10],
//             ['Western Australia', 750],
//             ['West of Macquarie Island', 10],
//             ['Sulawesi, Indonesia', 750],
//             ['Northern Territory, Australia', 750],
//             ['North of Halmahera, Indonesia', 217],
//             ['North Island, New Zealand', 10],
//             ['Philippine Islands Region', 750],
//             ['Taiwan', 10],
//             ['Northcentral Siberia, Russia', 5],
//             ['Northeastern China', 10],
//             ['South of Timor, Indonesia', 750],
//             ['Minahassa Peninsula, Sulawesi', 750],
//             ['Southeastern China', 10],
//             ['Malay Peninsula', 10],
//             ['Panay, Philippines', 10],
//             ['New South Wales, Australia', 10],
//             ['Off South Coast of Australia', 10],
//             ['Near Coast of South Australia', 10],
//             ['Off West Coast of Northern Sumatra', 10]
//         ]
//     }]
// });


function render_event_occurences_in_region_by_radius(list_of_events){

    let data = [];
    let category = [];

    $.each(list_of_events, function (i, v) {
        data.push(parseInt(v.occurrences));
        category.push(v.region);
    });


// Set up the chart
    new Highcharts.Chart({
        chart: {
            renderTo: 'number-of-occurences-by-location-chart',
            type: 'column',
            inverted: true,
            // options3d: {
            //     enabled: true,
            //     alpha: 15,
            //     beta: 15,
            //     depth: 50,
            //     viewDistance: 25
            // }

        },
        xAxis: {
            categories: category
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Number of occurrences: {point.y}'
        },
        title: {
            text: '',
            align: 'left'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="http://ipg.tl/"' +'target="_blank">Instituto do Petróleo e Geologia - Instituto Público (IPG-IP)</a>',
            align: 'left'
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            name:'Number of occurrences by region',
            data: data,
            colorByPoint: true
        }]
    });
} //get_event_occurences_in_region_by_radius


function render_event_occurences_in_year_by_radius(list_of_events){
    let data = [];
    let category = [];

    $.each(list_of_events, function (i, v) {
        data.push(parseInt(v.occurrences));
        category.push(v.year);
    });

    new Highcharts.Chart({
        chart: {
            renderTo: 'number-of-occurences-by-year-chart',
            type: 'column',
            inverted: true,
            // options3d: {
            //     enabled: true,
            //     alpha: 15,
            //     beta: 0,
            //     depth: 50,
            //     viewDistance: 25
            // }

        },
        xAxis: {
            categories: category
        },
        yAxis: {
            title: {
                enabled: false
            }
        },
        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: 'Number of occurrences: {point.y}'
        },
        title: {
            text: '',
            align: 'left'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="http://ipg.tl/"' +'target="_blank">Instituto do Petróleo e Geologia - Instituto Público (IPG-IP)</a>',
            align: 'left'
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            name:'Number of occurences by year',
            data: data,
            colorByPoint: true
        }]
    });


} //render_event_occurences_in_year_by_radius

