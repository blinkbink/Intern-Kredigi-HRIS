<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:42
 */

class kehadiran_model extends CI_Model
{
    public function getKehadiran($kode_absensi, $dari, $sampai)
    {
            $this->db->select('*');
            $this->db->from('absensi a');
            $this->db->join('karyawan b', 'a.kode_absensi = b.kode_absensi', 'left');
            $this->db->join('absensi_status_kehadiran c', 'a.status_kehadiran = c.id_status_kehadiran', 'left');
            $this->db->where('a.kode_absensi', $kode_absensi);
            $this->db->where('date >=', $dari);
            $this->db->where('date <=', $sampai);
            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
    }

    public function getGroupKehadiran($kode_absensi, $dari, $sampai)
    {
            $this->db->select('COUNT(status_kehadiran) as hitung_status, nama_status, COUNT(status_kehadiran) as persentase');
            $this->db->from('absensi a');
            $this->db->join('karyawan b', 'a.kode_absensi = b.kode_absensi', 'left');
            $this->db->join('absensi_status_kehadiran c', 'a.status_kehadiran = c.id_status_kehadiran', 'left');
            $this->db->where('a.kode_absensi', $kode_absensi);
            $this->db->where('date >=', $dari);
            $this->db->where('date <=', $sampai);
            $this->db->group_by('a.status_kehadiran');

            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
    }

    public function getCountKehadiran($kode_absensi, $dari, $sampai)
    {
            $this->db->select('COUNT(status_kehadiran) as total_kehadiran');
            $this->db->from('absensi a');
            $this->db->join('karyawan b', 'a.kode_absensi = b.kode_absensi', 'left');
            $this->db->where('date >=', $dari);
            $this->db->where('date <=', $sampai);
            $this->db->where('a.kode_absensi', $kode_absensi);

            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
    }
    
