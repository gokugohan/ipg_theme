<?php

function annual_report_setting_page() {
    ?>        
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Annual report</h1>
                </div>
                <form method="post">
                    <input type="hidden" value="insert" id="input-insert" name="input-insert"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" id="annual-report-title-new" name="annual-report-title-new"/>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Url</label>
                                <input type="text" class="form-control" id="annual-report-url-new" name="annual-report-url-new"/>
                            </div>
                        </div>                       
                    </div>                  
                    <div class="form-group">
                        <input class="button button-primary" type="submit" value="submit"/>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <?php
                $is_input_insert = isset($_POST['input-insert']) ? TRUE : FALSE;
                $is_input_update = isset($_POST['input-update']) ? TRUE : FALSE;
                $is_input_delete = isset($_POST['input-delete']) ? TRUE : FALSE;
                
                
                if ($is_input_insert) {
                    $title = isset($_POST['annual-report-title-new']) ? $_POST['annual-report-title-new'] : FALSE;
                    $url = isset($_POST['annual-report-url-new']) ? $_POST['annual-report-url-new'] : FALSE;
                    if ($title && $url) {
                        ipg_insert_new_annual_report($title, $url);
                    }
                } else if ($is_input_update) {
                    $id = isset($_POST['annual-report-id-update']) ? $_POST['annual-report-id-update'] : FALSE;
                    $title = isset($_POST['annual-report-title-update']) ? $_POST['annual-report-title-update'] : FALSE;
                    $url = isset($_POST['annual-report-url-update']) ? $_POST['annual-report-url-update'] : FALSE;
                    if ($id && $title && $url) {
                        ipg_update_annual_report($id, $title, $url);
                    }
                } else if ($is_input_delete) {

                    $id = isset($_POST['annual-report-id-delete']) ? $_POST['annual-report-id-delete'] : FALSE;                    
                    if ($id) {                        
                        ipg_delete_annual_report($id);
                    }
                }


                ipg_display_annual_report(TRUE);
                ?>
            </div>
        </div>
    </div>
    <form method="post">
        <div id="modal-edit-annual-report" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Annual report</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-update" name="input-update"/>
                        <input type="hidden" id="annual-report-id-update" name="annual-report-id-update"/>

                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control"  id="annual-report-title-update" name="annual-report-title-update"/>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Url</label>
                            <input type="text" class="form-control" id="annual-report-url-update" name="annual-report-url-update"/>
                        </div>

                    </div>                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-update-annual-report" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>

    <form method="post">
        <div id="modal-delete-annual-report" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Annual report</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-delete" name="input-delete"/>
                        <input type="hidden" id="annual-report-id-delete" name="annual-report-id-delete"/>
                        <h5 class="text-warning">The "<span id="title-report"></span>" is about to delete, are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-delete-annual-report" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    <?php
}

function add_setting_fields_annual_report() {
    
}
