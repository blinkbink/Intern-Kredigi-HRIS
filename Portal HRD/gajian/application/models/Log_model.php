<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends MY_Model {
	
	protected $_table_name = 'activity_logs';
	protected $_primary_key = 'activity_ID';
	protected $_order_by = 'activity_ID';
	protected $_order_by_type = 'DESC';

	function __construct() {
		parent::__construct();
	}
}	

?>