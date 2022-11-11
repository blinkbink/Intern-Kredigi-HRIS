<?php

/**
 * Created by PhpStorm.
 * User: asass
 * Date: 02/07/2017
 * Time: 22:24
 */
class home extends CI_Controller
{
    public function index()
    {
        if($this->session->userdata('username') != '')
        {
            $this->load->model('home_model');
            $data = $this->home_model->getHRD();
            $this->load->view('home', array('data' => $data));
        }
        else
        {
            redirect(base_url() . '/');
        }
    }

    public function add()
    {
        $this->load->view('add');
    }

    public function insert()
    {
        $insert_data = array(
            'nama' => $_POST['nama'],
            'umur' => $_POST['umur']
        );
        $query = $this->db->insert('hrd', $insert_data);
        if($query != null)
        {
            redirect('home');
        }
    }

    public function edit($id)
    {
        $this->load->model('home_model'); # <- add this
        $query = $this->home_model->editHRD("WHERE idHRD = '$id' ");

        $data = array(
            "idHRD" => $query[0]['idHRD'],
            "nama" => $query[0]['nama'],
            "umur" => $query[0]['umur']
        );
        $this->load->view('edit', $data);
    }

    public function delete($id)
    {
        $where = array('idHRD' => $id);
        $delete_data = $this->db->delete('hrd', $where);
        if($delete_data != null)
        {
            redirect(base_url()."home");
        }
    }

    public function update()
    {
        $where = array('idHRD' => $_POST['id']);
        $update_array = array(
            'idHRD' => $_POST['id'],
            'nama' => $_POST['nama'],
            'umur' => $_POST['umur'],
        );
        $update = $this->db->update('hrd', $update_array, $where);
        if($update != null)
        {
            redirect('home');
        }
    }

}