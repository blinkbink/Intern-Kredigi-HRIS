<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends MY_Model {
	
	protected $_table_name = 'absensi';
	protected $_primary_key = 'absensi_ID';
	protected $_order_by = 'absensi_ID';
	protected $_order_by_type = 'DESC';

	function __construct() {
		parent::__construct();
	}
	
	function getDataAbsensiHarian($tanggal) {
		$gaji=array();
		$date=date('Y-m-d',strtotime($tahun.'-'.$bulan.'-'.date('d').''));

		$this->db->query("SELECT absent FROM absensi WHERE absent LIKE 'True' AND date LIKE '".$tanggal."'");
		$mangkir = $this->db->count_all_results('absensi');

		//$this->db->query("SELECT absent FROM absensi WHERE absent LIKE 'True' AND date LIKE '".$tanggal."'");
		//$hadirkerja = $this->db->count_all_results('absensi');

		$absensiHarian[] = array(
			'absen' => $mangkir
		);
	}
}	

?>
