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
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
        $this->load->model("karyawan_model");
        $this->load->model("kehadiran_model");
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
            $id = $p['karyawan_ID'];
            $kode_absensi = $p['kode_absensi'];
        }
        $absensi = $this->kehadiran_model->getKehadiran($kode_absensi, $dari, $sampai);
        $group = $this->kehadiran_model->getGroupKehadiran($kode_absensi, $dari, $sampai);
        $count = $this->kehadiran_model->getCountKehadiran($kode_absensi, $dari, $sampai);

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);
        $status = $this->kehadiran_model->getListStatusKehadiran();

        $this->load->view('kehadiran/catatan_kehadiran', array('profile' => $profile, 'absensi' => $absensi, 'group' => $group, 'count' => $count, 'notifikasi' => $notifikasi, 'total' => $total, 'status' => $status));
    }
}