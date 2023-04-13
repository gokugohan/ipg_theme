$(document).ready(function () {

	// $(window).on('load', function() {
	// 	if ($('#preloader').length) {
	//
	// 	  $('#preloader').delay(100).fadeOut('slow', function() {
	// 		$(this).remove();
	// 	  });
	//
	// 	}
	//   });

    $("#tbl-studies-research").dataTable({"ordering": false});
    $("#tbl-list-of-publication").dataTable({"ordering": false});
    $("#tbl-career-opportunity").dataTable({"ordering": false});
    $("#tbl-procurement").dataTable({"ordering": false});
    $("#tbl-annual-report").dataTable({"ordering": false});

    $("li.dropdown ul").addClass("dropdown-menu");

    $("a.dropdown-toggle").on("click",function(){
       //$("li.dropdown ul").addClass("dropdown-menu");
    });

    $("#tbl-studies-research").dataTable();
    $("#tbl-procurement").dataTable();

    $(".btn-view-event").on("click", function () {

        $("#view-event-title").html($(this).data("title") + " - " + $(this).data("start") + " - " + $(this).data("end"));
        $("#event-image").prop("src", $(this).data("image"));

        $("#event-title").html($(this).data("title") + ' (<span class="event-venue">' + $(this).data("venue") + '</span>)');
        $("#event-content").html($(this).data("content"));
        // http://www.google.com/maps/place/
        var len = $(this).data("lat").toString();

//        if(len.length>0){
//            $("#event-coordenate").prop("href","http://www.google.com/maps/place/"+$(this).data("lat")+","+$(this).data("lon"));
//        }else{
//            $("#event-coordenate").html("");
//        }
        lat = $(this).data("lat");
        lon = $(this).data("lon");
        $("#modal-view-event").modal();
    });

  $("#tbl-studies-research").parent().addClass("add-scrool-x");

});
