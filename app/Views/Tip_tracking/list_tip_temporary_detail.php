<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" style="text-align: left;">
                                <p><?= $_GET['driver']; ?> <span>|---|</span> <?= $_GET['plat']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">
                                <form action="<?= base_url('Tip/addTemporaryDetail') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker" name="temporary_start_time" id="start_time_id" placeholder=" Masukkan Time Out" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control datetimepicker" name="temporary_end_time" id="end_time_id" placeholder=" Masukkan Time In" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control bootstrap-select" style="width: 100%;" name="temporary_Dono[]" id="" multiple data-live-search="true" multiple data-live-search-placeholder="Search" data-actions-box="true">
                                                        <option value="">-- Select DO No --</option>
                                                        <?php foreach ($data_dono as $dono) : ?>
                                                            <option value="<?= $dono['tr_dono'] ?>"><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input name="temporary_remarks" id="" class="form-control" cols="12" rows="1" placeholder=" Masukkan Remarks">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="temporary_driver" class="form-control" value="<?= $_GET['driver']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="temporary_plat" class="form-control" value="<?= $_GET['plat']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control select2" style="width: 100%;" name="temporary_value" id="">
                                                        <option value="">-- Select Value --</option>
                                                        <?php foreach ($data_value as $value) : ?>
                                                            <option value="<?= $value['value_tip'] ?>">Rp.<?= $value['value_tip'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="temporary_trip" id="trip_id" placeholder=" Masukkan Trip">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <button type="submit" class="btn btn-primary"><i class="nav-icon far fa-plus-square"></i> Save </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <?php if ($data_temporary_detail) { ?>
                                                        <a href="<?php foreach ($data_temporary_detail as $list) : ?>
                                                        <?= base_url('Tip/transferTemporary?driver=' . $list['driver'] . '&plat=' . $list['lorry']) ?>
                                                        <?php endforeach; ?>" class="btn btn-success rilis"><i class="nav-icon fas fa-share"></i> Send </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr style="color:black;">
                    <div class="card-body">
                        <table class="table table-bordered tableView" style="width: 100%;">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Driver</th>
                                    <th>Plat Lorry</th>
                                    <th>Start Out</th>
                                    <th>Start In</th>
                                    <th>DO No</th>
                                    <th>Total DO</th>
                                    <th>Customer</th>
                                    <th>Value</th>
                                    <th>Trip</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($data_temporary_detail as $list) :
                                    $no++;
                                ?>
                                    <tr align="center">
                                        <td><?= $no; ?></td>
                                        <td><?= $list['driver'] ?></td>
                                        <td><?= $list['lorry'] ?></td>
                                        <td><?= $list['time_out'] ?></td>
                                        <td><?= $list['time_in'] ?></td>
                                        <td><?= $list['donoo'] ?></td>
                                        <td><?= $list['jml_do'] ?></td>
                                        <td><?= $list['customer'] ?></td>
                                        <td><?= $list['value_tip'] ?></td>
                                        <td><?= $list['trip'] ?></td>
                                        <td><?= $list['remarks'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning mb-1 update-record" data-idtip="<?= $list['id']; ?>" data-start_time="<?= $list['time_in'] ?>" data-end_time="<?= $list['time_out'] ?>" data-value="<?= $list['value_tip'] ?>" data-driver="<?= $list['driver'] ?>" data-lorry="<?= $list['lorry'] ?>" data-trip="<?= $list['trip'] ?>" data-remarks="<?= $list['remarks'] ?>" data-donoo="<?= $list['remarks'] ?>">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url() . '/Tip/deleteListTip?id=' .  $list['id'] . '&driver=' . $list['driver'] . '&plat=' . $list['lorry'] ?>" class="btn btn-danger mb-1 hapus"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($data_temporary_detail as $list) : ?>
    <div class="modal fade" id="UpdateModal" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <script src="<?= base_url('asset/animasi/js') ?>/lottie-player.js"></script>
                        <lottie-player class="text-center" src="<?= base_url('asset/animasi/update.json') ?>" background="transparent" speed="1.2" style="width: auto; height: auto;" loop autoplay></lottie-player>
                    </div>
                    <div class="col-md-6">
                        <form action="<?= base_url('Tip/editListTip') ?>" method="POST">
                            <div class="modal-body">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- ID Tip -->
                                        <input type="text" class="form-control" name="id_edit" id="" readonly hidden>
                                        <!--  -->
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="">Start Time</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="start_time_edit" id="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="">End Time</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="end_time_edit" id="" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Data Hidden -->
                                        <input type="text" class="form-control" name="lorry_edit" id="" value="" hidden>
                                        <input type="text" class="form-control" name="driver_edit" id="" value="" hidden>
                                        <!-- ----------- -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Value</label>
                                                    <div class="input-group">
                                                        <select class="form-control select2 value_edit" style="width: 100%;" name="value_edit" id="">
                                                            <?php foreach ($data_value as $value) : ?>
                                                                <option value="<?= $value['value_tip'] ?>">Rp.<?= $value['value_tip'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="">Trip</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="trip_edit" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Remark</label>
                                            <div class="input-group">
                                                <textarea name="remarks_edit" id="" class="form-control" cols="12" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Do No</label>
                                        <div class="input-group">
                                            <select class="form-control bootstrap-select dono_edit" style="width: 100%;" name="Dono_edit[]" id="" multiple data-live-search="true" multiple data-live-search-placeholder="Search" data-actions-box="true">
                                                <?php foreach ($data_dono as $dono) : ?>
                                                    <option value="<?= $dono['tr_dono'] ?>"><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    //JAVASCRIPT DATATABLE
    $(function() {
        $('.tableView').DataTable({
            stateSave: true,
            "searching": true,
            "ordering": false,
            "scrollX": true,
            fixedColumns: {
                left: 4,
                right: 1
            },
            lengthMenu: [
                [-1],
                ["All"]
            ],
        });
    });
    //----------------------------------------------------------------------------------------------------------

    //JAVASCRIPT MULTIPLE SELECT PADA DO
    $(document).ready(function() {
        $('.bootstrap-select').selectpicker();
    });
    //----------------------------------------------------------------------------------------------------------

    //JAVASCRIPT MULTIPLE SELECT PADA DO
    $(document).ready(function() {
        $('.bootstrap-select').selectpicker();

        //GET UPDATE
        $('.update-record').on('click', function() {
            var idTip = $(this).data('idtip');
            var start = $(this).data('start_time');
            var end = $(this).data('end_time');
            var trip = $(this).data('trip');
            var remarks = $(this).data('remarks');
            var plat = $(this).data('lorry');
            var driver = $(this).data('driver');

            $(".dono_edit").val('');
            $(".value_edit").val('');
            // $(".driver_edit").val('');
            // $(".lorry_edit").val('');
            $('#UpdateModal').modal('show');
            $('[name="id_edit"]').val(idTip);
            $('[name="start_time_edit"]').val(start);
            $('[name="end_time_edit"]').val(end);
            $('[name="trip_edit"]').val(trip);
            $('[name="remarks_edit"]').val(remarks);
            $('[name="lorry_edit"]').val(plat);
            $('[name="driver_edit"]').val(driver);


            //AJAX REQUEST TO GET SELECTED PRODUCT
            $.ajax({
                url: "<?= base_url('tip/get_do_by_tip'); ?>",
                method: "POST",
                data: {
                    id: idTip
                },
                cache: false,
                success: function(data) {
                    var item = data;
                    var val1 = item.replace("[", "");
                    var val2 = val1.replace("]", "");
                    var values = val2;
                    $.each(values.split(","), function(i, b) {
                        console.log(values);
                        $(".dono_edit option[value=" + b + "]").prop("selected", true).trigger('change');
                        $(".dono_edit").selectpicker('refresh');
                    });
                }

            });

            $.ajax({
                url: "<?= base_url('tip/get_value_tip'); ?>",
                method: "POST",
                data: {
                    id: idTip
                },
                cache: false,
                success: function(data) {
                    var item = data;
                    var val1 = item.replace("[", "");
                    var val2 = val1.replace("]", "");
                    var values = val2;
                    // console.log(values);
                    $.each(values.split(","), function(i, e) {
                        $(".value_edit option[value=" + e + "]").prop("selected", true).trigger('change');
                        $(".value_edit").selectpicker('refresh');
                    });
                }

            });

            // $.ajax({
            //     url: "<?= base_url('tip/get_driver_tip'); ?>",
            //     method: "POST",
            //     data: {
            //         id: idTip
            //     },
            //     cache: false,
            //     success: function(data) {
            //         var item = data;
            //         var val1 = item.replace("[", "");
            //         var val2 = val1.replace("]", "");
            //         var values = val2;
            //         $.each(values.split(","), function(i, r) {
            //             // console.log(r);
            //             // $('.driver_edit option[value="' + r + '"]').prop('selected', true);
            //             $(".driver_edit option[value=" + r + "]").prop("selected", true).trigger('change');
            //             $(".driver_edit").selectpicker('refresh');
            //         });
            //     }

            // });

            // $.ajax({
            //     url: "<?= base_url('tip/get_lorry_tip'); ?>",
            //     method: "POST",
            //     data: {
            //         id: idTip
            //     },
            //     cache: false,
            //     success: function(data) {
            //         var item = data;
            //         var val1 = item.replace("[", "");
            //         var val2 = val1.replace("]", "");
            //         var values = val2;
            //         $.each(values.split(","), function(i, s) {
            //             // console.log(values);
            //             $(".lorry_edit option[value=" + s + "]").prop("selected", true).trigger('change');
            //             $(".lorry_edit").selectpicker('refresh');
            //         });
            //     }

            // });
            return false;
        });
    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>