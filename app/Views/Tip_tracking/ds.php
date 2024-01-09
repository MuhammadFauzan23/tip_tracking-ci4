"<div class='card-body'>" +
    "<form action='<?= base_url('Tip/tambahlistTip') ?>' method='POST'>" +
        "<div class='row'>" +
            "<div class='col-md-6'>" +
                "<div class='row'>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>Start Time</label>" +
                            "<div class='input-group'>" +
                                "<input type='datetime-local' class='form-control' name='start_time[]' id='start_time_id'>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>End Time</label>" +
                            "<div class='input-group'>" +
                                "<input type='datetime-local' class='form-control' name='end_time[]' id='end_time_id'>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "<div class='row'>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>Remark</label>" +
                            "<div class='input-group'>" +
                                "<input name='remarks[]' id='' class='form-control'>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>DO No</label>" +
                            "<div class='input-group'>" +
                                "<select class='form-control select2" + addform + "' style='width: 100%;' name='Dono[]' id='dono_id' multiple>" +
                                    "<?php foreach ($data_dono as $dono) : ?>" +
                                    "<option value='<?= $dono['dono'] ?>'><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>" +
                                    "<?php endforeach; ?>" +
                                    "</select>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
            "<div class='col-md-6'>" +
                "<div class='row'>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>Trip</label>" +
                            "<div class='input-group'>" +
                                "<input type='text' class='form-control' name='trip[]' id=''>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>Value</label>" +
                            "<div class='input-group'>" +
                                "<select class='form-control select2" + addform + "' style='width: 100%;' name='value[]' id='value_id'>" +
                                    "<option value=''>-- Select Value --</option>" +
                                    "<?php foreach ($data_value as $value) : ?>" +
                                    "<option value='<?= $value['value_tip'] ?>'>Rp.<?= $value['value_tip'] ?></option>" +
                                    "<?php endforeach; ?>" +
                                    "</select>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "<div class='row'>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>Driver</label>" +
                            "<div class='input-group'>" +
                                "<select class='form-control select2" + addform + "' style='width: 100%;' name='driver[]' id='driver_id'>" +
                                    "<option value=''>-- Select Driver --</option>" +
                                    "<?php foreach ($data_driver as $driver) : ?>" +
                                    "<option value='<?= $driver['name_driver'] ?>'><?= $driver['name_driver'] ?></option>" +
                                    "<?php endforeach; ?>" +
                                    "</select>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                            "<label for=''>BP Lorry</label>" +
                            "<div class='input-group'>" +
                                "<select class='form-control select2" + addform + "' style='width: 100%;' name='lorry[]' id='bp_lorry_id'>" +
                                    "<option value=''>-- Select Lorry --</option>" +
                                    "<?php foreach ($data_lorry as $lorry) : ?>" +
                                    "<option value='<?= $lorry['plat_lorry'] ?>'><?= $lorry['plat_lorry'] ?></option>" +
                                    "<?php endforeach; ?>" +
                                    "</select>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
            "<button type='button' class='btn btn-danger btnhapusform'>" +
                "<i class='fa fa-trash'>Hapus</i>" +
                "</button>" +
            "</div>" +
        "</form>" +
    "</div>"
)