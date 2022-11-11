<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site{

	public $side;
	public $template;
	public $template_setting;
	public $website_setting;
	public $_isHome = FALSE;
	public $_isCategory = FALSE;
	public $_isSearch = FALSE;
	public $_isDetail = FALSE;

	function login_validate($timeout) {
		$_this =& get_instance();
		$_this->session->set_userdata(array('expires_by' => time() + $timeout));
	}

	function login_check() {
		$_this =& get_instance();
		$user_session = $_this->session->userdata;
		$exp_time = $user_session['expires_by'];
		if (time() < $exp_time) {
			$_this->Site->login_validate();
			return true; 
		} else {
			$_this->session->sess_destroy();
			return false; 
		}
	}

	function is_logged_in(){
		$_this =& get_instance();

		$user_session = $_this->session->userdata;

		
		if($_this->uri->segment(1) == 'login' || $_this->uri->segment(2) == 'login'){
			if(isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE ){
				redirect(site_url());
			}
		}
		else{
			if(!isset($user_session['logged_in'])){
				$_this->session->sess_destroy();
				redirect(site_url('login'));
			}
			else{
				$exp_time = $user_session['expires_by'];
				if (time() < $exp_time) {
					$_this->session->set_userdata(array('expires_by' => time() + 3600));//600));
				} else {
					$_this->session->sess_destroy();
				}
			}
		}

		
	}


	
	function login_log(){
		$_this =& get_instance();	
		$_this->load->library('user_agent');
		$_this->load->model('Login_model');
		
		$user_session = $_this->session->userdata;

		if(isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE) {
			$sessId = session_id();
			
			//$ip = $_SERVER['REMOTE_ADDR'];
			$ip = '112.215.36.142';
			//$ip = '127.0.0.1';
			$date = date('Y-m-d H:i:s');
			$agent = $_this->agent->agent_string();
			
			@$var = file_get_contents("http://ip-api.com/json/$ip");
			$var = json_decode($var);

			$loginLogs = array(
					'login_IP' => $var->query, 
					'login_IP' => $ip, 
					'login_user' => $user_session['username'], 
					'login_date' => $date, 
					'login_agent' => $agent, 
					'login_session' => $sessId,
					'login_city' => @$var->city, 	
					'login_region' => @$var->regionName, 	
					'login_country' => @$var->country, 	
					'login_os' => $_this->agent->platform(),
					'login_browser' => $_this->agent->browser().' '.$_this->agent->version(),
					'login_isp' => @$var->isp
			);
								
			$_this->Login_model->insert($loginLogs);
			
			$_this->session->set_userdata(array('user_online' => session_id() ));			
		}
		
		return TRUE;		
	}

	function activity_log($log,$table,$data=NULL,$where=NULL){
		$_this =& get_instance();
		$_this->load->model('Log_model');

		$user_session = $_this->session->userdata;
		$date = date('Y-m-d H:i:s');

		$dataLogs = array(
					'activity_date' => $date, 
					'activity_user' => $user_session['username'], 
					'activity_perusahaan' => $user_session['perusahaan_ID'], 
					'activity_session' => $user_session['user_online'], 
					'activity_key' => $log, 
					'activity_table' => $table, 
					'activity_data' => @$data, 
					'activity_where' => @$where 
					
		);
				
		$id = $_this->Log_model->insert($dataLogs);
		return $id;
	}	

	function visitor_log(){
		
		$_this =& get_instance();	
		$_this->load->library('user_agent');
		$_this->load->model('Statistik_model');
		
		if((!$_this->session->userdata('user_online')) ){
			$sessId = session_id();
			
			//$ip = $_SERVER['REMOTE_ADDR'];
			$ip = '112.215.36.142';
			//$ip = '127.0.0.1';
			$date = date('Y-m-d H:i:s');
			$agent = $_this->agent->agent_string();
			(!empty($_SERVER['HTTP_REFERER'])) ? $reff = $_SERVER['HTTP_REFERER'] : $reff = '';
			
			@$var = file_get_contents("http://ip-api.com/json/$ip");
			$var = json_decode($var);

			$visitorLogs = array(
					'visitor_IP' => $var->query, 
					'visitor_IP' => $ip, 
					'visitor_referer' => $reff, 
					'visitor_date' => $date, 
					'visitor_agent' => $agent, 
					'visitor_session' => $sessId,
					'visitor_city' => @$var->city, 	
					'visitor_region' => @$var->regionName, 	
					'visitor_country' => @$var->country, 	
					'visitor_os' => $_this->agent->platform(),
					'visitor_browser' => $_this->agent->browser().' '.$_this->agent->version(),
					'visitor_isp' => @$var->isp
			);
								
			$_this->Statistik_model->insert($visitorLogs);
			
			$_this->session->set_userdata(array('user_online' => session_id() ));			
		}
		
		return TRUE;		
	}	

	function create_dir(){
		global $SConfig;
		$_this =& get_instance();		
		$path = $SConfig->_document_root.'/uploads';
		
		if(!is_dir($path.'/'.get_user_info('perusahaan_ID').'/')){
			mkdir($path.'/'.get_user_info('perusahaan_ID'), 0755);
			touch($path.'/'.get_user_info('perusahaan_ID').'/'.'index.php');
		}
		
	}	

	function media_upload_config(){
		global $SConfig;
		$_this =& get_instance();		
		$path = $SConfig->_document_root.'/uploads';
		$realpath = $path.'/'.get_user_info('perusahaan_ID');
		
		$config['upload_path'] = $realpath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2000';
		$config['max_width']  = '3000';
		$config['max_height']  = '3000';
		
		return $config;		
	}	

	function file_upload_config(){
		global $SConfig;
		$_this =& get_instance();		
		$path = $SConfig->_document_root.'/uploads';
		$realpath = $path.'/'.get_user_info('perusahaan_ID');
		
		$config['upload_path'] = $realpath;
		$config['allowed_types'] = 'jpg|xls|xlsx|pdf|doc|csv|doc';
		$config['max_size']	= '2000';
		
		return $config;		
	}	

	function resize_img($image=NULL, $width=NULL, $height=NULL, $type=NULL){
		global $SConfig;
		$_this =& get_instance();
		$_this->load->library('image_lib'); 
		
		/* definite globalvar */
		$hostname = $SConfig->_host_name; 
		$docroot = $SConfig->_document_root;
		$siteurl = $SConfig->_site_url;
		
		/* jika kosong maka jadikan nilai default */
		(!empty($width)) ? $width_image = $width : $width_image = 75;
		(!empty($height)) ? $height_image = $height : $height_image = 50;		
		
		/* change path to directory */
		$directory = str_replace($siteurl,$docroot,$image);
		
		/* change files name to new name */
		$get_latest_slash = strrpos($directory, '/');
		$file_name = substr($directory,	$get_latest_slash+1 );
		$extension = substr($file_name, strrpos($file_name, '.'));
		$file_name_without_ext = substr($directory,	$get_latest_slash+1, strrpos($file_name, '.') );
		$new_name = $file_name_without_ext.'_'.$width_image.'x'.$height_image.$extension;
		
		/* path baru */
		$new_path = str_replace($file_name, $new_name, $directory);
		
		/* new url */
		$new_url = str_replace($docroot,$siteurl, $new_path);
		
		$file_is_exist = file_exists($new_path);
		
		if($file_is_exist == TRUE){
			return $new_url;
		}
		else{
			/* configuration */
			$config['image_library'] = 'gd2';
			$config['source_image']	= $directory;
			$config['create_thumb'] = TRUE;
			$config['thumb_marker'] = '';
			$config['maintain_ratio'] = TRUE;
			
			if(file_exists($config['source_image'])){
				$img_size = getimagesize($config['source_image']);
				$t_ratio = $width/$height;
		      	$o_width = $img_size[0];
		      	$o_height = $img_size[1];
			
				if ((!empty($img_size)) && ($t_ratio > $o_width/$o_height)){
					$config['width'] = $width;
					$config['height'] = round( $width * ($o_height / $o_width));
					$y_axis = round(($config['height']/2) - ($height/2));
					$x_axis = 0;
				}
				else{
					$config['width'] = round( $height * ($o_width / $o_height));
					$config['height'] = $height;
					$y_axis = 0;
					$x_axis = round(($config['width']/2) - ($width/2));
				}				
			}
			
			else{
				$config['width'] = $width;
				$config['height'] = $height;
				$y_axis = 0;
				$x_axis = round(($config['width']/2) - ($width/2));				
			}

	  		
			$config['new_image'] = $new_path;
			
			/* load library image */
			$_this->image_lib->clear();
			$_this->image_lib->initialize($config);
			
			/* jika tidak ada masalah maka lakukan resize */
			$_this->image_lib->resize();
			
			$source_img01 = $config['new_image'];
			$config['image_library'] = 'gd2';
			$config['source_image'] = $source_img01;
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = false;
			$config['width'] = $width;
			$config['height'] = $height;
			$config['y_axis'] = $y_axis ;
			$config['x_axis'] = $x_axis ;
			
			$_this->image_lib->clear();
			$_this->image_lib->initialize($config);
			$_this->image_lib->crop();
			/* return value */			
		}		

		return $new_url;
	}

	function is_url_admin(){
		$_this =& get_instance();
		if($_this->uri->total_segments() == 1 && $_this->uri->segment(1) == 'admin'){
			redirect(site_url('dashboard'));
		}
	}
}
