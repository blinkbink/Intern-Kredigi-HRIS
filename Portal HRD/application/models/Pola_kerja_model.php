<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pola_kerja_model extends MY_Model {
	
	protected $_table_name = 'pola_kerja';
	protected $_primary_key = 'id_polker';
	protected $_order_by = 'id_polker';
	protected $_order_by_type = 'ASC';
//*
	public $rules = array(
		'pola_kerja' => array(
            'field' => 'pola_kerja',
            'label' => 'Nama Pola Kerja',
            'rules' => 'trim|required'
		),
		'toleransi' => array(
		'field' => 'toleransi',
		'label' => 'Toleransi Keterlambatan',
		'rules' => 'optional'
		),
		'hari' => array(
                'field' => 'hari',
                'label' => 'Hari',
                'rules' => 'required'
                ),
		'status_hari' => array(
                'field' => 'status_hari',
                'label' => 'Status Hari',
                'rules' => 'required'
                ),
                'jam_masuk' => array(
                'field' => 'jam_masuk',
                'label' => 'Jam Masuk Kerja',
	        'rules' => 'required'
                ),
                'jam_pulang' => array(
                'field' => 'jam_pulang',
                'label' => 'Jam Pulang Kerja',
                'rules' => 'required'
                ),
	);	
//*/
	
	function __construct() {
		parent::__construct();
	}	
	
	function insertPolaKerja($dataA){
		$this->db->insert('pola_kerja', $dataA);
		return $this->db->insert_id();
	}
	
	function insertPolaHari($dataB){
		$this->db->insert('pola_kerja_hari', $dataB);
	}

	function hapusPolaHari($where){
		$this->db->where($where);
		$this->db->delete('pola_kerja');
		$this->db->delete('pola_kerja_hari');
	}

	function getData($id){
		$this->db->from('pola_kerja');
		$this->db->where('id_polker', $id);
		return $this->db->get()->result();
	}
	
	function getListData($id = NULL){
		//$polaKerja = array();
		$perusahaanID = $this->session->userdata('perusahaan_ID');
		$this->db->from('pola_kerja');
		$this->db->where('perusahaan_ID', $perusahaanID);
		if($id != NULL){
			$this->db->where('id_polker', $id);
		}
		$query = $this->db->get();
		$row = $query->num_rows();
		if($row > 0){
		    foreach ($query->result_array() as $key) {
//*
			$this->db->from('pola_kerja_hari');
			$this->db->where('id_polker', $key['id_polker']);
			$polker = $this->db->get();
	                $totalHari = $polker->num_rows();
			
			$this->db->from('pola_kerja_hari');
                        $this->db->where('id_polker', $key['id_polker']);
			$this->db->where('jenis_hari LIKE "Hari Kerja"');
                        $polker = $this->db->get();
                        $totalHariKerja = $polker->num_rows();

			$this->db->from('pola_kerja_hari');
                        $this->db->where('id_polker', $key['id_polker']);
			$this->db->where('jenis_hari = "Hari Libur"');
                        $query = $this->db->get();
                        $totalHariLibur = $query->num_rows();
//*/
			$polaKerja[] = array(
				'row' => $row,
				'id_polker' => $key['id_polker'],
				'nama_polker' => $key['nama_polker'],
				'toleransi' => $key['toleransi_telat'],
				'totalHari' => $totalHari,
				'totalHariKerja' => $totalHariKerja,
				'totalHariLibur' => $totalHariLibur
			);
		    }
		} else {
			$polaKerja[] = array(
				'row' => $row
			);
		}
		return $polaKerja;
	}

	function getPolaKerja($id_polker){
		$this->db->from('pola_kerja_hari');
		$this->db->where('id_polker', $id_polker);
		$query = $this->db->get();
		foreach ($query->result_array() as $key) {
			$polaKerjaHari[] = array(
				'jenis_hari' => $key['jenis_hari'],
				'hari_ke' => $key['hari_ke'],
				'jam_mulai' => $key['jam_mulai'],
				'jam_selesai' => $key['jam_selesai']
			);
		} 
		return $polaKerjaHari;
	}
}