    public function getListStatusKehadiran()
    {
        //$this->db->from('absensi_status_kehadiran');
        //$this->db->where('id_status_kehadiran', $status);
        $query = $this->db->get('absensi_status_kehadiran');
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        } 
        else
        {
            return false;
        }
    }
    
    function getDataAbsensiRekap($kode_absensi, $tanggalAwal, $tanggalAkhir, $idKaryawan = NULL) {
        //inisialisasi
        $sabtu = 0;
        $tlemburSabtu = 0;
        $adaTglMerah = 0;
        $tmangkir = 0;
        $ttelat = 0;
        $tkerja = 0;
        $tlembur = 0;
        $tabstain = 0;
        $tizin = 0;
        $tsakit = 0;
        $tcuti = 0;
        $tharikerja = 0;
        $tharisabtu = 0;
        $tharimerah = 0;
        $ttugas = 0;

        //perusahaan ID
        $perusahaanID = $this->session->userdata('perusahaan_ID');

        //total hari
        $date1 = date_create($tanggalAwal);
        $date2 = date_create($tanggalAkhir);
        $jumlahHari = date_diff($date1, $date2)->format("%a")+1; //ditambahkan +1 agar lebih akurat menghitung hari

        //cari tahu hari apakah ini, apakah sabtu, minggu, libur?
        $start  = new DateTime($tanggalAwal);
        $end    = new DateTime($tanggalAkhir);
        $i      = 0;
        
        //Membaca hari satu per satu dari tanggal $start ke tanggal $end
        for($dt = $start; $dt <= $end; $dt->modify('+1 day')){
            //tgl merah
            $this->db->select("tanggalLibur");
            $this->db->from("tanggal_libur");
            $this->db->where("tanggalLibur = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $adaTglMerah = $query->num_rows();

            //mangkir
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'3');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $mangkir = $query->num_rows();

            //izin
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'7');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $izin = $query->num_rows();

            //sakit
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'8');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $sakit = $query->num_rows();
            
            //cuti
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'9');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $cuti = $query->num_rows();
            
            //tugas luar
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'5');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $tugas = $query->num_rows();

            //telat
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("late != 'null'");
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $telat = $query->num_rows();

            //menghitung waktu lembur berdasarkan jumlah total jam kerja dalam satu hari
            $query = $this->db->query("SELECT HOUR(TIMEDIFF(clock_out, clock_in)) AS jam_kerja, clock_in, clock_out FROM absensi WHERE kode_absensi = ".$kode_absensi." AND date = '".$dt->format('Y-m-d')."'");
            $result = $query->row_array();
            $jumlahJamKerja = $result['jam_kerja'];

            //menghitung lembur dengan metode jumlah jam kerja
            if ($dt->format("N") == 6){ // Lembur hari Sabtu
                if ($jumlahJamKerja >= 6){
                    $tlemburSabtu = $tlemburSabtu + 1;
                }
            } else { //Lembur hari kerja
                if ($jumlahJamKerja >= 11){
                    $tlembur = $tlembur + 1;
                }
            }

            //query masuk kerja
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("(absent is null OR absent = '')");
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $kerja = $query->num_rows();
            
            //Menghitung hari kerja, kerja di hari sabtu, mangkir, tanggal merah/minggu
            if(($dt->format("N") == 1 || $dt->format("N") == 2 || $dt->format("N") == 3 || $dt->format("N") == 4 || $dt->format("N") == 5) && $adaTglMerah == 0){//hari kerja dan bukan tgl merah
                $tharikerja = $tharikerja + 1;
                $tkerja = $tkerja + $kerja;
                $tmangkir = $tmangkir + $mangkir;
            }
            else if ($dt->format("N") == 6 && $adaTglMerah == 0) { //hari sabtu dan sabtunya ga tgl merah
                //khusus yang ga kerja di hari sabtu, alias libur, mangkir dikosongkan untuk hari sabtu ini
                if($perusahaanID == 1){ //kredigi
                    if($mangkir > 0){
                        $tmangkir = $tmangkir + $mangkir - 1;
                    }
                    $tharimerah = $tharimerah + 1;
                } else { //bukan kredigi
                    $tmangkir = $tmangkir + $mangkir;
                    $sabtu = $kerja + $sabtu;
                    $tharisabtu = $tharisabtu + 1;
                }
            } 
            else if ($dt->format("N") == 7) { //hari minggu karena ga ada di absensi tambahin ke hari libur
                $tharimerah = $tharimerah + 1;
            }
            else if ($adaTglMerah > 0) { //tgl merah
                if($mangkir > 0){
                    $tmangkir = $tmangkir + $mangkir - 1;
                }
                $tharimerah = $tharimerah + 1;
            }
            $ttelat = $ttelat + $telat;
            $tizin = $tizin + $izin;
            $tcuti = $tcuti + $cuti;
            $tsakit = $tsakit + $sakit;
            $ttugas = $ttugas + $tugas;
            $i++;
        } //closed for menghitung hari satu per satu

        //total ga masuk kerja (bolos, izin, sakit, dan cuti)
        $tabstain = $tmangkir + $tizin + $tsakit + $tcuti;

        $absensiRekap[] = array(
            //'total' => $total,
            'totalHari' => $jumlahHari,
            'totalMangkir' => $tmangkir,
            'totalTelat' => $ttelat,
            'totalAbsensi' => $tkerja,
            'totalLembur' => $tlembur,
            'kerjaSabtu' => $sabtu,
            'lemburSabtu' => $tlemburSabtu,
            'totalHariKerja' => $tharikerja,
            'totalHariSabtu' => $tharisabtu,
            'totalSakit' => $tsakit,
            'totalIzin' => $tizin,
            'totalCuti' => $tcuti,
            'totalTugas' => $ttugas,
            'totalKetidakhadiran' => $tabstain,
            'totalTglMerah' => $tharimerah,
            'iterasi'=>$i,
        );
        return $absensiRekap;
   }


}