<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends MY_Model {
	
	protected $_table_name = 'perusahaan';
	protected $_primary_key = 'perusahaan_ID';
	protected $_order_by = 'perusahaan_ID';
	protected $_order_by_type = 'ASC';

	function __construct() {
		parent::__construct();
	}

        function get_perusahaan_detail($id=NULL,$key=NULL){
                $this->db->where('perusahaan_ID',$this->session->userdata('perusahaan_ID'));
                $info = parent::get($id);
                if($key!=NULL)
                        return  $info->$key;
                else
                        return $info;
        }
}	

?>
