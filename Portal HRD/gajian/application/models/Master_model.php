<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends MY_Model {
	
	protected $_table_name = 'data_master';
	protected $_primary_key = 'master_ID';
	protected $_order_by = 'master_ID';
	protected $_order_by_type = 'ASC';

	public $rules = array(
		'nama_data' => array(
            'field' => 'nama_data',
            'label' => 'Data',
            'rules' => 'trim|required'
		)
	);	

	
	function __construct() {
		parent::__construct();
	}	
	


	function get_data_detail($id=NULL,$key=NULL){
		$info = parent::get($id);
		if(!empty($info)){
			if($key!=NULL)
				return  $info->$key;
			else
				return $info;
		}
		else
			return '';
	}
}