<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script src="<?= base_url('asset/animasi/js') ?>/lottie-player.js"></script>
                <lottie-player class="text-center" src="<?= base_url('asset/animasi/delivery.json') ?>" background="transparent" speed="1.2" style="width: auto; height: auto;" loop autoplay></lottie-player>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6" style="text-align: left;">
                                        <h3 class="card-title">Tip Tracking Temporary</h3>
                                    </div>
                                    <div class="col-md-6" style="text-align: right;">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="nav-icon far fa-plus-square"></i> Temporary Master</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered tableView" style="width: 100%;">
                                    <thead align="center">
                                        <th>NO</th>
                                        <th>Driver</th>
                                        <th>Plat Lory</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $no = 0;
                                        foreach ($data_temporary as $list) :
                                            $no++;
                                            $stts = 'detail';
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $list['driver_name'] ?></td>
                                                <td><?= $list['plat_lorry'] ?></td>
                                                <td>
                                                    <a href="<?= base_url() . '/tip/viewTemporaryDetail?driver=' . $list['driver_name'] . '&plat=' . $list['plat_lorry'] ?>" class="btn btn-success mb-1"><i class="nav-icon far fa-plus-square"></i> List</a>
                                                    <a href="<?= base_url() . '/tip/deleteTemporaryDetail?driver=' . $list['driver_name'] . '&plat=' . $list['plat_lorry'] ?>" class="btn btn-danger mb-1 hapus"><i class="nav-icon fas fa-trash-alt"></i> List</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Master Temporary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <script src="<?= base_url('asset/animasi/js') ?>/lottie-player.js"></script>
                    <lottie-player class="text-center" src="<?= base_url('asset/animasi/delivery.json') ?>" background="transparent" speed="1.2" style="width: auto; height: auto;" loop autoplay></lottie-player>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('Tip/addTemporary') ?>" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Driver</label>
                                        <div class="input-group">
                                            <select class="form-control select2" style="width: 100%;" name="driver_tambah" id="">
                                                <option value="">-- Select Driver --</option>
                                                <?php foreach ($data_driver as $driver) : ?>
                                                    <option value="<?= $driver['name_driver'] ?>"><?= $driver['name_driver'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">BP Lorry</label>
                                        <div class="input-group">
                                            <select class="form-control select2" style="width: 100%;" name="lorry_tambah" id="">
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
                        <div class="modal-footer">
                            <button class="btn btn-circle btn-facebook btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add -->

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
                [5, 10, 15, -1],
                ["5", "10", "15", "All"]
            ],
        });
    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>