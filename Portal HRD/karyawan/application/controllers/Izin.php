<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:29
 */

class Izin extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("izin_model");
        $this->load->library("Pdf_Library");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index()
    {
        $this->load->model('karyawan_model');
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d);
        {
            $id_karyawan = $d['idkaryawan'];
        }
        $status = $this->izin_model->countStatusIzin($id_karyawan);
        $data = $this->izin_model->getIzin($id_karyawan);

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('izin/pengajuan_izin', array('data' => $data, 'status' => $status, 'notifikasi' => $notifikasi, 'total' => $total, 'profile' => $id));
    }

    public function edit_izin($id)
    {
        $report = null;
        $this->load->model("karyawan_model");
        $data = $this->izin_model->getDetailIzin($id);

        if(isset($_POST['submit']))
        {
            $report = null;
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $jenis_izin = $this->input->post('jenis_izin');
            $tanggal_izin = date('Y-m-d', strtotime($this->input->post('tanggal_izin')));
            $jumlah_hari_izin = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');

            $where = array('id_izin' => $id);
            $update_array = array(
                'tanggal_pengajuan' => $tanggal_pengajuan,
                'jenis' => $jenis_izin,
                'tanggal_izin' => $tanggal_izin,
                'jumlah_hari' => $jumlah_hari_izin,
                'keterangan' => $keterangan
            );
            $update_izin = $this->db->update('izin', $update_array, $where);
            if($update_izin != null)
            {
                $report = '<div class="alert alert-success" role="alert">Sukses Mengubah Pengajuan Izin Anda</div>';
            }
        }

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id_karyawan = $p['idkaryawan'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view("izin/ubah_izin", array('data' => $data, 'notifikasi' => $notifikasi, 'total' => $total, 'report' => $report));
    }

    public function detail_izin($id)
    {
        $this->load->model("karyawan_model");
        $data = $this->izin_model->getDetailIzin($id);

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id_karyawan = $p['idkaryawan'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view("izin/data_izin", array('data' => $data, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function form_izin()
    {
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d)
        {
            $id_karyawan = $d['idkaryawan'];
        }

        if (isset($_POST['submit']))
        {
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $jenis_izin = $this->input->post('jenis_izin');
            $tanggal_izin = date("Y-m-d", strtotime($this->input->post('tanggal_izin')));
            $jumlah_hari_izin = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');

            $data = array(
                'id_karyawan'=> $id_karyawan,
                'tanggal_pengajuan'=>$tanggal_pengajuan,
                'tanggal_izin'=>$tanggal_izin,
                'jumlah_hari'=>$jumlah_hari_izin,
                'jenis'=>$jenis_izin,
                'keterangan'=> $keterangan,
                'status'=> "Pending"
            );

            $update = $this->db->insert('izin', $data);
            if($update != 0)
            {
                redirect(base_url()."izin");
            }

        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('izin/input_izin', array('data' => $id, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function batal_izin($id)
    {
        $where = array('id_izin' => $id);
        $update_array = array(
            'status' => "Batal"
        );
        $update_data = $this->db->update('izin', $update_array, $where);
        if($update_data != null)
        {
            redirect(base_url().'Izin');
        }
    }
}