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
                            <div class="col" class="col text-left">
                                <?php
                                $dari = date("d F Y", strtotime($_GET['dari_tanggal']));
                                $ke = date("Y-m-d", strtotime($_GET['ke_tanggal']));
                                $ke_ = date("Y-m-d", strtotime("+1 month", strtotime($ke)));
                                $ke__ = date("d F Y", strtotime($ke_));
                                $no = 1;
                                ?>
                                <h3 class="card-title"> Monthly Distance Allowance <b><?= $dari ?></b> <span>-</span> <b><?= $ke__ ?></b></h3>
                            </div>
                            <div class="col text-right">
                                <a type="button" name="Print PDF" href="<?= base_url('tip/printreportrentangbulan?dari_tanggal=' . $dari . '&ke_tanggal=' . $ke_) ?>" class="btn btn-primary mb-1"><i class="nav-icon fas fa-print"></i> Cetak laporan</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table style="width:100%" class="table table-bordered tableView">
                            <thead>
                                <tr align="center">
                                    <th rowspan="2">No</th>
                                    <th style="min-width: 20px;" rowspan="2">Date</th>
                                    <th colspan="4">allowance</th>
                                    <th rowspan="2">Total allowance</th>
                                    <th colspan="4">Trip</th>
                                    <th rowspan="2">Total Tip</th>
                                </tr>
                                <tr align="center">
                                    <th>Chandra Sinaga</th>
                                    <th>Doni</th>
                                    <th>Dafrizal</th>
                                    <th>Herian</th>
                                    <th>Chandra Sinaga</th>
                                    <th>Doni</th>
                                    <th>Dafrizal</th>
                                    <th>Herian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $begin = new DateTime($dari);
                                $end   = new DateTime($ke__);
                                for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                                ?>
                                    <tr align="center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $i->format("d M Y") ?></td>
                                        <?php $trip = 0; ?>
                                        <?php foreach ($data_report_bulanan as $chandra) { ?>
                                            <?php if ($i->format('Y-m-d') == $chandra['tgl']) { ?>
                                                <?php $trip = $chandra['trip_chandra']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_chandra = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_chandra ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $doni) { ?>
                                            <?php if ($i->format('Y-m-d') == $doni['tgl']) { ?>
                                                <?php $trip = $doni['trip_doni']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_doni = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_doni ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $dafrizal) { ?>
                                            <?php if ($i->format('Y-m-d') == $dafrizal['tgl']) { ?>
                                                <?php $trip = $dafrizal['trip_dafrizal']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_dafrizal = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_dafrizal ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $herian) { ?>
                                            <?php if ($i->format('Y-m-d') == $herian['tgl']) { ?>
                                                <?php $trip = $herian['trip_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_herian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_herian ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $tp) { ?>
                                            <?php if ($i->format('Y-m-d') == $tp['tgl']) { ?>
                                                <?php $trip = $tp['trip_chandra'] + $tp['trip_doni'] + $tp['trip_dafrizal'] + $tp['trip_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $chandra) { ?>
                                            <?php if ($i->format('Y-m-d') == $chandra['tgl']) { ?>
                                                <?php
                                                $trip = $chandra['value_chandra'];
                                                ?>
                                            <?php } ?>
                                            <?php $tampilkan_tip_chandra = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_tip_chandra, 2, ".", ",") ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $doni) { ?>
                                            <?php if ($i->format('Y-m-d') == $doni['tgl']) { ?>
                                                <?php
                                                $trip = $doni['value_doni'];
                                                ?>
                                            <?php } ?>
                                            <?php $tampilkan_tip_doni = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_tip_doni, 2, ".", ",") ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $dafrizal) { ?>
                                            <?php if ($i->format('Y-m-d') == $dafrizal['tgl']) { ?>
                                                <?php
                                                $trip = $dafrizal['value_dafrizal'];
                                                ?>
                                            <?php } ?>
                                            <?php $tampilkan_tip_dafrizal = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_tip_dafrizal, 2, ".", ",") ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $herian) { ?>
                                            <?php if ($i->format('Y-m-d') == $herian['tgl']) { ?>
                                                <?php
                                                $trip = $herian['value_herian'];
                                                ?>
                                            <?php } ?>
                                            <?php $tampilkan_tip_herian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_tip_herian, 2, ".", ",") ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $tp) { ?>
                                            <?php if ($i->format('Y-m-d') == $tp['tgl']) { ?>
                                                <?php $trip = $tp['value_chandra'] + $tp['value_doni'] + $tp['value_dafrizal'] + $tp['value_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_total = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td>Rp <?= number_format($tampilkan_total, 2, ".", ",") ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr align="center">
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <?php foreach ($total_data_report_bulanan as $total) { ?>
                                        <th><?= $total['total_trip_chandra'] ?></th>
                                        <th><?= $total['total_trip_doni'] ?></th>
                                        <th><?= $total['total_trip_dafrizal'] ?></th>
                                        <th><?= $total['total_trip_herian'] ?></th>
                                        <th><?= $total['total_trip_chandra'] + $total['total_trip_doni'] + $total['total_trip_dafrizal'] + $total['total_trip_herian'] ?></th>
                                        <th>Rp. <?= number_format($total['total_value_chandra'], 2, ".", ",") ?></th>
                                        <th>Rp. <?= number_format($total['total_value_doni'], 2, ".", ",") ?></th>
                                        <th>Rp. <?= number_format($total['total_value_dafrizal'], 2, ".", ",") ?></th>
                                        <th>Rp. <?= number_format($total['total_value_herian'], 2, ".", ",") ?></th>
                                        <th>Rp. <?= number_format($total['total_value_chandra'] + $total['total_value_doni'] + $total['total_value_dafrizal'] + $total['total_value_herian'], 2, ".", ",") ?></th>
                                    <?php } ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //JAVASCRIPT DATATABLE
    $(function() {
        // JAVASCRIPT DATATABLE
        $('.tableView').DataTable({
            'dom': 'Bflrtip',
            "ordering": false,
            "searching": false,
            "info": true,
            "scrollY": 500,
            "scrollX": 500,
            "buttons": [],
            "lengthMenu": [
                [-1],
                ["All"]
            ],
            // fixedColumns: {
            //     left: 1,
            //     right: 1
            // }

        });
    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>