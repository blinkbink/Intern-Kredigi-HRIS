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
}	

?>