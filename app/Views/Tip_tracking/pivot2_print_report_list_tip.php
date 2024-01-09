<?= $this->extend('layout/template') ?>
<?= $this->extend('layout/sidebar') ?>
<?= $this->section('content') ?>
<style>
    table.table {
        width: 40px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="card ">
            <div class="row" style="font-size: small;">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="row mt-2">
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
                                    <th>Driver</th>
                                    <?php while ($tgl <= $jumtgl) {
                                        $tanggal = sprintf("%02d", $tgl)
                                    ?>
                                        <?php $date = $tanggal . ' ' . $convert_bulan . ' ' . $tahun ?>
                                        <th> <?= $date ?></th>
                                    <?php
                                        $tgl++;
                                    }
                                    ?>
                                    <th style="background-color: aquamarine;">Total Allowance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <th>Chandra Sinaga</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_chandra as $chandra) { ?>
                                            <?php if ($chandra['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php
                                                $trip = $chandra['chandra'];
                                                ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color: aquamarine;"><b><?= $total['total_trip_chandra'] ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th>Doni</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_doni as $doni) { ?>
                                            <?php if ($doni['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $doni['doni']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color: aquamarine;"><b><?= $total['total_trip_doni'] ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th>Dafrizal</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_dafrizal as $dafrizal) { ?>
                                            <?php if ($dafrizal['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $dafrizal['dafrizal']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b><?= $total['total_trip_dafrizal'] ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th>Herian</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_herian as $herian) { ?>
                                            <?php if ($herian['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $herian['herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td><?= $tampilkan_harian ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b><?= $total['total_trip_herian'] ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th style="background-color:aqua;">Total</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan as $tp) { ?>
                                            <?php if ($tp['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $tp['trip_chandra'] + $tp['trip_doni'] + $tp['trip_dafrizal'] + $tp['trip_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td style="background-color:aqua;"><b><?= $tampilkan_harian ?></b></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b><?= $total['total_trip_chandra'] + $total['total_trip_doni'] + $total['total_trip_dafrizal'] + $total['total_trip_herian'] ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" style="font-size: small;">
                <div class="col-md-12">
                    <div class="row mt-2">
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
                        </div>
                        <div class="col text-right">
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table style="width:100%" class="table table-bordered tableView">
                            <thead>
                                <tr align="center">
                                    <th>Driver</th>
                                    <?php while ($tgl <= $jumtgl) {
                                        $tanggal = sprintf("%02d", $tgl)
                                    ?>
                                        <?php $date = $tanggal . ' ' . $convert_bulan . ' ' . $tahun ?>
                                        <th> <?= $date ?></th>
                                    <?php
                                        $tgl++;
                                    }
                                    ?>
                                    <th style="background-color:aquamarine;">Total Tip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <th>Chandra Sinaga</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_chandra as $chandra) { ?>
                                            <?php if ($chandra['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php
                                                $trip = $chandra['chandra_value'];
                                                ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_harian, 2, ".", ",") ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b>Rp <?= number_format($total['total_value_chandra'], 2, ".", ",") ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th>Doni</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        $total = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_doni as $doni) { ?>
                                            <?php if ($doni['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $doni['doni_value']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_harian, 2, ".", ",") ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b>Rp. <?= number_format($total['total_value_doni'], 2, ".", ",") ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th>Dafrizal</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_dafrizal as $dafrizal) { ?>
                                            <?php if ($dafrizal['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $dafrizal['dafrizal_value']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_harian, 2, ".", ",") ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b>Rp <?= number_format($total['total_value_dafrizal'], 2, ".", ",") ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th>Herian</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan_herian as $herian) { ?>
                                            <?php if ($herian['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $herian['herian_value']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td> Rp <?= number_format($tampilkan_harian, 2, ".", ",") ?></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b>Rp <?= number_format($total['total_value_herian'], 2, ".", ",") ?></b></td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <tr align="center">
                                    <th style="background-color:aqua;">Total</th>
                                    <?php for ($tgl = 1; $tgl <= $jumtgl; $tgl++) { ?>
                                        <?php
                                        $tanggal = sprintf("%02d", $tgl);
                                        $trip = 0;
                                        ?>
                                        <?php foreach ($data_report_bulanan as $tp) { ?>
                                            <?php if ($tp['tgl'] == $tahun . '-' . $bulan . '-' .  $tanggal) { ?>
                                                <?php $trip = $tp['value_chandra'] + $tp['value_doni'] + $tp['value_dafrizal'] + $tp['value_herian']; ?>
                                            <?php } ?>
                                            <?php $tampilkan_harian = $trip == null ? "0" : $trip; ?>
                                        <?php } ?>
                                        <td style="background-color:aqua;"><b>Rp <?= number_format($tampilkan_harian, 2, ".", ",") ?></b></td>
                                    <?php } ?>
                                    <?php foreach ($total_data_report_bulanan as $total) {  ?>
                                        <td style="background-color:aquamarine;"><b>Rp <?= number_format($total['total_value_chandra'] + $total['total_value_doni'] + $total['total_value_dafrizal'] + $total['total_value_herian'], 2, ".", ",") ?></b>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                                <!-- -------------------------------------------------------------------------------------- -->
                            </tbody>
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
            // "scrollY": 500,
            "scrollX": 500,
            "buttons": [],
            "lengthMenu": [
                [10, 20, 30, 40, 50, -1],
                ["10", "20", "30", "40", "All"]
            ],
            // fixedColumns: {
            //     left: 1,
            //     right: 0
            // }

        });
    });
    //----------------------------------------------------------------------------------------------------------
</script>
<?= $this->endSection() ?>