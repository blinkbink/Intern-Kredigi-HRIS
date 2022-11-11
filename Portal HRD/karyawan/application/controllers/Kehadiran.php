<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:42
 */

class kehadiran extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("kehadiran_model");
        $this->load->library("Pdf_Library");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index()
    {
        $profile = $this->karyawan_model->getProfile();

        $dari = date('Y-01-01');
        $sampai = date('Y-12-31');
        if(isset($_POST['submit']))
        {
            $dari = date("Y-m-d", strtotime($this->input->post('dari')));
            $sampai = date("Y-m-d", strtotime($this->input->post('sampai')));
        }

        foreach ($profile as $p)
        {
            $id = $p['idkaryawan'];
        }
        $absensi = $this->kehadiran_model->getKehadiran($id, $dari, $sampai);
        $group = $this->kehadiran_model->getGroupKehadiran($id, $dari, $sampai);
        $count = $this->kehadiran_model->getCountKehadiran($id, $dari, $sampai);

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view('kehadiran/catatan_kehadiran', array('profile' => $profile, 'absensi' => $absensi, 'group' => $group, 'count' => $count, 'notifikasi' => $notifikasi, 'total' => $total));
    }
}