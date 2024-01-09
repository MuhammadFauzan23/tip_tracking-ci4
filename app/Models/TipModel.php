<?php

namespace App\Models;

use CodeIgniter\Model;

class TipModel extends Model
{

    // MODEL TEMPORARY 
    public function getdataTemporary()
    {
        return $this->db->table('tblmas_temporary_tip_tracking')->get()->getResultArray();
    }

    public function getdataTemporaryDetail($driver, $plat)
    {
        $query = "SELECT tblmas_temporary_tip_tracking_detail.* ,GROUP_CONCAT(tbltrn_do1.dono) AS donoo, COUNT(tbltrn_do1.dono) AS jml_do, tblmas_customer.customername AS customer, tbltrn_do1.dono
            FROM tblmas_temporary_tip_tracking_detail
                JOIN tblmas_temporary_do_tip_tracking ON tblmas_temporary_tip_tracking_detail.id = tblmas_temporary_do_tip_tracking.tipID
                    JOIN tbltrn_do1 ON tbltrn_do1.tr_dono = tblmas_temporary_do_tip_tracking.doID
                        JOIN tblmas_customer ON tblmas_customer.idcustomer = tbltrn_do1.idcustomer
                            WHERE tblmas_temporary_tip_tracking_detail.driver = '$driver' AND tblmas_temporary_tip_tracking_detail.lorry = '$plat'
                                GROUP BY tblmas_temporary_tip_tracking_detail.id ASC";
        return $this->db->query($query)->getResultArray();
    }

    public function addTemporary($data)
    {
        $this->db->table('tblmas_temporary_tip_tracking')->insert($data);
        $pesan = [
            'stts' => true,
            'msg' => "Data telah di tambah...!",
        ];
        return $pesan;
    }

    public function addTemporaryDetail($data, $dono)
    {
        // dd($dono);
        $this->db->transStart();
        $this->db->table('tblmas_temporary_tip_tracking_detail')->insert($data);
        // Ambil data ID tip pada tabel tblmas_tip_tracking
        $tip_id = $this->db->insertID();
        $result = array();
        foreach ($dono as $key => $val) {
            $result[] = array(
                'tipID'     => $tip_id,
                'doID'      => $_POST['temporary_Dono'][$key],
                'driver'    => $data['driver'],
                'lorry'     => $data['lorry'],
            );
        }

        //multiple insert ke tabel tblmas_detail_tip_tracking
        $this->db->table('tblmas_temporary_do_tip_tracking')->insertBatch($result);
        $this->db->transComplete();

        $pesan = [
            'stts' => true,
            'msg' => "Data telah di tambah...!",
        ];
        return $pesan;
    }

    public function Edittip($id, $value_tip, $driver, $lorry, $trip, $remarks, $dono) //Edit Data Tip Tracking
    {
        //update data pada tabel tblmas_tip_tracking
        $this->db->transStart();
        $data = [
            'value_tip' => $value_tip,
            'driver' => $driver,
            'lorry' => $lorry,
            'trip' => $trip,
            'remarks' => $remarks
        ];
        $this->db->table('tblmas_temporary_tip_tracking_detail')->where(['id' => $id])->update($data);

        //Delete dropdown multiple sesuai id tip
        $this->db->table('tblmas_temporary_do_tip_tracking')->where(['tipID' => $id])->delete(['tipID' => $id]);

        //update data baru pada tabel tblmas_detail_tip_tracking yang dipilih
        $result = array();
        foreach ($dono as $key => $val) {
            $result[] = array(
                'tipID'   => $id,
                'doID'   => $_POST['Dono_edit'][$key]
            );
        }

        //multiple insert ke tabel tblmas_detail_tip_tracking
        $this->db->table('tblmas_temporary_do_tip_tracking')->insertBatch($result);
        $this->db->transComplete();

        $pesan['stts'] = true;
        $pesan['msg'] = "Perubahan data berhasil...!";
        return $pesan;
    }

