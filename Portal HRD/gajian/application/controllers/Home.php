<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();		
		
		$this->load->model(array());
		$this->load->helper(array());
		$this->load->library(array());
		
	}

	public function index()
	{
		$this->load->view('home');
	}
}
