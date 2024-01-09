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
                                $bulan = $_GET['bulan'];
                                $convert_bulan = $_GET['bulan'];
                                if ($convert_bulan == 1) {
                                    $convert_bulan = "Januari";
                                } elseif ($convert_bulan == 2) {
                                    $convert_bulan = "Februari";
                                } elseif ($convert_bulan == 3) {
                                    $convert_bulan = "Maret";
                                } elseif ($convert_bulan == 4) {
                                    $convert_bulan = "April";
                                } elseif ($convert_bulan == 5) {
                                    $convert_bulan = "Mei";
                                } elseif ($convert_bulan == 6) {
                                    $convert_bulan = "Juni";
                                } elseif ($convert_bulan == 7) {
                                    $convert_bulan = "Juli";
                                } elseif ($convert_bulan == 8) {
                                    $convert_bulan = "Agustus";
                                } elseif ($convert_bulan == 9) {
                                    $convert_bulan = "September";
                                } elseif ($convert_bulan == 10) {
                                    $convert_bulan = "Oktober";
                                } elseif ($convert_bulan == 11) {
                                    $convert_bulan = "November";
                                } elseif ($convert_bulan == 12) {
                                    $convert_bulan = "Desember";
                                }

                                $convert_bulan_1 = $_GET['bulan'];
                                if ($convert_bulan_1 == 1) {
                                    $convert_bulan_1 = "Jan";
                                } elseif ($convert_bulan_1 == 2) {
                                    $convert_bulan_1 = "Feb";
                                } elseif ($convert_bulan_1 == 3) {
                                    $convert_bulan_1 = "Mar";
                                } elseif ($convert_bulan_1 == 4) {
                                    $convert_bulan_1 = "Apr";
                                } elseif ($convert_bulan_1 == 5) {
                                    $convert_bulan_1 = "Mei";
                                } elseif ($convert_bulan_1 == 6) {
                                    $convert_bulan_1 = "Jun";
                                } elseif ($convert_bulan_1 == 7) {
                                    $convert_bulan_1 = "Jul";
                                } elseif ($convert_bulan_1 == 8) {
                                    $convert_bulan_1 = "Ags";
                                } elseif ($convert_bulan_1 == 9) {
                                    $convert_bulan_1 = "Sept";
                                } elseif ($convert_bulan_1 == 10) {
                                    $convert_bulan_1 = "Okt";
                                } elseif ($convert_bulan_1 == 11) {
                                    $convert_bulan_1 = "Nov";
                                } elseif ($convert_bulan_1 == 12) {
                                    $convert_bulan_1 = "Des";
                                }
                                $tahun = $_GET['tahun'];
                                $tgl = 1;
                                $no = 1;
                                $jumtgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // dapat jumlah tanggal
                                ?>
                                <h3 class="card-title"> Monthly Trip Delivery Allowance <b><?= $convert_bulan ?> <?= $tahun ?></b></h3>
                            </div>
                            <div class="col text-right">
                                <a type="button" name="Print PDF" href="<?= base_url('tip/printreportperbulan?bulan=' . $bulan . '&tahun=' . $tahun) ?>" class="btn btn-primary mb-1"><i class="nav-icon fas fa-print"></i> Cetak laporan</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                    <tr align="center">
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <td><?= $tgl; ?></td>
                                        <td><?= $tanggal . ' ' . $convert_bulan_1 . ' ' . $tahun ?></td>
                                        <?php foreach ($data_report_bulanan as $chandra) { ?>
                                            <?php if ($chandra['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $chandra['trip_chandra']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_chandra = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_chandra ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $doni) { ?>
                                            <?php if ($doni['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $doni['trip_doni']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_doni = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_doni ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $dafrizal) { ?>
                                            <?php if ($dafrizal['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $dafrizal['trip_dafrizal']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_dafrizal = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_dafrizal ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $herian) { ?>
                                            <?php if ($herian['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $herian['trip_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian_herian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian_herian ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $tp) { ?>
                                            <?php if ($tp['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $tp['trip_chandra'] + $tp['trip_doni'] + $tp['trip_dafrizal'] + $tp['trip_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian ?></td>
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <!-- -------------------------------------------------------------------------------------- -->
                                        <?php foreach ($data_report_bulanan as $chandra) { ?>
                                            <?php if ($chandra['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
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
                                            <?php if ($doni['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
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
                                            <?php if ($dafrizal['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
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
                                            <?php if ($herian['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
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
                                            <?php if ($tp['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
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
            "searching": true,
            "info": false,
            "scrollY": 500,
            "scrollX": 500,
            "buttons": [],
            "lengthMenu": [
                [-1],
                ["All"]
            ],
            fixedColumns: {
                left: 1,
                right: 1
            }

        });
    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>