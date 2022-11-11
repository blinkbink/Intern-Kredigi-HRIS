<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class indexing extends CI_Controller {

	public function index()
	{
	    if(isset($_SESSION['username']))
        {
            redirect(base_url(). "karyawan");
        }
        else
        {
            $this->load->model('indexing_model');
            $this->load->view('login');
        }
	}

	public function validate()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->load->model('indexing_model');

            if($this->indexing_model->integrity_login($username, $password))
            {
                $session_data = array(
                    'username' => $username
                );
                $this->session->set_userdata($session_data);

                redirect(base_url() . 'karyawan');

            }
            else
            {
                $this->session->set_flashdata('error', 'invalid username or password');
                redirect(base_url() . '');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'input your username/password');
            redirect(base_url() . '/');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('username');
        redirect(base_url() . '');
    }

    function profile()
    {
        $this->load->model('indexing_model');
        $data = $this->indexing_model->getProfile();

        $this->load->view('profile', array('data' => $data));
    }

    function edit()
    {
        $data_edit = array(
            'title' => $_POST['title'],
            'name' => $_POST['name'],
            'phone' => $_POST['phone']
        );

        $this->load->view("editprofile", $data_edit);
    }

    function update()
    {
        $where = array('email' => $_SESSION['username']);
        $update_array = array(
            'phone' => $_POST['phone'],
            'name' => $_POST['name'],
            'title' => $_POST['title'],
        );
        $update = $this->db->update('customer', $update_array, $where);
        if($update != null)
        {
            redirect(base_url().'indexing/profile');
        }
    }
}
