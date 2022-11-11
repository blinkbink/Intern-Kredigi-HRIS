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
	
	function get_gaji_available_test($jenis,$bulan,$tahun){
		$gaji=array();
		$thn=date('Y',strtotime($tahun);
		$bln=date('m',strtotime($bulan);
		if($jenis!='')
		$gaji_use=$this->Slip_gaji_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'master_gaji_ID' => $jenis));
		else	
		$gaji_use=$this->Slip_gaji_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID')));
		foreach($gaji_use as $key => $gg) {
		       $cut_off=$gg->master_gaji_tglCutOff1;
		       $absensi=$gg->master_gaji_tglAbsensi;
                                $this->db->select('karir_ID,karyawan_ID,group_gaji,tgl_efektif');
                                $this->db->from('`periode_gaji` p, `karyawan_karir` k');
                                $this->db->from('k.karir_ID = p.karir_ID');
                                $this->db->where(array('YEAR(p.periode_awal) = ' => $thn));
                                $this->db->where(array('MONTH(p.periode_awal) = ' => $bulan));
                                $this->db->where("group_gaji LIKE '%\"".$gg->master_gaji_ID."\"%'");
                                $result=$this->db->count_all_results('karyawan_karir');
                                if($result>0)
		        $gaji[] = array('nama'=>$gg->master_gaji_nama,'periode'=>($cut_off-$absensi),'jumlah'=>$result);     

		}

		return $gaji;

	}
}
