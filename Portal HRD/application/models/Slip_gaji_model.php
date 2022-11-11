<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slip_gaji_model extends MY_Model {
	
	protected $_table_name = 'master_gaji';
	protected $_primary_key = 'master_gaji_ID';
	protected $_order_by = 'master_gaji_ID';
	protected $_order_by_type = 'ASC';

	public $rules = array(
		'nama_data' => array(
            'field' => 'nama',
            'label' => 'Nama Slip Gaji',
            'rules' => 'trim|required'
		)
	);	

	
	function __construct() {
		parent::__construct();
	}	
	
	function data_use($where){
		$this->db->where($where);
		//$this->db->from('karyawan_karir');
		return $this->db->count_all_results('karyawan_karir');
	}

	function komponen_use($where){
		$this->db->where($where);
		//$this->db->from('karyawan_karir');
		return $this->db->count_all_results('karyawan_karir');
	}

	function pendapatan_utama(){
		$option=array(
		'0' => array(
            'nama' => 'Gaji Pokok (Basic Salary)',
            'tipe' => 'Gaji Pokok'
		),
		'1' => array(
            'nama' => 'Tunjangan Hari Raya (THR)',
            'tipe' => 'THR'
		),
		'2' => array(
            'nama' => 'Uang Lembur (overtime)', 
            'tipe' => 'Uang Lembur'
		)

	);
		//return json_encode($option);
		return $option;
		
	}

	function get_data_detail($id=NULL,$key=NULL){
		//$this->db->select('{PRE}data_perusahaan.nama_data, {PRE}data_perusahaan.option_data', '{PRE}master_gaji_item.*');
		
		$this->db->join('data_perusahaan', 'data_perusahaan.data_ID  = master_gaji_item.data_ID', 'LEFT' );
		$this->db->where('master_gaji_item.master_gaji_ID',$id);
		if(!empty($key)){
			$this->db->where('data_perusahaan.kategori_data',$key);
		}
		return $this->db->get('master_gaji_item')->result();
	}
	function get_data_param($id,$param){
		$data_id=array();

		$data_use=$this->Slip_gaji_model->get_data_detail($id,$param);
		foreach($data_use as $key => $item) {
		        $data_id[] = $item->data_ID;         
		}

		$this->db->where(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'kategori_data' => $param));
		if(!empty($data_id))
			$this->db->where_not_in('data_ID',$data_id);
		
		$data = $this->db->get('data_perusahaan')->result();

		
		return $data;

	}
	function get_gaji_available($jenis,$bulan,$tahun){
		$gaji=array();
		$date=date('Y-m-d',strtotime($tahun.'-'.$bulan.'-'.date('d').''));
		if($jenis!='')
            $gaji_use=$this->Slip_gaji_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'master_gaji_ID' => $jenis));
		else	
            $gaji_use=$this->Slip_gaji_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID')));
		foreach($gaji_use as $key => $gg) {
            $cut_off=$gg->master_gaji_tglCutOff1;
            $absensi=$gg->master_gaji_tglAbsensi;
            $this->db->select('karir_ID,karyawan_ID,group_gaji,tgl_efektif');
            $this->db->where(array('tgl_efektif < ' => $date));
            $this->db->where(array('tgl_stop >= ' => $date));
            $this->db->where("group_gaji LIKE '%\"".$gg->master_gaji_ID."\"%'");
            $result=$this->db->count_all_results('karyawan_karir');
            if($result>0)
                $gaji[] = array('nama'=>$gg->master_gaji_nama,'periode'=>($cut_off-$absensi),'jumlah'=>$result);     
		}
		return $gaji;
	}

	function get_gaji_available_tes2($jenis,$bulan,$tahun){
		$gaji=array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		
		if($jenis!='') {
			$gaji_use = $this->db->query('SELECT DISTINCT p.master_gaji_ID, m.master_gaji_nama, p.periode_type, p.periode_awal, p.periode_akhir FROM master_gaji m, periode_gaji p WHERE m.`perusahaan_ID` = '.$perusahaanID.' AND p.master_gaji_ID = '.$jenis.' AND m.master_gaji_ID = p.master_gaji_ID AND YEAR(p.periode_akhir) = '.$tahun.' AND MONTH(p.periode_akhir) = '.$bulan);
		} else {
			$gaji_use = $this->db->query('SELECT DISTINCT p.master_gaji_ID, m.master_gaji_nama, p.periode_type, p.periode_awal, p.periode_akhir FROM master_gaji m, periode_gaji p WHERE m.`perusahaan_ID` = '.$perusahaanID.' AND m.master_gaji_ID = p.master_gaji_ID AND YEAR(p.periode_akhir) = '.$tahun.' AND MONTH(p.periode_akhir) = '.$bulan);
		} 
		//*/
		foreach ($gaji_use->result_array() as $key) {
			//menghitung total karyawan di slip gaji tersebut per  periode gaji 
            /* ini yang dipake sebelum bawah ini
			$query = $this->db->query('Select distinct k.karyawan_ID, p.master_gaji_ID
from periode_gaji p, karyawan k, karyawan_karir r
where p.master_gaji_ID = '.$key['master_gaji_ID'].' 
AND YEAR(p.periode_akhir) = '.$tahun.'
AND MONTH(p.periode_akhir) = '.$bulan.'
AND p.karir_ID = r.karir_ID
AND r.karyawan_ID = k.karyawan_ID
AND r.perusahaan_ID = '.$perusahaanID);
//*/
            $this->db->distinct('k.karyawan_ID, p.master_gaji_ID');
            $this->db->from('periode_gaji p, karyawan_karir r, karyawan k');
            $this->db->where('p.master_gaji_ID', $key['master_gaji_ID']);
            $this->db->where('YEAR(p.periode_akhir)', $tahun);
            $this->db->where('MONTH(p.periode_akhir)', $bulan);
            $this->db->where('p.karir_ID = r.karir_ID');
            $this->db->where('r.karyawan_ID = k.karyawan_ID');
            $this->db->where('r.perusahaan_ID', $perusahaanID);
            $this->db->group_by('r.karyawan_ID, p.master_gaji_ID');
			$query = $this->db->get(); //klo ga pake query atas (yg dikomentarin mati) matiin ini juga lagi
			$result = $query->num_rows();

            if($result>0) {
				$gaji[] = array(
	        		'nama'=>$key['master_gaji_nama'],
	        		'periode_awal'=>$key['periode_awal'],
	        		'periode_akhir'=>$key['periode_akhir'],
					//'nama'=>$masterGaji,
		       		'jumlah'=>$result,
					'master_gaji_id'=>$key['master_gaji_ID'],
					'periode_type'=>$key['periode_type']
		        );
			}
		}
        return $gaji;
	}

	function get_periodegaji_list($masterGajiID, $periodeDate){
		$periodegaji = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		$this->db->distinct('r.karyawan_ID');
		$this->db->from('periode_gaji p, karyawan_karir r, karyawan k, master_gaji m');
		$this->db->where('p.master_gaji_ID = '.$masterGajiID);
		$this->db->where('p.master_gaji_ID = m.master_gaji_ID');
		$this->db->where('p.karir_ID = r.karir_ID');
		$this->db->where('r.karyawan_ID = k.karyawan_ID');
		$this->db->where('r.perusahaan_ID = '.$perusahaanID);
		$this->db->where('p.periode_akhir = "'.$periodeDate.'"');
		$this->db->group_by('r.karyawan_ID');
		$query = $this->db->get();
        $rows = $query->num_rows();
        //return $this->db->get();
        //if($result>0) {
        foreach ($query->result_array() as $key) {
            if(!$key['status_absensi']){
                $status_absensi = "Belum lengkap";
            } else {
                $status_absensi = $key['status_absensi'];
            }
            if(!$key['status_pembayaran']){
                $status_pembayaran = "Belum";
            } else {
                $status_pembayaran = $key['status_pembayaran'];
            }
            $periodegaji[] = array(
                'periode_gaji_id'=>$key['periode_gaji_ID'],
                'nama_lengkap'=>$key['nama_lengkap'],
                'id_karyawan'=>$key['karyawan_ID'],
                'nik'=>$key['nomor_induk'],
                'status_wp'=>$key['status_wp'],
                'jabatan_ID'=>$key['jabatan_ID'],
                'kode_absensi'=>$key['kode_absensi'],
                //'status_absensi'=>$key['status_absensi'],
                'status_absensi'=>$status_absensi,
                //'status_pembayaran'=>$key['status_pembayaran']
                'status_pembayaran'=>$status_pembayaran,
                'periode_type'=>$key['periode_type'],
                'periode_awal'=>$key['periode_awal'],
                'periode_akhir'=>$key['periode_akhir'],
                'json_gaji'=>$key['gaji_detail_bulanan'],
                'nama'=>$key['master_gaji_nama'],
                'karir_ID'=>$key['karir_ID']
                //'master_gaji_id'=>$key['master_gaji_ID']
            );
        }
        return $periodegaji;
	}

	function get_list_date_periodegaji($masterGajiID, $lastPeriode = NULL, $param = NULL){
		$list = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		$this->db->distinct('p.periode_awal');
		$this->db->from('periode_gaji p, master_gaji m');
		$this->db->where('p.master_gaji_ID', $masterGajiID);
		$this->db->where('p.master_gaji_ID = m.master_gaji_ID');
		$this->db->where('m.perusahaan_ID', $perusahaanID);
		if(!empty($lastPeriode) && !empty($param)){
			if($param == '<'){
                $this->db->where('p.periode_akhir < "'.$lastPeriode.'"');
			} elseif($param == '>') {
                $this->db->where('p.periode_akhir > "'.$lastPeriode.'"');
			}
		}
		$this->db->group_by('p.periode_awal');
		$query = $this->db->get();
		$rows = $query->num_rows();
		$num = 0;
		foreach ($query->result_array() as $key) {
			if($rows > 0){
                $list[] = array(
                    'num' => $num,
                    'jml_list' => $rows,
                    'master_gajiID' => $key['master_gaji_ID'],
                    'periode_awal' => $key['periode_awal'],
                    'periode_akhir' => $key['periode_akhir'],
                    'nama' => $key['master_gaji_nama']
                );
                $num++;
			}
		}
		return $list;
	}

	function get_periodegaji_detail($masterGajiID, $periodeDate, $karyawanID){
		$periodegaji = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		$this->db->from('periode_gaji p'); 
		$this->db->join('karyawan_karir r', 'p.karir_ID = r.karir_ID', 'inner');
		$this->db->join('master_gaji m', 'p.master_gaji_ID = m.master_gaji_ID', 'inner');
		$this->db->join('karyawan k', 'k.karyawan_ID = r.karyawan_ID', 'inner');
		$this->db->where('p.master_gaji_ID', $masterGajiID);
		$this->db->where('r.perusahaan_ID', $perusahaanID);
		$this->db->where('p.periode_akhir', $periodeDate);
		$this->db->where('r.karyawan_ID', $karyawanID);
		//$this->db->group_by('r.karyawan_ID');
		$query = $this->db->get();
		$rows = $query->num_rows();
		//return $this->db->get();
//		if($result>0) {
		foreach ($query->result_array() as $key) {
            $periodegaji[] = array(
                'periode_gaji_id'=>$key['periode_gaji_ID'],
                'nama_lengkap'=>$key['nama_lengkap'],
                'id_karyawan'=>$key['karyawan_ID'],
                'kode_absensi'=>$key['kode_absensi'],
                'tglEfektif'=>$key['tgl_efektif'],
                'periode_type'=>$key['periode_type'],
                'periode_awal'=>$key['periode_awal'],
                'periode_akhir'=>$key['periode_akhir'],
                'json_gaji'=>$key['gaji_detail_bulanan'],
                'nama'=>$key['master_gaji_nama'],
                'karir_ID'=>$key['karir_ID'],
                'jumlahRow'=>$rows
            );
		}
		return $periodegaji;
	}
	
	function getPeriodeDate($masterGajiID){
		$periodeDate = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		$this->db->select('`periode_gaji_ID`, `karir_ID`, `periode_awal`, `periode_akhir`');
		$this->db->from('`periode_gaji`');
		$this->db->where('master_gaji_ID    ` = '.$masterGajiID);
		$this->db->order_by('periode_awal', 'DESC');
		$query = $this->db->get();
		$result = $query->num_rows();

		foreach ($query->result_array() as $key) {
/*			$query = $this->db->query('Select distinct k.karyawan_ID, p.master_gaji_ID 
from periode_gaji p, karyawan k, karyawan_karir r
where p.master_gaji_ID = '.$key['master_gaji_ID'].' 
AND p.periode_awal = "'.$key['periode_awal'].'"
AND p.periode_akhir = "'.$key['periode_akhir'].'"
AND p.karir_ID = r.karir_ID
AND r.karyawan_ID = k.karyawan_ID
AND r.perusahaan_ID = '.$perusahaanID);
//*/                      
//          $jml = $query->num_rows();

			$periodeDate[] = 
				array(
				'jumlahQuery' => $result,
				'periodeGajiID' => $key['periode_gaji_ID'],
				'karir_ID' => $key['karir_ID'],
				'periode_awal' => $key['periode_awal'],
				'periode_akhir' => $key['periode_akhir']
				//'jmlSlip' => $jml		
			);
		}
		return $periodeDate;
	}

	function getDetailSlip($masterGajiID, $akhirPeriode, $karirID){
		$detailSlip = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		//$this->db->select();
		$this->db->from('periode_gaji p, master_gaji g, master_gaji_item i, data_perusahaan d');
		$this->db->where('p.master_gaji_ID = '.$masterGajiID);
		$this->db->where('p.periode_akhir = '.$akhirPeriode);
		$this->db->where('p.karir_ID = '.$karirID);
		$this->db->where('p.master_gaji_ID = g.master_gaji');
		$this->db->where('g.perusahaan_ID = '.$perusahaanID);
		$this->db->where('g.master_gaji = i.master_gaji');
		$this->db->where('i.data_ID = d.data_ID');
		$query = $this->db->get();
		foreach ($query->result_array() as $key){
			$detailSlip[] = array(
				'data_ID'=>$key['data_ID'],
				'master_gaji_nama'=> $key['master_gaji_nama'],
				'nama_data' => $key['nama_data'],
				'option_data' => $key['option_data'],
				'status_data' => $key['status_data'],
				'kategori_data' => $key['kategori_data']
			);
		}
		return $detailSlip;
	}
	
	function getItemGaji($masterGajiID){
        $itemGaji = array();
		$this->db->from('master_gaji_item m, data_perusahaan p');
		$this->db->where('m.master_gaji_ID = '.$masterGajiID);
		$this->db->where('m.data_ID = p.data_ID');
		$query = $this->db->get();
		$result = $query->num_rows();
		foreach ($query->result_array() as $key){
            $itemGaji[] = array(
                'data_ID'=>$key['data_ID'],
                'kategori_data'=> $key['kategori_data'],
                'nama_data'=>$key['nama_data'],
                'status_data'=>$key['status_data'],
                'option_data'=>$key['option_data'],
                'jumlahRow'=>$result
			);
		}
		return $itemGaji;
    }

	function getUnit($periodeID, $itemGajiID){
		$unitGaji = array();
        $this->db->from('unit_gaji');
        $this->db->where('periode_gaji_ID = '.$periodeID);
        $this->db->where('data_id = '.$itemGajiID);
        $query = $this->db->get(); 
        $result = $query->num_rows();

        foreach ($query->result() as $key){
            $unitGaji[] = array(
                'unit'=>$key->unit,
                'jumlahRow'=>$result
            );
        }
		return $unitGaji;
	}

	function changeStatusPembayaran($where, $data){
		$this->db->where($where);
		$this->db->update('periode_gaji',$data);
	}

	function update_data_slip($where, $data){
        $this->db->where($where);
        $this->db->update('periode_gaji',$data);
    }

	function update_data_unit($periode_gaji_id, $unit, $data_id){
		$this->db->from('unit_gaji');
		$this->db->where('periode_gaji_ID', $periode_gaji_id);
		$this->db->where('data_id', $data_id);
		$query = $this->db->get();
        $result = $query->num_rows();
		if($result > 0){
			//klo ada datanya, update aja
			$dataUnit = array(
                'unit' => $unit,
            );
			$this->db->where('periode_gaji_ID',$periode_gaji_id);
			$this->db->where('data_id',$data_id);
			$this->db->update('unit_gaji',$dataUnit);
		} else {
			//klo ga ada datanya, input data baru
			$this->db->set('periode_gaji_ID', $periode_gaji_id);
			$this->db->set('data_id', $data_id);
			$this->db->set('unit', $unit);
			$this->db->insert('unit_gaji');
		}
	}
    
    function getTipeData($idmastergaji, $option){
        $this->db->from('master_gaji_item i, master_gaji m, data_perusahaan d');
        $this->db->where('i.master_gaji_ID = m.master_gaji_ID');
        $this->db->where('i.data_ID = d.data_ID');
        $this->db->where('m.master_gaji_ID', $idmastergaji);
        //$this->db->where('d.option_data', $option);
        $this->db->like('d.option_data', $option);
        $query = $this->db->get();
        $result = $query->num_rows();
        if($result > 0){
            foreach ($query->result_array() as $key){
                $itemGaji = array(
                    'itemID'=>$key['data_ID'],
                );
            }
		return $itemGaji;
        }
    }

	function getNamaBulan($bulan){
		switch ($bulan) 
        {
			case '1': $bulan = 'Jan'; break;
			case '2': $bulan = 'Feb'; break;
			case '3': $bulan = 'Mar'; break;
			case '4': $bulan = 'Apr'; break;
			case '5': $bulan = 'Mei'; break;
			case '6': $bulan = 'Jun'; break;
			case '7': $bulan = 'Jul'; break;
			case '8': $bulan = 'Agu'; break;
			case '9': $bulan = 'Sep'; break;
			case '10': $bulan = 'Okt'; break;
			case '11': $bulan = 'Nov'; break;
			case '12': $bulan = 'Des'; break;
			default: break;
		}
		return $bulan;
	}
}
