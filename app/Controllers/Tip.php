<?php

namespace App\Controllers;

use App\Models\TipModel;
use CodeIgniter\HTTP\Request;
use \Dompdf\Dompdf;

class Tip extends BaseController
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone
        $this->tip  = new TipModel();
    }

    // +------------------------------------------------------------------------+
    // +------------------------------------------------------------------------+
    // |  Dibawah ini adalah kumpulan controller untuk mengatur data" Temporary |
    // +------------------------------------------------------------------------+
    // +------------------------------------------------------------------------+

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('layout/dashboard', $data);
    }

    public function viewTemporary()
    {
        $data = [
            'title' => 'Dashboard',
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_temporary' => $this->tip->getdataTemporary()
        ];
        return view('Tip_tracking/list_tip_temporary', $data);
    }
    // +------------------------------------------------------------------------+
    public function viewTemporaryDetail()
    {
        $driver = $this->request->getVar('driver');
        $plat = $this->request->getVar('plat');
        $data  = [
            'title' => 'Dashboard',
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_temporary_detail' => $this->tip->getdataTemporaryDetail($driver, $plat)
        ];
        return view('Tip_tracking/list_tip_temporary_detail', $data);
    }
    // +------------------------------------------------------------------------+
    public function addTemporary()
    {
        $data = [
            'driver_name' => $this->request->getPost('driver_tambah'),
            'plat_lorry' => $this->request->getPost('lorry_tambah')
        ];
        $pesan = $this->tip->addTemporary($data);
        session()->setFlashdata('message', $pesan);
        return redirect()->to('Tip/viewTemporary');
    }
    // +------------------------------------------------------------------------+
    public function addTemporaryDetail()
    {
        $dono = $this->request->getPost('temporary_Dono');
        $driver = $this->request->getPost('temporary_driver');
        $plat = $this->request->getVar('temporary_plat');

        $data = [
            'driver' => $this->request->getPost('temporary_driver'),
            'lorry' => $this->request->getPost('temporary_plat'),
            'time_out' => date("Y-m-d H:i", strtotime($this->request->getPost('temporary_start_time'))) ? date("Y-m-d H:i", strtotime($this->request->getPost('temporary_start_time'))) : '',
            'time_in' => date("Y-m-d H:i", strtotime($this->request->getPost('temporary_end_time'))) ? date("Y-m-d H:i", strtotime($this->request->getPost('temporary_end_time'))) : '',
            'value_tip' => $this->request->getPost('temporary_value'),
            'trip' => $this->request->getPost('temporary_trip'),
            'remarks' => $this->request->getPost('temporary_remarks'),
            'tgl' => date("Y-m-d", strtotime($this->request->getPost('temporary_start_time'))),
        ];
        // dd($data);
        $pesan = $this->tip->addTemporaryDetail($data, $dono);
        session()->setFlashdata('message', $pesan);
        return redirect()->to('Tip/viewTemporaryDetail?driver=' . $driver . '&plat=' . $plat);
    }
    // +------------------------------------------------------------------------+
    public function transferTemporary()
    {
        $driver = $this->request->getVar('driver');
        $plat = $this->request->getVar('plat');
        $id = $this->request->getVar('id');
        // $time_out = $this->request->getVar('time_out');
        // $time_in = $this->request->getVar('time_in');
        // $value_tip = $this->request->getVar('value');
        // $trip = $this->request->getVar('trip');
        // $remarks = $this->request->getVar('remarks');

        $pesan = $this->tip->transferTemporary($driver, $plat, $id);
        session()->setFlashdata('message', $pesan);
        return redirect()->to('Tip/viewTemporary');
    }
    // +------------------------------------------------------------------------+
    public function deleteListTip()
    {
        $data_id = $this->request->getVar('id');
        $driver = $this->request->getVar('driver');
        $plat = $this->request->getVar('plat');
        $pesan = $this->tip->Deletetip($data_id);
        session()->setFlashdata('message', $pesan);
        return redirect()->to('Tip/viewTemporaryDetail?driver=' . $driver . '&plat=' . $plat);
    }

    public function deleteTemporaryDetail()
    {
        $driver = $this->request->getVar('driver');
        $plat = $this->request->getVar('plat');
        $pesan = $this->tip->deleteTemporaryDetail($driver, $plat);
        session()->setFlashdata('message', $pesan);
        return redirect()->to('Tip/viewTemporary');
    }
    // +--------------------------------------------------------------------------+

    // +--------------------------------------------------------------------------+
    // +--------------------------------------------------------------------------+
    // |  Dibawah ini adalah kumpulan controller untuk mengatur data" Master Tip  |
    // +--------------------------------------------------------------------------+
    // +--------------------------------------------------------------------------+
    public function viewListTip()
    {
        $data = [
            'title' => 'Dashboard',
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'bulan_tahun_tip' => $this->tip->getDateTime()
        ];
        return view('Tip_tracking/list_tip', $data);
    }
    // +--------------------------------------------------------------------------+
    public function viewListTipbydate() // Read data tip
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $data = [
            'title' => 'List by date time',
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_per_bulan_tahun' => $this->tip->getdataperDate($bulan, $tahun)
        ];
        return view('Tip_tracking/list_tip_by_date', $data);
    }
    // +--------------------------------------------------------------------------+
    public function viewListTipbydatetime() // Read data tip
    {
        $tgl = $this->request->getVar('date');
        $data = [
            'title' => 'List by date time',
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_per_hari_bulan_tahun' => $this->tip->getdataperDateTime($tgl)
        ];
        return view('Tip_tracking/list_tip_by_date_time', $data);
    }
    // +--------------------------------------------------------------------------+
    public function reportperBulan() // Read data tip
    {
        $bulan = $this->request->getVar('bulan');
        $convert_bulan = number_format($this->request->getVar('bulan'));
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
        $tahun = $this->request->getVar('tahun');
        $data = [
            'title' => 'Report Tip ' . $convert_bulan . ' ' . $tahun,
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_report_bulanan' => $this->tip->getreportbyMonth($bulan, $tahun),
            'total_data_report_bulanan' => $this->tip->getreportbyMonthtotal($bulan, $tahun),
            // 'data_report_bulanan_chandra' => $this->tip->getreportbyMonth_chandra($bulan, $tahun),
            // 'data_report_bulanan_doni' => $this->tip->getreportbyMonth_doni($bulan, $tahun),
            // 'data_report_bulanan_dafrizal' => $this->tip->getreportbyMonth_dafrizal($bulan, $tahun),
            // 'data_report_bulanan_herian' => $this->tip->getreportbyMonth_herian($bulan, $tahun),
        ];
        return view('Tip_tracking/report_list_tip', $data);
    }
    // +--------------------------------------------------------------------------+
    public function printreportperbulan()
    {
        $dompdf = new Dompdf();
        $bulan = $this->request->getVar('bulan');
        $convert_bulan = number_format($this->request->getVar('bulan'));
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
        $tahun = $this->request->getVar('tahun');
        $data = [
            'title' => 'Report Tip ' . $convert_bulan . ' ' . $tahun,
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_report_bulanan' => $this->tip->getreportbyMonth($bulan, $tahun),
            'total_data_report_bulanan' => $this->tip->getreportbyMonthtotal($bulan, $tahun),
        ];
        $hasil_report = view('Tip_tracking/print_report_list_tip', $data);

        $dompdf->loadHtml($hasil_report);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Report Tip  ' . $convert_bulan . ' ' . $tahun . '.pdf');
    }
    // +--------------------------------------------------------------------------+
    public function reportrentangBulan()
    {
        $dari = date("Y-m-d", strtotime($this->request->getVar('dari_tanggal')));
        $ke = date("Y-m-d", strtotime("+1 month", strtotime($this->request->getVar('ke_tanggal'))));
        $convert_dari = date("d F Y", strtotime($dari));
        $convert_ke = date("d F Y", strtotime($ke));
        // dd($ke);
        $data = [
            'title' => 'Report Tip ' . $convert_dari . ' - ' . $convert_ke,
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_report_bulanan' => $this->tip->getreportbyRentangMonth($dari, $ke),
            'total_data_report_bulanan' => $this->tip->getreportbyRentangMonthMonthtotal($dari, $ke),
        ];
        return view('Tip_tracking/report_rentang_list_tip', $data);
    }

    // public function reportrentangBulan()
    // {
    //     $dari = date("Y-m-d", strtotime($this->request->getVar('dari_tanggal')));
    //     $ke = date("Y-m-d", strtotime($this->request->getVar('ke_tanggal')));
    //     $convert_dari = date("d F Y", strtotime($dari));
    //     $convert_ke = date("d F Y", strtotime($ke));
    //     $data = [
    //         'title' => 'Report Tip ' . $convert_dari . ' - ' . $convert_ke,
    //         'data_driver' => $this->tip->getdataDriver(),
    //         'data_lorry' => $this->tip->getdataLorry(),
    //         'data_value' => $this->tip->getdataValue(),
    //         'data_dono' => $this->tip->getdataDono(),
    //         'data_report_bulanan' => $this->tip->getreportbyRentangMonth($dari, $ke),
    //         'total_data_report_bulanan' => $this->tip->getreportbyRentangMonthMonthtotal($dari, $ke),
    //     ];
    //     return view('Tip_tracking/report_rentang_list_tip', $data);
    // }
    // // +--------------------------------------------------------------------------+
    public function printreportrentangbulan()
    {
        $dompdf = new Dompdf();

        $dari = date("Y-m-d", strtotime($this->request->getVar('dari_tanggal')));
        $ke = date("Y-m-d", strtotime($this->request->getVar('ke_tanggal')));
        $convert_dari = date("d F Y", strtotime($dari));
        $convert_ke = date("d F Y", strtotime($ke));
        $data = [
            'title' => 'Report Tip ' . $convert_dari . ' - ' . $convert_ke,
            'data_driver' => $this->tip->getdataDriver(),
            'data_lorry' => $this->tip->getdataLorry(),
            'data_value' => $this->tip->getdataValue(),
            'data_dono' => $this->tip->getdataDono(),
            'data_report_bulanan' => $this->tip->getreportbyRentangMonth($dari, $ke),
            'total_data_report_bulanan' => $this->tip->getreportbyRentangMonthMonthtotal($dari, $ke),
        ];
        $hasil_report = view('Tip_tracking/print_report_rentang_list_tip', $data);

        $dompdf->loadHtml($hasil_report);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Report Tip  ' . $convert_dari . ' - ' . $convert_ke . '.pdf');
    }
    // +--------------------------------------------------------------------------+
    public function addListTip()
    {
        $start_time = $this->request->getPost('start_time_tambah');
        $end_time = $this->request->getPost('end_time_tambah');
        $value_tip = $this->request->getPost('value_tambah');
        $driver = $this->request->getPost('driver_tambah');
        $lorry = $this->request->getPost('lorry_tambah');
        $trip = $this->request->getPost('trip_tambah');
        $remarks = $this->request->getPost('remarks_tambah');
        $dono = $this->request->getPost('Dono_tambah'); //data multi select

        $pesan = $this->tip->Addtip($start_time, $end_time, $value_tip, $driver, $lorry, $trip, $remarks, $dono);
        session()->setFlashdata('pesan', $pesan);
        return redirect()->to('Tip/viewListTip');
    }
    // +--------------------------------------------------------------------------+
    public function editListTip()
    {
        $id = $this->request->getPost('id_edit');
        $value_tip = $this->request->getPost('value_edit');
        $driver = $this->request->getPost('driver_edit');
        $plat = $this->request->getPost('lorry_edit');
        $trip = $this->request->getPost('trip_edit');
        $remarks = $this->request->getPost('remarks_edit');
        $dono = $this->request->getPost('Dono_edit');
        // dd($dono);

        $pesan = $this->tip->Edittip($id, $value_tip, $driver, $plat, $trip, $remarks, $dono);
        session()->setFlashdata('pesan', $pesan);
        return redirect()->to('Tip/viewTemporaryDetail?driver=' . $driver . '&plat=' . $plat);
    }
    // +--------------------------------------------------------------------------+

    // SELECTED DROPDOWN SESUAI ID
    function get_do_by_tip() // ajax untuk selected DO value sesuai ID yang dipilih
    {
        $tip_ID = $this->request->getPost('id');
        // dd($tip_ID);
        $data = $this->tip->get_do_by_tip($tip_ID)->getResult();
        foreach ($data as $result) {
            $value[] = (string) $result->tr_dono;
        }
        echo json_encode($value);
    }

    function get_value_tip() // ajax untuk selected value sesuai ID yang dipilih
    {
        $tip_ID = $this->request->getPost('id');
        // dd($tip_ID);
        $data = $this->tip->get_value_tip($tip_ID)->getResult();
        foreach ($data as $result) {
            $value[] = (int) $result->value_tip;
        }
        echo json_encode($value);
    }
}
