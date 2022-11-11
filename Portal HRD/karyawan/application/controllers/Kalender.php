<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 31/07/2017
 * Time: 15:22
 */

class kalender extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("kalender_model");
        $this->load->model("karyawan_model");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index($year = null, $month = 7)
    {
        if(isset($year))
            $year = date('Y');

        $profile = $this->karyawan_model->getProfile();
        $kalender = $this->kalender_model->generate($year, $month);

        foreach ($profile as $p)
        {
            $id = $p['idkaryawan'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);


        $this->load->view('kalendar', array('profile' => $profile, 'kalender' => $kalender, 'notifikasi' => $notifikasi, 'total' => $total));
    }
}