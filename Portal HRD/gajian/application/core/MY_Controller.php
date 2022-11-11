<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $data = array();

	function __construct(){
		parent::__construct();

		$this->load->model(array('User_model','Perusahaan_model'));
		$this->load->helper(array('url','template_helper','user_helper','date'));
		$this->load->library(array('Site', 'session'));

		$this->User_model->update(array('last_page'=> uri_string(),'last_login'=>date('Y-m-d H:i:s')),array('username'=>get_user_info('username')));
		
    	$this->site->is_logged_in();

    	
	}

}