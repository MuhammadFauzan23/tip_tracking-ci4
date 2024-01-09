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
                            <div class="col-md-3" style="text-align: left;">
                                <h3 class="card-title">Tip Tracking Detail</h3>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3" style="text-align: right;"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered tableView" style="width: 100%;">
                            <thead align="center">
                                <th>Time Out</th>
                                <th>Time In</th>
                                <th>Customer Name</th>
                                <th>Value</th>
                                <th>DO No</th>
                                <th>Driver</th>
                                <th>BP Lorry</th>
                                <th>Trip</th>
                                <th>Remark</th>
                            </thead>
                            <tbody align="center">
                                <?php foreach ($data_per_hari_bulan_tahun as $list) : ?>
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
                                        <td><?= $list['time_out'] ?></td>
                                        <td><?= $list['time_in'] ?></td>
                                        <td><?= $list['customer'] ?></td>
                                        <td>Rp. <?= $list['value_tip']; ?></td>
                                        <td><?= $list['donoo'] ?></td>
                                        <td style="<?= $colorB ?>"><?= $list['driver'] ?></td>
                                        <td><?= $list['lorry'] ?></td>
                                        <td><?= $list['trip'] ?></td>
                                        <td><?= $list['remarks'] ?></td>
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
</script>
<?= $this->endSection() ?>