<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends MY_Controller {

  public function __construct(){
    parent::__construct();

   $this->load->model(array('Pengumuman_model'));
   $this->load->helper(array('tgl_indo_helper', 'form', 'url'));
   $this->load->library(array());
  }

  public function index()
  {
    $data['user'] = $this->Pengumuman_model->tampil_data()->result();
    $this->load->view('pengumuman/list', $data);
  }

  public function tambah()
  {
	$this->load->view('pengumuman/form');
  }

  public function tambah_aksi()
  {
	$judul = $this->input->post('judul');
	$pesan = $this->input->post('pesan');
	$user = $this->session->userdata('username');
	$hari_ini =  date('Y-m-d H:i:s');
	$data = array(
		'judul'=> $judul,
		'pesan_pengumuman'=> $pesan,
		'oleh'=> $user,
		'waktu' => $hari_ini
	);
	$this->Pengumuman_model->input_data($data,'pengumuman');
	redirect('pengumuman');
  }

  public function detail($id)
  {
        $where = array('idpengumuman'=> $id);
        $data['pengumuman'] = $this->Pengumuman_model->edit_data($where,'pengumuman')->result();
        $this->load->view('pengumuman/detail',$data);
  }

  public function edit($id)
  {
	$where = array('idpengumuman'=> $id);
	$data['pengumuman'] = $this->Pengumuman_model->edit_data($where,'pengumuman')->result();
	$this->load->view('pengumuman/edit',$data);
  }

  public function edit_aksi()
  {
	$id = $this->input->post('id');
	$judul = $this->input->post('judul');
	$pesan = $this->input->post('pesan');

	$data = array(
		'judul'=>$judul,
		'pesan_pengumuman'=>$pesan
	);

	$where = array(
		'idpengumuman'=>$id
	);

	$this->Pengumuman_model->update_data($where,$data,'pengumuman');
	redirect('pengumuman');
  }

  public function hapus()
  {
	//$id = $this->uri->segment('3');
	$id = $this->input->post('id_data');
	$where = array('idpengumuman'=> $id);
	$this->Pengumuman_model->hapus_data($where,'pengumuman');
	redirect('pengumuman');
  }
}
