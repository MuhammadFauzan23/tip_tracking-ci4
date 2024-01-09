<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="row">
                            <div class="col mt-2">
                                <h3 class="card-title">Tip Tracking Schedule</h3>
                            </div>
                            <div class="col">
                            </div>
                            <div class="col">
                                <div style="text-align: right;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="nav-icon far fa-plus-square"></i> Add Trip</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered tableView" style="width: 100%;">
                            <thead align="center">
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Customer Name</th>
                                <th>Value</th>
                                <th>DO No</th>
                                <th>Driver</th>
                                <th>BP Lorry</th>
                                <th>Trip</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </thead>
                            <tbody align="center">
                                <?php
                                foreach ($data_list as $list) :
                                ?>
                                    <?php
                                    $driver = $list['driver'];
                                    if ($driver == "Chandra Sinaga") {
                                        $colorB = 'background-color:yellow';
                                    ?>
                                    <?php } elseif ($driver == "Doni") {
                                        $colorB = 'background-color:orange';
                                    ?>
                                    <?php } elseif ($driver == "Dafrizal") {
                                        $colorB = 'background-color:Green';
                                    ?>
                                    <?php } elseif ($driver == "Herian") {
                                        $colorB = 'background-color:Grey';
                                    ?>
                                    <?php } ?>
                                    <tr>
                                        <td><?= $list['start_time'] ?></td>
                                        <td><?= $list['end_time'] ?></td>
                                        <td><?= $list['customer'] ?></td>
                                        <td>Rp. <?= $list['value_tip']; ?></td>
                                        <td><?= $list['donoo'] ?></td>
                                        <td style="<?= $colorB ?>"><?= $list['driver'] ?></td>
                                        <td><?= $list['lorry'] ?></td>
                                        <td><?= $list['trip'] ?></td>
                                        <td><?= $list['remarks'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning mb-1 update-record" data-idtip="<?= $list['id']; ?>" data-start_time="<?= $list['start_time'] ?>" data-end_time="<?= $list['end_time'] ?>" data-value="<?= $list['value_tip'] ?>" data-driver="<?= $list['driver'] ?>" data-lorry="<?= $list['lorry'] ?>" data-trip="<?= $list['trip'] ?>" data-remarks="<?= $list['remarks'] ?>" data-donoo="<?= $list['remarks'] ?>">
                                                <i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#delete<?= $list['id'] ?>"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add  -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Tip/addListTip') ?>" method="POST">
                    <!-- Buat tombol untuk menabah form data -->
                    <div class="col-md-12" style="text-align: right;">
                        <button type="button" id="btn-tambah-form" class="btn btn-success"><i class="fas fa-plus"></i> Add Form</button>
                        <button type="button" id="btn-reset-form" class="btn btn-danger"><i class="fas fa-trash"></i> Delete Form</button>
                        <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-file"></i> Save</button>
                    </div>
                    <hr>
                    <!-- Main Form -->
                    <h6>Form data : 1</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start Time</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="start_time_tambah[]" id="start_time_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">End Time</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="end_time_tambah[]" id="end_time_id">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">DO No</label>
                                <div class="input-group">
                                    <select class="form-control bootstrap-select" style="width: 100%;" name="Dono_tambah[]" id="" multiple data-live-search="true" multiple data-live-search-placeholder="Search" data-actions-box="true">
                                        <option value="">-- Select DO No --</option>
                                        <?php foreach ($data_dono as $dono) : ?>
                                            <option value="<?= $dono['dono'] ?>"><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Trip</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="trip_tambah[]" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Value</label>
                                        <div class="input-group">
                                            <select class="form-control select2" style="width: 100%;" name="value_tambah[]" id="">
                                                <option value="">-- Select Value --</option>
                                                <?php foreach ($data_value as $value) : ?>
                                                    <option value="<?= $value['value_tip'] ?>">Rp.<?= $value['value_tip'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Driver</label>
                                        <div class="input-group">
                                            <select class="form-control select2" style="width: 100%;" name="driver_tambah[]" id="">
                                                <option value="">-- Select Driver --</option>
                                                <?php foreach ($data_driver as $driver) : ?>
                                                    <option value="<?= $driver['name_driver'] ?>"><?= $driver['name_driver'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">BP Lorry</label>
                                        <div class="input-group">
                                            <select class="form-control select2" style="width: 100%;" name="lorry_tambah[]" id="">
                                                <option value="">-- Select Lorry --</option>
                                                <?php foreach ($data_lorry as $lorry) : ?>
                                                    <option value="<?= $lorry['plat_lorry'] ?>"><?= $lorry['plat_lorry'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remark</label>
                                <div class="input-group">
                                    <input name="remarks_tambah[]" id="" class="form-control" cols="12" rows="1"></input>
                                </div>
                            </div>
                        </div>
                        <!-- End Main Form -->
                    </div>

                    <!-- COPY Form -->
                    <div id="insert-form"></div>
                    <!-- End  Form -->
                </form>

                <!-- Kita buat textbox untuk menampung jumlah data form -->
                <input type="hidden" id="jumlah-form" value="1">
                <!-- -------------------------------------------------- -->
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add -->

<!-- Modal Edit  -->
<?php foreach ($data_list as $list) : ?>
    <div class="modal fade" id="UpdateModal" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Tip/editListTip') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- ID Tip -->
                                <input type="text" class="form-control" name="id_edit" id="" readonly hidden>
                                <!--  -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Start Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="start_time_edit" id="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">End Time</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="end_time_edit" id="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Do No</label>
                                    <div class="input-group">
                                        <select class="form-control bootstrap-select dono_edit" style="width: 100%;" name="Dono_edit[]" id="" multiple data-live-search="true" multiple data-live-search-placeholder="Search" data-actions-box="true">
                                            <?php foreach ($data_dono as $dono) : ?>
                                                <option value="<?= $dono['dono'] ?>"><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Driver</label>
                                            <div class="input-group">
                                                <select class="form-control select2 driver_edit" style="width: 100%;" name="driver_edit" id="driver">
                                                    <?php foreach ($data_driver as $driver) : ?>
                                                        <option value="<?= $driver['name_driver'] ?>"><?= $driver['name_driver'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">BP Lorry</label>
                                            <div class="input-group">
                                                <select class="form-control select2 lorry_edit" style="width: 100%;" name="lorry_edit" id="">
                                                    <?php foreach ($data_lorry as $lorry) : ?>
                                                        <option value="<?= $lorry['plat_lorry'] ?>"><?= $lorry['plat_lorry'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Remark</label>
                                    <div class="input-group">
                                        <textarea name="remarks_edit" id="" class="form-control" cols="12" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Modal Edit -->

<?php foreach ($data_list as $list) : ?>
    <!-- Modal Delete  -->
    <div class="modal fade" id="delete<?= $list['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Tip/deleteListTip') ?>" method="POST">
                    <div class="modal-body">
                        <!-- ID Tip -->
                        <input type="text" class="form-control" name="id" id="" value="<?= $list['id'] ?>" hidden>
                        <!--  -->
                        <p style="text-align: center;">Are you sure want to delete data with Customer :</p>
                        <h4 style="text-align: center;"><b><?= $list['customer'] ?></b></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

<?php endforeach; ?>

<script>
    //javascript switch alert
    <?php $pesan = session()->getFlashdata('pesan') ?>
    $(function() {
        <?php if ($pesan) { ?>
            <?php if ($pesan['stts'] != true) { ?>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Terjadi Kesalahan Proses!',
                    text: '<?= $pesan['msg'] ?>',
                    timer: 2500
                })
            <?php } else { ?>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Proses OK!',
                    text: '<?= $pesan['msg'] ?>',
                    timer: 2500
                })
        <?php }
        } ?>
    });
    //.........................................................................................................

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
                [5, 10, 15, -1],
                ["5", "10", "15", "All"]
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

            $(".dono_edit").val('');
            $(".value_edit").val('');
            $(".driver_edit").val('');
            $(".lorry_edit").val('');
            $('#UpdateModal').modal('show');
            $('[name="id_edit"]').val(idTip);
            $('[name="start_time_edit"]').val(start);
            $('[name="end_time_edit"]').val(end);
            $('[name="trip_edit"]').val(trip);
            $('[name="remarks_edit"]').val(remarks);


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
                    $.each(values.split(","), function(i, e) {
                        // console.log(values);
                        $(".dono_edit option[value=" + e + "]").prop("selected", true).trigger('change');
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

            $.ajax({
                url: "<?= base_url('tip/get_driver_tip'); ?>",
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
                    $.each(values.split(","), function(i, r) {
                        // console.log(r);
                        // $('.driver_edit option[value="' + r + '"]').prop('selected', true);
                        $(".driver_edit option[value=" + r + "]").prop("selected", true).trigger('change');
                        $(".driver_edit").selectpicker('refresh');
                    });
                }

            });

            $.ajax({
                url: "<?= base_url('tip/get_lorry_tip'); ?>",
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
                    $.each(values.split(","), function(i, s) {
                        // console.log(values);
                        $(".lorry_edit option[value=" + s + "]").prop("selected", true).trigger('change');
                        $(".lorry_edit").selectpicker('refresh');
                    });
                }

            });
            return false;
        });
    });
    //----------------------------------------------------------------------------------------------------------

    // DYNAMIC FORM
    $(document).ready(function() { // Ketika halaman sudah diload dan siap
        $("#btn-tambah-form").click(function() { // Ketika tombol Tambah Data Form di klik
            var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
            var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya

            // Kita akan menambahkan form dengan menggunakan append
            // pada sebuah tag div yg kita beri id insert-form
            $("#insert-form").append(
                "<hr>" +
                "<h6>Form data : " + nextform + "</h6>" +
                "<div class='row'>" +
                "<div class='col-md-6'>" +
                "<div class='row'>" +
                "<div class='col-md-6'>" +
                "<div class='form-group'>" +
                "<label for=''>Start Time</label>" +
                "<div class='input-group'>" +
                "<input type='datetime-local' class='form-control' name='start_time_tambah[]' id='start_time_id'>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-6'>" +
                "<div class='form-group'>" +
                "<label for=''>End Time</label>" +
                "<div class='input-group'>" +
                "<input type='datetime-local' class='form-control' name='end_time_tambah[]' id='end_time_id'>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='form-group'>" +
                "<label for=''>DO No</label>" +
                "<div class='input-group'>" +
                "<select class='form-control bootstrap-select" + nextform + "' style='width: 100%;' name='Dono_tambah[]' id='' multiple data-live-search='true' multiple data-live-search-placeholder='Search' data-actions-box='true'>" +
                "<option value=''>-- Select DO No --</option>" +
                "<?php foreach ($data_dono as $dono) : ?> <option value=<?= $dono['dono'] ?> ><?= $dono['dono'] ?> |---| <?= $dono['customername'] ?></option> + <?php endforeach; ?> " +
                "</select>" +
                "</div>" +
                "</div>" +
                "</div>" +

                "<div class='col-md-6'>" +
                "<div class='row'>" +
                "<div class='col-md-6'>" +
                "<div class='form-group'>" +
                "<label for=''>Trip</label>" +
                "<div class='input-group'>" +
                "<input type='text' class='form-control' name='trip_tambah[]' id=''>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-6'>" +
                "<div class='form-group'>" +
                "<label for=''>Value</label>" +
                "<div class='input-group'>" +
                "<select class='form-control select2" + nextform + "' style='width: 100%;' name='value_tambah[]' id=''>" +
                "<option value=''>-- Select Value --</option>" +
                "<?php foreach ($data_value as $value) : ?><option value=<?= $value['value_tip'] ?> >Rp.<?= $value['value_tip'] ?></option><?php endforeach; ?>" +
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
                "<select class='form-control select2" + nextform + "' style='width: 100%;' name='driver_tambah[]' id=''>" +
                "<option value=''>-- Select Driver --</option>" +
                "<?php foreach ($data_driver as $driver) : ?><option value=<?= $driver['name_driver'] ?> ><?= $driver['name_driver'] ?></option><?php endforeach; ?>" +
                "</select>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-6'>" +
                "<div class='form-group'>" +
                "<label for=''>BP Lorry</label>" +
                "<div class='input-group'>" +
                "<select class='form-control select2" + nextform + "' style='width: 100%;' name='lorry_tambah[]' id=''>" +
                "<option value=''>-- Select Lorry --</option>" +
                "<?php foreach ($data_lorry as $lorry) : ?><option value=<?= $lorry['plat_lorry'] ?> ><?= $lorry['plat_lorry'] ?></option><?php endforeach; ?>" +
                "</select>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>" +

                "<div class='col-md-12'>" +
                "<div class='form-group'>" +
                "<label for=''>Remark</label>" +
                "<div class='input-group'>" +
                "<input name='remarks_tambah[]' id='' class='form-control' cols='12' rows='1'></input>" +
                "</div>" +
                "</div>" +
                "</div>" +

                "</div>"
            );
            $(".select2" + nextform + "").select2();
            $(".bootstrap-select" + nextform + "").selectpicker();

            $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
        });

        // Buat fungsi untuk mereset form ke semula
        $("#btn-reset-form").click(function() {
            $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
            $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
        });
    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>