<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 09/08/2017
 * Time: 11:21
 */

class Karyawan extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        if(!isset($_SESSION['username']))
        {
            redirect('');
        }
        $this->load->model("karyawan_model");
        $this->load->model("kalender_model");
    }

    public function index()
    {
        $data = $this->karyawan_model->getProfile();

        foreach ($data as $d)
        {
            $id = $d['karyawan_ID'];
        }
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);
        $kalender = $this->kalender_model->getKalender();

        $this->load->view('home', array('data' => $data, 'notifikasi' => $notifikasi, 'total' => $total, 'kalender' => $kalender));
    }

    public function profile()
    {
        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Pengajuan Perubahan data akan segera di proses.
                                                    </div>";
        }
        $data = $this->karyawan_model->getProfile();

        foreach ($data as $d)
        {
            $id = $d['karyawan_ID'];
        }
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $perubahan = $this->karyawan_model->getPerubahan();

        $this->load->view('karyawan/data_diri', array('data' => $data, 'perubahan' => $perubahan, 'notifikasi' => $notifikasi, 'total' => $total, 'message' => $message));
    }

    public function kata_sandi()
    {
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $d)
        {
            $id = $d['karyawan_ID'];
        }
        $result = null;
        $sandi_lama = hash('SHA256', $this->input->post('sandi_lama'));
        $sandi_baru = hash('SHA256', $this->input->post('sandi_baru'));
        $ulang_sandi = hash('SHA256', $this->input->post('ulang_sandi'));

        $this->load->model("karyawan_model");
        $cek_password_lama = $this->karyawan_model->getProfile();

        if(!empty($_POST['submit']))
        {
            foreach ($cek_password_lama as $password_lama)
                if($sandi_lama == $password_lama['password'] && $sandi_baru == $ulang_sandi)
                {
                    $where = array('username' => $_SESSION['username']);
                    $update_array = array(
                        'password' => $sandi_baru
                    );
                    $update_password = $this->db->update('user', $update_array, $where);
                    if($update_password != null)
                    {
                        $result = '<div class="alert alert-success" role="alert">Sukses Mengubah Kata Sandi Anda</div>';
                    }
                }
                else if($sandi_lama != $password_lama['password'])
                {
                    $result = '<div class="alert alert-danger" role="alert">Kata Sandi lama tidak sesuai</div>';
                }
                else
                {
                    $result = '<div class="alert alert-danger" role="alert">Kata Sandi baru tidak sesuai dengan konfirmasi Kata sandi</div>';
                }
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view('karyawan/kata_sandi', array('result' => $result, 'profile' => $profile, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function edit()
    {
        $perubahan = $this->karyawan_model->getPerubahan();
        $data = $this->karyawan_model->getProfile();

        foreach ($perubahan as $p)

            if($p['status'] == "Menunggu")
            {
                redirect(base_url(). "index.php/karyawan/profile");
            }

        foreach ($data as $d)
        {
            $id = $d['karyawan_ID'];
        }
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view('karyawan/perubahan', array('data' => $data,'notifikasi' => $notifikasi,'total' => $total));
    }


    public function save()
    {
        $this->load->model('karyawan_model');
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $id);

        $email = $this->input->post('email');
        $agama = $this->input->post('agama');
        $golongan_darah = $this->input->post('golongan_darah');
        $statusP_perkawinan = $this->input->post('status_perkawinan');
        $ktp = $this->input->post('ktp');
        $hp = $this->input->post('hp');

        $data = array(
            'karyawan_ID'=> $id['karyawan_ID'],
            'email'=>$email,
            'agama'=>$agama,
            'golongan_darah'=>$golongan_darah,
            'status_perkawinan'=>$statusP_perkawinan,
            'nomor_ktp'=>$ktp,
            'nomor_hp'=>$hp,
            'status'=> "Menunggu"
        );


        $this->db->insert('perubahan', $data);
        $this->session->set_flashdata('in',1);
        redirect(base_url()."index.php/karyawan/profile");
    }



    function logout()
    {
        $this->session->unset_userdata('username');
        redirect(base_url() . '');
    }
}