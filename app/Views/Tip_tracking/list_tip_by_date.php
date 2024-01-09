<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script src="<?= base_url('asset/animasi/js') ?>/lottie-player.js"></script>
                <lottie-player class="text-center" src="<?= base_url('asset/animasi/report.json') ?>" background="transparent" speed="1.2" style="width: auto; height:auto;" loop autoplay></lottie-player>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="row">
                                    <h3 class="card-title">Tip Tracking by Date</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered tableView" style="width: 100%;">
                                    <thead align="center">
                                        <th>NO</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $no = 0;
                                        foreach ($data_per_bulan_tahun as $list) :
                                            $convert = date('d F Y', strtotime($list['tgl']));
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $convert ?></td>
                                                <td>
                                                    <a href="<?= base_url() . '/tip/viewListTipbydatetime?date=' . $list['tgl'] ?>" class="btn btn-success mb-1"><i class="far fa-book-alt"></i> Lihat Harian </a>
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
                "<?php foreach ($data_driver as $driver) : ?><option value='<?= $driver['name_driver'] ?>' ><?= $driver['name_driver'] ?></option><?php endforeach; ?>" +
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
                "<?php foreach ($data_lorry as $lorry) : ?><option value='<?= $lorry['plat_lorry'] ?>' ><?= $lorry['plat_lorry'] ?></option><?php endforeach; ?>" +
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