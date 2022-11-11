<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("sakit_model");
        $this->load->library("Pdf_Library", "session");
    }

    public function index()
    {
        $this->load->view("login");
    }

    public function validasi()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->load->model('login_model');

            if($this->login_model->integrity_login($username, $password))
            {
                $session_data = array(
                    'username' => $username
                );
                //$this->session->set_userdata($session_data);
                $this->session->set_userdata($session_data);

                echo $_SESSION['username'];
                //redirect( '/karyawan');
                //redirect(base_url() . 'index.php/karyawan');
                //echo $_SESSION['username'];
                //print_r($this->session->userdata);
                //$this->load->view('sidebar');
                //echo "Sukses Login";

            }
            else
            {
                $result = '<div class="alert alert-danger" role="alert">Username atau Password Salah</div>';
                $this->load->view("login", array('result' => $result));
            }
        }
        else
        {
            $result = '<div class="alert alert-warning" role="alert">Form Tidak Boleh Kosong</div>';
            $this->load->view("login", array('result' => $result));
        }
    }
}
