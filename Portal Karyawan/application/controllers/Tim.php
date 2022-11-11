<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 25/07/2017
 * Time: 12:29
 */

class tim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['username']))
        {
            redirect('');
        }
        $this->load->model("karyawan_model");
        $this->load->model("tim_model");
    }

    public function index()
    {
        $nama_tim = null;
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['karyawan_ID'];
        }
        $kodeTIM = $this->tim_model->getKodeTIM($id);
        if($kodeTIM != null) {
            foreach ($kodeTIM as $k)
            {
                if($k['nama_tim']!=null)
                {
                    $nama_tim = $k['nama_tim'];
                }
            }
        }
        $data = $this->tim_model->getTIM($nama_tim);
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);


        $this->load->view('tim/member', array('data' => $data, 'profile' => $profile, 'notifikasi' => $notifikasi, 'total' => $total));
    }
}


?>