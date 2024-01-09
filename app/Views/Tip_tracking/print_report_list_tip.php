<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid black;
            padding: 5px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: black;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            background-color: white;
            color: white;
            color: black;
            font-size: 12px;
        }

        .box1 {
            width: 70px;
            height: 70px;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
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
        <h1 class="card-title">PT. Etowa Packaging Indonesia</h1>
        <div style="text-align:left">Monthly Trip Allowance | Store Department</div>
        <div style="text-align:left"><b><?= $convert_bulan ?> <?= $tahun ?></b></div>
    </div>
    <table id="table" border="2" style="font-size: 14px;" class="table2">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th style="min-width: 20px;" rowspan="2">Date</th>
                <th colspan="4">allowance</th>
                <th rowspan="2">Total allowance</th>
                <th colspan="4">Trip</th>
                <th rowspan="2">Total Tip</th>
            </tr>
            <tr>
                <?php foreach ($data_driver as $driver) { ?>
                    <th><?= $driver['name_driver'] ?></th>
                <?php } ?>
                <?php foreach ($data_driver as $driver) { ?>
                    <th><?= $driver['name_driver'] ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
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
    <br>
    <div style="float:right;">
        <table id="table" border="2" style="font-size: 14px;">
            <thead>
                <tr>
                    <th>Prepared by</th>
                    <th>Checked by</th>
                    <th>Verified by</th>
                    <th>Approved by</th>
                </tr>
            </thead>
            <tbody>
                <tr align="center">
                    <td>
                        <div class="box1"></div>
                    </td>
                    <td>
                        <div class="box1"></div>
                    </td>
                    <td>
                        <div class="box1"></div>
                    </td>
                    <td>
                        <div class="box1"></div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr align="center">
                    <th> <?= session()->get('fullname') ?> </th>
                    <th> Juliaman S </th>
                    <th></th>
                    <th> KH Lee </th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>