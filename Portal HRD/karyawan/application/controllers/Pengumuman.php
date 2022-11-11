<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:14
 */

class Pengumuman extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("pengumuman_model");

        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index()
    {
        $profile = $this->karyawan_model->getProfile();
        $like = null;
        $this->load->model("karyawan_model");
        if(isset($_POST['submit']))
        {
            $like =  $this->input->post('search');;
        }
        $data = $this->pengumuman_model->getPengumuman($like);

        foreach ($profile as $p)
        {
            $id = $p['idkaryawan'];
        }
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view('informasi/info', array('data' => $data, 'profile' => $profile, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function pesan_pengumuman($id)
    {
        $profile = $this->karyawan_model->getProfile();
        $this->load->model("karyawan_model");
        $data = $this->pengumuman_model->getDetailPengumuman($id);

        foreach ($profile as $p)
        {
            $id = $p['idkaryawan'];
        }
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);


        $this->load->view('informasi/detail_pengumuman', array('data' => $data, 'profile' => $profile, 'notifikasi' => $notifikasi, 'total' => $total));
    }
}