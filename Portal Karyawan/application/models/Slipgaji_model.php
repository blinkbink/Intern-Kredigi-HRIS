<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:38
 */

class slipgaji_model extends CI_Model
{
    public function getSlipGaji($id_karyawan)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('karyawan a');
            $this->db->join('slipgaji b', 'b.karyawan_ID = a.karyawan_ID', 'left');
            $this->db->where('a.karyawan_ID', $id_karyawan);
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
    }

    public function reportSlipGaji($id_slip)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('slipgaji a');
            $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
            $this->db->where('idslipgaji', $id_slip);
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
    
    function get_periodegaji_list($karyawanID){
		$periodegaji = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		$this->db->from('periode_gaji p, karyawan_karir r, karyawan k, master_gaji m');
		$this->db->where('p.master_gaji_ID = m.master_gaji_ID');
		$this->db->where('p.karir_ID = r.karir_ID');
		$this->db->where('r.karyawan_ID = k.karyawan_ID');
		$this->db->where('r.karyawan_ID', $karyawanID);
        $this->db->where('p.status_pembayaran', 'Sudah');
		//$this->db->where('r.perusahaan_ID', $perusahaanID);
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
                'periode_gaji_ID'=>$key['periode_gaji_ID'],
                'nama_lengkap'=>$key['nama_lengkap'],
                'id_karyawan'=>$key['karyawan_ID'],
                'kode_absensi'=>$key['kode_absensi'],
                'nik'=>$key['nomor_induk'],
                'status_wp'=>$key['status_wp'],
                'jabatan_ID'=>$key['jabatan_ID'],
                'kode_absensi'=>$key['kode_absensi'],
                'status_absensi'=>$status_absensi,
                'status_pembayaran'=>$status_pembayaran,
                'periode_type'=>$key['periode_type'],
                'periode_awal'=>$key['periode_awal'],
                'periode_akhir'=>$key['periode_akhir'],
                'json_gaji'=>$key['gaji_detail_bulanan'],
                'id_master_gaji'=>$key['master_gaji_ID'],
                'nama'=>$key['master_gaji_nama'],
                'karir_ID'=>$key['karir_ID'],
            );
        }
        return $periodegaji;
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
    
    function get_periodegaji_detail($masterGajiID, $periodeDate, $karyawanID){
		$periodegaji = array();
		$this->db->from('periode_gaji p'); 
		$this->db->join('karyawan_karir r', 'p.karir_ID = r.karir_ID', 'inner');
		$this->db->join('master_gaji m', 'p.master_gaji_ID = m.master_gaji_ID', 'inner');
		$this->db->join('karyawan k', 'k.karyawan_ID = r.karyawan_ID', 'inner');
		$this->db->where('p.master_gaji_ID', $masterGajiID);
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
}