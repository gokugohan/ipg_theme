$(document).ready(function ($) {
    $("#tbl-studies-research").dataTable();
    $("#tbl-career-opportunity").dataTable();
    $("#tbl-procurement").dataTable();
    $("#tbl-annual-report").dataTable();

    $("body").on("click",".btn-edit-study-research", function () {
        var id = ($(this).data("id"));
        var author = ($(this).data("author"));
        var title = ($(this).data("title"));
        var docType = ($(this).data("doc-type"));
        var division = ($(this).data("division"));
        var year = ($(this).data("year"));
        var linkFile = ($(this).data("link-file"));

        $("#study-research-id-update").val(id);
        $("#study-research-author-update").val(author);
        $("#study-research-title-update").val(title);
        $("#study-research-document-type-update").val(docType);
        $("#study-research-division-update").val(division);
        $("#study-research-date-update-span").text("(" + year + ")");
        $("#study-research-link-update").val(linkFile);
        $("#modal-edit-study-research").modal();
    });
    $("body").on("click", ".btn-delete-study-research",function () {
        var id = $(this).data("id");
        var title = $(this).data("title");
        $("#study-research-id-delete").val(id);
        $("#title-research").text(title);
        $("#modal-delete-study-research").modal();
    });


    $("body").on("click",".edit-staff-detail", function () {
        $("#staff-id-edit").val($(this).data("id"));
        $("#staff-name-edit").val($(this).data("name"));
        $("#staff-image-edit").val($(this).data("img"));
        $("#staff-email-edit").val($(this).data("email"));
        $("#staff-degree-edit").val($(this).data("degree"));
        $("#staff-position-edit").val($(this).data("position"));
        $("#modal-edit-staff").modal();
    });
    
    $("body").on("click",".btn-delete-staff",function(){       
       $("#staff-id-delete").val($(this).data("id"));
       $("#staff-name-delete").text($(this).data("name"));
       $("#modal-delete-staff").modal();
    });
   
   $("body").on("click",".btn-edit-annual-report",function(){
       $("#annual-report-id-update").val($(this).data("id"));
       $("#annual-report-title-update").val($(this).data("title"));
       $("#annual-report-url-update").val($(this).data("url"));       
       $("#modal-edit-annual-report").modal();
   });
   $("body").on("click",".btn-delete-annual-report",function(){
       
       $("#annual-report-id-delete").val($(this).data("id"));
       $("#title-report").text($(this).data("title"));
       
      $("#modal-delete-annual-report").modal();
   });
  
  $("body").on("click",".btn-edit-procurement",function(){	   
	   $("#procurement-id-update").val($(this).data("id"));
       $("#procurement-title-update").val($(this).data("title"));
       $("#procurement-open-date-update").val($(this).data("open-date"));
       $("#procurement-close-date-update").val($(this).data("close-date"));
       $("#procurement-url-update").val($(this).data("url"));
       $("#modal-edit-procurement").modal();
   });
   
   $("body").on("click",".btn-delete-procurement",function(){       
       $("#procurement-id-delete").val($(this).data("id"));
       $("#title-procurement").text($(this).data("title"));
       $("#modal-delete-procurement").modal();
    });

    $('.datepicker').datepicker({
        // format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        autoclose: true
    });

});
