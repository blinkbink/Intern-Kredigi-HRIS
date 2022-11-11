<?php
/* REFERENSI, ada di tabel absensi_status_kehadiran
 * Status Kehadiran:
 * 1: Belum Ada Status
 * 2: Hadir Hari Kerja
 * 3: Mangkir
 * 4: Bukan Hari Kerja
 * 5: Tugas Luar
 * 6: Hadir Bukan Hari Kerja
 * 7: Izin
 * 8: Sakit
 * 9: Cuti
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends MY_Model {
	
	protected $_table_name = 'absensi';
	protected $_primary_key = 'id_absensi';
	protected $_order_by = 'id_absensi';
	protected $_order_by_type = 'DESC';

	function __construct() {
		parent::__construct();
	}

    function edit_data($where, $data, $table){		
        $this->db->where($where);
        $this->db->update($table, $data);
    }

	function getDataAbsensiHarian($tanggal, $hari_ini) {
		$perusahaanID = $this->session->userdata('perusahaan_ID');

		$absensiHarian=array();
		
		//$total = $this->db->count_all_results('karyawan');
		$this->db->from("karyawan");
        $this->db->where("perusahaan_ID = ".$perusahaanID);
		$query = $this->db->get();
		$total = $query->num_rows();

		//mangkir
        /*
		$this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.absent LIKE 'True'");
		$this->db->where("a.date LIKE '".$tanggal."'");
        //*/
        $this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.status_kehadiran",'3');
		$this->db->where("a.date LIKE '".$tanggal."'");
		$query = $this->db->get();
		$mangkir = $query->num_rows();
		$persenMangkir = ($mangkir/$total) * 100;

		//sakit
        /*
		$this->db->select("s.id_sakit");
        $this->db->from("sakit s, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.karyawan_ID = s.karyawan_ID");
        $this->db->where("s.tanggal_sakit LIKE '".$tanggal."'");
        //*/
        $this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.status_kehadiran",'8');
		$this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $sakit = $query->num_rows();
        $persenSakit = ($sakit/$total) * 100;

		//izin
        /*
        $this->db->select("i.id_izin");
        $this->db->from("izin i, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.karyawan_ID = i.karyawan_ID");
        $this->db->where("i.tanggal_izin LIKE '".$tanggal."'");
		$this->db->where("i.status LIKE 'Di Setujui'");
        //*/
        $this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.status_kehadiran",'7');
		$this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $izin = $query->num_rows();
        $persenIzin = ($izin/$total) * 100;
	
		//cuti
        /*
        $this->db->select("c.id_cuti");
        $this->db->from("cuti c, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.karyawan_ID = c.karyawan_ID");
        $this->db->where("c.tanggal_cuti LIKE '".$tanggal."'");
        //*/
        $this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.status_kehadiran",'9');
		$this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $cuti = $query->num_rows();
        $persenCuti = ($cuti/$total) * 100;
        
        //tugas luar
        $this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.status_kehadiran",'5');
		$this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $tugas = $query->num_rows();
        $persenTugas = ($tugas/$total) * 100;

		//telat
        $this->db->select("a.late");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
        $this->db->where("a.late != 'null'");
        $this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $telat = $query->num_rows();		
        $persenTelat = ($telat/$total) * 100;

		//$this->db->query("SELECT absent FROM absensi WHERE absent LIKE 'True' AND date LIKE '".$tanggal."'");
		//$hadirkerja = $this->db->count_all_results('absensi');
		//cari tahu hari apa
        //$formTgl = DateTime::createFromFormat('d/m/Y',$tanggal);
		$formTgl = DateTime::createFromFormat('Y-m-d',$tanggal);
        $hariApa = $formTgl->format('D');

        //Cari tahu weekend dan weekday
        if(strcmp($hariApa, 'Sun') == 0 ){
			$hariKerja = 0;
		/*        
		} else if(strcmp($hariApa, 'Sat') == 0) {
        	$hariKerja = 2;
		//*/
        } else {
            $hariKerja = 1;
        }
	
		//tgl merah
        $this->db->select("tanggalLibur");
		$this->db->from("tanggal_libur");
        $this->db->where("tanggalLibur = '".$hari_ini."'");
        $query = $this->db->get();
        $adaTglMerah = $query->num_rows();

        $bukanHariKerja = 0;
		$persenBukanHariKerja = 0;

		if($adaTglMerah == 1){
            $hariKerja = 0;
			$bukanHariKerja = $mangkir;
			$persenBukanHariKerja = ($bukanHariKerja/$total) * 100;
            $mangkir = 0;
			$persenMangkir = 0;
        }

        //query masuk kerja
        $this->db->select("a.clock_in, a.clock_out");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
        //$this->db->where("(a.clock_in != 'null' || a.clock_out != 'null')");
        $this->db->where("a.status_kehadiran",'2');
        $this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        	
	        //inisialisasi var
        $kerjaKerja = 0;
		$persenKerjaKerja = 0;
        $kerjaSabtu = 0;
		$persenKerjaSabtu = 0;
        $kerjaLibur = 0;
		$persenKerjaLibur = 0;

        if($hariKerja == 1){
            $kerjaKerja = $query->num_rows();
			$persenKerjaKerja = ($kerjaKerja/$total) * 100;
        } else if($hariKerja == 2) {
            $kerjaSabtu = $query->num_rows();
			$persenKerjaSabtu = ($kerjaSabtu/$total) * 100;
        } else {
            $kerjaLibur = $query->num_rows();
			$persenKerjaLibur = ($kerjaLibur/$total) * 100;
        }

		//jumlah pekerja tidak ada status
        //menghitung karyawan yg tak punya kode_absensi
        $this->db->select("kode_absensi");
		$this->db->from("karyawan");
        $this->db->where("perusahaan_ID = ".$perusahaanID);
        $this->db->where("kode_absensi = 'null'");
        //$this->db->where("perusahaan_ID = '".$perusahaanID."'");
        //$this->db->where("date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $nostatus1 = $query->num_rows();
        
        //menghitung karyawan yang status_kehadirannya: Belum Ada Status (1)
        $this->db->select("a.absent");
		$this->db->from("absensi a, karyawan k");
        $this->db->where("k.perusahaan_ID = ".$perusahaanID);
        $this->db->where("k.kode_absensi = a.kode_absensi");
		$this->db->where("a.status_kehadiran",'1');
		$this->db->where("a.date LIKE '".$tanggal."'");
        $query = $this->db->get();
        $nostatus2 = $query->num_rows();
        
        $nostatus = $nostatus1 + $nostatus2;
		//$nostatus=$this->db->count_all_results();
		$persennostatus = ($nostatus/$total) * 100;

		$absensiHarian[] = array(
			'total' => $total,
			'mangkir' => $mangkir,
            'persenMangkir' => $persenMangkir,
			'telat' => $telat,
            'persenTelat' => $persenTelat,
			'kerjaKerja' => $kerjaKerja,
            'persenKerjaKerja' => $persenKerjaKerja,
			'kerjaSabtu' => $kerjaSabtu,
            'persenKerjaSabtu' => $persenKerjaSabtu,
			'kerjaLibur' => $kerjaLibur,
            'persenKerjaLibur' => $persenKerjaLibur,
			'hariApa' => $hariApa,
			'hariKerja' => $hariKerja,
            'bukanHariKerja' => $bukanHariKerja,
			'persenBukanHariKerja' => $persenBukanHariKerja,
			'nostatus' => $nostatus,
            'persennostatus' => $persennostatus,
			//'tglUbah' => $tglUbah,
            'adaTglMerah' => $adaTglMerah,
			//'tanggal' => $date
			'sakit' => $sakit,
			'persenSakit' => $persenSakit,
			'izin' => $izin,
			'persenIzin' => $persenIzin,
			'cuti' => $cuti,
			'persenCuti' => $persenCuti,
            'tugas' => $tugas,
            'persenTugas' => $persenTugas,
		);
		return $absensiHarian;
	}
    
    function getKodeAbsensi($idKaryawan){
        $this->db->select("kode_absensi");
        $this->db->from("karyawan");
        $this->db->where("karyawan_ID", $idKaryawan);
        $query = $this->db->get();
        foreach ($query->result_array() as $key){
            $kode = array('kode_absensi' => $key['kode_absensi']);
        }
        return $kode;
    }
    
    function getDataAbsensiHarianPersonal($tanggal, $idkaryawan, $kodeAbsensi) {
        $this->db->from('absensi');
        $this->db->where('kode_absensi', $kodeAbsensi);//$key['kode_absensi']);
        $this->db->where('date', $tanggal);
        $query = $this->db->get();
        $adagak = $query->num_rows();
        
        if($adagak > 0){
            foreach ($query->result_array() as $key){
                $kodet = array(
                    'id_absensi' => $key['id_absensi'],
                    'kode_absensi' => $key['kode_absensi'],
                    'status_kehadiran' => $key['status_kehadiran'],
                    'on_duty' => $key['on_duty'],
                    'off_duty' => $key['off_duty'],
                    'clock_in' => $key['clock_in'],
                    'clock_out' => $key['clock_out'],
                    'late' => $key['late'],
                    'alasan_telat' => $key['alasan_telat'],
                );
            }
        } else {
            $kodet = array(
                'id_absensi' => '',
                'kode_absensi' => '',
                'status_kehadiran' => '0',
                'on_duty' => '',
                'off_duty' => '',
                'clock_in' => '',
                'clock_out' => '',
                'late' => '',
                'alasan_telat' => '',
            );
        }
        return $kodet;
    }
    
    function getListStatusKehadiran() {
        $this->db->from('absensi_status_kehadiran');
		$query = $this->db->get();
        return $query;
    }
	
	function getListAbsensi($kodeabsensi, $dateAwal, $dateAkhir){
		//$karyawan = $this->db->get('karyawan');
		//foreach($karyawan->result_array() as $key) {
		
		$adaTglMerah = 0;
        //tgl merah
        $this->db->select("tanggalLibur");
        $this->db->from("tanggal_libur");
        $this->db->where("tanggalLibur >= '".$dateAwal."'");
        $this->db->where("tanggalLibur <= '".$dateAkhir."'");
        $query = $this->db->get();
        $adaTglMerah = $query->num_rows();
		
		//cari tahu hari apakah ini, sabtu?
		$start    = new DateTime($dateAwal);
		$end      = new DateTime($dateAkhir);
		$interval = DateInterval::createFromDateString('1 day');
		$period   = new DatePeriod($start, $interval, $end);

		$sabtu = 0;
		foreach ($period as $dt) {
		    if ($dt->format("N") == 6) {
		        echo $dt->format("l Y-m-d");
                $sabtu = 1 + $sabtu;
		    }
		}

		//total hari absen
		$this->db->from('absensi');
		$this->db->where('kode_absensi', $kodeabsensi);//$key['kode_absensi']);
		$this->db->where('date >= "'.$dateAwal.'"');
		$this->db->where('date <= "'.$dateAkhir.'"');
		$query = $this->db->get();
		$totalAbsensi = $query->num_rows();
		$totalAbsensi = $totalAbsensi - $adaTglMerah;
		if($totalAbsensi < 0){ $totalAbsensi = 0; }
		
		//total hari
/*
		$date1 = date_create($dateAwal);
		$date2 = date_create($dateAkhir);
		$jumlahHari = date_diff($date1, $date2)->format("%a");
//*/
        $datetime1 = new DateTime($dateAwal);
        $datetime2 = new DateTime($dateAkhir);
        $difference = $datetime1->diff($datetime2);
        $jumlahHari = $difference->d;
//*/
        //total telat
        $this->db->from("absensi");
        $this->db->where("kode_absensi", $kodeabsensi);//$key['kode_absensi']);
        $this->db->where("late != 'null'");
        $this->db->where("date >= '".$dateAwal."'");
        $this->db->where("date <= '".$dateAkhir."'");
        $query = $this->db->get();
        $telat = $query->num_rows();
		//$telat = $telat - $adaTglMerah;
		if($telat < 0){ $telat = 0; }

		//total mangkir
		$this->db->from("absensi");
        $this->db->where("kode_absensi", $kodeabsensi);//$key['kode_absensi']);
        $this->db->where("absent LIKE 'True'");
        $this->db->where("date >= '".$dateAwal."'");
        $this->db->where("date <= '".$dateAkhir."'");
        $query = $this->db->get();
        $mangkir = $query->num_rows();
		$mangkir = $mangkir - $adaTglMerah;
		if($mangkir < 0){ $mangkir = 0; }

		$absensiList[] = array (
            //'nama_lengkap'=> $key['nama_lengkap'],
            'totalHari'=> $jumlahHari,
            'totalAbsensi' => $totalAbsensi,
            'totalMangkir' => $mangkir,
            'totalTelat' => $telat,
            'tglMerah' => $adaTglMerah,
            //'day' => $day,
            'sabtu' => $sabtu,
        );
		//}
		return $absensiList;
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
            /*
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("absent LIKE 'True'");
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            //*/
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'3');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $mangkir = $query->num_rows();

            //izin
            /*
            $this->db->from("izin_setuju");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("tgl_izin = '".$dt->format('Y-m-d')."'");
            //*/
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'7');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $izin = $query->num_rows();

            //sakit
            /*
            $this->db->from("sakit_setuju");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("tgl_sakit = '".$dt->format('Y-m-d')."'");
            //*/
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("status_kehadiran",'8');
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            $query = $this->db->get();
            $sakit = $query->num_rows();
            
            //cuti
            /*
            $this->db->from("cuti_setuju");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("tgl_cuti = '".$dt->format('Y-m-d')."'");
            //*/
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

            //lembur (khusus Alia: di atas jam 19:00 - 05:00 (snein-jumat), 15:00-05:00 (sabtu))
            /*
            $this->db->select("HOUR(TIMEDIFF(clock_out, clock_in)) AS jam_kerja");
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $kode_absensi);
            $this->db->where("date = '".$dt->format('Y-m-d')."'");
            //*/
            
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
        
            /* menghitung lembur dengan metode sekarang (melihat waktu tap out finger print)
            if ($dt->format("N") == 6){
                $this->db->from("absensi");
                $this->db->where("kode_absensi", $kode_absensi);
                $this->db->where("(`clock_out` >= '15:00' OR `clock_out` <= '05:00')");
                $this->db->where("date = '".$dt->format('Y-m-d')."'");
                $query = $this->db->get();
                $lemburSabtu = $query->num_rows();
                $tlemburSabtu = $tlemburSabtu + $lemburSabtu;
            } else {
                $this->db->from("absensi");
                $this->db->where("kode_absensi", $kode_absensi);
                $this->db->where("(`clock_out` >= '19:00' OR `clock_out` <= '05:00')");
                $this->db->where("date = '".$dt->format('Y-m-d')."'");
                $query = $this->db->get();
                $lembur = $query->num_rows();
                $tlembur = $tlembur + $lembur;
            }
            //*/

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
    
        //jika sakit, izin, cuti, nilai mangkir dikurangi sesuai jumlah hari izin/sakit/cuti, sehingga terlihat aktual bolosnya
        //$tmangkir = $tmangkir - ($tizin + $tsakit + $tcuti + $ttugas);

        //jika nilai mangkir minus, diset nilainya ke nol
        /*
        if($tmangkir < 0) {
            $tmangkir = 0;
        } /*
        if ($tkerja < 0) {
            $tkerja = 0;
        }//*/

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

   public function upload_data($filename){
        ini_set('memory_limit', '-1');
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $inputFileName = './uploads/'.$perusahaanID.'/'.$filename;
        try {
                $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
                die('Error loading file :' . $e->getMessage());
        }
                
        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);
        $tgl_today = date("Y-m-d h:i:s");

        for ($i=2; $i < ($numRows+1) ; $i++) {            
            //Merubah format tanggal menjadi YYYY-MM-DD
            $pisahtgl = explode('/', $worksheet[$i]["F"]);
            $dateymd = $pisahtgl[2].'-'.$pisahtgl[1].'-'.$pisahtgl[0];
            
            //echo $dateymd;
            
            //query untuk mengecek data apakah ada atau tidak
            $this->db->from("absensi");
            $this->db->where("kode_absensi", $worksheet[$i]["A"]);
            $this->db->where("date", $dateymd);
            $query = $this->db->get();
            $adagak = $query->num_rows();
            foreach ($query->result_array() as $key){
                $idAbsensi = $key['id_absensi'];
            }
            //echo " ada ga:".$adagak;
            if($adagak === 0){ //klo ga ada datanya, simpan
                /*
                 * Status Kehadiran
                 * 1: Belum Ada Status
                 * 2: Hadir Hari Kerja
                 * 3: Mangkir
                 * 4: Bukan Hari Kerja
                 * 5: Tugas Luar
                 * 6: Hadir Bukan Hari Kerja
                 * 7: Izin
                 * 8: Sakit
                 * 9: Cuti
                 */ 
                if($worksheet[$i]["P"] == "True"){
                    $status = 3; //mangkir
                } else {
                    $status = 2; //hadir hari kerja
                }
                $ins = array(
                    "kode_absensi"  => $worksheet[$i]["A"],
                    "name"          => $worksheet[$i]["D"],
                    //"date"          => $worksheet[$i]["F"],
                    "status_kehadiran"=> $status,
                    "date"          => $dateymd,
                    "timetabel"     => $worksheet[$i]["G"],
                    "on_duty"       => $worksheet[$i]["H"],
                    "off_duty"      => $worksheet[$i]["I"],
                    "clock_in"      => $worksheet[$i]["J"],
                    "clock_out"     => $worksheet[$i]["K"],
                    "late"          => $worksheet[$i]["N"],
                    "early"         => $worksheet[$i]["O"],
                    "absent"        => $worksheet[$i]["P"],
                    "ot_time"       => $worksheet[$i]["Q"],
                    "work_time"     => $worksheet[$i]["R"],
                    "att_time"      => $worksheet[$i]["Z"],
                    "tgl_input"     => $tgl_today,
                    "filename"      => $filename
                );
                $this->db->insert('absensi', $ins);
            } else { //klo ada datanya, update dengan kondisi tertentu
                //echo '!';
                $this->db->from("absensi");
                $this->db->where('id_absensi', $idAbsensi);
                $this->db->where("(status_kehadiran = 1 OR status_kehadiran = 5 OR status_kehadiran = 7 OR status_kehadiran = 8 OR status_kehadiran = 9)");
                $query = $this->db->get();
                $adaStatus = $query->num_rows();
                foreach ($query->result_array() as $key){
                    $status = $key['status_kehadiran'];
                }
                if($adaStatus > 0){ //jika ada
                    if($status === 1){
                        if($worksheet[$i]["P"] == "True"){
                            $status = 3; //mangkir
                        } else {
                            $status = 2; //hadir hari kerja
                        }
                    }
                    
                    $upd = array(
                        "name"          => $worksheet[$i]["D"],
                        'status_kehadiran'=> $status,
                        "timetabel"     => $worksheet[$i]["G"],
                        "on_duty"       => $worksheet[$i]["H"],
                        "off_duty"      => $worksheet[$i]["I"],
                        "clock_in"      => $worksheet[$i]["J"],
                        "clock_out"     => $worksheet[$i]["K"],
                        "late"          => $worksheet[$i]["N"],
                        "early"         => $worksheet[$i]["O"],
                        "absent"        => $worksheet[$i]["P"],
                        "ot_time"       => $worksheet[$i]["Q"],
                        "work_time"     => $worksheet[$i]["R"],
                        "att_time"      => $worksheet[$i]["Z"],
                        "tgl_input"     => $tgl_today,
                        "filename"      => $filename
                    );
                    $this->db->where('id_absensi', $idAbsensi);
                    $this->db->update('absensi', $upd);
                }
            }
        }
    }
}	

?>