    public function transferTemporary($driver, $plat)
    {
        $this->db->query("INSERT INTO tblmas_tip_tracking (id, driver, lorry, time_out, time_in, value_tip, trip, remarks, tgl) 
                SELECT id, driver, lorry, time_out, time_in, value_tip, trip, remarks, tgl
                    FROM tblmas_temporary_tip_tracking_detail
                        WHERE tblmas_temporary_tip_tracking_detail.driver = '$driver' AND tblmas_temporary_tip_tracking_detail.lorry = '$plat'");
        $this->db->query("DELETE FROM tblmas_temporary_tip_tracking_detail WHERE tblmas_temporary_tip_tracking_detail.driver = '$driver' AND tblmas_temporary_tip_tracking_detail.lorry = '$plat'");

        $this->db->query("INSERT INTO tblmas_detail_tip_tracking (tipID ,doID) SELECT tipID ,doID FROM tblmas_temporary_do_tip_tracking
        WHERE tblmas_temporary_do_tip_tracking.driver = '$driver' AND tblmas_temporary_do_tip_tracking.lorry = '$plat'");
        $this->db->query("DELETE FROM tblmas_temporary_do_tip_tracking WHERE tblmas_temporary_do_tip_tracking.driver = '$driver' AND tblmas_temporary_do_tip_tracking.lorry = '$plat'");

        $pesan = [
            'stts' => true,
            'msg' => "Data berhasiil dirilis...!",
        ];
        return $pesan;
    }

    public function getDateTime()
    {
        return $this->db->table('tblmas_tip_tracking')->groupBy('month(time_out)')->groupBy('year(time_out)')->get()->getResultArray();
    }

    public function getdataperDate($bulan, $tahun)
    {
        $query = "SELECT tblmas_tip_tracking.* ,GROUP_CONCAT(tbltrn_do1.dono) AS donoo,COUNT(tbltrn_do1.dono) AS dono, tblmas_customer.customername AS customer 
                    FROM tblmas_tip_tracking
                        JOIN tblmas_detail_tip_tracking ON tblmas_tip_tracking.id = tblmas_detail_tip_tracking.tipID
                            JOIN tbltrn_do1 ON tbltrn_do1.tr_dono = tblmas_detail_tip_tracking.doID
                                JOIN tblmas_customer ON tblmas_customer.idcustomer = tbltrn_do1.idcustomer
                                    WHERE month(tblmas_tip_tracking.tgl) = '$bulan' AND year(tblmas_tip_tracking.tgl) = '$tahun' GROUP BY tblmas_tip_tracking.tgl ASC";
        return $this->db->query($query)->getResultArray();
    }

    public function getdataperDateTime($tgl)
    {
        $query = "SELECT tblmas_tip_tracking.*, GROUP_CONCAT(tbltrn_do1.dono) AS donoo,COUNT(tbltrn_do1.dono) AS dono, tblmas_customer.customername AS customer 
                    FROM tblmas_tip_tracking
                        JOIN tblmas_detail_tip_tracking ON tblmas_tip_tracking.id = tblmas_detail_tip_tracking.tipID
                            JOIN tbltrn_do1 ON tbltrn_do1.tr_dono = tblmas_detail_tip_tracking.doID
                                JOIN tblmas_customer ON tblmas_customer.idcustomer = tbltrn_do1.idcustomer
                                    WHERE tblmas_tip_tracking.tgl='$tgl'
                                        GROUP BY tblmas_tip_tracking.id ASC";
        return $this->db->query($query)->getResultArray();
    }

    public function getreportbyMonth($bulan, $tahun)
    {
        $query = "SELECT tgl,
        COUNT(IF(driver='Chandra sinaga', trip, NULL)) trip_chandra,
        COUNT(IF(driver='Doni', trip, NULL)) trip_doni,
        COUNT(IF(driver='Dafrizal', trip, NULL)) trip_dafrizal,
        COUNT(IF(driver='Herian', trip, NULL)) trip_herian,
        SUM(IF(driver='Chandra sinaga', value_tip, 0)) value_chandra,
        SUM(IF(driver='Doni', value_tip, 0)) value_doni,
        SUM(IF(driver='Dafrizal', value_tip, 0)) value_dafrizal,
        SUM(IF(driver='Herian', value_tip, 0)) value_herian
            FROM tblmas_tip_tracking
                WHERE month(tgl)=$bulan AND year(tgl)=$tahun GROUP BY tgl";
        return $this->db->query($query)->getResultArray();
    }

    public function getreportbyMonthtotal($bulan, $tahun)
    {
        $query = "SELECT tgl,
                    COUNT(IF(driver='Chandra sinaga', trip, NULL)) total_trip_chandra,
                    COUNT(IF(driver='Doni', trip, NULL)) total_trip_doni,
                    COUNT(IF(driver='Dafrizal', trip, NULL)) total_trip_dafrizal,
                    COUNT(IF(driver='Herian', trip, NULL)) total_trip_herian,

                    SUM(IF(driver='Chandra sinaga', value_tip, 0)) total_value_chandra,
                    SUM(IF(driver='Doni', value_tip, 0)) total_value_doni,
                    SUM(IF(driver='Dafrizal', value_tip, 0)) total_value_dafrizal,
                    SUM(IF(driver='Herian', value_tip, 0)) total_value_herian
                        FROM tblmas_tip_tracking
                            WHERE month(tgl)=$bulan AND year(tgl)=$tahun";
        return $this->db->query($query)->getResultArray();
    }

    // public function getreportbyMonth_chandra($bulan, $tahun)
    // {
    //     $query = "SELECT tgl,
    //     COUNT(IF(driver='Chandra sinaga', trip, NULL)) chandra,
    //     SUM(IF(driver='Chandra sinaga', value_tip, 0)) chandra_value
    //         FROM tblmas_tip_tracking
    //             WHERE month(tgl)=$bulan AND year(tgl)=$tahun AND driver='Chandra sinaga' GROUP BY tgl";
    //     return $this->db->query($query)->getResultArray();
    // }
    // public function getreportbyMonth_doni($bulan, $tahun)
    // {
    //     $query = "SELECT tgl,
    //     COUNT(IF(driver='Doni', trip, NULL)) doni,
    //     SUM(IF(driver='Doni', value_tip, 0)) doni_value
    //         FROM tblmas_tip_tracking
    //             WHERE month(tgl)=$bulan AND year(tgl)=$tahun AND driver='Doni' GROUP BY tgl";
    //     return $this->db->query($query)->getResultArray();
    // }
    // public function getreportbyMonth_dafrizal($bulan, $tahun)
    // {
    //     $query = "SELECT tgl,
    //     COUNT(IF(driver='Dafrizal', trip, NULL)) dafrizal,
    //     SUM(IF(driver='Dafrizal', value_tip, 0)) dafrizal_value
    //         FROM tblmas_tip_tracking
    //             WHERE month(tgl)=$bulan AND year(tgl)=$tahun AND driver='Dafrizal' GROUP BY tgl";
    //     return $this->db->query($query)->getResultArray();
    // }
    // public function getreportbyMonth_herian($bulan, $tahun)
    // {
    //     $query = "SELECT tgl,
    //     COUNT(IF(driver='Herian', trip, NULL)) herian,
    //     SUM(IF(driver='Herian', value_tip, 0)) herian_value
    //         FROM tblmas_tip_tracking
    //             WHERE month(tgl)=$bulan AND year(tgl)=$tahun AND driver='Herian' GROUP BY tgl";
    //     return $this->db->query($query)->getResultArray();
    // }


    public function getreportbyRentangMonth($dari, $ke)
    {
        $query = "SELECT tgl,
                    COUNT(IF(driver='Chandra sinaga', trip, NULL)) trip_chandra,
                    COUNT(IF(driver='Doni', trip, NULL)) trip_doni,
                    COUNT(IF(driver='Dafrizal', trip, NULL)) trip_dafrizal,
                    COUNT(IF(driver='Herian', trip, NULL)) trip_herian,

                    SUM(IF(driver='Chandra sinaga', value_tip, 0)) value_chandra,
                    SUM(IF(driver='Doni', value_tip, 0)) value_doni,
                    SUM(IF(driver='Dafrizal', value_tip, 0)) value_dafrizal,
                    SUM(IF(driver='Herian', value_tip, 0)) value_herian
                        FROM tblmas_tip_tracking
			                WHERE tgl BETWEEN '$dari' AND '$ke' GROUP BY tgl";
        return $this->db->query($query)->getResultArray();
    }

    public function getreportbyRentangMonthMonthtotal($dari, $ke)
    {
        $query = "SELECT tgl,
                    COUNT(IF(driver='Chandra sinaga', trip, NULL)) total_trip_chandra,
                    COUNT(IF(driver='Doni', trip, NULL)) total_trip_doni,
                    COUNT(IF(driver='Dafrizal', trip, NULL)) total_trip_dafrizal,
                    COUNT(IF(driver='Herian', trip, NULL)) total_trip_herian,

                    SUM(IF(driver='Chandra sinaga', value_tip, 0)) total_value_chandra,
                    SUM(IF(driver='Doni', value_tip, 0)) total_value_doni,
                    SUM(IF(driver='Dafrizal', value_tip, 0)) total_value_dafrizal,
                    SUM(IF(driver='Herian', value_tip, 0)) total_value_herian
                        FROM tblmas_tip_tracking
			                WHERE tgl BETWEEN '$dari' AND '$ke'";
        return $this->db->query($query)->getResultArray();
    }

    public function getdataView()
    {
        $query = "SELECT tblmas_tip_tracking.*, GROUP_CONCAT(tbltrn_do1.dono) AS donoo, COUNT(tbltrn_do1.dono) AS dono, tblmas_customer.customername AS customer 
                    FROM tblmas_tip_tracking
                        JOIN tblmas_detail_tip_tracking ON tblmas_tip_tracking.id = tblmas_detail_tip_tracking.tipID
                            JOIN tbltrn_do1 ON tbltrn_do1.tr_dono = tblmas_detail_tip_tracking.doID
                                JOIN tblmas_customer ON tblmas_customer.idcustomer = tbltrn_do1.idcustomer
                                    GROUP BY tblmas_tip_tracking.id ASC";
        return $this->db->query($query)->getRowArray();
    }
    // -----------------------------------------------------------------------------------------------------------------

    //MODEL GET DATA FOR DROPDOWN WITH ID AND WITHOUT ID
    function get_do_by_tip($tip_ID)
    {
        $query = "select tbltrn_do1.*, tblmas_temporary_tip_tracking_detail.* FROM tbltrn_do1
                    join tblmas_temporary_do_tip_tracking ON tblmas_temporary_do_tip_tracking.doID = tbltrn_do1.tr_dono
                    join tblmas_temporary_tip_tracking_detail ON tblmas_temporary_tip_tracking_detail.id = tblmas_temporary_do_tip_tracking.tipID
                        WHERE tblmas_temporary_tip_tracking_detail.id = $tip_ID  AND tbltrn_do1.stsdosent = 0;";
        return $this->db->query($query);
    }

    function get_value_tip($tip_ID)
    {
        return $this->db->table('tblmas_temporary_tip_tracking_detail')
            ->select('tblmas_temporary_tip_tracking_detail.*')
            ->join('tblmas_value', 'tblmas_value.value_tip = tblmas_temporary_tip_tracking_detail.value_tip')
            ->where(['tblmas_temporary_tip_tracking_detail.id' => $tip_ID])->get();
    }

    public function Deletetip($data_id)
    {
        $query = "DELETE tblmas_temporary_tip_tracking_detail.*, tblmas_temporary_do_tip_tracking.* FROM tblmas_temporary_tip_tracking_detail JOIN tblmas_temporary_do_tip_tracking ON tblmas_temporary_do_tip_tracking.tipID = tblmas_temporary_tip_tracking_detail.id where tblmas_temporary_tip_tracking_detail.id = $data_id";
        $this->db->query($query);
        $pesan['stts'] = true;
        $pesan['msg'] = "Data berhasil Dihapus...!";
        return $pesan;
    }

    public function deleteTemporaryDetail($driver, $plat)
    {
        $query = "DELETE FROM tblmas_temporary_tip_tracking where driver_name = '$driver' AND plat_lorry = '$plat'";
        $this->db->query($query);
        $pesan['stts'] = true;
        $pesan['msg'] = "Data berhasil Dihapus...!";
        return $pesan;
    }

    public function getdataDriver()
    {
        return $this->db->table('tblmas_driver')->get()->getResultArray();
    }

    public function getdataLorry()
    {
        return $this->db->table('tblmas_lorry')->get()->getResultArray();
    }

    public function getdataValue()
    {
        return $this->db->table('tblmas_value')->get()->getResultArray();
    }

    public function getdataDono()
    {
        $query = "SELECT tblmas_customer.*, tbltrn_do1.* FROM tblmas_customer
                    JOIN tbltrn_do1 ON tbltrn_do1.idcustomer = tblmas_customer.idcustomer
                        WHERE tbltrn_do1.stsdosent = 0";
        return $this->db->query($query)->getResultArray();
    }
    // -----------------------------------------------------------------------------------------------------------------
}
