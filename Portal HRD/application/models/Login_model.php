<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model {
	
	protected $_table_name = 'login_logs';
	protected $_primary_key = 'login_ID';
	protected $_order_by = 'login_ID';
	protected $_order_by_type = 'DESC';

	function __construct() {
		parent::__construct();
	}
    
    function cekUser($idKaryawan)
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->where('karyawan_ID', $idKaryawan);
        $this->db->where('perusahaan_ID', $perusahaanID);
        $this->db->where('group', 'Karyawan');
        $query  = $this->db->get('user');

        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}	

?>