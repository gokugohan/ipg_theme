<?php

function procurement_setting_page()
{
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Procurement form</h1>
                </div>
                <form method="post">
                    <input type="hidden" value="111" id="input-insert" name="input-insert"/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" id="procurement-title"
                                       name="procurement-title"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Open Date</label>
                                <input type="text" class="form-control datepicker" id="procurement-open-date" autocomplete="off"
                                       name="procurement-open-date"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Close Date</label>
                                <input type="text" class="form-control datepicker" id="procurement-close-date" autocomplete="off"
                                       name="procurement-close-date"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Url (file location)</label>
                                <input type="text" class="form-control" id="procurement-url" name="procurement-url"/>
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
                $is_insert = isset($_POST['input-insert']) == 999;
                $is_update = isset($_POST['input-update']) == 111;
                $is_delete = isset($_POST['input-delete']);


                if ($is_insert) {
                    $title = isset($_POST['procurement-title']) ? $_POST['procurement-title'] : FALSE;
                    $open_date = isset($_POST['procurement-open-date']) ? $_POST['procurement-open-date'] : FALSE;
                    $close_date = isset($_POST['procurement-close-date']) ? $_POST['procurement-close-date'] : FALSE;
                    $url = isset($_POST['procurement-url']) ? $_POST['procurement-url'] : FALSE;

                    if ($title && $url) {
                        ipg_insert_new_procurement($title, $url, $open_date, $close_date);
                    }
                } else if ($is_update) {
                    $id = isset($_POST['procurement-id-update']) ? $_POST['procurement-id-update'] : FALSE;
                    $title = isset($_POST['procurement-title-update']) ? $_POST['procurement-title-update'] : FALSE;
                    $open_date = isset($_POST['procurement-open-date-update']) ? $_POST['procurement-open-date-update'] : FALSE;
                    $close_date = isset($_POST['procurement-close-date-update']) ? $_POST['procurement-close-date-update'] : FALSE;
                    $url = isset($_POST['procurement-url-update']) ? $_POST['procurement-url-update'] : FALSE;

                    if ($title && $url) {
                        ipg_update_procurement($id, $title, $url, $open_date, $close_date);
                    }
                } else if ($is_delete) {
                    $id = isset($_POST['procurement-id-delete']) ? $_POST['procurement-id-delete'] : FALSE;
                    if ($id) {
                        ipg_delete_procurement($id);
                    }
                }


                ipg_display_procurement(TRUE);
                ?>
            </div>
        </div>
    </div>
    <form method="post">
        <div id="modal-edit-procurement" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Procurement</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-update" name="input-update"/>
                        <input type="hidden" id="procurement-id-update" name="procurement-id-update"/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" id="procurement-title-update"
                                           name="procurement-title-update"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Open Date</label>
                                    <input type="text" class="form-control datepicker" id="procurement-open-date-update"
                                           autocomplete="off"
                                           name="procurement-open-date-update"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Close Date</label>
                                    <input type="text" class="form-control datepicker" id="procurement-close-date-update"
                                           autocomplete="off"
                                           name="procurement-close-date-update"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Url</label>
                                    <input type="text" class="form-control" id="procurement-url-update"
                                           name="procurement-url-update"/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-update-procurement" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>

    <form method="post">
        <div id="modal-delete-procurement" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Procurement</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="input-delete" name="input-delete"/>
                        <input type="hidden" id="procurement-id-delete" name="procurement-id-delete"/>
                        <h5 class="text-warning">The "<span id="title-procurement"></span>" is about to delete, are you
                            sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-delete-procurement" class="btn btn-warning"><span
                                    class="glyphicon glyphicon-remove"></span> Delete
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    <?php
}

function add_setting_fields_procurement()
{
    add_settings_field_to_section(
        'ipg_setting_procurement', 'Add new procurement', 'ipg_setting_settings_procurement', 'procurement_ipg_theme_setting', 'ipg_setting_procurement_section'
    );
}
