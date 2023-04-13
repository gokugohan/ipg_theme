<?php

function staff_setting_page() {
    ?>    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>IPG Staffs</h1>
                </div>
                <form method="post">
                    <input type="hidden" id="input-insert" name="input-insert" value="111"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" id="staff-name" name="staff-name"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Photo url</label>
                                <input type="text" class="form-control"  id="staff-image" name="staff-image"/>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" id="staff-email" name="staff-email"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Degree(Grau de estudo)</label>
                                <input type="text" class="form-control" id="staff-degree" name="staff-degree"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Position</label>
                                <input type="text" class="form-control" id="staff-position" name="staff-position"/>
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

                var_dump($is_input_insert);
                var_dump($is_input_update);
                var_dump($is_input_delete);

                $name = isset($_POST['staff-name']) ? $_POST['staff-name'] : FALSE;
                $image = isset($_POST['staff-image']) ? $_POST['staff-image'] : FALSE;
                $email = isset($_POST['staff-email']) ? $_POST['staff-email'] : FALSE;
                $degree = isset($_POST['staff-degree']) ? $_POST['staff-degree'] : FALSE;
                $position = isset($_POST['staff-position']) ? $_POST['staff-position'] : FALSE;

                if ($is_input_insert && ($name && $image && $email && $position)) {
                    ipg_insert_new_ipg_staff($name, $email, $image, $position, $degree);
                } else if ($is_input_update) {
                    $id = isset($_POST['staff-id-edit'])?$_POST['staff-id-edit']:FALSE;
                    $name = isset($_POST['staff-name-edit']) ? $_POST['staff-name-edit'] : FALSE;
                    $image = isset($_POST['staff-image-edit']) ? $_POST['staff-image-edit'] : FALSE;
                    $email = isset($_POST['staff-email-edit']) ? $_POST['staff-email-edit'] : FALSE;
                    $degree = isset($_POST['staff-degree-edit']) ? $_POST['staff-degree-edit'] : FALSE;
                    $position = isset($_POST['staff-position-edit']) ? $_POST['staff-position-edit'] : FALSE;
                   
                    
                    if ($id && $name && $image && $email && $position) {
                        ipg_update_ipg_staff($id, $name, $email, $image, $position, $degree);
                    }
                } else if ($is_input_delete) {
                    $id = isset($_POST['staff-id-delete']) ? $_POST['staff-id-delete'] : FALSE;
                    if ($id) {
                        ipg_delete_ipg_staff($id);
                    }
                }

                (ipg_display_ipg_staff(TRUE));
                ?>
            </div>
        </div>
    </div>


    <form method="post">
        <div id="modal-edit-staff" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change staff data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="input-update" name="input-update" value="222"/>
                        <input type="hidden" id="staff-id-edit" name="staff-id-edit"/>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" id="staff-name-edit" name="staff-name-edit"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Photo url</label>
                            <input type="text" class="form-control"  id="staff-image-edit" name="staff-image-edit"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" id="staff-email-edit" name="staff-email-edit"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Degree(Grau de estudo)</label>
                            <input type="text" class="form-control" id="staff-degree-edit" name="staff-degree-edit"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Position</label>
                            <input type="text" class="form-control" id="staff-position-edit" name="staff-position-edit"/>
                        </div>                  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-edit-staff" class="btn btn-primary">Save Changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>


    <form method="post">
        <div id="modal-delete-staff" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Staff data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-delete" name="input-delete"/>
                        <input type="hidden" id="staff-id-delete" name="staff-id-delete"/>
                        <h5 class="text-warning">The staff "<strong><span id="staff-name-delete"></span></strong>" data is about to remove, are you sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-delete-staff" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>

    <?php
}

function add_setting_fields_staff() {
    add_settings_field_to_section(
            'ipg_setting_career', 'Add new vacancy', 'ipg_setting_settings_studies_research', 'studies_research_ipg_theme_setting', 'ipg_setting_studies_research_section'
    );
}
