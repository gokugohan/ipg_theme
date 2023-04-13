<?php

function event_setting_page() {
    ?>        
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Events</h1>
                </div>
                <form method="post">
                    <input type="hidden" value="insert" id="input-insert" name="input-insert"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" id="event-title-new" name="event-title-new"/>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Url</label>
                                <input type="text" class="form-control" id="event-url-new" name="event-url-new"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Css class</label>
                                <input type="text" class="form-control" id="event-class-new" name="event-class-new"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Start</label>
                                <input type="date" class="form-control" id="event-start-new" name="event-start-new"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">End</label>
                                <input type="date" class="form-control" id="event-end-new" name="event-end-new"/>
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
                $is_insert = isset($_POST['input-insert']) == "insert";
                if($is_insert){
                    $title = isset($_POST['event-title-new']) ? $_POST['event-title-new'] : FALSE;
                    $url = isset($_POST['event-url-new']) ? $_POST['event-url-new'] : FALSE;
                    $class = isset($_POST['event-class-new']) ? $_POST['event-class-new'] : FALSE;
                    $start = isset($_POST['event-start-new']) ? $_POST['event-start-new'] : FALSE;
                    $end = isset($_POST['event-end-new']) ? $_POST['event-end-new'] : FALSE;
                    if($title && $url && $class && $start && $end){
                        ipg_insert_new_event($title, $url, $class, $start, $end);
                    }
                }
                var_dump(ipg_display_events());
                ?>
            </div>
        </div>
    </div>
    <form method="post">
        <div id="modal-edit-study-research" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Studies and Research</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-update" name="input-update"/>
                        <input type="hidden" id="study-research-id-update" name="study-research-id-update"/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Author</label>
                                    <input type="text" class="form-control"  id="study-research-author-update" name="study-research-author-update"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" id="study-research-title-update" name="study-research-title-update"/>
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Document type</label>
                                    <select class="form-control" id="study-research-document-type-update" name="study-research-document-type-update">
                                        <option value="-1">Select document type</option>
                                        <option value="Paper">Paper</option>
                                        <option value="Presentation">Presentation</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Division</label>
                                    <select class="form-control" id="study-research-division-update" name="study-research-division-update">
                                        <option value="-1">Select Division</option>
                                        <option value="Geo-Investigation">Geo-Investigation</option>
                                        <option value="Geo-Hazard">Geo-Hazard</option>
                                        <option value="Geo-Information">Geo-Information (GIS)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">                    
                                    <label class="control-label">Year</label>
                                    <span id="study-research-date-update-span"></span>
                                    <input type="date" class="form-control" id="study-research-date-update" name="study-research-date-update"/>
                                </div>  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Link for file</label>
                            <input type="text"class="form-control"  id="study-research-link-update" name="study-research-link-update"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-update-study-research" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>

    <form method="post">
        <div id="modal-delete-study-research" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Studies and Research</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-delete" name="input-delete"/>
                        <input type="hidden" id="study-research-id-delete" name="study-research-id-delete"/>
                        <h5 class="text-warning">The "<span id="title-research"></span>" is about to delete, are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-delete-study-research" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    <?php
}

function add_setting_fields_events() {
    
}
