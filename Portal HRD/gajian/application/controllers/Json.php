<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

  public function __construct(){
    parent::__construct();    
    
    $this->load->model(array());
    $this->load->helper(array('tgl_indo_helper'));
    $this->load->library(array('Site', 'session'));
    
  }

	public function index(){
  }

  public function session(){
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    $user_data = $this->session->userdata;
      //print_r($user_data);
      $expired = @$user_data['expires_by'];
      $time = time();

      $selisih = $expired - $time + 10;

      if($selisih>60)
      echo json_encode(array('status'=>date('i',$selisih)));
    else
      echo json_encode(array('status'=>'None'));

      }
  } 
  public function waktu(){
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    $user_data = $this->session->userdata;
      //print_r($user_data);
      $expired = @$user_data['expires_by'];
      $time = time();

      $selisih = $expired - $time;

      echo json_encode(array('waktu'=>tgl_indo(date('Y-m-d')) .' '. date('H:i') . ' &nbsp; (GMT +07:00)'));
}
      
  }
  
}
