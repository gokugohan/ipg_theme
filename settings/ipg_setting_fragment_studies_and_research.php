<?php

function studies_and_research_setting_page() {
    ?>
    <!--    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/css/bootstrap.min.css' ?>">    -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Studies and research form</h1>
                </div>
                <form method="post">
                    <input type="hidden" value="111" id="input-insert" name="input-insert"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Author</label>
                                <input type="text" class="form-control"  id="study-research-author" name="study-research-author"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" id="study-research-title" name="study-research-title"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Summary</label>
                                <textarea type="text" class="form-control" id="study-research-summary" name="study-research-summary"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Document type</label>
                                <select class="form-control" id="study-research-document-type" name="study-research-document-type">
                                    <option value="-1">Select document type</option>
                                    <option value="Article">Article</option>
<!--                                    <option value="Book">Book</option>-->
                                    <option value="Paper">Paper</option>
                                    <option value="Poster">Poster</option>
                                    <option value="Presentation">Presentation</option>
                                    <option value="Report">Report</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Division</label>
                                <select class="form-control" id="study-research-division" name="study-research-division">
                                    <option value="-1">Select Division</option>
                                    <option value="Geo-Investigation">Geo-Investigation</option>
                                    <option value="Geo-Hazard">Geo-Hazard</option>
                                    <option value="Hidrogeology & Mineral Resource">Hidrogeology & Mineral Resource</option>
                                    <option value="Geo-Information">Geo-Information (GIS)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <input type="date" class="form-control" id="study-research-date" name="study-research-date"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Link for file</label>
                        <input type="text"class="form-control"  id="study-research-link" name="study-research-link"/>
                    </div>

                    <div class="form-group">
                        <input class="button button-primary" type="submit" value="submit"/>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <?php
                $is_insert = isset($_POST['input-insert']) == 999;
                $is_update = isset($_POST['input-update']) == 111;
                $is_delete = isset($_POST['input-delete']);


                if ($is_insert) {
                    $date = isset($_POST['study-research-date']) ? $_POST['study-research-date'] : FALSE;
                    $title = isset($_POST['study-research-title']) ? $_POST['study-research-title'] : FALSE;
                    $author = isset($_POST['study-research-author']) ? $_POST['study-research-author'] : FALSE;
                    $url = isset($_POST['study-research-link']) ? $_POST['study-research-link'] : FALSE;
                    $division = isset($_POST['study-research-division']) ? $_POST['study-research-division'] : FALSE;
                    $doc_type = isset($_POST['study-research-document-type']) ? $_POST['study-research-document-type'] : FALSE;

                    if ($date && $title && $author && $url && $doc_type) {
                        ipg_insert_new_study_and_research($date, $title, $author, $url, $doc_type, $division);
                    }
                } else if ($is_update) {
                    //echo "IS UPDATE";
                    $id = isset($_POST['study-research-id-update']) ? $_POST['study-research-id-update'] : FALSE;
                    $date = isset($_POST['study-research-date-update']) ? $_POST['study-research-date-update'] : FALSE;
                    $title = isset($_POST['study-research-title-update']) ? $_POST['study-research-title-update'] : FALSE;
                    $author = isset($_POST['study-research-author-update']) ? $_POST['study-research-author-update'] : FALSE;
                    $url = isset($_POST['study-research-link-update']) ? $_POST['study-research-link-update'] : FALSE;
                    $division = isset($_POST['study-research-division-update']) ? $_POST['study-research-division-update'] : FALSE;
                    $doc_type = isset($_POST['study-research-document-type-update']) ? $_POST['study-research-document-type-update'] : FALSE;
                    if ($id && $date && $title && $author && $url && $doc_type && $is_update) {
                        ipg_update_study_and_research($id, $date, $title, $author, $url, $doc_type, $division, $is_update);
                    }
                }else if($is_delete){
                    $id = isset($_POST['study-research-id-delete']) ? $_POST['study-research-id-delete'] : FALSE;
                    if($id){
                        ipg_delete_study_and_research($id);
                    }
                }


                ipg_display_studies_and_research(NULL,TRUE);
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
                                      	<option value="Poster">Poster</option>
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

function add_setting_fields_studies_and_research() {
    add_settings_field_to_section(
            'ipg_setting_career', 'Add new vacancy', 'ipg_setting_settings_studies_research', 'studies_research_ipg_theme_setting', 'ipg_setting_studies_research_section'
    );
}
