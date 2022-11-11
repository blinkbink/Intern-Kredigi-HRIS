<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:09
 */

class Cuti extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("cuti_model");
        $this->load->library("Pdf_Library");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index()
    {
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['id_karyawan'];
        }
        $dataCuti = $this->cuti_model->getCuti($id);
        $hitungCuti = $this->cuti_model->getCountCuti($id);
        $status = $this->cuti_model->getStatusCuti($id);

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view('cuti/cuti_tahunan', array('profile' => $profile, 'dataCuti' => $dataCuti, 'hitungCuti' => $hitungCuti, 'status' => $status, 'notifikasi' => $notifikasi, 'total' => $total));

    }

    public function add_cuti()
    {
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $id);

        $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
        $tanggal_cuti = date("Y-m-d", strtotime($this->input->post('tanggal_cuti')));
        $lama_cuti = $this->input->post('lama_cuti');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'id_karyawan'=> $id['idkaryawan'],
            'tanggal_pengajuan'=>$tanggal_pengajuan,
            'tanggal_cuti'=>$tanggal_cuti,
            'lama_cuti'=>$lama_cuti,
            'keterangan'=>$keterangan,
            'status'=> "Pending"
        );

        $this->db->insert('cuti', $data);
        redirect(base_url()."cuti");
    }

    public function detail_cuti($id)
    {
        $data = $this->cuti_model->getDetailCuti($id);

        $this->load->view("detail_cuti", array('data' => $data));
    }

    public function batal_cuti($id)
    {
        $where = array('id_cuti' => $id);
        $update_array = array(
            'status' => "Batal"
        );
        $update_data = $this->db->update('cuti', $update_array, $where);
        if($update_data != null)
        {
            redirect(base_url().'karyawan/cuti');
        }
    }

    public function edit_cuti($id)
    {
        $result = null;
        $data = $this->cuti_model->getDetailCuti($id);

        if(isset($_POST['submit']))
        {
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_cuti = date("Y-m-d", strtotime($this->input->post('tanggal_cuti')));
            $lama_cuti = $this->input->post('lama_cuti');
            $keterangan = $this->input->post('keterangan');

            $where = array('id_cuti' => $id);
            $update_array = array(
                'tanggal_pengajuan' => $tanggal_pengajuan,
                'tanggal_cuti' => $tanggal_cuti,
                'lama_cuti' => $lama_cuti,
                'keterangan' => $keterangan
            );
            $update_izin = $this->db->update('cuti', $update_array, $where);
            if($update_izin != null)
            {
                $result = '<div class="alert alert-success" role="alert">Sukses Mengubah Pengajuan Cuti Anda</div>';
            }
        }

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['id_karyawan'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view("cuti/edit_cuti", array('data' => $data, 'result' => $result, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function form_cuti()
    {
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['id_karyawan'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view("cuti/form_cuti", array('notifikasi' => $notifikasi, 'total' => $total));
    }
}